<?php 
include_once 'inc/db.php';
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

$about_sql = "SELECT * FROM about WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$about_result = $conn->query($about_sql);
$about = $about_result->fetch_assoc();

if (!$about) {
    $about_sql = "SELECT * FROM about WHERE page_id = 1 AND position = 1 LIMIT 1";
    $about_result = $conn->query($about_sql);
    $about = $about_result->fetch_assoc();
}

if (!$about) {
    $about = [
        'sub_title' => 'About Us',
        'title' => 'Transforming Learning Into Lasting Impact',
        'description' => 'Luctus. Curabitur nibh justo imperdiet non ex non tempus faucibus urna Aliquam at elit vitae dui sagittis maximus Luctus. Curabitur nibh justo imperdiet non ex non tempus faucibus.',
        'image_main' => 'assets/img/home-1/about/about-01.png',
        'image_thumb' => 'assets/img/home-1/about/about-02.png',
        'image_3' => 'assets/img/home-1/about/about-03.png',
        'counter1_val' => '25',
        'counter1_text' => 'Year of Experience',
        'counter2_val' => '500',
        'counter2_text' => 'Class Completed',
        'counter3_val' => '100',
        'counter3_text' => 'Experts Instructors',
        'author_image' => 'assets/img/home-1/about/client-01.png',
        'author_name' => 'Ronald Richards',
        'author_designation' => 'Co, Founder',
        'btn_text' => 'Explore More',
        'btn_link' => 'about.html'
    ];
}
?>
        <!-- About Section Start (Pos: <?php echo $current_position; ?>) -->
        <section class="nano-about-section section-padding fix">
            <div class="container">
                <div class="nano-about-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="nano-about-image">
                                <img src="<?php echo $about['image_main']; ?>" alt="img">
                                <div class="nano-about-image-2 float-bob-x">
                                    <img src="<?php echo $about['image_thumb']; ?>" alt="img">
                                </div>
                                <div class="nano-about-image-3 float-bob-y">
                                    <img src="<?php echo $about['image_3']; ?>" alt="img">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="nano-about-content">
                                <div class="section-title mb-0">
                                    <h6 class="wow fadeInUp"><?php echo $about['sub_title']; ?></h6>
                                    <h2 class="wow fadeInUp" data-wow-delay=".2s">
                                        <?php echo $about['title']; ?>
                                    </h2>
                                </div>
                                <p class="about-text wow fadeInUp" data-wow-delay=".3s">
                                    <?php echo $about['description']; ?>
                                </p>
                                <div class="nano-counter-area">
                                    <div class="nano-counter-item wow fadeInUp" data-wow-delay=".4s">
                                        <h2><span class="count"><?php echo $about['counter1_val']; ?></span>+</h2>
                                        <p><?php echo $about['counter1_text']; ?></p>
                                    </div>
                                    <div class="nano-counter-item wow fadeInUp" data-wow-delay=".5s">
                                        <h2><span class="count"><?php echo $about['counter2_val']; ?></span>+</h2>
                                        <p><?php echo $about['counter2_text']; ?></p>
                                    </div>
                                    <div class="nano-counter-item border-none wow fadeInUp" data-wow-delay=".6s">
                                        <h2><span class="count"><?php echo $about['counter3_val']; ?></span>+</h2>
                                        <p><?php echo $about['counter3_text']; ?></p>
                                    </div>
                                </div>
                                <div class="nano-about-author wow fadeInUp" data-wow-delay=".9s">
                                    <div class="nano-about-button">
                                        <a href="<?php echo $about['btn_link']; ?>" class="theme-btn">
                                            <?php echo $about['btn_text']; ?>
                                            <i class="fa-solid fa-arrow-up-right"></i>
                                        </a>
                                    </div>
                                    <div class="nano-author-image">
                                        <img src="<?php echo $about['author_image']; ?>" alt="author-img">
                                        <div class="content">
                                            <h6><?php echo $about['author_name']; ?></h6>
                                            <p><?php echo $about['author_designation']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
