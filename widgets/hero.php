<?php 
include_once 'inc/db.php';

// Get IDs from parent page
$current_page_id = isset($page_id) ? $page_id : 1;
// Get position index from parent page (e.g. 1st hero, 2nd hero)
$current_position = isset($position) ? $position : 1;

// Fetch unique content for this specific Page + Position
$hero_sql = "SELECT * FROM hero WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$hero_result = $conn->query($hero_sql);
$hero = $hero_result ? $hero_result->fetch_assoc() : null;

if (!$hero) {
    // Fallback: If no specific content for this position, try first hero of this page
    $hero_sql = "SELECT * FROM hero WHERE page_id = $current_page_id LIMIT 1";
    $hero_result = $conn->query($hero_sql);
    $hero = $hero_result ? $hero_result->fetch_assoc() : null;
}

if (!$hero) {
    // Second Fallback: Home Page (1) first hero
    $hero_sql = "SELECT * FROM hero WHERE page_id = 1 AND position = 1 LIMIT 1";
    $hero_result = $conn->query($hero_sql);
    $hero = $hero_result ? $hero_result->fetch_assoc() : null;
}

// Final static fallback with all nano-hero fields
if (!$hero) {
    $hero = [
        'sub_title' => 'Welcome to Online Education',
        'title' => 'Learn from the Top Sites Around the World',
        'description' => 'Education is the foundation of personal societal growth, empowering individuals with knowledge, skills critical empowering thinking.',
        'btn_text' => 'Get Started',
        'btn_link' => 'contact.html',
        'bg_image' => 'assets/img/home-1/hero/hero-bg.jpg',
        'shape_1' => 'assets/img/home-1/hero/shape-01.png',
        'shape_2' => 'assets/img/home-1/hero/shape-02.png',
        'shape_3' => 'assets/img/home-1/hero/shape-03.png',
        'shape_4' => 'assets/img/home-1/hero/shape-04.png',
        'shape_5' => 'assets/img/home-1/hero/shape-05.png',
        'student_count' => '5436',
        'student_img' => 'assets/img/home-1/hero/client-img.png',
        'course_count' => '5436',
        'hero_img_1' => 'assets/img/home-1/hero/hero-01.png',
        'hero_img_2' => 'assets/img/home-1/hero/hero-02.png'
    ];
}

// Ensure columns exist even if DB isn't fully migrated yet (safety)
$hero['bg_image'] = $hero['bg_image'] ?? 'assets/img/home-1/hero/hero-bg.jpg';
$hero['shape_1'] = $hero['shape_1'] ?? 'assets/img/home-1/hero/shape-01.png';
$hero['shape_2'] = $hero['shape_2'] ?? 'assets/img/home-1/hero/shape-02.png';
$hero['shape_3'] = $hero['shape_3'] ?? 'assets/img/home-1/hero/shape-03.png';
$hero['shape_4'] = $hero['shape_4'] ?? 'assets/img/home-1/hero/shape-04.png';
$hero['shape_5'] = $hero['shape_5'] ?? 'assets/img/home-1/hero/shape-05.png';
$hero['student_count'] = $hero['student_count'] ?? '5436';
$hero['student_img'] = $hero['student_img'] ?? 'assets/img/home-1/hero/client-img.png';
$hero['course_count'] = $hero['course_count'] ?? '5436';
$hero['hero_img_1'] = $hero['hero_img_1'] ?? 'assets/img/home-1/hero/hero-01.png';
$hero['hero_img_2'] = $hero['hero_img_2'] ?? 'assets/img/home-1/hero/hero-02.png';
?>

        <!-- Nano Hero Section Start (Position: <?php echo $current_position; ?>) -->
        <section class="fix nano-hero-1 bg-cover" style="background-image: url('<?php echo $hero['bg_image']; ?>');">
            <div class="hero-shape-1 float-bob-x">
                <img src="<?php echo $hero['shape_1']; ?>" alt="img">
            </div>
            <div class="hero-shape-2 float-bob-y">
                <img src="<?php echo $hero['shape_2']; ?>" alt="img">
            </div>
            <div class="hero-shape-3 float-bob-y">
                <img src="<?php echo $hero['shape_3']; ?>" alt="img">
            </div>
            <div class="hero-shape-4 float-bob-x">
                <img src="<?php echo $hero['shape_4']; ?>" alt="img">
            </div>
            <div class="hero-shape-5 float-bob-y">
                <img src="<?php echo $hero['shape_5']; ?>" alt="img">
            </div>
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="nano-hero-content">
                            <span class="wow fadeInUp"><?php echo $hero['sub_title']; ?></span>
                            <h1 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $hero['title']; ?></h1>
                            <p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $hero['description']; ?></p>
                            <a href="<?php echo $hero['btn_link']; ?>" class="theme-btn wow fadeInUp" data-wow-delay=".6s">
                                <?php echo $hero['btn_text']; ?>
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="nano-right-items">
                            <div class="client-counter-box float-bob-x">
                                <div class="content">
                                    <h3><span class="count"><?php echo $hero['student_count']; ?></span>+</h3>
                                    <p>Student</p>
                                </div>
                                <div class="image">
                                    <img src="<?php echo $hero['student_img']; ?>" alt="img">
                                </div>
                            </div>
                            <div class="counter-box float-bob-y">
                                <h3><span class="count"><?php echo $hero['course_count']; ?></span>+</h3>
                                <p>Success Courses</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5 col-md-5 col-6">
                                    <div class="nano-hero-image style-2">
                                        <img src="<?php echo $hero['hero_img_1']; ?>" alt="img" class="wow img-custom-anim-left">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-sm-7 col-md-7 col-6">
                                    <div class="nano-hero-imag-2">
                                        <img src="<?php echo $hero['hero_img_2']; ?>" alt="img" class="wow img-custom-anim-right">                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

