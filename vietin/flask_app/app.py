import os
import logging
import json
from datetime import datetime, date
from flask import Flask, request, jsonify

from config import settings

log_handlers = [logging.StreamHandler()]
try:
    log_dir = os.path.dirname(settings.log_file)
    if log_dir:
        os.makedirs(log_dir, exist_ok=True)
    log_handlers.append(logging.FileHandler(settings.log_file))
except Exception as e:
    print(f"Warning: Could not create log file {settings.log_file}: {e}")

logging.basicConfig(
    level=getattr(logging, settings.log_level),
    format="%(asctime)s - %(name)s - %(levelname)s - %(message)s",
    handlers=log_handlers
)
logger = logging.getLogger(__name__)

app = Flask(__name__)

import pymysql

def get_db_connection():
    return pymysql.connect(
        host=settings.db_host,
        port=settings.db_port,
        user=settings.db_user,
        password=settings.db_password,
        database=settings.db_name,
        charset="utf8mb4",
        cursorclass=pymysql.cursors.DictCursor
    )

@app.route("/health", methods=["GET"])
def health():
    return jsonify({"status": "ok", "service": "vietin-notify"}), 200

@app.route("/api/vietin/notify", methods=["POST"])
def vietin_notify():
    client_ip = request.headers.get('X-Forwarded-For', request.remote_addr).split(',')[0].strip()
    logger.info(f"Notify request from IP: {client_ip}")

    if client_ip not in settings.vtb_ips:
        logger.warning(f"Rejected request from non-whitelisted IP: {client_ip}")
        return jsonify({"error": "Forbidden"}), 403

    try:
        data = request.get_json(force=True)
    except Exception as e:
        logger.error(f"Failed to parse JSON: {e}")
        return jsonify({"error": "Bad Request"}), 400

    if not data:
        logger.error("Empty request body")
        return jsonify({"error": "Bad Request"}), 400

    logger.info(f"Notify payload: {json.dumps(data)}")

    request_id = data.get("requestId", "")
    bill_number = data.get("billNumber", "")
    amount = data.get("amount", "")
    customer_number = data.get("customerNumber", "")
    acct_no = data.get("acctNo", "")
    bank_code = data.get("bankcode", "")
    status_transaction = data.get("statusTransaction", "")
    remark = data.get("remark", "")
    merchant_id = data.get("merchantId", "")
    terminal_id = data.get("terminalId", "")
    transaction_date = data.get("transactionDate", "")

    if not request_id or not bill_number:
        logger.error("Missing required fields: requestId or billNumber")
        return jsonify({"error": "Bad Request - missing requestId or billNumber"}), 400

    is_success = (status_transaction == "00")

    conn = None
    try:
        conn = get_db_connection()
        with conn.cursor() as cursor:
            cursor.execute("""
                CREATE TABLE IF NOT EXISTS payment_log (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    request_id VARCHAR(64) NOT NULL,
                    bill_number VARCHAR(64) NOT NULL,
                    amount VARCHAR(32),
                    customer_number VARCHAR(256),
                    acct_no VARCHAR(32),
                    bank_code VARCHAR(32),
                    status_transaction VARCHAR(8),
                    remark VARCHAR(512),
                    merchant_id VARCHAR(64),
                    terminal_id VARCHAR(64),
                    transaction_date VARCHAR(32),
                    is_success TINYINT(1) DEFAULT 0,
                    client_ip VARCHAR(64),
                    created_at DATETIME,
                    UNIQUE KEY uk_request_id (request_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            """)
            conn.commit()

            cursor.execute(
                "SELECT COUNT(*) as cnt FROM payment_log WHERE request_id = %s",
                (request_id,)
            )
            row = cursor.fetchone()
            if row and row["cnt"] > 0:
                logger.info(f"Duplicate notification for requestId: {request_id}")
                return jsonify({
                    "requestId": request_id,
                    "billNumber": bill_number,
                    "merchantId": merchant_id,
                    "terminalId": terminal_id,
                    "status": {"code": "00", "message": "Success"}
                }), 200

            if is_success:
                cursor.execute(
                    "SELECT customer_id, sale_ids FROM payments WHERE bill_number = %s",
                    (bill_number,)
                )
                payment_row = cursor.fetchone()

                if payment_row:
                    customer_id = payment_row["customer_id"]
                    sale_ids_json = payment_row["sale_ids"]
                    try:
                        sale_ids = json.loads(sale_ids_json) if sale_ids_json else []
                    except (json.JSONDecodeError, TypeError):
                        sale_ids = [s.strip().strip('"') for s in str(sale_ids_json).strip("[]").split(",")]

                    logger.info(f"Found payment: customer_id={customer_id}, sale_ids={sale_ids}")

                    cursor.execute(
                        "SELECT customer_name FROM customers WHERE customer_id = %s",
                        (customer_id,)
                    )
                    cust_row = cursor.fetchone()
                    customer_name = cust_row["customer_name"] if cust_row else ""

                    today = datetime.now().strftime("%Y-%m-%d")

                    for sale_id in sale_ids:
                        sale_id = sale_id.strip()

                        cursor.execute(
                            "UPDATE product_sale SET status = %s, payment = %s, remain = %s WHERE sale_id = %s",
                            ('2', amount, '0', sale_id)
                        )
                        logger.info(f"Updated product_sale for sale_id={sale_id}: status=2, payment={amount}, remain=0, rows={cursor.rowcount}")

                        cursor.execute(
                            "SELECT sale_date, remain FROM product_sale WHERE sale_id = %s LIMIT 1",
                            (sale_id,)
                        )
                        ps_row = cursor.fetchone()
                        sale_date = ps_row["sale_date"] if ps_row else None
                        remain_amount = ps_row["remain"] if ps_row and ps_row.get("remain") else amount

                        if isinstance(sale_date, (datetime, date)):
                            sale_date_str = sale_date.strftime("%Y-%m-%d")
                        else:
                            sale_date_str = str(sale_date) if sale_date else today

                        cursor.execute("SELECT COALESCE(MAX(payment_id), 400000) + 1 as next_id FROM customer_payment")
                        next_pay = cursor.fetchone()
                        payment_id = next_pay["next_id"] if next_pay else 400001

                        cursor.execute(
                            """INSERT INTO customer_payment
                               (payment_id, payment_date, customer_id, sale_id, sale_date,
                                amount, total_amount, payment_type, cur_lak, rate_lak,
                                total_lak, payment_name, receipt_name, user_id, user_date)
                               VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""",
                            (payment_id, today, customer_id, sale_id, sale_date_str,
                             str(remain_amount), str(remain_amount), "2", str(remain_amount),
                             "1", str(remain_amount), customer_name, "api", "API", today)
                        )
                        logger.info(f"Inserted customer_payment: payment_id={payment_id}, sale_id={sale_id}")

                cursor.execute(
                    "UPDATE payments SET status = 'paid', paid_at = %s WHERE bill_number = %s",
                    (datetime.now(), bill_number)
                )
                logger.info(f"Updated payments status=paid for bill_number={bill_number}")

            cursor.execute(
                """INSERT INTO payment_log
                   (request_id, bill_number, amount, customer_number, acct_no, bank_code,
                    status_transaction, remark, merchant_id, terminal_id, transaction_date,
                    is_success, client_ip, created_at)
                   VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""",
                (request_id, bill_number, amount, customer_number, acct_no, bank_code,
                 status_transaction, remark, merchant_id, terminal_id, transaction_date,
                 1 if is_success else 0, client_ip, datetime.now())
            )
            conn.commit()
            logger.info(f"Payment notification processed: requestId={request_id}, billNumber={bill_number}")

    except Exception as e:
        logger.error(f"Database error: {e}")
        if conn:
            conn.rollback()
        return jsonify({"error": "Internal Server Error"}), 500
    finally:
        if conn:
            conn.close()

    return jsonify({
        "requestId": request_id,
        "billNumber": bill_number,
        "merchantId": merchant_id,
        "terminalId": terminal_id,
        "status": {"code": "00", "message": "Success"}
    }), 200

if __name__ == "__main__":
    app.run(host=settings.api_host, port=settings.api_port, debug=settings.api_debug)
