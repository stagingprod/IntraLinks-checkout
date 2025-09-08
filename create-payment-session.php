<?php

ini_set('memory_limit', '1024M');
require_once 'vendor/autoload.php';
$config = require 'config.php';
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Country;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Checkout\Environment;


$api = CheckoutSdk::builder()->staticKeys()
    ->environment(Environment::{$config['api']['environment']}())  
    ->secretKey($config['api']['secret_key'])  
    ->build();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $invoice_number = $_POST['invoice_number'];
    $usd_amount = floatval($_POST['usd_amount']);
    $currency = strtoupper($_POST['currency']);  
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $billing_address1 = $_POST['billing_address1'];
    $billing_address2 = $_POST['billing_address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $card_name = $_POST['card_name'];
    $card_number = str_replace(' ', '', trim($_POST['card_number']));
    $cvv = $_POST['cvv'];
    $expiry_month = $_POST['expiry_month'];    
	$expiry_year = $_POST['expiry_year'];
    
    if ($currency === 'JPY') {
    $amount_in_smallest_unit = round($usd_amount); 
    } else {
    $amount_in_smallest_unit = $usd_amount * 100;
     } 
	
    $phone = new Phone();
    $phone->country_code = $_POST['country_code'];  
    $phone->number = $_POST['phone'];
    $address = new Address();
    $address->address_line1 = $billing_address1;
    $address->address_line2 = $billing_address2;
    $address->city = $city;
    $address->state = $state;
    $address->zip = $postal_code;
    $address->country = Country::$GB;  
    $requestCardSource = new RequestCardSource();
    $requestCardSource->name = $card_name; 
    $requestCardSource->number = $card_number;  
    $requestCardSource->expiry_year = $expiry_year;  
    $requestCardSource->expiry_month = $expiry_month;  
    $requestCardSource->cvv = $cvv;
    $requestCardSource->billing_address = $address;
    $requestCardSource->phone = $phone;

    $customerRequest = new CustomerRequest();
    $customerRequest->email = $email;  
    $customerRequest->name = $first_name.' '.$last_name;

    $paymentIndividualSender = new PaymentIndividualSender();
    $paymentIndividualSender->first_name = $first_name; 
    $paymentIndividualSender->last_name = $last_name;  
    $paymentIndividualSender->address = $address;
    $currencyEnum = Currency::$USD;  
    switch (strtoupper($currency)) {
        case 'USD':
            $currencyEnum = Currency::$USD;
            break;
        case 'EUR':
            $currencyEnum = Currency::$EUR;
            break;
        case 'GBP':
            $currencyEnum = Currency::$GBP;
            break;
        case 'JPY':
            $currencyEnum = Currency::$JPY;
            break;
		case 'BRL':
            $currencyEnum = Currency::$BRL;
            break;
        default:
            $currencyEnum = Currency::$USD;  
            break;
    }


    $request = new PaymentRequest();
    $request->source = $requestCardSource;
    $request->capture = true;
    $request->reference = $invoice_number;  
    $request->amount = $amount_in_smallest_unit;  
    $request->currency = $currencyEnum;  
    $request->customer = $customerRequest;
    $request->sender = $paymentIndividualSender;
    $request->processing_channel_id = $config['api']['processing_channel_id'];  

    try {
        $response = $api->getPaymentsClient()->requestPayment($request);
        echo json_encode($response);  
         session_start();
    $_SESSION['payment_response'] = $response;  
    $_SESSION['invoice_number'] = $invoice_number;


    echo json_encode(['status' => 'success', 'invoice_number' => $invoice_number]);
    exit();
    } catch (CheckoutApiException $e) {
  
        $error_details = $e->error_details;
        $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;

     
        echo json_encode([
            'error' => 'API error', 
            'details' => $error_details, 
            'status_code' => $http_status_code
        ]);
    } catch (CheckoutAuthorizationException $e) {
     
        echo json_encode(['error' => 'Authorization error']);
    }
}
?>
