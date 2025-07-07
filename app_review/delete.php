<?php
include 'db.php';
$id = $_GET['id'];

// Padam semua comment berkaitan dulu
$conn->query("DELETE FROM comments WHERE application_id = $id");

// Baru padam dari applications
$conn->query("DELETE FROM applications WHERE id = $id");

header("Location: index.php");
?>
