<?php 
include_once 'inc/db.php';
$cta_sql = "SELECT * FROM cta LIMIT 1";
$cta_result = $conn->query($cta_sql);
$cta = $cta_result->fetch_assoc();
if (!$cta) {
    $cta = [
        'title' => 'Join our newsletter, spam-free.',
        'bg_image' => 'assets/img/home-1/cta/cta-bg.jpg',
        'placeholder' => 'Enter your email',
        'btn_text' => 'Subscribe Now'
    ];
}
?>
        <!-- CTA Section Start -->
        <section class="nano-cta-section section-padding fix bg-cover" style="background-image: url('<?php echo $cta['bg_image']; ?>');">
            <div class="container container-custom">
                <div class="nano-cta-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="nano-cta-content">
                                <h2 class="text-white wow fadeInUp"><?php echo $cta['title']; ?></h2>
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-5 wow fadeInUp" data-wow-delay=".5s">
                            <form action="#" id="cta-form" class="cta-form-box">
                                <div class="form-clt">
                                    <input type="text" name="email" id="email" placeholder="<?php echo $cta['placeholder']; ?>">
                                    <button type="submit" class="theme-btn theme-white">
                                        <?php echo $cta['btn_text']; ?>
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
