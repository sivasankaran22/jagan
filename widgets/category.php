<?php 
include_once 'inc/db.php';
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

// Fetch unique categories for this specific Page and Position
$cat_sql = "SELECT * FROM top_categories WHERE page_id = $current_page_id AND position = $current_position ORDER BY id ASC";
$cat_result = $conn->query($cat_sql);

if ($cat_result->num_rows == 0) {
    // Fallback: If no categories assigned to this instance, try Home (1) Pos (1)
    $cat_sql = "SELECT * FROM top_categories WHERE page_id = 1 AND position = 1 ORDER BY id ASC";
    $cat_result = $conn->query($cat_sql);
}

// Deep fallback if database is empty
if ($cat_result->num_rows == 0) {
    // Maybe provide hardcoded sample categories here if needed
}
?>
        <!-- Category Section Start (Pos: <?php echo $current_position; ?>) -->
        <section class="nano-category-section section-padding fix section-bg">
            <div class="container">
                <div class="section-title text-center">
                    <h6 class="wow fadeInUp">Top Categories</h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Explore Our Categories</h2>
                </div>
                <div class="row">
                    <?php 
                    if ($cat_result->num_rows > 0) {
                        while($row = $cat_result->fetch_assoc()) {
                    ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo $row['delay']; ?>">
                        <div class="nano-category-box-items">
                            <div class="icon">
                                <img src="<?php echo $row['icon']; ?>" alt="img">
                            </div>
                            <h3><a href="<?php echo $row['link']; ?>"><?php echo $row['name']; ?></a></h3>
                            <a href="<?php echo $row['link']; ?>" class="theme-btn theme-white">
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <?php } } else { echo "<p class='text-center'>No categories found for this instance.</p>"; } ?>
                </div>
            </div>
        </section>
