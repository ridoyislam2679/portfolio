<?php 
include_once("header.php");

$minPrice = 0;
$maxPrice = 999999;
$brand = '';
$condition = 'New';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchBtn'])) {
    
    // Price range
    if (!empty($_POST['price_range'])) {
        $priceRange = explode("-", $_POST['price_range']);
        $minPrice = (int)$priceRange[0];
        $maxPrice = (int)$priceRange[1];
    }

    // Brand
    if (!empty($_POST['brand'])) {
        $brand = $_POST['brand'];
    }

    // Condition
    if (!empty($_POST['condition'])) {
        $condition = $_POST['condition'];
    }
}

// SQL query for phones
$sql = "SELECT model_name, main_image, price FROM mobiles WHERE price >= ? AND price <= ?";
$params = [$minPrice, $maxPrice];

// Add condition filter if selected
if(!empty($condition)){
    $sql .= " AND status = ?";
    $params[] = $condition;
}

// Add brand filter if selected
if(!empty($brand)){
    $sql .= " AND brand_name = ?";
    $params[] = $brand;
}

$sql .= " ORDER BY created_at LIMIT 20";  // max 20 results

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$phones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Main Content -->
    <section class="top-phones-section">
        <div class="container">
            <div class="row">
				<?php 
				if($phones && count($phones) > 0){
					foreach($phones as $row){
						?>
						<div class="col-6 col-md-4 col-lg-3 mb-4">
							<div class="card phone-card">
								<div class="phone-img-container">
									<img src="images/<?php echo strtolower($condition=='New'?'new':'used'); ?>/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
								</div>
								<div class="card-body text-center">
									<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
									<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
									<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>/" class="btn btn-primary btn-sm">Details</a>
								</div>
							</div>
						</div>
						<?php
					}
				}else{
					echo "<h5>No phones found matching your criteria.</h5>";
				}
				?>
			</div>
        </div>
    </section>
<?php 
	include_once("footer.php");
?>