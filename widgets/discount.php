<?php 
include_once 'inc/db.php';
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

$discount_sql = "SELECT * FROM discount WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$discount_result = $conn->query($discount_sql);
$discount = $discount_result->fetch_assoc();

if (!$discount) {
    // Try Home (1) Position 1
    $discount_sql = "SELECT * FROM discount WHERE page_id = 1 AND position = 1 LIMIT 1";
    $discount_result = $conn->query($discount_sql);
    $discount = $discount_result->fetch_assoc();
}

if (!$discount) {
    $discount = [
        'title' => 'Act Fast: 50% Off for the <br> First 50 Students!',
        'description' => 'The ability to learn at my own pace was a game-changer for me. The flexible schedule allowed me to balance my studies with work and personal life, making it possible.',
        'bg_image' => 'assets/img/home-1/discount/bg-img.jpg',
        'btn_1_text' => 'Become a Student',
        'btn_1_link' => 'contact.html',
        'btn_2_text' => 'Become a Teacher',
        'btn_2_link' => 'team.html'
    ];
}
?>
        <!-- Discount Section Start (Pos: <?php echo $current_position; ?>) -->
        <section class="nano-discount-section bg-cover fix" style="background-image: url('<?php echo $discount['bg_image']; ?>');">
            <div class="container">
                <div class="nano-discount-wrapper">
                    <div class="nano-discount-content">
                        <h2 class="wow fadeInUp"><?php echo $discount['title']; ?></h2>
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            <?php echo $discount['description']; ?>
                        </p>
                        <div class="discount-button">
                            <a href="<?php echo $discount['btn_1_link']; ?>" class="theme-btn wow fadeInUp" data-wow-delay=".5s">
                                <?php echo $discount['btn_1_text']; ?>
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                            <a href="<?php echo $discount['btn_2_link']; ?>" class="theme-btn theme-white wow fadeInUp" data-wow-delay=".7s">
                                <?php echo $discount['btn_2_text']; ?>
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
