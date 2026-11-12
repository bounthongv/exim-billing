# VietinBank Notify API - Summary

## Endpoint

- **URL:** [https://invoice.apis.com.la/api/vietin/notify](https://invoice.apis.com.la/api/vietin/notify)

- **Method:** POST

- **Content-Type:** application/json

- **Hosted on:** apis.com.la (port 5006, Flask/Gunicorn, systemd service vietin-notify)

- **Proxied via:** Apache reverse proxy on invoice.apis.com.la

## IP Whitelist

Only accepts requests from VietinBank notification IPs:

- 103.37.29.214

- 203.171.16.106

- 14.238.134.102

## What the endpoint does

1. Receives a POST request from VietinBank with payment notification JSON

2. Verifies the sender IP is whitelisted

3. Parses the JSON payload (requestId, billNumber, amount, statusTransaction, etc.)

4. Checks idempotency (request\_id already in payment\_log -\> skip)

5. If payment successful (statusTransaction == 00): a. Looks up payments table by bill\_number -\> gets customer\_id and sale\_ids (JSON array) b. For each sale\_id in sale\_ids:

   - Updates product\_sale: sets status = 2 (paid), payment = amount, remain = 0

   - Gets sale\_date from product\_sale

   - Gets customer\_name from customers table

   - Inserts into customer\_payment with payment details c. Updates payments table: sets status = paid, paid\_at = now()

6. Logs the notification in payment\_log table

7. Responds with 200 OK + Notify API response format

## Tables and fields updated

### 1. product\_sale (UPDATE)

- status -\> set to '2' (paid)
- payment -\> amount from VTB notification
- remain -\> set to '0'
- Matched by: sale\_id (from payments.sale\_ids)

### 2. customer\_payment (INSERT)

- payment\_id -\> MAX(payment\_id) + 1 (running number, starts at 400001)

- payment\_date -\> current date (YYYY-MM-DD)

- customer\_id -\> from payments.customer\_id

- sale\_id -\> from payments.sale\_ids (each item)

- sale\_date -\> from product\_sale.sale\_date

- amount -\> amount from VTB notification

- total\_amount -\> same as amount

- payment\_type -\> 2

- cur\_lak -\> same as amount

- rate\_lak -\> 1

- total\_lak -\> same as amount

- payment\_name -\> customer\_name from customers table

- receipt\_name -\> api

- user\_id -\> API

- user\_date -\> current date

- Other fields (cur\_thb, cur\_usd, rate\_thb, rate\_usd, remark, Bank\_account, office\_id) -\> NULL/blank

### 3. payments (UPDATE)

- status -\> paid

- paid\_at -\> current datetime

- Matched by: bill\_number

### 4. payment\_log (INSERT - for audit)

- request\_id, bill\_number, amount, customer\_number, acct\_no, bank\_code

- status\_transaction, remark, merchant\_id, terminal\_id, transaction\_date

- is\_success (1 if statusTransaction == 00, else 0)

- client\_ip, created\_at

## Source data flow

VTB sends notification with billNumber | v Lookup payments table: bill\_number -\> customer\_id + sale\_ids (JSON array) | v For each sale\_id: - Update product\_sale: status=2, payment=amount, remain=0 - Insert customer\_payment record | v Update payments.status = paid | v Log in payment\_log | v Respond 200 OK

## Handling of non-successful payments

The VTB Notify API sends statusTransaction field with the following values:

| Status | Meaning | Action taken by webhook |
| - | - | - |
| 00 | Success | Full processing: update product\_sale, insert customer\_payment, update payments, log |
| 01 | Already paid previously | Logged only (no DB update, idempotency) |
| 02 | Invalid transaction | Logged only (no DB update) |
| 03 | Transaction not found | Logged only (no DB update) |
| 04 | Invalid amount | Logged only (no DB update) |
| 05 | Transaction expired | Logged only (no DB update) |
| 08 | Timeout | Logged only (no DB update) |
| 09 | Maintenance | Logged only (no DB update) |


### For non-success (statusTransaction != 00):

1. The notification is still logged in payment\_log with is\_success = 0

2. No updates are made to product\_sale, customer\_payment, or payments tables

3. The webhook still responds with 200 OK (so VTB does not retry)

4. The payments table status remains pending (or whatever it was before)

5. The customer payment page will continue polling but will not show Paid

### Important notes:

- VTB may send multiple notifications for the same transaction (retries). The webhook handles this via idempotency check on request\_id.

- For failed/expired/timeout cases, the payments table keeps status = pending so the customer can retry payment.

- The expires\_at field in the payments table tracks QR code expiry. The application should check this and regenerate QR if expired.

- VTB marks some failures as Refunded after reconciliation - the application should handle reconciliation separately if needed.

## Related tables (read-only lookups)

- customers -\> customer\_name (by customer\_id)

- product\_sale -\> sale\_date (by sale\_id)

## Files

- /home/apis/vietin-notify/backend/app.py - Flask application

- /home/apis/vietin-notify/backend/config.py - Configuration

- /home/apis/vietin-notify/backend/venv/ - Python virtual environment

- /etc/systemd/system/vietin-notify.service - Systemd service

- /etc/apache2/sites-available/invoice.apis.com.la.conf - Apache proxy (HTTP)

- /etc/apache2/sites-available/invoice.apis.com.la-le-ssl.conf - Apache proxy (HTTPS)

