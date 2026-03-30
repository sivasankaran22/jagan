<?php 
include_once 'inc/db.php';
$news_sql = "SELECT * FROM news LIMIT 2";
$news_result = $conn->query($news_sql);
?>
        <!-- News Section Start -->
        <section class="nano-news-section section-padding fix">
            <div class="container container-custom">
                <div class="section-title text-center">
                    <h6 class="wow fadeInUp">Blogs And Insight</h6>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">The latest education news <br> and insight</h2>
                </div>
                <div class="row">
                    <?php 
                    if ($news_result->num_rows > 0) {
                        $i = 1;
                        while($n = $news_result->fetch_assoc()) {
                    ?>
                    <div class="col-xl-6 col-lg-6 col-md-12 wow fadeInUp" data-wow-delay=".<?php echo $i*2; ?>s">
                        <div class="nano-news-box-items flex-lg-row flex-md-column flex-column">
                            <div class="nano-news-image">
                                <img src="<?php echo $n['image']; ?>" alt="img">
                                <span class="post-box"><?php echo $n['category']; ?></span>
                            </div>
                            <div class="nano-news-content">
                                <ul class="post-date">
                                    <li>
                                        <div class="icon">
                                            <i class="fa-calendar-days"></i>
                                        </div>
                                        <?php echo $n['date_post']; ?>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="fa-regular fa-comment-dots"></i>
                                        </div>
                                        Comments (<?php echo $n['comments']; ?>)
                                    </li>
                                </ul>
                                <h3><a href="<?php echo $n['link']; ?>"><?php echo $n['title']; ?></a></h3>
                                <a href="<?php echo $n['link']; ?>" class="theme-btn theme-white">
                                    Read Details
                                    <i class="fa-solid fa-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } } else { echo "<p>No news found.</p>"; } ?>
                </div>
            </div>
        </section>
