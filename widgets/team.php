<?php 
include_once 'inc/db.php';
$current_page_id = isset($page_id) ? $page_id : 1;
$current_position = isset($position) ? $position : 1;

$team_sql = "SELECT * FROM team WHERE page_id = $current_page_id AND position = $current_position ORDER BY id ASC";
$team_result = $conn->query($team_sql);

if ($team_result->num_rows == 0) {
    // Fallback to Home (1) Position 1
    $team_sql = "SELECT * FROM team WHERE page_id = 1 AND position = 1 ORDER BY id ASC";
    $team_result = $conn->query($team_sql);
}
?>
        <!-- Team Section Start (Pos: <?php echo $current_position; ?>) -->
        <section class="nano-team-section section-padding fix">
            <div class="container container-custom">
                <div class="section-title text-center">
                    <h6 class="wow fadeInUp">Team Member</h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">The latest education news <br> and insight</h2>
                </div>
                <div class="row">
                    <?php 
                    if ($team_result->num_rows > 0) {
                        $delay = 0.2;
                        while($t = $team_result->fetch_assoc()) {
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                        <div class="nano-team-box-items">
                            <div class="nano-team-image">
                                <img src="<?php echo $t['image']; ?>" alt="img">
                                <div class="social-icon">
                                    <i class="fa-solid fa-share-nodes"></i>
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nano-team-content">
                                <h3><a href="team-details.html"><?php echo $t['name']; ?></a></h3>
                                <p><?php echo $t['designation']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 0.2; } } else { echo "<p class='text-center'>No instructors found for this layout position.</p>"; } ?>
                </div>
            </div>
        </section>
