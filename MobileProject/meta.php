<?php
// Default values
$title = "Mobile Reviews in Bangladesh";
$meta_description = "Latest new mobile/ pre-owned mobile specifications, reviews and prices in Bangladesh.";
$meta_keywords = "mobiles, reviews, price, bd, pre-owned, new";
$canonical = "https://mobilereviewbd.com/";

// বর্তমান URL বের করো
$page = $_SERVER['REQUEST_URI'];
$og_image = "https://mobilereviewbd.com/images/mobilereviewbdlogo.jpg";

// 1️⃣ যদি phone-details page হয়
if (strpos($page, '/phone-details/') !== false && isset($_GET['name'])) {
    $slug = $_GET['name'];

    // Slug থেকে model_name মেলানো (space আর hyphen দুইটাই হ্যান্ডেল করবে)
    $stmt = $pdo->prepare("SELECT model_name, phone_title, meta_description, main_image, status FROM mobiles 
                           WHERE REPLACE(LOWER(model_name), ' ', '-') = LOWER(?)");
    $stmt->execute([$slug]);
    $phone = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($phone) {
        $model = ucfirst($phone['model_name']);
        $title = ucfirst($phone['phone_title']);
        //$title = "$model - Mobile Review In BD";
        $meta_description = !empty($phone['meta_description'])
            ? $phone['meta_description']
            : "Read full review, specifications and price of $model in Bangladesh.";
        $meta_keywords = "$model, $model price in Bangladesh, $model review, mobile review bd";
		
		if (!empty($phone['main_image'])) {
			if($phone['main_image'] == "New"){
				$og_image = "https://mobilereviewbd.com/images/new/" . $phone['main_image'];
			}else{
				$og_image = "https://mobilereviewbd.com/images/used/" . $phone['main_image'];
			}            
        }		
    }
	$canonical = "$base/phone-details/" . $slug;

// 2️⃣ অন্য pages এর জন্য dynamic switch
} elseif (strpos($page, '/brands') !== false) {
    $title = "All Mobile Brands in Bangladesh | mobilereviewbd";
    $meta_description = "Browse all mobile brands available in Bangladesh with specs and prices.";
    $meta_keywords = "mobile brands, bd brands, samsung, xiaomi, oppo, iphone, mi, oppo, realme, iqoo, vivo, honor";
	$canonical = "$base/brands/";

} elseif (strpos($page, '/compare') !== false) {
    $title = "Compare Mobile Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Easily compare latest new mobile phones and pre-owned mobile phones side by side with specs and price in BD.";
    $meta_keywords = "compare mobiles, phone comparison, specs, bd, reviews";
	$canonical = "$base/compare/";

} elseif (strpos($page, '/top10') !== false) {
    $title = "Top 10 Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the top 10 best phones in Bangladesh by performance, camera and price.";
    $meta_keywords = "top 10 phones, best mobiles bd, budget phones";
	$canonical = "$base/top10/";

} elseif (strpos($page, '/top-phones') !== false) {
    $title = "Top 10 Phones in Bangladesh";
    $meta_description = "Discover the top 10 best phones in Bangladesh by performance, camera and price.";
    $meta_keywords = "top 10 phones, best mobiles bd, budget phones";
	$canonical = "$base/top-phones/";

}elseif (strpos($page, '/gaming-phones') !== false) {
    $title = "Top 10 Gaming Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the top 10 best gaming phones in Bangladesh for PUBG and Free Fire performance.";
    $meta_keywords = "gaming phones, free fire phones, pubg phone, best gaming phone bd";
	$canonical = "$base/gaming-phones/";

} elseif (strpos($page, '/camera-phones') !== false) {
    $title = "Top 10 Camera Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the top 10 best camera phones in Bangladesh with high zoom and resolution.";
    $meta_keywords = "camera phones, zoom, resolution, best camera phone bd";
	$canonical = "$base/camera-phones/";

} elseif (strpos($page, '/new-phones') !== false) {
    $title = "Latest Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the latest phone prices in Bangladesh with performance and camera rating.";
    $meta_keywords = "new phones, latest mobile bd, price, performance";
	$canonical = "$base/new-phones/";

}  elseif (strpos($page, '/upcoming-phones') !== false) {
    $title = "Latest Upcoming Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the latest upcoming-phones prices in Bangladesh with performance and camera rating.";
    $meta_keywords = "new phones, latest mobile bd, price, performance";
	$canonical = "$base/upcoming-phones/";

} elseif (strpos($page, '/pre-owned-phone') !== false) {
    $title = "Pre-owned Phones in Bangladesh | mobilereviewbd";
    $meta_description = "Discover the best pre-owned phones price in Bangladesh with reliable condition.";
    $meta_keywords = "used phones bd, pre-owned, second-hand mobiles, bashundhara, jamuna";
	$canonical = "$base/pre-owned-phone/";

} elseif (strpos($page, '/user-gied') !== false) {
    $title = "How to Use Your Phone - User Guide";
    $meta_description = "Discover the best phone usage guide and maintenance tips for pre-owned or new mobiles.";
    $meta_keywords = "user guide, how to use phone, mobile tips, bd news";
	$canonical = "$base/user-gied/";

} elseif (strpos($page, '/images') !== false) {
    $title = "Best Mobile Images Gallery | mobilereviewbd";
    $meta_description = "High-quality mobile images and wallpapers of popular phones.";
    $meta_keywords = "mobile image, wallpapers, iphone, samsung, vivo, oppo";
	$canonical = "$base/images/";

}  elseif (strpos($page, '/about-us') !== false) {
    $title = "About Mobile Review BD | mobilereviewbd";
    $meta_description = "MobileReviewBD is one of the trusted mobile information sites in Bangladesh. We collect the latest news, reviews, prices, and details of new and used phones from reliable sources and share them with readers in a clear and simple way.";
    $meta_keywords = "mobilereviewbd, mbolie, about";
	$canonical = "$base/about-us/";

}  elseif (strpos($page, '/contact') !== false) {
    $title = "contact mobile review bd | mobilereviewbd";
    $meta_description = "MobileReviewBD is one of the trusted mobile information sites in Bangladesh. If you want to contact mobile review bd team? please sent your email.";
    $meta_keywords = "contact, mobilereviewbd, hridoy, asmaul, mithu, jahidul";
	$canonical = "$base/contact/";

}   elseif (strpos($page, '/privacy-policy') !== false) {
    $title = "contact mobile review bd | mobilereviewbd";
    $meta_description = "MobileReviewBD — a trusted platform in Bangladesh where you can find the latest mobile phone reviews, prices, and specifications. We do not collect, store, or share any personal information from users. Our only goal is to provide accurate and updated information about mobile phones.";
    $meta_keywords = "privacy-policy, mobilereviewbd, reviews, specifications";
	$canonical = "$base/privacy-policy/";

}    elseif (strpos($page, '/disclaimer') !== false) {
    $title = "Disclaimer mobile review bd | mobilereviewbd";
    $meta_description = "MobileReviewBD — The mobile specifications, features, and prices we provide are collected from various trusted sources including manufacturer websites, retailer listings, and industry publications.";
    $meta_keywords = "privacy-policy, mobilereviewbd, reviews, specifications";
	$canonical = "$base/disclaimer/";

}     elseif (strpos($page, '/faq') !== false) {
    $title = "Mobile Review BD FAQ Questions | mobilereviewbd";
    $meta_description = "MobileReviewBD — FAQ page will answer all your mobile-related questions. Detailed help on phone selection, prices, features, and reviews in one place.";
    $meta_keywords = "privacy-policy, mobilereviewbd, reviews, specifications";
	$canonical = "$base/faq/";

} else {
    // Default values আগের মতোই থাকবে
}

// এখন HTML এ এগুলো প্রিন্ট করো
?>