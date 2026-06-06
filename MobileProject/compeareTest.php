<?php
include "header.php";

$condition = isset($_GET['condition']) ? $_GET['condition'] : ""; // "new" / "pre-owned"
$phones = [];

if ($condition) {
    $sql = "SELECT mobile_id, model_name FROM mobiles WHERE status = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$condition]);
    $phones = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container compare_section">
    <!-- Header -->
    <div class="comparison-header text-center">
        <h2><i class="fas fa-mobile-alt"></i> Phone Comparison Tool</h2>
        <p>Compare specifications side by side to find your perfect phone</p>
    </div>

    <!-- Search Box -->
	<div class="search-box">
		<!-- Condition Filter -->
		<form method="get" action=""> 
			<div class="row form-row">
				<div class="col-md-12 mb-3">
					<label for="condition">Select Phone Condition </label>
					<select class="form-control" name="condition" onchange="this.form.submit()">
						<option value="">-- Choose --</option>
						<option value="New" <?php if($condition=='New') echo 'selected'; ?>>Both are new Phone</option>
						<option value="Pre-Owned" <?php if($condition=='Pre-Owned') echo 'selected'; ?>>Both are Used Phone</option>
					</select>
				</div>
			</div>
		</form>

		<!-- Compare Form -->
		<div id="compareForm">
			<div class="row form-row">
				<!-- Phone 1 -->
				<div class="col-md-5 mb-3">
					<label for="phone1">Select First Phone</label>
					<input class="form-control" list="phones1" id="phone1" placeholder="Search phone...">
					<datalist id="phones1">
						<?php 
						foreach ($phones as $p) {
							echo '<option value="'.$p['model_name'].'">';
						}
						?>
					</datalist>
				</div>

				<div class="col-md-2 text-center mb-3 d-flex align-items-end justify-content-center">
					<h4 class="mb-0">VS</h4>
				</div>

				<!-- Phone 2 -->
				<div class="col-md-5 mb-3">
					<label for="phone2">Select Second Phone</label>
					<input class="form-control" list="phones2" id="phone2" placeholder="Search phone...">
					<datalist id="phones2">
						<?php 
						foreach ($phones as $p) {
							echo '<option value="'.$p['model_name'].'">';
						}
						?>
					</datalist>
				</div>
			</div>
		</div>
	</div>
	<!-- Show specifications side by side -->
	<div class="row mt-4">
		<div class="col-6 col-sm-6" id="phone1Specs">
			<!-- Phone 1 specs will load here -->
		</div>
		<div class="col-6 col-sm-6" id="phone2Specs">
			<!-- Phone 2 specs will load here -->
		</div>
	</div>
</div>

<script>
function loadSpecs(phoneName, targetDiv) {
    if (phoneName.trim() === "") return;

    fetch("getPhoneSpecs.php?model_name=" + encodeURIComponent(phoneName))
    .then(res => res.text())
    .then(data => {
        document.getElementById(targetDiv).innerHTML = data;
    });
}

document.getElementById("phone1").addEventListener("change", function() {
    loadSpecs(this.value, "phone1Specs");
});

document.getElementById("phone2").addEventListener("change", function() {
    loadSpecs(this.value, "phone2Specs");
});
</script>

<?php include_once('footer.php'); ?>