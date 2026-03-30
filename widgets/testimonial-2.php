<?php 
include_once 'inc/db.php';

// Get IDs from parent page context (set by page-builder or individual pages)
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

// 1. Fetch Section Branding
$sec_sql = "SELECT * FROM testimonial_2_section WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$sec_res = $conn->query($sec_sql);
$section = $sec_res ? $sec_res->fetch_assoc() : null;

if (!$section) {
    $section = [
        'sub_title' => 'Tesimonials',
        'title' => 'What Our Clients are Saying <br> About Us'
    ];
}

// 2. Fetch Testimonial Items
$items_sql = "SELECT * FROM testimonials WHERE page_id = $current_page_id AND position = $current_position ORDER BY id ASC";
$items_res = $conn->query($items_sql);
$testimonials = [];
if ($items_res && $items_res->num_rows > 0) {
    while($row = $items_res->fetch_assoc()) $testimonials[] = $row;
} else {
    // Static Fallback Data
    $testimonials = [
        ['name' => 'Alexander Cameron', 'role' => 'Lead Developer', 'image' => 'assets/img/home-2/testimonial/client-01.png', 'content' => 'Morbi consectetur elementum purus mattis cursus purus metus iaculis sagittis. Vestibulum molestie bibendum turpis luctus sem lacinia quis. Quisque amet velit sit amet dui hendrerit ultricies a id ipsum Mauris sit amet lacinia est"sed augue. Donec lacinia est"sed augue Donec elementumelementum.', 'rating' => 5],
        ['name' => 'John Doe', 'role' => 'Designer', 'image' => 'assets/img/home-2/testimonial/client-02.png', 'content' => 'Another great review from a happy client. The quality of work and attention to detail exceeded expectations in every single way possible.', 'rating' => 5],
        ['name' => 'Jane Smith', 'role' => 'Manager', 'image' => 'assets/img/home-2/testimonial/client-03.png', 'content' => 'Professionalism and expertise are second to none. I highly recommend their services to anyone looking for top-tier educational support.', 'rating' => 4],
    ];
}
?>

        <!-- Testimonial Section Start (Position: <?php echo $current_position; ?>) -->
        <section class="nano-testimonial-section-2 mt-0 mb-0 style-inner section-padding section-bg">
            <div class="testimonial-shape-1">
                <img src="assets/img/home-2/testimonial/shape-01.png" alt="img">
            </div>
            <div class="testimonial-shape-2">
                <img src="assets/img/home-2/testimonial/shape-02.png" alt="img">
            </div>
            <style>
                .testimonial-thumbs {
                    margin-top: 30px;
                    max-width: 500px;
                }
                .testimonial-thumbs .swiper-slide {
                    cursor: pointer;
                    opacity: 0.6;
                    transition: all 0.3s ease;
                    text-align: center;
                }
                .testimonial-thumbs .swiper-slide-thumb-active {
                    opacity: 1;
                }
                .testimonial-thumbs .swiper-slide img {
                    width: 80px !important;
                    height: 80px !important;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 3px solid transparent;
                    margin: 0 auto 10px;
                    transition: all 0.3s ease;
                }
                .testimonial-thumbs .swiper-slide-thumb-active img {
                    border-color: #fca12a;
                    transform: scale(1.1);
                }
                .testimonial-thumbs .nano-info {
                    transition: all 0.3s ease;
                    opacity: 0;
                    transform: translateY(10px);
                }
                .testimonial-thumbs .swiper-slide-thumb-active .nano-info {
                    opacity: 1;
                    transform: translateY(0);
                }
                .testimonial-thumbs .nano-info h3 {
                    font-size: 16px;
                    margin: 0;
                }
                .testimonial-thumbs .nano-info span {
                    font-size: 13px;
                    color: #666;
                }
                .nano-testimonial-box-2 {
                    padding: 40px;
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                    margin-bottom: 20px;
                    min-height: 250px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }
                .nano-testimonial-box-2 .star {
                    color: #fca12a;
                    margin-bottom: 15px;
                }
                .nano-testimonial-box-2 h3 {
                    font-size: 20px;
                    line-height: 1.6;
                    font-weight: 500;
                }
                @media (max-width: 767px) {
                    .testimonial-thumbs .swiper-slide img {
                        width: 60px !important;
                        height: 60px !important;
                    }
                    .testimonial-thumbs .nano-info h3 { font-size: 14px; }
                }
            </style>
           <div class="container">
                <div class="section-title text-center">
                    <h6 class="wow fadeInUp"><?php echo $section['sub_title']; ?></h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $section['title']; ?></h2>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-2 d-none d-xl-block">
                        <div class="array-button">
                            <button class="array-prev"><i class="fa-solid fa-chevron-left"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="swiper-container fix testimonial-slider-content">
                            <div class="swiper-wrapper">
                                <?php foreach($testimonials as $t): ?>
                                <div class="swiper-slide">
                                     <div class="nano-testimonial-box-2">
                                        <div class="star">
                                            <?php 
                                            $r = isset($t['rating']) ? intval($t['rating']) : 5;
                                            for($i=1; $i<=5; $i++) echo ($i <= $r) ? '<i class="fa-solid fa-star-sharp"></i>' : '<i class="fa-regular fa-star-sharp"></i>';
                                            ?>
                                        </div>
                                        <h3>"<?php echo htmlspecialchars($t['content']); ?>”</h3>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                         <div class="swiper-container testimonial-thumbs mx-auto">
                            <div class="swiper-wrapper">
                                <?php foreach($testimonials as $t): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $t['image']; ?>" alt="img">
                                    <div class="nano-info">
                                        <h3><?php echo $t['name']; ?></h3>
                                        <span><?php echo $t['role']; ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 d-none d-xl-block">
                        <div class="array-button justify-content-end">
                            <button class="array-next"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
