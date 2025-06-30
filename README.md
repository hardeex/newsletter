# Essential Nigeria Newsletter API

A robust and flexible API for subscribing, unsubscribing, and managing newsletters. This API ensures smooth communication with users while maintaining security through throttling, bot protection, and IP blocklists.

---

## **Features**

* **Email Subscription:** Users can subscribe to the newsletter using their email address and platform information.
* **Email Resubscription:** If a user is already subscribed and unsubscribed, they will receive a re-subscription process with a welcome email.
* **Unsubscription:** Users can unsubscribe using a unique token, preventing further communications.
* **Bot Detection:** Honeypot field used to detect bots and prevent spam sign-ups.
* **IP Blocklist:** Protects the system from blacklisted IP addresses.
* **Rate Limiting:** Throttles requests to prevent abuse (2 requests per minute per user).

---

## **Installation**

### **Prerequisites**

* PHP >= 8.0
* Laravel >= 8.x
* Composer
* MySQL or other database systems supported by Laravel
* Mailer setup (e.g., SMTP, Mailgun, etc.)

### **Steps to Set Up the Project**

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/hardeex/newsletter
   cd essential-newsletter-api
   ```

2. **Install Dependencies:**

   Run the following command to install the required PHP dependencies:

   ```bash
   composer install
   ```

3. **Set Up Environment Configuration:**

   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

4. **Generate the Application Key:**

   ```bash
   php artisan key:generate
   ```

5. **Configure Your Mail Service:**

   Ensure you have the correct mail configuration in the `.env` file. Example configuration for SMTP:

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="no-reply@essentialnews.ng"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

6. **Set Up the Database:**

   Run the following command to create your database and apply migrations:

   ```bash
   php artisan migrate
   ```

   You can modify your database settings in the `.env` file as needed.

---

## **API Endpoints**

### **1. POST /subscribe**

#### **Description:**

Subscribe a user to the newsletter. If the email is already subscribed, a re-subscription process will occur with the welcome email being resent.

#### **Request URL:**

`POST https://news-letter.essentialnews.ng/api/subscribe`

#### **Request Headers:**

* `Content-Type`: `application/json`

#### **Request Body Parameters:**

| Field      | Type   | Description                                                                                  | Example                            |
| ---------- | ------ | -------------------------------------------------------------------------------------------- | ---------------------------------- |
| `email`    | string | **Required**. The email address of the subscriber.                                           | `newslleteeee44eeteeest@gmail.com` |
| `platform` | string | **Required**. The platform or website where the user is subscribing from.                    | `adex website`                     |
| `honeypot` | string | **Optional**. Hidden field used to trap bots. If filled, the request is considered as a bot. | `null`                             |

#### **Response:**

* **Success (New Subscription):**

  ```json
  {
      "message": "Successfully subscribed!"
  }
  ```

* **Success (Already Subscribed - Welcome Email Sent Again):**

  ```json
  {
      "message": "This email is already subscribed, but we’ve resent the welcome email!"
  }
  ```

* **Error (Email Already Subscribed):**

  ```json
  {
      "message": "This email is already subscribed."
  }
  ```

* **Error (IP Blocked):**

  ```json
  {
      "message": "Your IP has been blacklisted."
  }
  ```

* **Error (Bot Detected):**

  ```json
  {
      "message": "Bot detected. Subscription rejected."
  }
  ```

* **Error (Internal Server Error):**

  ```json
  {
      "message": "An error occurred while processing your subscription."
  }
  ```

---

### **2. GET /unsubscribe/{token}**

#### **Description:**

Unsubscribe a user from the newsletter using a unique token that was provided during the subscription process.

#### **Request URL:**

`GET https://news-letter.essentialnews.ng/api/unsubscribe/{token}`

#### **Path Parameters:**

| Field   | Type   | Description                                                        | Example                                                        |
| ------- | ------ | ------------------------------------------------------------------ | -------------------------------------------------------------- |
| `token` | string | **Required**. The unique token sent to the user for unsubscribing. | `Ti80i950TpTAjhy1W8psBBRcizVA3TgMgK08gGrEJcIhzUwdEV49fkTgtL2j` |

#### **Response:**

* **Success (Unsubscribed):**

  ```json
  {
      "message": "You have been successfully unsubscribed."
  }
  ```

* **Error (Invalid or Expired Token):**

  ```json
  {
      "message": "Invalid or expired unsubscribe link."
  }
  ```

---

## **Rate Limiting**

The `/subscribe` route has a rate limit of **2 requests per minute per user** to prevent abuse, enforced by the `custom_throttle` middleware (`2,1`).

---

## **Error Handling**

The API returns JSON responses with appropriate HTTP status codes:

* **200 OK**: Successful request.
* **201 Created**: New resource created (e.g., new subscriber).
* **400 Bad Request**: Invalid request (e.g., email already exists).
* **403 Forbidden**: IP blocked due to blacklisting.
* **404 Not Found**: Unsubscribe link invalid or expired.
* **500 Internal Server Error**: Unexpected server errors.

---

## **Contributing**

We welcome contributions to improve the functionality and features of this project. To contribute:

1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Submit a pull request with a clear description of your changes.

---

## **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## **Contact**

For any questions or support, feel free to reach out to us at:

* **Email**: [webmasterjdd@gmail.com](mailto:webmasterjdd@gmail.com)
* **Website**: [https://dev.connectnesthub.com/](https://dev.connectnesthub.com/)

---

