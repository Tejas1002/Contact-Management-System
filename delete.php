<?php include 'includes/db.php'; ?>

<?php
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM contacts WHERE id = :id");
$stmt->execute(['id' => $id]);
header("Location: index.php");
?>
