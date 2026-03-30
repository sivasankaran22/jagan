<?php 
include_once 'inc/db.php'; 
// Detect Page ID for SEO
$current_page_id = isset($page_id) ? $page_id : 1; 
$page_query = $conn->query("SELECT * FROM pages WHERE id = $current_page_id");
$seo = $page_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="bizantheme">
        
        <!-- Standard SEO -->
        <title><?php echo $seo ? $seo['title'] : 'Eduex Education'; ?></title>
        <meta name="description" content="<?php echo $seo['meta_description'] ?? 'Eduex - Premium Education & Kindergarten Platform'; ?>">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
        <meta property="og:title" content="<?php echo $seo['og_title'] ?? $seo['title']; ?>">
        <meta property="og:description" content="<?php echo $seo['og_description'] ?? $seo['meta_description']; ?>">
        <meta property="og:image" content="<?php echo $seo['og_image'] ?? 'assets/img/logo/og-image.jpg'; ?>">

        <!-- Twitter -->
        <meta property="twitter:card" content="<?php echo $seo['twitter_card'] ?? 'summary_large_image'; ?>">
        <meta property="twitter:title" content="<?php echo $seo['og_title'] ?? $seo['title']; ?>">
        <meta property="twitter:description" content="<?php echo $seo['og_description'] ?? $seo['meta_description']; ?>">
        <meta property="twitter:image" content="<?php echo $seo['og_image'] ?? 'assets/img/logo/og-image.jpg'; ?>">

        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="assets/img/favicon.svg">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<< All Min Css >>-->
        <link rel="stylesheet" href="assets/css/all.min.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--<< Magnific Popup.css >>-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--<< MeanMenu.css >>-->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--<< Nice Select.css >>-->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>

        <!-- GT Back To Top Start -->
        <button id="back-top" class="back-to-top show">
            <i class="fa-regular fa-arrow-up"></i>
        </button>

        <!-- GT MouseCursor Start -->
        <div class="mouseCursor cursor-outer"></div>
        <div class="mouseCursor cursor-inner"></div>

        <!-- Offcanvas Area Start -->
        <div class="fix-area">
            <div class="offcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="offcanvas__content">
                        <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo">
                                <a href="index.php">
                                        <img src="assets/img/new/jagans-academy-logo1.png" alt="logo-img">
                                    </a>
                            </div>
                            <div class="offcanvas__close">
                                <button>
                                    <i class="fas fa-times"></i>
                                    </button>
                            </div>
                        </div>
                        <h3 class="offcanvas-title">Hello There!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
                        <div class="mobile-menu fix mt-3"></div>
                        <div class="social-icon d-flex align-items-center">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>

                        <div class="offcanvas__contact">
                            <h3>Information</h3>
                            <ul class="contact-list">
                                <li>
                                    <span>
                                            Address:
                                        </span> Hyderabad
                                </li>
                                <li>
                                    <span>
                                            Call Us:
                                        </span>
                                    <a href="tel:+919848256441">+91 9848256441</a>
                                </li>
                                <li>
                                    <span>
                                            Email:
                                        </span>
                                    <a href="mailto:jagansjsacademy0169@gmail.com">jagansjsacademy0169@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                        <a href="courses-details.html" class="theme-btn">
                            Start Free Trail
                            <i class="fa-solid fa-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas__overlay"></div>


        <!-- Header Top Section Start -->
        <div class="header-top-section">
            <div class="container-fluid">
                <div class="header-top-wrapper">
                    <ul>
                        <li>
                            <i class="fa-solid fa-phone-plus"></i>
                            <a href="tel:1234563223">+91 9848256441</a>
                        </li>
                        <li>
                           <i class="fa-solid fa-envelopes"></i>
                            <a href="mailto:Eduex@gmail.com">jagansjsacademy0169@gmail.com</a>
                        </li>
                        <li>
                           <i class="fa-solid fa-location-dot"></i>
                           Hyderabad
                        </li>
                    </ul>
                    <div class="social-icon">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Section Start -->
        <header id="header-sticky" class="header-1">
            <div class="logo-shape">
                <img src="assets/img/inner/logo-shape.png" alt="img">
            </div>
            <div class="container-fluid">
                <div class="mega-menu-wrapper">
                    <div class="header-main">
                        <div class="logo">
                                <a href="index.php" class="header-logo">
                                    <img src="assets/img/new/jagans-academy-logo1.png" alt="logo-img">
                                </a>
                                 <a href="index.php" class="header-logo2">
                                    <img src="assets/img/new/jagans-academy-logo1.png" alt="logo-img">
                                </a>
                        </div>
                        <div class="header-right-items">
                             <div class="mean__menu-wrapper">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <?php 
                                        $main_menus = $conn->query("SELECT * FROM menus WHERE parent_id = 0 ORDER BY sort_order ASC");
                                        while($menu = $main_menus->fetch_assoc()):
                                            $pid = $menu['id'];
                                            $subs = $conn->query("SELECT * FROM menus WHERE parent_id = $pid ORDER BY sort_order ASC");
                                            $has_sub = $subs->num_rows > 0;
                                        ?>
                                        <li class="<?php echo $has_sub ? 'has-dropdown' : ''; ?>">
                                            <a href="<?php echo $menu['link']; ?>">
                                                <?php echo $menu['title']; ?>
                                                <?php if($has_sub): ?> <i class="fa-solid fa-chevron-down"></i> <?php endif; ?>
                                            </a>
                                            <?php if($has_sub): ?>
                                            <ul class="submenu">
                                                <?php while($sub = $subs->fetch_assoc()): ?>
                                                    <li><a href="<?php echo $sub['link']; ?>"><?php echo $sub['title']; ?></a></li>
                                                <?php endwhile; ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="header-right d-flex justify-content-end align-items-center">
                            <a href="#" class="main-header__search search-toggler">
                                <i class="fa-regular fa-magnifying-glass"></i>
                            </a>
                            <a href="courses-details.html" class="theme-btn">
                               Start Free Trail
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                            <div class="header__hamburger d-xl-none my-auto">
                                <div class="sidebar__toggle">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                        </div>
                        </div> 
                    </div>
                </div>
            </div>
        </header>

        <!-- Search Section Start -->
        <div class="search-popup">
            <div class="search-popup__overlay search-toggler"></div>
            <div class="search-popup__content">
                <form role="search" method="get" class="search-popup__form" action="#">
                    <input type="text" id="search" name="search" placeholder="Search Here...">
                    <button type="submit" aria-label="search submit" class="search-btn">
                        <span><i class="fa-regular fa-magnifying-glass"></i></span>
                    </button>
                </form>
            </div>
        </div>
