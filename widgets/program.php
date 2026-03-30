<?php 
include_once 'inc/db.php';
$program_sql = "SELECT * FROM programs";
$program_result = $conn->query($program_sql);
?>
        <!-- Program Section Start -->
        <section class="nano-program-section section-padding fix">
            <div class="container container-custom">
                <div class="row">
                    <?php 
                    if ($program_result->num_rows > 0) {
                        $i = 1;
                        while($p = $program_result->fetch_assoc()) {
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo $i*2; ?>s">
                        <div class="nano-program-box-items">
                            <div class="nano-program-image">
                                <img src="<?php echo $p['image']; ?>" alt="img">
                                <div class="nano-program-content">
                                    <h3><a href="<?php echo $p['link']; ?>"><?php echo $p['title']; ?></a></h3>
                                    <p><?php echo $p['description']; ?></p>
                                    <a href="<?php echo $p['link']; ?>" class="theme-btn theme-white">
                                        Read Details
                                        <i class="fa-solid fa-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } } else { echo "<p>No programs found.</p>"; } ?>
                </div>
            </div>
        </section>
