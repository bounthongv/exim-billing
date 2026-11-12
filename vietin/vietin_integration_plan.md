# VietinBank QR API Integration Plan

## Overview
This document outlines the complete integration plan between the shopping.exim.la web application and VietinBank's QR API for beer cost payments. The process involves requesting a QR code from VietinBank and then receiving payment notifications via a webhook.

## 1. Requesting QR Code (GenQR API - Outgoing)

The application sends a POST request to VietinBank's API to generate a QR code.

### 1.1. API Endpoint & Connection
- **UAT Endpoint:** https://(ip address or domain name):(port) (Provided by VTB, e.g., https://api-uat.vietinbank.com.la/vtb/api/v1/create/qr)
- **Method:** POST
- **Content-Type:** application/json
- **Protocol:** HTTPS

### 1.2. Request Headers
The API input message is a JSON message. The header section must contain the following information:

| Key | Description |
|-----|-------------|
| X-Source-Request-Verify | Value generated with the MD5 hash function: "key" + merchantId + terminalId + merchantName + billNumber. Field values taken from the request body. The "key" field is provided by VTB. (From ConfigUAT_QR_EXIM.xlsx: PM88) |
| X-Source-Router | Provided by VTB. (From ConfigUAT_QR_EXIM.xlsx: genqr) |
| User | Provided by VTB. (From ConfigUAT_QR_EXIM.xlsx: EXIM) |
| Passwd | Provided by VTB. (From ConfigUAT_QR_EXIM.xlsx: Ab123456) |

### 1.3. Request Body (GenQR)
All fields are required (Man. = Yes).

| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| requestId | Yes | String | 32 | Unique identifier of the transaction. |
| channelId | Yes | String | 10 | Channel used to perform the transaction. e.g. MOBILE, WEB, POS, BRANCH |
| merchantId | Yes | String | 25 | Payment merchant ID. Code configured by VietinBank on the system. |
| terminalId | Yes | String | 50 | TerminalId of the merchant. Code configured by VietinBank on the system. |
| merchantName | Yes | String | 50 | Merchant name, without diacritics. |
| amount | Yes | String | 50 | Amount to be paid. |
| merchantCity | Yes | String | 20 | City of the merchant. |
| billNumber | Yes | String | 30 | Bill number to be paid. |
| expDate | Yes | String | 100 | Expiry time for QR payment. Format: yyyyMMddHHmm (e.g. 202403161722) |
| customerNumber | Yes | String | 100 | Customer code of the unit that requests the QR generation, passed in. |
| purpose | Yes | String | N/A | Transaction content passed in when generating the QR. |
| currency | Yes | String | 4 | Currency. |
| preseve1 | Yes | String | N/A | Reserved field. |
| preseve2 | Yes | String | N/A | Reserved field. |
| preseve3 | Yes | String | N/A | Reserved field. |

Sample Request:
```json
{
    "requestId": "{{$guid}}",
    "channelId": "WEB",
    "merchantId": "9956789999",
    "terminalId": "LAVIE",
    "merchantName": "LAVIE",
    "amount": "250000",
    "merchantCity": "Vientiane",
    "billNumber": "A23456789aA12",
    "expDate": "202403161722",
    "customerNumber": "A37563",
    "purpose": "Iced coffee",
    "currency": "LAK",
    "preseve1": "",
    "preseve2": "",
    "preseve3": ""
}
```

### 1.4. Response Body (GenQR)
All fields are required (Man. = Yes).

| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| requestId | Yes | String | 32 | Unique identifier of the transaction. |
| qrData | Yes | String | 500 | QR code generated and returned by the server. |
| merchantId | Yes | String | 25 | Payment merchant ID. |
| terminalId | Yes | String | 50 | TerminalId of the merchant. |
| status | Yes | statusObject | | Processing status. |

Description of statusObject:
| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| code | Yes | String | 2 | Status code. |
| message | Yes | String | 500 | Description of the processing status. |

Sample Response:
```json
{
    "requestId": "288b2b73-be70-43a4-95ca-3af8411a4bc9",
    "status": {
        "code": "00",
        "message": "Success"
    },
    "qrData": "00020101021238550016A0052662846625770108701204180203002031290400002536252049999530341854062500005802LA5905LAVIE6009Vientiane62910113A23456789aA120310995678999904122024031617220506A333LA0606A375630705LAVIE0811Iced coffee63044313",
    "merchantId": "9956789999",
    "terminalId": "LAVIE"
}
```

### 1.5. GenQR API Status Codes
| No. | Status | Description |
|-----|--------|-------------|
| 1 | 00 | Processed successfully. |
| 2 | 01 | The QR does not belong to the QrPay payment flow; it follows the money transfer flow. |
| 3 | 02 | The transaction does not exist. |
| 4 | 03 | The transaction has already been completed successfully; no second update is performed. |
| 5 | 04 | The transaction's bill number has already been paid successfully; no second payment is performed. |
| 6 | 40 | Duplicate transaction code. |
| 7 | 41 | A mandatory field must not be passed in empty. |
| 8 | 42 | The expiry time passed in is not in the yyyyMMddHHmm format. |
| 9 | 43 | The merchant / terminal information passed in is incorrect. |
| 10 | 44 | The QR is not in the correct format. |
| 11 | 45 | The QR has expired for payment. |
| 12 | 95 | input data is null. |
| 13 | 96 | Execution error (try / catch). |

## 2. Handling Payment Notifications (Notify API - Incoming Webhook)

VTB system calls the partner's service to send transaction information. The partner uses this to write off the customer's bill.

### 2.1. Flow
1. The customer scans the QR code to pay.
2. VTB processes the payment and returns the transaction result (success or failure) through the Notify API.
3. Lavie uses the transaction result to write off the customer's bill.
4. Response of the Notify API.

### 2.2. API Endpoint & Connection
- **MAIN_URL:** https://(ip address or domain name):(port) --- (Provided by partner)
- **Method:** POST
- **Content-Type:** application/json

### 2.3. Request Body (Notify API)
All fields are required (Man. = Yes).

| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| requestId | Yes | String | 32 | Unique identifier of the transaction. |
| billNumber | Yes | String | 12 | Bill number. |
| amount | Yes | String | 13 | Payment amount. |
| customerNumber | Yes | String | 250 | Customer name or customer code. |
| acctNo | Yes | String | 15 | Account of the sending party. |
| bankcode | Yes | String | 15 | Code of the sending bank. |
| statusTransaction | Yes | String | 4 | Transaction status. Success = 00 |
| remark | Yes | String | 500 | Payment content. |
| merchantId | Yes | String | 25 | Payment merchant ID. |
| terminalId | Yes | String | 50 | TerminalId of the merchant. |
| transactionDate | Yes | String | 50 | Time at which the customer made the payment. Format: yyyyMMddHHmmss (e.g. 20240520150611) |
| preseve1 | Yes | String | N/A | Reserved field. |
| preseve2 | Yes | String | N/A | Reserved field. |
| preseve3 | Yes | String | N/A | Reserved field. |

Sample Request:
```json
{
    "requestId": "{{$guid}}",
    "billNumber": "A23456789aA12",
    "amount": "250000",
    "customerNumber": "A37563",
    "acctNo": "904000025362",
    "bankcode": "BCEL",
    "statusTransaction": "00",
    "remark": "Iced coffee",
    "terminalId": "YHANOI",
    "merchantId": "0899999999",
    "transactionDate": "20240503170957",
    "preseve1": "",
    "preseve2": "",
    "preseve3": ""
}
```

### 2.4. Response Body (Notify API)
All fields are required (Man. = Yes).

| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| requestId | Yes | String | 32 | Unique identifier of the transaction. |
| billNumber | Yes | String | 12 | Bill number. |
| merchantId | Yes | String | 25 | Payment merchant ID. |
| terminalId | Yes | String | 50 | TerminalId of the merchant. |
| status | Yes | statusObject | | Processing status. |

Description of statusObject:
| Field name | Man. | Format | Len. | Description |
|------------|------|--------|------|-------------|
| code | Yes | String | 2 | Status code. |
| message | Yes | String | 500 | Description of the processing status. |

Sample Response:
```json
{
    "requestId": "{{$guid}}",
    "billNumber": "A23456789aA12",
    "terminalId": "YHANOI",
    "merchantId": "0899999999",
    "status": {
        "code": "00",
        "message": "Success"
    }
}
```

### 2.5. Notify API Status Codes
| No. | Status | Description | Remarks |
|-----|--------|-------------|---------|
| 1 | 00 | Processed successfully. | |
| 2 | 01 | The transaction was already paid previously. | Refunded after reconciliation. |
| 3 | 02 | Invalid transaction. | Refunded after reconciliation. |
| 4 | 03 | Transaction not found. | Refunded after reconciliation. |
| 5 | 04 | Invalid amount. | Refunded after reconciliation. |
| 6 | 05 | The transaction has expired for payment. | Refunded after reconciliation. |
| 7 | 08 | Timeout. | Undetermined - awaiting reconciliation. |
| 8 | 09 | Maintenance. | Refunded after reconciliation. |

## 3. Error Handling and Logging

- **Robust Logging:** Implement detailed logging for both outgoing QR requests and incoming payment notifications (request body, response, timestamps, errors).
- **Idempotency:** Ensure the payment notification handler is idempotent, meaning processing the same notification multiple times does not lead to incorrect data (e.g., double-crediting an account). This is crucial if VietinBank retries sending notifications.

## 4. Status

- **GenQR API (Outgoing):** Already implemented and connected successfully. No further work needed.

## 5. Action Items for Notify API (Incoming Webhook)

- [ ] **Develop Incoming Webhook Endpoint:** Create the PHP script (e.g., `vietin_payment_callback.php`) to receive, verify, and process payment notifications from VietinBank.
- [ ] **Parse Payload:** Extract `requestId`, `billNumber`, `amount`, `statusTransaction`, `transactionDate`, etc. from the incoming JSON request body.
- [ ] **Verify Request Authenticity:** Implement security checks (IP whitelist: `103.37.29.214`, `203.171.16.106`, `14.238.134.102`, or a signature/HMAC from the PDF spec) to ensure the notification is from VietinBank.
- [ ] **Update Database:** Based on `statusTransaction` (`00` = success), update the corresponding order/invoice record in the `exim_stock` database (e.g., set `payment_status = 'Paid'`).
- [ ] **Idempotency:** Ensure the handler is idempotent - processing the same notification multiple times must not lead to double-crediting. Check if the transaction was already processed before updating.
- [ ] **Acknowledge Receipt:** Respond with HTTP `200 OK` and the Notify API response body (requestId, billNumber, merchantId, terminalId, status) to confirm successful processing.
- [ ] **Robust Logging:** Log all incoming notifications (request body, response, timestamps, errors) for debugging and audit.
- [ ] **Configure Server:** Ensure the `shopping.exim.la` server (Apache/Nginx) is configured to allow `POST` requests to the new webhook endpoint.
- [ ] **Whitelist IP:** Ensure VietinBank's notification IPs are whitelisted on your server firewall if necessary.
- [ ] **Testing:** Thoroughly test the Notify API in the UAT environment, simulating successful and failed payments, duplicate notifications, and invalid payloads.

## 6. UI / Customer Experience Consideration

After generating the QR code and displaying it on the payment page:

1. The customer scans the QR with their bank app and pays.
2. VTB processes the payment and calls our webhook (Notify API) in the background.
3. Our database gets updated (`payment_status = 'Paid'`).
4. **Problem:** The customer's browser doesn't know the payment succeeded — it only knows it showed a QR code.
5. **Solution:** The payment page should poll our database (e.g., every 3-5 seconds via AJAX) to check if `payment_status` has changed to `Paid`. Once it detects `Paid`, show a success message and redirect/refresh.
6. If the customer clicks "Cancel" or the QR expires, stop polling and show an appropriate message.

This way the customer sees real-time feedback without needing a page refresh, while the actual payment confirmation comes from VTB via the webhook (not from the customer clicking a button).