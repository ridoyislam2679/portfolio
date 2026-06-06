<?php
ob_start();
session_start();
include "db/index.php";

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

include "header.php";
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
						
						<!-- Confirm Order Button -->
						<button class="btn btn-primary w-100 py-3" name="order_submit">
							<i class="fas fa-check-circle me-2"></i>অর্ডার নিশ্চিত করুন
						</button>
						</form>
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
					</div>
				</div>
			</div>
		</div>
		
		<!-- Confirmation Modal -->
		<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-success text-white">
						<h5 class="modal-title" id="confirmationModalLabel"><i class="fas fa-check-circle me-2"></i>অর্ডার সফল</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center py-4">
						<div class="success-animation">
							<i class="fas fa-check-circle"></i>
						</div>
						<h4 class="text-success">আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে!</h4>
						<p class="mb-0">আমাদের representative শীঘ্রই আপনার সাথে যোগাযোগ করবে।</p>
						<p class="mt-3">অর্ডার নম্বর: <strong>#ORD-2023-78945</strong></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
						<button type="button" class="btn btn-success">অর্ডার ট্র্যাক করুন</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include "footer.php"; ?>