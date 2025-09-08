<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/ico" href="images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Intralinks Pay</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<meta name="robots" content="noindex, nofollow">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<style>
		
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
			max-width: 120px;
			border-right: 1px solid #999;
		}
		#paymentForm {
		max-width: 550px; margin:0px auto;
		}
		.bg-dark-blue {
		background-color: transparent;
		}
		small {font-size:12px;}
		.form-label {
		margin-bottom: .5rem;
		font-size: 14px;
		color: #555;
		}
		h4.mb-0 {
		font-size: 16px;
		}

		@media only screen and (max-width: 600px) {
			.text-end {text-align: left !important;}
		}
		
	</style>
</head>
<body>
	<div class="pymnt-pg-hdr p-3">
		<div class="container">
			<div class="row text-center mb-3">
				<div class="col-md-12 mb-2">
					<a target="_blank" href="https://www.intralinks.com/"><img src="images/logo.svg"></a>
				</div>
				<div class="col-md-12">
					<p class="mb-0">Please enter your Invoice Number, select the Currency, and proceed with the payment.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container mb-5">
		<form id="paymentForm">
			<div class="row">
				<div class="col-md-12 mb-4 mb-md-0">
				
				
					<div class="card mb-4 rounded-0 border-0">
						<div class="card-header bg-dark-blue  rounded-0">
							<h4 class="mb-0">Payment Details</h4>
						</div>
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Invoice Number<span>*</span></label>
									</div>
										<div class="col-md-8">
									<input id="invoice_input" name="invoice_number" class="form-control" placeholder="Enter Invoice Numbers" required>
									<small>Enter Multiple Invoice Numbers separated by Comma (,)</small>
								</div>
							</div>
							
                           <div class="row mb-3">							
							<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Currency<span>*</span></label>
									</div>
										<div class="col-md-8">
									<select class="form-select" name="currency" id="currency_select" required>
										<option value="">Select Currency</option>
										<option value="GBP">GBP</option>
										<option value="USD">USD</option>
										<option value="EUR">EUR</option>
										<option value="JPY">JPY</option>
										<option value="BRL">BRL</option>
									</select>
								</div>
						  </div>
						  
						  <div class="row mb-3">	
								<div class="col-md-4 text-end align-content-center">
									<label id="usd_label" class="form-label fw-semibold">Enter Amount<span>*</span></label>
									</div>
										<div class="col-md-8">
									   <input type="number" name="usd_amount" class="form-control" required step="0.01" min="0"
                                        onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
										</div>
								</div>
								
								
								 <div class="row mb-3">
									<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">First Name<span>*</span></label>	
									</div>
									<div class="col-md-8">
									<input type="text" name="first_name" required class="form-control">
							        </div>
								</div>
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Last Name<span>*</span></label></div>
									<div class="col-md-8">
									<input type="text" name="last_name" required class="form-control">
								</div>
								</div>
								
								</div>
							
						</div>
					
					
					
				
					<div class="card mb-4 rounded-0 border-0 mb-4">
						<div class="card-header bg-dark-blue rounded-0">
							<h4 class="mb-0">Card Details</h4>
						</div>
						<div class="card-body">
						
							<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Card Name<span>*</span></label>
									</div>
									<div class="col-md-8">
									<input type="text" name="card_name" class="form-control" required id="card_name">
								</div>
								</div>
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Credit Card Number<span>*</span></label>
									</div>
										<div class="col-md-8">
									<input type="text" name="card_number" class="form-control" required id="card_number" maxlength="19">
								</div>
								</div>
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">CVV2<span>*</span></label></div>
									<div class="col-md-8">
									<input type="text" name="cvv" class="form-control" required id="cvv" maxlength="4">
									</div>
								</div>
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Expiration Date<span>*</span></label>
									</div>
										<div class="col-md-8">
									<input type="text" name="expiration_date" class="form-control" required id="expiration_date" placeholder="MM/YYYY">
									<input type="hidden" name="expiry_month" id="expiry_month">
									<input type="hidden" name="expiry_year" id="expiry_year">
								</div>	</div>
							
						</div>
					</div>
					
			
				
				
					<div class="card rounded-0 border-0 mb-4">
						<div class="card-header bg-dark-blue  rounded-0">
							<h4 class="mb-0">Billing Details</h4>
						</div>
						<div class="card-body">
						
							<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Billing Address 1</label>
									</div>
									<div class="col-md-8">
									<input type="text" name="billing_address1" class="form-control">
								</div>
								</div>
								
								<div class="row mb-3">
									<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Billing Address 2</label>
									</div>
									<div class="col-md-8">
									<input type="text" name="billing_address2" class="form-control">
								</div>
								</div>
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">City</label></div>
									<div class="col-md-8">
									<input type="text" name="city" class="form-control">
								</div>
								</div>
								
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">State/Province</label>
									</div>
									<div class="col-md-8">
									<input type="text" name="state" class="form-control">
									</div>
								</div>
								
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Postal Code</label>
									</div>
									<div class="col-md-8">
									<input type="text" name="postal_code" class="form-control">
									</div>
								</div>
								
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Phone</label>
									</div>
										<div class="col-md-8">
									<div class="input-group">
										<select class="form-select" id="country_code" name="country_code">
											<option value="+44" selected>+44 (UK)</option>
											<option value="+1">+1 (USA)</option>
											<option value="+81">+81 (Japan)</option>
											<option value="+55">+55 (Brazil)</option>
											<option value="+49">+49 (Germany)</option>
											<option value="+33">+33 (France)</option>
											<option value="+39">+39 (Italy)</option>
											<option value="+34">+34 (Spain)</option>
											<option value="+31">+31 (Netherlands)</option>
										</select>
										<input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number">
									</div></div>
								</div>
								
								
								<div class="row mb-3">
								<div class="col-md-4 text-end align-content-center">
									<label class="form-label fw-semibold">Email</label>
									</div>
											<div class="col-md-8">
									<input type="email" name="email" class="form-control">
									</div>
								</div>
							
							
							
						</div>
					</div>
					
					<div class="card rounded-0 border-0">
						<div class="card-body">
							<div class="d-flex justify-content-center">
								<button type="submit" class="btn btn-success"><i class="fa-solid fa-arrow-right me-3"></i>Make Payment</button>
							</div>
							<span id="error-message" class="danger"></span>
						</div>
					</div>
					
					
				</div>
			
				
				
			</div>
		</form>
	</div>
	<div class="copyright p-2 bg-light-blue">
		<div class="container text-center text-white"> &copy; <?php echo date("Y"); ?> Intralinks, SS&C Inc. All Rights Reserved. </div>
	</div>

	<script src="https://checkout-web-components.checkout.com/index.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#error-message').hide();
			$('#paymentForm').on('submit', function(event) {
				event.preventDefault();
				var formData = $(this).serialize();
				$.ajax({
					url: 'create-payment-session.php',
					type: 'POST',
					data: formData,
					success: function(response) {
						console.log('Server Response:', response);
						var cleanedResponse = response.trim().replace(/}{/g, '},{');
						var data = JSON.parse('[' + cleanedResponse + ']');
						var lastResponse = data[data.length - 1];
						console.log(lastResponse);
						if (lastResponse.status === 'success' && lastResponse.invoice_number) {
							console.log('Redirecting to success page with invoice number:', data.invoice_number);
							window.location.href = 'success.php?invoice_number=' + lastResponse.invoice_number;
						} else {
							console.log('Full Error Object:', lastResponse);
							var errorMessage = "Error: Unknown error";
							if (lastResponse.details && lastResponse.details.error_codes) {
								errorMessage = "Error: " + lastResponse.details.error_codes.join(', ');
							}
							console.error(errorMessage);
							$('#error-message').text(errorMessage).fadeIn();
						}
					},
					error: function(xhr, status, error) {
						console.error('AJAX Error:', error);
						alert('There was an error with the payment processing.');
					}
				});
			});
		});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.0/tagify.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.0/tagify.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/libphonenumber-js@1.9.20/bundle/libphonenumber-max.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.querySelector('form').addEventListener('submit', function(e) {
				const currencySelect = document.getElementById('currency_select');
				if (!currencySelect.value) {
					alert('Please select Currency.');
					e.preventDefault();
				}
			});
		});

		var input = document.getElementById('invoice_input');
		var tagify = new Tagify(input, {
			delimiters: ",",
			maxTags: 10,
			placeholder: "Enter Invoice Numbers",
			originalInputValueFormat: values => values.map(item => item.value).join(", ")
		});

		tagify.on("add", function(e) {
			let totalLength = tagify.value.reduce((sum, tag) => sum + tag.value.length, 0);
			if (totalLength > 80) {
				tagify.removeTag(e.detail.index);
				alert("Total invoice numbers must not exceed 80 characters.");
			}
		});

		tagify.on("remove", function(e) {
			console.log("Removed Tag:", e.detail.data.value);
		});

		document.getElementById('currency_select').addEventListener('change', function() {
			const selectedCurrency = this.value;
			const label = document.getElementById('usd_label');
			switch (selectedCurrency) {
				case 'USD':
					label.innerHTML = 'USD Amount<span>*</span>';
					break;
				case 'EUR':
					label.innerHTML = 'EUR Amount<span>*</span>';
					break;
				case 'GBP':
					label.innerHTML = 'GBP Amount<span>*</span>';
					break;
				case 'JPY':
					label.innerHTML = 'JPY Amount<span>*</span>';
					break;
				case 'BRL':
					label.innerHTML = 'BRL Amount<span>*</span>';
					break;
				default:
					label.innerHTML = 'Enter Amount<span>*</span>';
					break;
			}
		});

		document.addEventListener('DOMContentLoaded', function() {
			const phoneInput = document.getElementById('phone');
			const countryCodeSelect = document.getElementById('country_code');
			phoneInput.addEventListener('input', function() {
				let phoneNumber = phoneInput.value.replace(/\D/g, '');
				if (phoneNumber.length > 3 && phoneNumber.length <= 6) {
					phoneNumber = phoneNumber.replace(/(\d{3})(\d{1,3})/, '($1) $2');
				} else if (phoneNumber.length > 6) {
					phoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{1,4})/, '($1) $2-$3');
				}
				phoneInput.value = phoneNumber;
			});

			document.querySelector('form').addEventListener('submit', function(e) {
				const phoneNumber = phoneInput.value.replace(/\D/g, '');
				console.log('Phone Number without Country Code:', phoneNumber);
				document.getElementById('phone').value = phoneNumber;
				if (phoneNumber.length > 0 && phoneNumber.length < 10) {
					alert('Please enter a valid phone number.');
					e.preventDefault();
				}
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			function validateCardNumber(cardNumber) {
				const regex = /^[0-9]{13,19}$/;
				if (!regex.test(cardNumber)) {
					return false;
				}
				let sum = 0;
				let shouldDouble = false;
				for (let i = cardNumber.length - 1; i >= 0; i--) {
					let digit = parseInt(cardNumber.charAt(i));
					if (shouldDouble) {
						digit *= 2;
						if (digit > 9) {
							digit -= 9;
						}
					}
					sum += digit;
					shouldDouble = !shouldDouble;
				}
				return sum % 10 === 0;
			}

			const form = document.querySelector('form');
			form.addEventListener('submit', function(event) {
				const cardName = document.getElementById('card_name').value;
				const cardNumber = document.getElementById('card_number').value.replace(/\s+/g, '');
				const cvv = document.getElementById('cvv').value;
				const expirationDate = document.getElementById('expiration_date').value;
				const currentDate = new Date();
				const expDate = new Date(expirationDate + '-01');
				let isValid = true;
				if (!cardName.trim()) {
					alert('Card Name is required');
					isValid = false;
				}
				if (!/^\d{3,4}$/.test(cvv)) {
					alert('Invalid CVV. It should be 3 or 4 digits');
					isValid = false;
				}
				if (!isValid) {
					event.preventDefault();
				}
			});

			document.getElementById('card_number').addEventListener('input', function(e) {
				let cardNumber = e.target.value.replace(/\s+/g, '').replace(/\D/g, '');
				let formatted = '';
				for (let i = 0; i < cardNumber.length; i++) {
					if (i > 0 && i % 4 === 0) {
						formatted += ' ';
					}
					formatted += cardNumber[i];
				}
				e.target.value = formatted;
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			const expirationInput = document.getElementById('expiration_date');
			const expiryMonthInput = document.getElementById('expiry_month');
			const expiryYearInput = document.getElementById('expiry_year');
			expirationInput.addEventListener('input', function() {
				let value = expirationInput.value;
				value = value.replace(/\D/g, '');
				if (value.length > 2) {
					value = value.slice(0, 2) + '/' + value.slice(2, 6);
				}
				expirationInput.value = value;
				if (value.length === 7) {
					const [month, year] = value.split('/');
					expiryMonthInput.value = month;
					expiryYearInput.value = year;
				}
			});
		});
	</script>
</body>
</html>
