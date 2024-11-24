<?php
$host = 'localhost';
$port = '3307'; // XAMPP MySQL port
$dbname = 'ContactDB';
$username = 'root';
$password = ''; // Default password is empty for root in XAMPP

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop further execution if the connection fails
}
?>

