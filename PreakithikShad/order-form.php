<?php
include "header.php";

if (isset($_SESSION['user_id'])) {
    $field = "user_id";
    $value = $_SESSION['user_id'];
} else {
    $field = "session_id";
    $value = session_id();
}

$query = $pdo->prepare("
    SELECT c.cart_id, p.product_name, p.product_price, c.quantity, (p.product_price * c.quantity) AS subtotal
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.$field=?
");
$query->execute([$value]);
$cart = $query->fetchAll();

$total = 0;

?>

<?php 
	if(isset($_POST['order_submit'])){
		$selected_option = $_POST['paymentMethod'];
		if($selected_option == 'online_payment'){
			header('location:payment.php');
		}else{
			header('location:checkout.php');
		}
	}
?>

	<!-- Order Modal -->
	<div class="order-modal mb-3">
		<div class="container" id="orderModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="orderModalLabel"><i class="fas fa-shopping-bag me-2"></i>অর্ডার সম্পন্ন করুন</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Order Items Summary -->
						<div class="order-items-summary mb-4">
							<h6 class="mb-3">আপনার অর্ডার</h6>
							<?php foreach ($cart as $item): 
								$total += $item['subtotal'];
							?>
								<div class="order-item d-flex justify-content-between mb-2">
									<span><?= $item['product_name'] ?></span>
									<span><?= $item['subtotal'] ?> টাকা</span>
								</div>
							<?php endforeach; ?>
							<div class="summary-item d-flex justify-content-between mb-2">
								<span>ডেলিভারি চার্জ</span>
								<span id="delivery-charge">৫০ টাকা</span>
							</div>
							<div class="order-item d-flex justify-content-between mb-3 pt-2 border-top">
								<strong>মোট</strong>
								<strong><?= $total+50 ?> টাকা</strong>
							</div>
						</div>
						
						<!-- Payment Method -->
						<form action="" method="POST">
						<div class="payment-options mb-4">
							<label class="form-label">পেমেন্ট পদ্ধতি নির্বাচন করুন</label>
							
							<div class="payment-card selected" id="cash-on-delivery">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="paymentMethod" id="paymentCOD" value="cash_on_delivery" checked>
									<label class="form-check-label d-flex align-items-center" for="paymentCOD">
										<i class="fas fa-money-bill-wave payment-icon"></i>
										<div>
											<h6 class="mb-0">ক্যাশ অন ডেলিভারি</h6>
											<small>পণ্য হাতে পেয়ে তারপর পেমেন্ট করুন</small>
										</div>
									</label>
								</div>
							</div>
							
							<div class="payment-card" id="online-payment">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="paymentMethod" id="paymentOnline" value="online_payment">
									<label class="form-check-label d-flex align-items-center" for="paymentOnline">
										<i class="fas fa-credit-card payment-icon"></i>
										<div>
											<h6 class="mb-0">অনলাইন পেমেন্ট</h6>
											<small>কার্ড/মোবাইল ব্যাংকিং/বিকাশ</small>
										</div>
									</label>
								</div>
							</div>
						</div>
						
						<!-- User Details Form -->
						<div class="user-details-form">
							<h5 class="mb-3">আপনার তথ্য দিন</h5>
							
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="customerName" class="form-label">নাম *</label>
									<input type="text" class="form-control" id="customerName" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="customerPhone" class="form-label">ফোন নম্বর *</label>
									<input type="tel" class="form-control" id="customerPhone" required>
								</div>
								<div class="col-12 mb-3">
									<label for="customerAddress" class="form-label">ঠিকানা *</label>
									<textarea class="form-control" id="customerAddress" rows="3" required></textarea>
								</div>
								<div class="col-md-6 mb-3">
									<label for="customerEmail" class="form-label">ইমেইল</label>
									<input type="email" class="form-control" id="customerEmail">
								</div>
								<div class="col-md-6 mb-3">
									<label for="customerCity" class="form-label">শহর *</label>
									<input type="text" class="form-control" id="customerCity" required>
								</div>
							</div>
						</div>
						
						
						<!-- Confirm Order Button -->
						<button class="btn btn-primary w-100 py-3" name="order_submit">
							<i class="fas fa-check-circle me-2"></i>অর্ডার নিশ্চিত করুন
						</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include "footer.php"; ?>