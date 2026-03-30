<?php 
$page_id = 5;
$breadcrumb_title = "page 3";
include_once "inc/db.php";
include "inc/header.php";
include "widgets/breadcrumb.php";
$position = 1;
include "widgets/about.php";
$position = 2;
include "widgets/category.php";
$position = 3;
include "widgets/about.php";
include "inc/footer.php";
?>