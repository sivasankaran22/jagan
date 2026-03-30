<?php
include_once 'inc/db.php';
?>
        <!-- Courses Section Start -->
        <section class="nano-courses-section section-padding fix">
            <div class="container">
                <div class="section-title-area align-items-end">
                    <div class="section-title">
                        <h6 class="wow fadeInUp">Popular Courses</h6>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Explore Featured Courses</h2>
                    </div>
                    <ul class="nav wow fadeInUp" data-wow-delay=".4s">
                        <li class="nav-item wow fadeInUp" data-wow-delay=".2s">
                            <a href="#AllCourses" data-bs-toggle="tab" class="nav-link active">
                               All Courses
                            </a>
                        </li>
                        <?php
                        $cat_sql = "SELECT DISTINCT category FROM courses";
                        $cat_result = $conn->query($cat_sql);
                        if ($cat_result->num_rows > 0) {
                            $delay = 0.4;
                            while($cat_row = $cat_result->fetch_assoc()) {
                                $cat_name = $cat_row['category'];
                                $cat_id = str_replace(' ', '', $cat_name);
                                echo '<li class="nav-item wow fadeInUp" data-wow-delay="'.$delay.'s">
                                        <a href="#'.$cat_id.'" data-bs-toggle="tab" class="nav-link">'.$cat_name.'</a>
                                      </li>';
                                $delay += 0.2;
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="AllCourses" class="tab-pane fade show active">
                        <div class="row">
                            <?php 
                            $sql = "SELECT * FROM courses";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo $i*2; ?>s">
                                <div class="nano-courses-box-items">
                                    <div class="nano-courses-image">
                                        <img src="<?php echo $row['image']; ?>" alt="img">
                                        <span class="post-box">
                                        <?php echo $row['category']; ?>
                                        </span>
                                    </div>
                                    <div class="nano-courses-content">
                                        <div class="star">
                                            <?php for($s=0; $s<$row['rating']; $s++) echo '<i class="fa-solid fa-star-sharp"></i>'; ?>
                                        </div>
                                        <h3><a href="courses-details.html"><?php echo $row['title']; ?></a></h3>
                                        <ul class="post-date">
                                            <li>
                                                <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I" class="icon video-popup">
                                                <i class="fa-regular fa-circle-play"></i>
                                                </a>
                                                <?php echo $row['lessons']; ?>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <i class="fa-regular fa-user"></i>
                                                </div>
                                                <?php echo $row['students']; ?>
                                            </li>
                                        </ul>
                                        <div class="client-info-area">
                                            <div class="client-info">
                                                <div class="img">
                                                    <img src="<?php echo $row['instructor_img']; ?>" alt="img">
                                                </div>
                                                <?php echo $row['instructor_name']; ?>
                                            </div>
                                            <h2><?php echo $row['price']; ?></h2>
                                        </div>
                                        <a href="courses-details.html" class="theme-btn">
                                        Enroll Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; } } else { echo "<p>No courses found.</p>"; } ?>
                        </div>
                    </div>
                    
                    <?php
                    // Reset pointer and generate category tabs
                    $cat_result->data_seek(0);
                    while($cat_row = $cat_result->fetch_assoc()) {
                        $cat_name = $cat_row['category'];
                        $cat_id = str_replace(' ', '', $cat_name);
                    ?>
                    <div id="<?php echo $cat_id; ?>" class="tab-pane fade">
                        <div class="row">
                            <?php 
                            $sql = "SELECT * FROM courses WHERE category='$cat_name'";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="nano-courses-box-items">
                                    <div class="nano-courses-image">
                                        <img src="<?php echo $row['image']; ?>" alt="img">
                                        <span class="post-box"><?php echo $row['category']; ?></span>
                                    </div>
                                    <div class="nano-courses-content">
                                        <div class="star">
                                            <?php for($s=0; $s<$row['rating']; $s++) echo '<i class="fa-solid fa-star-sharp"></i>'; ?>
                                        </div>
                                        <h3><a href="courses-details.html"><?php echo $row['title']; ?></a></h3>
                                        <ul class="post-date">
                                            <li>
                                                <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I" class="icon video-popup">
                                                <i class="fa-regular fa-circle-play"></i>
                                                </a>
                                                <?php echo $row['lessons']; ?>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fa-regular fa-user"></i></div>
                                                <?php echo $row['students']; ?>
                                            </li>
                                        </ul>
                                        <div class="client-info-area">
                                            <div class="client-info">
                                                <div class="img"><img src="<?php echo $row['instructor_img']; ?>" alt="img"></div>
                                                <?php echo $row['instructor_name']; ?>
                                            </div>
                                            <h2><?php echo $row['price']; ?></h2>
                                        </div>
                                        <a href="courses-details.html" class="theme-btn">Enroll Now</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
