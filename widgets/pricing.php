<?php 
include_once 'inc/db.php';
$plans_sql = "SELECT * FROM pricing_plans";
$plans_result = $conn->query($plans_sql);
?>
        <!-- Pricing Section Start -->
        <section class="nano-pricing-section-3 section-padding fix">
            <div class="container container-custom">
                <div class="section-title text-center">
                    <h6 class="wow fadeInUp">Pricing Plan</h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Select a plan according to <br> your requirements</h2>
                    <div class="d-flex justify-content-center mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".4s">
                        <div class="pricing-two__tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="pt-1-tab" data-bs-toggle="tab" data-bs-target="#pt-1" type="button" role="tab" aria-controls="pt-1" aria-selected="true">Monthly</button>
                                    <button class="nav-link" id="pt-2-tab" data-bs-toggle="tab" data-bs-target="#pt-2" type="button" role="tab" aria-controls="pt-2" aria-selected="false" tabindex="-1">Yearly</button>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                 <div class="pricing__tab-content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="pt-1" role="tabpanel" aria-labelledby="pt-1-tab">
                            <div class="pricing-package-wrapper">
                               <div class="row">
                                    <?php 
                                    if ($plans_result->num_rows > 0) {
                                        $i = 1;
                                        while($p = $plans_result->fetch_assoc()) {
                                    ?>
                                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo $i*3; ?>s">
                                        <div class="nano-pricing-box-items-3 <?php echo $p['is_popular'] ? 'active' : ''; ?>">
                                            <?php if($p['is_popular']): ?><span class="popul-text">Popular</span><?php endif; ?>
                                            <div class="pricing-header">
                                                <h3><?php echo $p['title']; ?></h3>
                                                <h2><?php echo $p['price_monthly']; ?> <sup>per month</sup></h2>
                                                <p><?php echo $p['description']; ?></p>
                                                <a href="pricing.php" class="theme-btn">
                                                    <?php echo $p['btn_text']; ?>
                                                </a>
                                            </div>
                                            <h4>Features</h4>
                                            <ul class="list-items">
                                                <?php 
                                                $feat_sql = "SELECT * FROM pricing_features WHERE plan_id=".$p['id'];
                                                $feat_result = $conn->query($feat_sql);
                                                while($f = $feat_result->fetch_assoc()) {
                                                ?>
                                                <li>
                                                    <i class="fa-solid fa-check"></i>
                                                    <?php echo $f['feature']; ?>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $i++; } } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pt-2" role="tabpanel" aria-labelledby="pt-2-tab">
                            <div class="pricing-package-wrapper">
                                 <div class="row">
                                    <?php 
                                    $plans_result->data_seek(0);
                                    if ($plans_result->num_rows > 0) {
                                        $i = 1;
                                        while($p = $plans_result->fetch_assoc()) {
                                    ?>
                                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo $i*3; ?>s">
                                        <div class="nano-pricing-box-items-3 <?php echo $p['is_popular'] ? 'active' : ''; ?>">
                                            <?php if($p['is_popular']): ?><span class="popul-text">Popular</span><?php endif; ?>
                                            <div class="pricing-header">
                                                <h3><?php echo $p['title']; ?></h3>
                                                <h2><?php echo $p['price_yearly']; ?> <sup>per year</sup></h2>
                                                <p><?php echo $p['description']; ?></p>
                                                <a href="pricing.php" class="theme-btn">
                                                    <?php echo $p['btn_text']; ?>
                                                </a>
                                            </div>
                                            <h4>Features</h4>
                                            <ul class="list-items">
                                                <?php 
                                                $feat_sql = "SELECT * FROM pricing_features WHERE plan_id=".$p['id'];
                                                $feat_result = $conn->query($feat_sql);
                                                while($f = $feat_result->fetch_assoc()) {
                                                ?>
                                                <li>
                                                    <i class="fa-solid fa-check"></i>
                                                    <?php echo $f['feature']; ?>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $i++; } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
