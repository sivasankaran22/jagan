<?php 
include_once 'inc/db.php';
$marquee_sql = "SELECT * FROM marquee_items";
$marquee_result = $conn->query($marquee_sql);
?>
        <div class="marquee-section">
            <div class="mycustom-marque theme-green-bg-1">
                <div class="scrolling-wrap">
                    <?php 
                    // Duplicate for seamless scroll
                    for($j=0; $j<4; $j++): 
                    ?>
                    <div class="comm">
                        <?php 
                        if ($marquee_result->num_rows > 0) {
                            while($m = $marquee_result->fetch_assoc()) {
                        ?>
                        <div class="cmn-textslide text-color-2"> 
                            <img src="<?php echo $m['icon']; ?>" alt="img"> 
                            <?php echo $m['text']; ?>
                        </div>
                        <?php 
                            }
                            $marquee_result->data_seek(0); // Reset for next loop
                        } 
                        ?>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
