<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "mobile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$mobile_id = $_POST['mobile_id'];
$brand_id = $_POST['brand_id'];
$made_by = $_POST['made_by'];
$height = $_POST['height'];
$width = $_POST['width'];
$thickness = $_POST['thickness'];
$build = $_POST['build'];
$weight = $_POST['weight'];
$colors = $_POST['colors'];
$water_resistant = $_POST['water_resistant'];
$display_type = $_POST['display_type'];
$screen_size = $_POST['screen_size'];
$resolution = $_POST['resolution'];
$aspect_ratio = $_POST['aspect_ratio'];
$refresh_rate = $_POST['refresh_rate'];
$main_camera_setup = $_POST['main_camera_setup'];
$main_camera_resolution = $_POST['main_camera_resolution'];
$selfie_camera_setup = $_POST['selfie_camera_setup'];
$selfie_camera_resolution = $_POST['selfie_camera_resolution'];
$operating_system = $_POST['operating_system'];
$chipset = $_POST['chipset'];
$cpu = $_POST['cpu'];
$gpu = $_POST['gpu'];
$ram = $_POST['ram'];
$internal_storage = $_POST['internal_storage'];
$battery_type = $_POST['battery_type'];
$capacity = $_POST['capacity'];
$charging = $_POST['charging'];
$network = $_POST['network'];
$sim_slot = $_POST['sim_slot'];
$wlan = $_POST['wlan'];
$bluetooth = $_POST['bluetooth'];
$usb = $_POST['usb'];
$fingerprint_sensor = $_POST['fingerprint_sensor'];
$face_unlock = $_POST['face_unlock'];

// Insert query
$sql = "INSERT INTO mobile_specification (
    mobile_id, brand_id, made_by, height, width, thickness, build, weight, 
    colors, water_resistant, display_type, screen_size, resolution, 
    aspect_ratio, refresh_rate, main_camera_setup, main_camera_resolution, 
    selfie_camera_setup, selfie_camera_resolution, operating_system, 
    chipset, cpu, gpu, ram, internal_storage, battery_type, capacity, 
    charging, network, sim_slot, wlan, bluetooth, usb, fingerprint_sensor, 
    face_unlock
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "iisssssssssssssssssssssssssssssssss", 
    $mobile_id, $brand_id, $made_by, $height, $width, $thickness, $build, $weight,
    $colors, $water_resistant, $display_type, $screen_size, $resolution,
    $aspect_ratio, $refresh_rate, $main_camera_setup, $main_camera_resolution,
    $selfie_camera_setup, $selfie_camera_resolution, $operating_system,
    $chipset, $cpu, $gpu, $ram, $internal_storage, $battery_type, $capacity,
    $charging, $network, $sim_slot, $wlan, $bluetooth, $usb, $fingerprint_sensor,
    $face_unlock
);

if ($stmt->execute()) {
    echo "Mobile specification added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>