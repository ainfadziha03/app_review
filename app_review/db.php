<?php
$conn = new mysqli("localhost", "root", "", "app_review");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();
?>
