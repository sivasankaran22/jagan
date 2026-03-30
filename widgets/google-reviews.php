<?php 
include_once 'inc/db.php';

// Context IDs
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

// 1. Section Branding
$sec_sql = "SELECT * FROM google_reviews_section WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$sec_res = $conn->query($sec_sql);
$section = $sec_res ? $sec_res->fetch_assoc() : null;

if (!$section) {
    $section = [
        'sub_title' => 'Students Reviews', 
        'title' => 'What Students Say About <br> Our Platform.',
        'google_score' => '5.0',
        'google_icon' => 'assets/img/home-1/testimonial/icon-01.png',
        'btn_text' => 'All Testimonials',
        'btn_link' => 'testimonial.html'
    ];
}

// 2. Reviews Items
$reviews_sql = "SELECT * FROM testimonials WHERE page_id = $current_page_id AND position = $current_position ORDER BY id ASC";
$reviews_res = $conn->query($reviews_sql);
$reviews = [];
if ($reviews_res && $reviews_res->num_rows > 0) {
    while($row = $reviews_res->fetch_assoc()) $reviews[] = $row;
} else {
    // Default Static Content
    $reviews = [
        ['name' => 'Marvin McKinney', 'role' => 'Product Manager', 'image' => 'assets/img/home-1/testimonial/client-01.png', 'content' => 'Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.'],
        ['name' => 'Lauren Janet', 'role' => 'Founder CEO', 'image' => 'assets/img/home-1/testimonial/client-02.png', 'content' => 'Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.'],
        ['name' => 'Ramon Joshua', 'role' => 'Product Manager', 'image' => 'assets/img/home-1/testimonial/client-03.png', 'content' => 'Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.'],
    ];
}
?>

        <!-- Testimonial Section Start (Position: <?php echo $current_position; ?>) -->
        <section class="nano-testimonial-section section-padding fix">
            <div class="container">
                <div class="section-title-area">
                    <div class="section-title">
                        <h6 class="wow fadeInUp"><?php echo htmlspecialchars($section['sub_title']); ?></h6>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $section['title']; ?></h2>
                    </div>
                    <div class="nano-testimonial-author-items wow fadeInUp" data-wow-delay=".4s">
                        <div class="nano-testimonial-author">
                            <div class="icon">
                                <img src="<?php echo htmlspecialchars($section['google_icon']); ?>" alt="img">
                            </div>
                            <div class="content">
                                <h3><?php echo htmlspecialchars($section['google_score']); ?></h3>
                                <p>Google Reviews</p>
                            </div>
                        </div>
                        <div class="testimonial-btn">
                            <a href="<?php echo htmlspecialchars($section['btn_link']); ?>" class="theme-btn">
                            <?php echo htmlspecialchars($section['btn_text']); ?>
                            <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper nano-testimonial-slider">
                    <div class="swiper-wrapper">
                        <?php foreach($reviews as $r): ?>
                        <div class="swiper-slide">
                            <div class="nano-testimonial-box-items">
                                <div class="quote-icon">
                                    <img src="assets/img/home-1/testimonial/quote-01.png" alt="img">
                                </div>
                                <h4>
                                    “ <?php echo htmlspecialchars(substr($r['content'], 0, 250)); ?>
                                </h4>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="<?php echo htmlspecialchars($r['image']); ?>" alt="img" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>
                                    <div class="client-content">
                                        <h3><?php echo htmlspecialchars($r['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($r['role']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="array-button mt-5">
                        <button class="array-prev"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="array-next"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </section>
