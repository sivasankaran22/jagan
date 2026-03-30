<?php 
 $page_id = 1; 
 $breadcrumb_title = 'Home Page'; 
 include_once 'inc/db.php'; 
 include 'inc/header.php'; 
 $position = 1; 
 include 'widgets/hero.php'; 
 $position = 2; 
 include 'widgets/about.php'; 
 $position = 3; 
 include 'widgets/why-choose-us-nano.php'; 
 $position = 4; 
 include 'widgets/team.php'; 
 $position = 5; 
 include 'widgets/testimonial-2.php'; 
 $position = 6; 
 include 'widgets/google-reviews.php'; 
 include 'inc/footer.php'; 
 ?>