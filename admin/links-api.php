<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) exit;
include_once '../inc/db.php';

header('Content_Type: application/json');
$res = $conn->query("SELECT id, title, filename FROM pages ORDER BY title ASC");
$pages = [
    ['id' => 0, 'title' => 'Home Page', 'filename' => 'index.php']
];
while($row = $res->fetch_assoc()) {
    if($row['filename'] != 'index.php') $pages[] = $row;
}
echo json_encode($pages);
?>
