# Intralinks Pay

A PHP-based payment processing application using the Checkout.com SDK for handling secure payments.

## Description

This project provides a web interface for processing payments through Checkout.com. It includes forms for entering payment details, processing transactions, and displaying success pages. The application sends email notifications to admins, team members, and customers upon successful payment.

## Features

- Secure payment processing with Checkout.com
- Support for multiple currencies (USD, EUR, GBP, JPY, BRL)
- Email notifications for successful transactions
- Responsive web interface
- Invoice number support with multiple entries

## Prerequisites

- PHP 7.4 or higher
- Composer (for dependency management)
- A web server (e.g., Apache, Nginx)
- Checkout.com account with API credentials

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/stagingprod/IntraLinks-checkout.git
   cd intralinks-pay
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Configure the application (see Configuration section below).

4. Ensure your web server is configured to serve PHP files and point to the project directory.

## Easy Setup Guide (For Users)

### Step 1: Create Your Configuration File

1. Look for a file named `config.php.example` in your project folder.
2. Make a copy of this file and rename the copy to `config.php`.
   - On Windows: Right-click the file, select "Copy", then right-click and select "Paste", then rename to `config.php`.
   - On Mac: Right-click the file, select "Duplicate", then rename to `config.php`.

### Step 2: Add Your Payment Credentials

1. Open the new `config.php` file with a text editor (like Notepad on Windows or TextEdit on Mac).
2. You'll see some text that looks like code. Don't worry - you just need to replace a few specific parts.

#### Finding Your Credentials from Checkout.com:

1. Go to your Checkout.com account dashboard.
2. Look for a section called "Keys" or "API Keys".
3. Find your "Secret Key" - it usually starts with "sk_".
4. Also find your "Processing Channel ID" - it usually starts with "pc_".

#### Adding the Credentials:

In the `config.php` file, find these lines and replace the placeholder text:

- Find: `'secret_key' => 'YOUR_API_SECRET_KEY_HERE'`
  - Replace with: `'secret_key' => 'sk_your_actual_key_from_checkout'`

- Find: `'processing_channel_id' => 'YOUR_PROCESSING_CHANNEL_ID_HERE'`
  - Replace with: `'processing_channel_id' => 'pc_your_actual_channel_id_from_checkout'`

- Find: `'admin' => 'admin@example.com, another-admin@example.com'`
  - Replace with your admin email addresses, separated by commas
  - Example: `'admin' => 'boss@company.com, manager@company.com'`

- Find: `'team' => 'team@example.com, another-team@example.com'`
  - Replace with your team email addresses, separated by commas
  - Example: `'team' => 'support@company.com, sales@company.com'`

#### Environment Setting:

- For testing: Keep `'environment' => 'sandbox'`
- For real payments: Change to `'environment' => 'production'`

### Step 3: Save and Test

1. Save the `config.php` file.
2. Make sure your web server is running (ask your IT person if needed).
3. Open your web browser and go to your website address.
4. Try making a test payment to see if everything works.

### Important Notes:

- **Never share your secret key with anyone!** It's like a password for your payment system.
- If you're testing, use the "sandbox" mode first.
- If you have questions, ask your technical team or Checkout.com support.
- Keep your `config.php` file safe and don't upload it to any public websites.

## Usage

1. Access the application through your web browser (e.g., `http://localhost/intralinks-pay/`).

2. Fill out the payment form with the required details:
   - Invoice Number(s)
   - Currency
   - Amount
   - Customer information
   - Card details
   - Billing information

3. Submit the form to process the payment.

4. Upon successful payment, you'll be redirected to a success page, and email notifications will be sent.

## File Structure

- `index.php` - Main payment form page
- `create-payment-session.php` - Handles payment processing
- `success.php` - Success page after payment
- `config.php` - Configuration file (not committed)
- `config.php.example` - Example configuration template
- `composer.json` - PHP dependencies
- `css/style.css` - Custom styles
- `images/` - Static images (logo, favicon, etc.)

## Dependencies

- Checkout.com PHP SDK
- Bootstrap 5.3.0 (for styling)
- jQuery 3.6.0
- Font Awesome 6.7.2
- Tagify 4.9.0 (for invoice input)

## Security Considerations

- This application handles sensitive payment information. Ensure HTTPS is enabled in production.
- Regularly update dependencies to address security vulnerabilities.
- Implement proper logging and monitoring for production use.
- Validate all user inputs to prevent injection attacks.

## Contributing

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes and test thoroughly.
4. Commit your changes: `git commit -am 'Add new feature'`
5. Push to the branch: `git push origin feature-name`
6. Submit a pull request.

## License

This project is proprietary software. All rights reserved by Intralinks, SS&C Inc.

## Support

For support or questions, please contact the development team or refer to the Checkout.com documentation.
