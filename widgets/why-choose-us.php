<?php 
include_once 'inc/db.php';
$wcu_sql = "SELECT * FROM why_choose_us LIMIT 1";
$wcu_result = $conn->query($wcu_sql);
$wcu = $wcu_result->fetch_assoc();
if (!$wcu) {
    $wcu = [
        'title' => 'Learning That Aligns With Your Personal Goals.',
        'description' => 'Unlock your full potential with education tailored to your personal aspirations. Learn, grow, and achieve success.',
        'main_image' => 'assets/img/home-1/choose-us/choose-1.png',
        'thumb_1' => 'assets/img/home-1/choose-us/choose-2.png',
        'thumb_2' => 'assets/img/home-1/choose-us/choose-3.png',
        'counter_value' => 92,
        'counter_text' => 'Customizable Courses.'
    ];
}

$features_sql = "SELECT * FROM why_choose_us_features";
$features_result = $conn->query($features_sql);
?>
        <!-- Why Choose Us Section Start -->
        <section class="nano-choose-us-section section-padding fix">
            <div class="container">
                <div class="nano-choose-us-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="nano-choose-us-image">
                                <img src="<?php echo $wcu['main_image']; ?>" alt="img">
                                <div class="nano-discount-thumb">
                                    <img src="<?php echo $wcu['thumb_1']; ?>" alt="img">
                                </div>
                                <div class="nano-discount-thumb-2">
                                    <img src="<?php echo $wcu['thumb_2']; ?>" alt="img">
                                </div>
                                <div class="nano-counter-box text-center">
                                    <h2><span class="count"><?php echo $wcu['counter_value']; ?></span>%</h2>
                                    <p><?php echo $wcu['counter_text']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-5">
                            <div class="nano-choose-us-content">
                                <div class="section-title">
                                    <h6 class="wow fadeInUp">Why Choose Us</h6>
                                    <h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo $wcu['title']; ?></h2>
                                </div>
                                <p class="choose-text wow fadeInUp" data-wow-delay=".4s">
                                   <?php echo $wcu['description']; ?>
                                </p>
                                <div class="row align-items-center g-4">
                                    <?php 
                                    if ($features_result->num_rows > 0) {
                                        while($f = $features_result->fetch_assoc()) {
                                    ?>
                                    <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $f['delay']; ?>">
                                        <div class="nano-icon-box-items <?php echo $f['style_class']; ?>">
                                            <div class="icon">
                                                <img src="<?php echo $f['icon']; ?>" alt="img">
                                            </div>
                                            <h3><?php echo $f['title']; ?></h3>
                                            <p><?php echo $f['description']; ?></p>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
