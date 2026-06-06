<?php	
	include_once('header.php');
	
	if(isset($_POST['payment_button'])){
		$method = $_POST['paymentMethod'];
		$number = $_POST['phoneNumber'];
		$amount = $_POST['amount'];
		$trxId  = $_POST['trxId'];
		
		if($method && $number && $amount && $trxId){
			header('location:checkout.php');
		}else{
			echo "<h2 style='color: #a38019; font-size: 1.5rem; text-align: center; display: block; background: antiquewhite; padding: 20px; margin-top: 20px; margin-bottom: -20px;'> Please Provide Right Information </h2>";
		}
	}
	
?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
					<h2 class='no-found'> Please Send Money <copy> 01763029679 this number and send your number and trnsection Id </h2>
                    <div class="card-header text-center py-4">
                        <h2><i class="bi bi-credit-card me-2"></i>Payment Form</h2>
                        <p class="mb-0">Please provide your payment details</p>
                    </div>
                    <div class="card-body p-4">
                        <form id="paymentForm" method="POST">
						
							<div class="payment-options mb-4">
								<label class="form-label">পেমেন্ট পদ্ধতি নির্বাচন করুন</label>
								
								<div class="payment-card" id="cash-on-delivery">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="paymentMethod" id="paymentCOD" value="Bikash" checked>
										<label class="form-check-label d-flex align-items-center" for="paymentCOD">
											<i class="fas fa-money-bill-wave payment-icon"></i>
											<div>
												<h6 class="mb-0">বিকাশ</h6>
											</div>
										</label>
									</div>
								</div>
								
								<div class="payment-card" id="online-payment">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="paymentMethod" id="paymentOnline" value="Nogod">
										<label class="form-check-label d-flex align-items-center" for="paymentOnline">
											<i class="fas fa-credit-card payment-icon"></i>
											<div>
												<h6 class="mb-0">নগদ</h6>
											</div>
										</label>
									</div>
								</div>
							</div>
						
                            <!-- Phone Number Field -->
                            <div class="mb-4">
                                <label for="phoneNumber" class="form-label required-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>
                            </div>

                            <!-- Amount Field -->
                            <div class="mb-4">
                                <label for="amount" class="form-label required-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" min="1" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid amount (minimum 1).
                                    </div>
                                </div>
                            </div>

                            <!-- Transaction ID Field -->
                            <div class="mb-4">
                                <label for="transactionId" class="form-label required-label">Transaction ID</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-receipt"></i></span>
                                    <input type="text" class="form-control" name="trxId" id="transactionId" placeholder="Enter transaction ID" required>
                                    <div class="invalid-feedback">
                                        Please provide your transaction ID.
                                    </div>
                                </div>
                            </div>
							
                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" name="payment_button" class="btn btn-primary btn-lg py-3">
                                    <i class="bi bi-send-check me-2"></i>Submit Payment
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center py-3">
                        <i class="bi bi-shield-check me-1"></i> Your information is secure and encrypted
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
	include_once('footer.php');
?>