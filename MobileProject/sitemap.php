<?php
header("Content-Type: application/xml; charset=utf-8");
include_once('db/index.php');

// Base URL (live হলে domain বসাবে)
//$base = "http://localhost/MobileProject/";
$base ="https://mobilereviewbd.com/";

// XML শুরু
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Homepage -->
    <url>
        <loc><?= $base ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
	<url>
        <loc><?= $base ?>index</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->
    <url>
        <loc><?= $base ?>brands/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $base ?>about/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $base ?>contact/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>privacy-policy/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>disclaimer/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>faq/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	
	
	<!-- Phones -->
	<url>
        <loc><?= $base ?>compare/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>new-phones/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>pre-owned/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $base ?>upcoming-phone/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>images/</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
	
	<!-- TOP 10 -->
	<url>
        <loc><?= $base ?>gaming-phones/<?php echo str_replace(" ", "-", "Top 10 Best Gaming Phones"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>camera-phones/<?php echo str_replace(" ", "-", "Top 10 Best Camera Phones"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 13000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 15000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 20000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 25000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 30000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 35000 in BD"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	
	
	<!-- top-phones -->
	<url>
        <loc><?= $base ?>top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 5000 to 10000"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 10000 to 15000"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 15000 to 20000"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 20000 to 25000"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
	<url>
        <loc><?= $base ?>top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 25000 to 30000"); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

<?php
// ✅ Brands (ধরি তোমার brands টেবিল আছে)
$stmt = $pdo->query("SELECT brand_name FROM brands");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $brand = urlencode($row['brand_name']);
    ?>
    <url>
        <loc><?= $base ?>brands/<?= $brand ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
<?php } ?>

<?php
// ✅ Phones (ধরি তোমার mobiles টেবিলে model_name আছে)
$stmt = $pdo->query("SELECT model_name FROM mobiles");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $phone = urlencode($row['model_name']);
    ?>
    <url>
        <loc><?= $base ?>phone-details/<?= $phone ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
<?php } ?>

<?php
// ✅ Articles/User Guide (ধরি তোমার articles টেবিলে slug আছে)
$stmt = $pdo->query("SELECT title FROM articles");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $slug = urlencode($row['title']);
    ?>
    <url>
        <loc><?= $base ?>user-gied/<?= $slug ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
<?php } ?>

</urlset>
