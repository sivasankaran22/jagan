<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) exit;
include_once '../inc/db.php';

header('Content-Type: application/json');
$res = $conn->query("SELECT * FROM uploads ORDER BY id DESC");
$images = [];
while($row = $res->fetch_assoc()) $images[] = $row;
echo json_encode($images);
?>
