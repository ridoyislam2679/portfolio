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
    SELECT c.cart_id, p.product_name, p.image, p.product_price, c.quantity, (p.product_price * c.quantity) AS subtotal
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.$field=?
");
$query->execute([$value]);
$cart = $query->fetchAll();

$total = 0;
?>

	<div class="container mt-4">
		<h2 class="mb-4 text-center">🛒 My Cart</h2>
		<table class="table table-bordered table-striped text-center align-middle">
			<thead class="table-dark">
				<tr>
					<th>Product</th>
					<th>Image</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Subtotal</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($cart as $item): 
				$total += $item['subtotal'];
			?>
				<tr data-id="<?= $item['cart_id'] ?>">
					<td><?= $item['product_name'] ?></td>
					<td><img src="assets/<?= $item['image'] ?>" class="cart-image"></td>
					<td>৳<?= $item['product_price'] ?></td>
					<td>
						<div class="qty-box">
							<button type="button" class="btn btn-outline-secondary btn-sm minus">-</button>
							<input type="number" value="<?= $item['quantity'] ?>" min="1" 
								   class="form-control qty-input" 
								   data-price="<?= $item['product_price'] ?>">
							<button type="button" class="btn btn-outline-secondary btn-sm plus">+</button>
						</div>
					</td>
					<td class="subtotal">৳<?= $item['subtotal'] ?></td>
					<td><a href="remove_cart.php?id=<?= $item['cart_id'] ?>" class="btn btn-danger btn-sm">Remove</a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		
		<div class="order-summary card mb-3">
			<div class="card-body">
				<h5 class="card-title mb-4">অর্ডার সারাংশ</h5>
				
				<div class="summary-item d-flex justify-content-between mb-2">
					<span>সাবটোটাল</span>
					<span id="subtotal-amount"><?= $total ?> টাকা</span>
				</div>
				
				<div class="summary-item d-flex justify-content-between mb-2">
					<span>ডেলিভারি চার্জ</span>
					<span id="delivery-charge">৫০ টাকা</span>
				</div>
				
				<div class="summary-item d-flex justify-content-between mb-3">
					<span>ট্যাক্স</span>
					<span id="tax-amount">০ টাকা</span>
				</div>
				
				<div class="total-price d-flex justify-content-between mb-4 pt-3 border-top">
					<strong>মোট মূল্য</strong>
					<h4>Total: <span id="total-with-charge"><?= $total+50 ?></span> টাকা</h4>
				</div>
				
				<form action="" method="POST">
					<button type="submit" class="btn btn-primary w-100 py-3" name="order_submit">
						<i class="fas fa-shopping-bag me-2"></i>অর্ডার সম্পন্ন করুন
					</button>
				</form>
				<?php 
					if(isset($_POST['order_submit'])){
						if (isset($_SESSION['user_id'])) {
							header('location:order.php');
						} else {
							header('location:order-form.php');
						}
					}
				?>			
				
				<button class="btn btn-success w-100 py-3 mt-2">
					<a href="index.php" class="shop-link">
						<i class="fas fa-arrow-left me-2"></i>শপিং চালিয়ে যান
					</a>
				</button>
				
				<div class="mt-3 text-center">
					<small class="text-muted">অর্ডার সম্পন্ন করে আপনি আমাদের <a href="#">শর্তাবলী</a> এবং <a href="#">প্রাইভেসি পলিসি</a> মেনে নিলেন</small>
				</div>
			</div>
		</div>	
	</div>
<?php include('footer.php'); ?>