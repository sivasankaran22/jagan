<?php 
include_once 'inc/db.php';
$testi_sql = "SELECT * FROM testimonials";
$testi_result = $conn->query($testi_sql);
?>
        <!-- Testimonial Section Start -->
        <section class="nano-testimonial-section section-padding fix">
            <div class="container container-custom">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="nano-testimonial-image">
                            <img src="assets/img/home-1/testimonial/testimonial-img.png" alt="img">
                            <div class="testimonial-shape">
                                <img src="assets/img/home-1/testimonial/testimonial-shape.png" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-5">
                        <div class="nano-testimonial-content">
                            <div class="section-title">
                                <h6 class="wow fadeInUp">Tesimonials</h6>
                                <h2 class="wow fadeInUp" data-wow-delay=".2s">What Our Clients are Saying <br> About Us</h2>
                            </div>
                            <div class="swiper-container testimonial-slider-content">
                                <div class="swiper-wrapper">
                                    <?php 
                                    if ($testi_result->num_rows > 0) {
                                        while($t = $testi_result->fetch_assoc()) {
                                    ?>
                                    <div class="swiper-slide">
                                         <div class="nano-testimonial-box-items">
                                            <div class="star">
                                                <?php for($s=0; $s<$t['rating']; $s++) echo '<i class="fa-solid fa-star-sharp"></i>'; ?>
                                            </div>
                                            <h3>
                                                “ <?php echo $t['content']; ?> ”
                                            </h3>
                                            <div class="client-info">
                                                <div class="img">
                                                    <img src="<?php echo $t['image']; ?>" alt="img">
                                                </div>
                                                <div class="content">
                                                    <h5><?php echo $t['name']; ?></h5>
                                                    <p><?php echo $t['role']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } else { echo "<p>No testimonials found.</p>"; } ?>
                                </div>
                                <div class="array-button mt-40">
                                    <button class="array-prev"><i class="fa-solid fa-chevron-left"></i></button>
                                    <button class="array-next"><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
