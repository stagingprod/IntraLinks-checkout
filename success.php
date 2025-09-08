<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$config = require 'config.php';

$invoice_number_json = isset($_GET['invoice_number']) ? $_GET['invoice_number'] : null;
$payment_response = isset($_SESSION['payment_response']) ? $_SESSION['payment_response'] : null;

if ($invoice_number_json) {
    $invoice_number_data = json_decode($invoice_number_json, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($invoice_number_data)) {
        if (isset($invoice_number_data[0]['value'])) {
            $invoice_numbers = array_column($invoice_number_data, 'value');
        } else {
            $invoice_numbers = $invoice_number_data;
        }
        $invoice_number = implode(', ', $invoice_numbers);
    } else {
        $invoice_number = $invoice_number_json;
    }
} else {
    $invoice_number = null;
}

if (!$payment_response) {
    header('Location: error.php');
    exit();
}

$adminemails = explode(',', $config['emails']['admin']); 
$teamemails = explode(',', $config['emails']['team']); 

if (!empty($payment_response['customer']['email'])) {
    $to = $payment_response['customer']['email'];
}

$subject = "Payment Received – Invoice $invoice_number";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: do_not_reply@intralinks.com\r\n";

$email_body = "<html>
<body>
    <p>Dear Admin,</p> <p>A new payment has been successfully processed. Below are the transaction details:</p>";


$email_body .= "<h3>Payment Details:</h3><ul>";

if (!empty($invoice_number)) {
    $email_body .= "<li><strong>Invoice Number:</strong> " . $invoice_number . "</li>";
}

if (!empty($payment_response['processed_on'])) {
    $email_body .= "<li><strong>Date:</strong> " . date('F j, Y', strtotime($payment_response['processed_on'])) . "</li>";
}

if (!empty($payment_response['amount']) && !empty($payment_response['currency'])) {
    $email_body .= "<li><strong>Amount:</strong> " . number_format($payment_response['amount'] / 100, 2) . ' ' . $payment_response['currency'] . "</li>";
}

if (!empty($payment_response['id'])) {
    $email_body .= "<li><strong>Payment ID:</strong> {$payment_response['id']}</li>";
}

if (!empty($payment_response['source']['card_type']) && !empty($payment_response['source']['last4'])) {
    $email_body .= "<li><strong>Card Type:</strong> {$payment_response['source']['card_type']} (**** **** **** {$payment_response['source']['last4']})</li>";
}


if (!empty($payment_response['source']['scheme'])) {
    $email_body .= "<li><strong>Scheme:</strong> {$payment_response['source']['scheme']}</li>";
}

if (!empty($payment_response['customer']['name'])) {
    $email_body .= "<li><strong>Name:</strong> {$payment_response['customer']['name']}</li>";
}

if (!empty($payment_response['customer']['email'])) {
    $email_body .= "<li><strong>Email:</strong> {$payment_response['customer']['email']}</li>";
}

if (!empty($payment_response['source']['phone']['country_code']) && !empty($payment_response['source']['phone']['number'])) {
    $email_body .= "<li><strong>Phone:</strong> {$payment_response['source']['phone']['country_code']} {$payment_response['source']['phone']['number']}</li>";
}

if (!empty($payment_response['source']['billing_address'])) {
    $billing = $payment_response['source']['billing_address'];
    $email_body .= "<li><strong>Billing Address:</strong> " .
        (!empty($billing['address_line1']) ? "{$billing['address_line1']}, " : '') .
        (!empty($billing['city']) ? "{$billing['city']}, " : '') .
        (!empty($billing['state']) ? "{$billing['state']}, " : '') .
        (!empty($billing['country']) ? "{$billing['country']}, " : '') .
        (!empty($billing['zip']) ? "{$billing['zip']}" : '') .
    "</li>";
}

$email_body .= "</ul>

<p>The payment has been successfully received. Please verify and update the records accordingly.</p>        
<p>For any issues or queries, please follow up as needed.</p>  <br> 
<p>Best Regards,<br>Intralinks</p>

</body>
</html>";


$team_email_body = "<html>
<body>
    <p>Dear Team,</p> <p>A new payment has been successfully processed. Below are the transaction details:</p>";


$team_email_body .= "<h3>Payment Details:</h3><ul>";

if (!empty($invoice_number)) {
    $team_email_body .= "<li><strong>Invoice Number:</strong> " . $invoice_number . "</li>";
}

if (!empty($payment_response['processed_on'])) {
    $team_email_body .= "<li><strong>Date:</strong> " . date('F j, Y', strtotime($payment_response['processed_on'])) . "</li>";
}

if (!empty($payment_response['amount']) && !empty($payment_response['currency'])) {
    $team_email_body .= "<li><strong>Amount:</strong> " . number_format($payment_response['amount'] / 100, 2) . ' ' . $payment_response['currency'] . "</li>";
}

if (!empty($payment_response['id'])) {
    $team_email_body .= "<li><strong>Payment ID:</strong> {$payment_response['id']}</li>";
}


$team_email_body .= "</ul>

<p>The payment has been successfully received. Please verify and update the records accordingly.</p>        
<p>For any issues or queries, please follow up as needed.</p>  <br>
<p>Best Regards,<br>Intralinks</p>

</body>
</html>";

$customer_email_body = "<html>
<body>
    <p>Dear User,</p> <p>Your payment has been successfully processed. Below are the transaction details:</p>";


$customer_email_body .= "<h3>Payment Details:</h3><ul>";

if (!empty($invoice_number)) {
    $customer_email_body .= "<li><strong>Invoice Number:</strong> " . $invoice_number . "</li>";
}

if (!empty($payment_response['processed_on'])) {
    $customer_email_body .= "<li><strong>Date:</strong> " . date('F j, Y', strtotime($payment_response['processed_on'])) . "</li>";
}

if (!empty($payment_response['amount']) && !empty($payment_response['currency'])) {
    $customer_email_body .= "<li><strong>Amount:</strong> " . number_format($payment_response['amount'] / 100, 2) . ' ' . $payment_response['currency'] . "</li>";
}

if (!empty($payment_response['id'])) {
    $customer_email_body .= "<li><strong>Payment ID:</strong> {$payment_response['id']}</li>";
}

if (!empty($payment_response['source']['card_type']) && !empty($payment_response['source']['last4'])) {
    $customer_email_body .= "<li><strong>Card Type:</strong> {$payment_response['source']['card_type']} (**** **** **** {$payment_response['source']['last4']})</li>";
}


if (!empty($payment_response['source']['scheme'])) {
    $customer_email_body .= "<li><strong>Scheme:</strong> {$payment_response['source']['scheme']}</li>";
}

if (!empty($payment_response['customer']['name'])) {
    $customer_email_body .= "<li><strong>Name:</strong> {$payment_response['customer']['name']}</li>";
}

if (!empty($payment_response['customer']['email'])) {
    $customer_email_body .= "<li><strong>Email:</strong> {$payment_response['customer']['email']}</li>";
}

if (!empty($payment_response['source']['phone']['country_code']) && !empty($payment_response['source']['phone']['number'])) {
    $customer_email_body .= "<li><strong>Phone:</strong> {$payment_response['source']['phone']['country_code']} {$payment_response['source']['phone']['number']}</li>";
}

if (!empty($payment_response['source']['billing_address'])) {
    $billing = $payment_response['source']['billing_address'];
    $customer_email_body .= "<li><strong>Billing Address:</strong> " .
        (!empty($billing['address_line1']) ? "{$billing['address_line1']}, " : '') .
        (!empty($billing['city']) ? "{$billing['city']}, " : '') .
        (!empty($billing['state']) ? "{$billing['state']}, " : '') .
        (!empty($billing['country']) ? "{$billing['country']}, " : '') .
        (!empty($billing['zip']) ? "{$billing['zip']}" : '') .
    "</li>";
}

$customer_email_body .= "</ul>
<p>Your payment has been successfully received.</p>        
<p>For any issues or queries, please follow up as needed.</p>  <br> 
<p>Best Regards,<br>Intralinks</p>
</body>
</html>";

if (!empty($payment_response['customer']['email'])) {
     $mail_sent_customer = mail($to, $subject, $customer_email_body, $headers);
}
foreach ($adminemails as $adminemail) {
    $adminemail = trim($adminemail); 
    mail($adminemail, $subject, $email_body, $headers);
}
foreach ($teamemails as $teamemail) {
    $teamemail = trim($teamemail);
   mail($teamemail, $subject, $team_email_body, $headers);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intralinks Pay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .danger {
            color: white;
            background-color: #972c2c94;
            display: none;
            padding: 10px;
            display: inline-block;
            width: 100%;
            margin-top: 15px;
            border-radius: 2px;
        }
        .input-group {
            display: flex;
        }
        .input-group .form-select {
            width: 100px;
            border-right: 0;
        }
        .input-group .form-control {
            flex-grow: 1;
            border-left: 0;
        }
        .input-group #phone {
            border-left: 1px solid #eee;
        }
        #country_code {
            max-width: 150px;
            border-right: 1px solid #999;
        }
        .pymnt-pg-hdr .container {
            background-color: transparent;
            box-shadow: none;
            padding: 0;
            margin: 0 auto;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        h2 {
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .invoice-info {
            font-weight: bold;
        }
        .payment-info, .card-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .payment-info ul, .card-info ul {
            padding-left: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #45a049;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
        .btn-sm.btn-yellow, .btn-sm.btn-blue {
            padding: 7px 10px;
        }
        .btn-blue, .btn-blue:hover {
            background-color: #1e76bd;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="pymnt-pg-hdr p-3 pb-0">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col-md-12 mb-2">
                    <a target="_blank" href="https://www.intralinks.com/"><img src="images/logo.svg"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <h1>Payment Successful</h1>
        <div class="payment-info">
            <h2 class="mb-3">Payment Details</h2>
            <ul>
                <li><strong>Invoice Number:</strong> <?php echo $invoice_number; ?></li>
                <li><strong>Date:</strong> <?php echo date('F j, Y', strtotime($payment_response['processed_on'])); ?></li>
             <li><strong>Amount Paid:</strong> <?php $currency = strtoupper($payment_response['currency']);
                  if ($currency === 'JPY') { echo number_format($payment_response['amount'], 0) . ' ' . $currency; } else {
                   echo number_format($payment_response['amount'] / 100, 2) . ' ' . $currency; } ?></li>
                <li><strong>Transaction ID:</strong> <?php echo $payment_response['id']; ?></li>
                <?php if (!empty($payment_response['customer']['name'])) { ?>
                    <li><strong>Customer Name:</strong> <?php echo $payment_response['customer']['name']; ?></li>
                <?php } ?>
                <?php if (!empty($payment_response['customer']['email'])) { ?>
                    <li><strong>Email:</strong> <?php echo $payment_response['customer']['email']; ?></li>
                <?php } ?>
                <?php if (!empty($payment_response['source']['phone']['number'])) { ?>
                    <li><strong>Phone:</strong> <?php echo $payment_response['source']['phone']['country_code'] . ' ' . $payment_response['source']['phone']['number']; ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="mb-8"> &nbsp; </div>
        <div class="text-center mt-2">
            <a href="/" class="btn btn-sm btn-blue"><i class="fa-solid fa-arrow-right me-1"></i> Make Another Payment </a>
            <a target="_blank" href="https://www.intralinks.com/" class="btn btn-sm btn-blue"><i class="fa-solid fa-arrow-right me-1"></i> Go to Home </a>
            <div class="mb-8"> &nbsp; </div>
        </div>
    </div>
    <div class="footer">
        <p>Thank you for your business!</p>
    </div>
    <div class="copyright p-2 bg-light-blue">
        <div class="conatiner text-center text-white"> &copy; <?php echo date("Y"); ?> Intralinks, SS&C Inc. All Rights Reserved. </div>
    </div>
</body>
</html>