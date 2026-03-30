<?php 
include_once 'inc/db.php';
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

// Fetch main section data
$wcu_sql = "SELECT * FROM why_choose_us WHERE page_id = $current_page_id AND position = $current_position LIMIT 1";
$wcu_result = $conn->query($wcu_sql);
$wcu = $wcu_result->fetch_assoc();

if (!$wcu) {
    // Try global default
    $wcu_sql = "SELECT * FROM why_choose_us WHERE page_id = 1 AND position = 1 LIMIT 1";
    $wcu_result = $conn->query($wcu_sql);
    $wcu = $wcu_result->fetch_assoc();
}

if (!$wcu) {
    $wcu = [
        'sub_title' => 'Why Choose Us',
        'title' => 'Learning That Aligns With Your Personal Goals.',
        'description' => 'Unlock your full potential with education tailored to your personal aspirations. Learn, grow, and achieve success.',
        'main_image' => 'assets/img/home-1/choose-us/choose-1.png',
        'thumb_1' => 'assets/img/home-1/choose-us/choose-2.png',
        'thumb_2' => 'assets/img/home-1/choose-us/choose-3.png',
        'counter_value' => '92',
        'counter_text' => 'Customizable Courses.'
    ];
}

// Fetch features (icons)
$features_sql = "SELECT * FROM why_choose_us_features WHERE page_id = $current_page_id AND position = $current_position ORDER BY id ASC";
$features_result = $conn->query($features_sql);
$features = [];
while ($row = $features_result->fetch_assoc()) {
    $features[] = $row;
}

// If no features found, provide defaults
// if (empty($features)) {
//     $features = [
//         ['title' => 'Early Learning', 'description' => 'At the heart of our online community stands.', 'icon' => 'assets/img/home-1/choose-us/icon-01.svg', 'delay' => '.6s', 'style_class' => ''],
//         ['title' => 'Art and Craft', 'description' => 'At the heart of our online community stands.', 'icon' => 'assets/img/home-1/choose-us/icon-02.svg', 'delay' => '.8s', 'style_class' => 'style-2'],
//         ['title' => 'Brain Train', 'description' => 'At the heart of our online community stands.', 'icon' => 'assets/img/home-1/choose-us/icon-03.svg', 'delay' => '.9s', 'style_class' => 'style-2'],
//         ['title' => 'Music Area', 'description' => 'At the heart of our online community stands.', 'icon' => 'assets/img/home-1/choose-us/icon-04.svg', 'delay' => '.9s', 'style_class' => '']
//     ];
// }

// Chunk features for the 2x2 layout
$chunks = array_chunk($features, 2);
?>
        <!-- Why Choose Us Section Start (Pos: <?php echo $current_position; ?>) -->
        <section class="nano-why-choose-us-section section-padding fix">
            <div class="container">
                <div class="nano-choose-us-wrapper">
                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="nano-choose-us-content">
                                <div class="section-title mb-0">
                                    <h6 class="wow fadeInUp"><?php echo $wcu['sub_title']; ?></h6>
                                    <h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $wcu['title']; ?></h2>
                                </div>
                                <p class="choose-text wow fadeInUp" data-wow-delay=".4s">
                                    <?php echo $wcu['description']; ?>
                                </p>
                                
                                <?php foreach($chunks as $chunk): ?>
                                <div class="nano-choose-icon">
                                    <?php foreach($chunk as $item): ?>
                                    <div class="nano-icon-items wow fadeInUp" data-wow-delay="<?php echo $item['delay']; ?>">
                                        <div class="icon <?php echo isset($item['style_class']) ? $item['style_class'] : ''; ?>">
                                            <img src="<?php echo $item['icon']; ?>" alt="img">
                                        </div>
                                        <div class="content">
                                            <h4><?php echo $item['title']; ?></h4>
                                            <p><?php echo $item['description']; ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInUp" data-wow-delay=".4s">
                            <div class="nano-choose-image">
                                <img src="<?php echo $wcu['main_image']; ?>" alt="img">
                                <div class="nano-counter-item float-bob-x">
                                    <h2><span class="count"><?php echo $wcu['counter_value']; ?></span>+</h2>
                                    <p><?php echo $wcu['counter_text']; ?></p>
                                </div>
                                <div class="nano-choose-image-2 float-bob-y">
                                    <img src="<?php echo $wcu['thumb_1']; ?>" alt="img">
                                </div>
                                <div class="nano-choose-image-3 float-bob-x">
                                    <img src="<?php echo $wcu['thumb_2']; ?>" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
