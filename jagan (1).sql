-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jagan`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `sub_title` varchar(255) DEFAULT 'About Us',
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `list_items` text DEFAULT NULL,
  `image_main` varchar(255) DEFAULT 'assets/img/home-1/about/about-1.png',
  `image_thumb` varchar(255) DEFAULT 'assets/img/home-1/about/about-2.png',
  `image_3` varchar(255) DEFAULT 'assets/img/home-1/about/about-03.png',
  `counter1_val` varchar(50) DEFAULT '25',
  `counter1_text` varchar(255) DEFAULT 'Year of Experience',
  `counter2_val` varchar(50) DEFAULT '500',
  `counter2_text` varchar(255) DEFAULT 'Class Completed',
  `counter3_val` varchar(50) DEFAULT '100',
  `counter3_text` varchar(255) DEFAULT 'Experts Instructors',
  `author_image` varchar(255) DEFAULT 'assets/img/home-1/about/client-01.png',
  `author_name` varchar(255) DEFAULT 'Ronald Richards',
  `author_designation` varchar(255) DEFAULT 'Co, Founder',
  `btn_text` varchar(100) DEFAULT 'About More',
  `btn_link` varchar(255) DEFAULT 'about.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `page_id`, `position`, `sub_title`, `title`, `description`, `list_items`, `image_main`, `image_thumb`, `image_3`, `counter1_val`, `counter1_text`, `counter2_val`, `counter2_text`, `counter3_val`, `counter3_text`, `author_image`, `author_name`, `author_designation`, `btn_text`, `btn_link`) VALUES
(1, 1, 1, 'About Us', 'Empowering Your Future Through Excellence.', 'There are many variations of passages of the Ipsum available, but the majority have suffered alteration in some form, by injected humour.', 'Flexible Classes, Learn From Anywhere, Unlimited Resources With Strong Support', 'assets/uploads/1774884060_home_aboutus_1.png', 'assets/uploads/1774884067_home_aboutus_2.png', 'assets/uploads/1774884076_home_aboutus_3.png', '25', 'Year of Experience', '500', 'Class Completed', '100', 'Experts Instructors', 'assets/uploads/1774885254_client_01.png', 'Ronald Richards', 'Co, Founder', 'About More', 'page-3.php'),
(2, 5, 1, 'tasdf asdf', 'tasfdasdf ', 'tasdf', 'tasdf', 'gsdf', 'f asdf', 'assets/img/home-1/about/about-03.png', '25', 'Year of Experience', '500', 'Class Completed', '100', 'Experts Instructors', 'assets/img/home-1/about/client-01.png', 'Ronald Richards', 'Co, Founder', 'atasf', 'tasdf'),
(3, 5, 3, 'ta sdfsfd', 'hgsadfaf', 'tasf af', 'tasdf', 'tasdf', 'tadsf', 'assets/img/home-1/about/about-03.png', '25', 'Year of Experience', '500', 'Class Completed', '100', 'Experts Instructors', 'assets/img/home-1/about/client-01.png', 'Ronald Richards', 'Co, Founder', 'tasdf', 'gasdfadsf');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT 5,
  `lessons` varchar(50) NOT NULL,
  `students` varchar(50) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `instructor_img` varchar(255) NOT NULL,
  `price` varchar(50) DEFAULT 'Free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `page_id`, `position`, `title`, `category`, `image`, `rating`, `lessons`, `students`, `instructor_name`, `instructor_img`, `price`) VALUES
(1, 1, 1, 'The Complete Figma Blueprint for UI/UX Designers', 'UI/UX Design', 'assets/img/home-1/courses/courses-01.jpg', 5, '1+ Lessons', 'Students 1', 'Jane Cooper', 'assets/img/home-1/courses/client-01.png', 'Free'),
(2, 1, 1, 'Mastering Webflow: Design Pro-Level Websites Easily', 'Web Design', 'assets/img/home-1/courses/courses-02.jpg', 5, '4+ Lessons', 'Students 2', 'Jane Cooper', 'assets/img/home-1/courses/client-01.png', 'Free'),
(3, 1, 1, 'Complete WordPress Theme Development Masterclass', 'Business', 'assets/img/home-1/courses/courses-03.jpg', 5, '7+ Lessons', 'Students 6', 'Jane Cooper', 'assets/img/home-1/courses/client-03.png', '$99.00');

-- --------------------------------------------------------

--
-- Table structure for table `cta`
--

CREATE TABLE `cta` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` text DEFAULT NULL,
  `bg_image` varchar(255) DEFAULT 'assets/img/home-1/cta/cta-bg.jpg',
  `placeholder` varchar(255) DEFAULT 'Enter your email',
  `btn_text` varchar(100) DEFAULT 'Subscribe Now'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cta`
--

INSERT INTO `cta` (`id`, `page_id`, `position`, `title`, `bg_image`, `placeholder`, `btn_text`) VALUES
(1, 1, 1, 'Join our newsletter, spam-free.', 'assets/img/home-1/cta/cta-bg.jpg', 'Enter your email', 'Subscribe Now');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bg_image` varchar(255) DEFAULT 'assets/img/home-1/discount/bg-img.jpg',
  `btn_1_text` varchar(100) DEFAULT 'Become a Student',
  `btn_1_link` varchar(255) DEFAULT 'contact.html',
  `btn_2_text` varchar(100) DEFAULT 'Become a Teacher',
  `btn_2_link` varchar(255) DEFAULT 'team.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `page_id`, `position`, `title`, `description`, `bg_image`, `btn_1_text`, `btn_1_link`, `btn_2_text`, `btn_2_link`) VALUES
(1, 1, 1, 'Act Fast: 50% Off for the <br> First 50 Students!', 'The ability to learn at my own pace was a game-changer for me. The flexible schedule allowed me to balance my studies with work and personal life, making it possible.', 'assets/img/home-1/discount/bg-img.jpg', 'Become a Student', 'contact.html', 'Become a Teacher', 'team.html');

-- --------------------------------------------------------

--
-- Table structure for table `google_reviews_section`
--

CREATE TABLE `google_reviews_section` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `sub_title` varchar(255) DEFAULT 'Students Reviews',
  `title` text DEFAULT NULL,
  `google_score` varchar(50) DEFAULT '5.0',
  `google_icon` varchar(255) DEFAULT 'assets/img/home-1/testimonial/icon-01.png',
  `btn_text` varchar(100) DEFAULT 'All Testimonials',
  `btn_link` varchar(255) DEFAULT 'testimonial.html',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `google_reviews_section`
--

INSERT INTO `google_reviews_section` (`id`, `page_id`, `position`, `sub_title`, `title`, `google_score`, `google_icon`, `btn_text`, `btn_link`, `created_at`) VALUES
(1, 1, 1, 'Students Reviews', 'What Students Say About <br> Our Platform.', '5.0', 'assets/img/home-1/testimonial/icon-01.png', 'All Testimonials', 'testimonial.html', '2026-03-30 21:25:29'),
(2, 1, 6, 'Students Reviews', 'What Students Say About <br> Our Platform.', '5.0', 'assets/img/home-1/testimonial/icon-01.png', 'All Testimonials', 'testimonial.html', '2026-03-30 21:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `sub_title` varchar(255) DEFAULT 'High Quality Education',
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `btn_text` varchar(100) DEFAULT 'Explore More',
  `btn_link` varchar(255) DEFAULT 'courses-details.html',
  `image` varchar(255) DEFAULT 'assets/img/home-1/hero/hero-img.png',
  `shape_image` varchar(255) DEFAULT 'assets/img/home-1/hero/hero-shape.png',
  `bg_image` varchar(255) DEFAULT 'assets/img/home-1/hero/hero-bg.jpg',
  `shape_1` varchar(255) DEFAULT 'assets/img/home-1/hero/shape-01.png',
  `shape_2` varchar(255) DEFAULT 'assets/img/home-1/hero/shape-02.png',
  `shape_3` varchar(255) DEFAULT 'assets/img/home-1/hero/shape-03.png',
  `shape_4` varchar(255) DEFAULT 'assets/img/home-1/hero/shape-04.png',
  `shape_5` varchar(255) DEFAULT 'assets/img/home-1/hero/shape-05.png',
  `student_count` varchar(20) DEFAULT '5436',
  `student_img` varchar(255) DEFAULT 'assets/img/home-1/hero/client-img.png',
  `course_count` varchar(20) DEFAULT '5436',
  `hero_img_1` varchar(255) DEFAULT 'assets/img/home-1/hero/hero-01.png',
  `hero_img_2` varchar(255) DEFAULT 'assets/img/home-1/hero/hero-02.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`id`, `page_id`, `position`, `sub_title`, `title`, `description`, `btn_text`, `btn_link`, `image`, `shape_image`, `bg_image`, `shape_1`, `shape_2`, `shape_3`, `shape_4`, `shape_5`, `student_count`, `student_img`, `course_count`, `hero_img_1`, `hero_img_2`) VALUES
(1, 1, 1, 'High Quality Education', 'Learning Is The Core <br> Of Your Success.', 'Unlock your full potential with education tailored to your personal aspirations. Learn, grow, and achieve success.', 'Explore More', 'courses-details.html', 'assets/img/home-1/hero/hero-img.png', 'assets/img/home-1/hero/hero-shape.png', 'assets/img/home-1/hero/hero-bg.jpg', 'assets/img/home-1/hero/shape-01.png', 'assets/img/home-1/hero/shape-02.png', 'assets/img/home-1/hero/shape-03.png', 'assets/img/home-1/hero/shape-04.png', 'assets/img/home-1/hero/shape-05.png', '5436', 'assets/img/home-1/hero/client-img.png', '5436', 'assets/uploads/1774883932_home_hero_girl.png', 'assets/uploads/1774883944_home_hero_boy.png'),
(2, 3, 1, 'tasdf asdf', 'tas dfasdf', 'tasfasdgas', 'atasf', 'tasdf', 'assets/img/home-1/hero/hero-img.png', 'assets/img/home-1/hero/hero-shape.png', 'assets/img/home-1/hero/hero-bg.jpg', 'assets/img/home-1/hero/shape-01.png', 'assets/img/home-1/hero/shape-02.png', 'assets/img/home-1/hero/shape-03.png', 'assets/img/home-1/hero/shape-04.png', 'assets/img/home-1/hero/shape-05.png', '5436', 'assets/img/home-1/hero/client-img.png', '5436', 'assets/img/home-1/hero/hero-01.png', 'assets/img/home-1/hero/hero-02.png');

-- --------------------------------------------------------

--
-- Table structure for table `marquee_items`
--

CREATE TABLE `marquee_items` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `text` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT 'assets/img/home-1/icon1.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marquee_items`
--

INSERT INTO `marquee_items` (`id`, `page_id`, `position`, `text`, `icon`) VALUES
(1, 1, 1, 'Education & University', 'assets/img/home-1/icon1.png'),
(2, 1, 1, 'Online Education', 'assets/img/home-1/icon1.png'),
(3, 1, 1, '230+ Quality Courses', 'assets/img/home-1/icon1.png'),
(4, 1, 1, 'Experience Instructors', 'assets/img/home-1/icon1.png'),
(5, 1, 1, 'Kindergarten Study', 'assets/img/home-1/icon1.png'),
(6, 1, 1, '25% Coupon Bonus', 'assets/img/home-1/icon1.png'),
(7, 1, 1, '25% Extra Coupon Bonus', 'assets/img/home-1/icon1.png');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT '#',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `link`, `sort_order`, `created_at`) VALUES
(1, 0, 'Home', 'index.php', 1, '2026-03-27 06:06:58'),
(2, 0, 'About', 'about.php', 2, '2026-03-27 06:06:58'),
(3, 0, 'Courses', 'courses.php', 5, '2026-03-27 06:06:58'),
(4, 0, 'Pages', '#', 3, '2026-03-27 06:06:58'),
(5, 2, 'Testimonial', 'testimonial.php', 1, '2026-03-27 06:06:58'),
(6, 4, 'Pricing', 'pricing.php', 1, '2026-03-27 06:06:58'),
(7, 0, 'Contact', 'contact.php', 4, '2026-03-27 06:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_post` varchar(100) DEFAULT '09 May, 2025',
  `comments` int(11) DEFAULT 0,
  `link` varchar(255) DEFAULT 'news-details.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `page_id`, `position`, `title`, `category`, `image`, `date_post`, `comments`, `link`) VALUES
(1, 1, 1, 'Repurpose mission critical action life items rather total', 'Education', 'assets/img/home-1/news/news-01.jpg', '09 May, 2025', 0, 'news-details.html'),
(2, 1, 1, 'The Importance of Integrating Arts into Science and Technology', 'Education', 'assets/img/home-1/news/news-02.jpg', '09 May, 2025', 0, 'news-details.html');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `twitter_card` varchar(50) DEFAULT 'summary_large_image',
  `widgets_json` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `filename`, `title`, `meta_description`, `og_title`, `og_description`, `og_image`, `twitter_card`, `widgets_json`, `created_at`) VALUES
(1, 'index.php', 'Home Page', 'Eduex - Premium Education & Kindergarten Platform', 'Eduex Education', 'Empowering your future through excellence in education.', 'assets/img/logo/og-image.jpg', 'summary_large_image', '[\"hero.php\",\"about.php\",\"why-choose-us-nano.php\",\"team.php\",\"testimonial-2.php\",\"google-reviews.php\"]', '2026-03-27 05:11:01'),
(3, 'tasdf-asdf.php', 'tasdfasdf', NULL, NULL, NULL, NULL, 'summary_large_image', '[\"courses.php\",\"cta.php\"]', '2026-03-27 05:22:33'),
(4, 'page-2.php', 'page-2 ', NULL, NULL, NULL, NULL, 'summary_large_image', '[\"team.php\",\"team.php\"]', '2026-03-27 05:28:26'),
(5, 'page-3.php', 'page 3', NULL, NULL, NULL, NULL, 'summary_large_image', '[\"about.php\",\"category.php\",\"about.php\"]', '2026-03-27 05:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_features`
--

CREATE TABLE `pricing_features` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `feature` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pricing_features`
--

INSERT INTO `pricing_features` (`id`, `plan_id`, `feature`) VALUES
(1, 1, 'Condimentum porttitor sem'),
(2, 1, 'Condimentum lacinia quisque'),
(3, 1, 'Fusce sagittis est fringilla auctor'),
(4, 1, 'Ligula enim varius lacus et luctus'),
(5, 1, 'Pellentesque non massa sed elit'),
(6, 2, 'Condimentum porttitor sem'),
(7, 2, 'Condimentum lacinia quisque'),
(8, 2, 'Fusce sagittis est fringilla auctor'),
(9, 2, 'Ligula enim varius lacus et luctus'),
(10, 2, 'Pellentesque non massa sed elit'),
(11, 3, 'Condimentum porttitor sem'),
(12, 3, 'Condimentum lacinia quisque'),
(13, 3, 'Fusce sagittis est fringilla auctor'),
(14, 3, 'Ligula enim varius lacus et luctus'),
(15, 3, 'Pellentesque non massa sed elit');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `price_monthly` varchar(50) DEFAULT NULL,
  `price_yearly` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `btn_text` varchar(100) DEFAULT 'Get Started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pricing_plans`
--

INSERT INTO `pricing_plans` (`id`, `page_id`, `position`, `title`, `price_monthly`, `price_yearly`, `description`, `is_popular`, `btn_text`) VALUES
(1, 1, 1, 'Basic Plan', '$99', '$990', 'Perfect for expanding teams educational institutions with moderate needs', 0, 'Get Started'),
(2, 1, 1, 'Business Plan', '$119', '$1190', 'Perfect for expanding teams educational institutions with moderate needs', 1, 'Get Started'),
(3, 1, 1, 'Enterprise Plan', '$199', '$1990', 'Perfect for expanding teams educational institutions with moderate needs', 0, 'Get Started');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT 'program-details.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `page_id`, `position`, `title`, `description`, `image`, `link`) VALUES
(1, 1, 1, 'First School (1 - 2 Years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-01.jpg', 'program-details.html'),
(2, 1, 1, 'Preschool (2 – 3 years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-02.jpg', 'program-details.html'),
(3, 1, 1, 'Kindergarten (3 – 5 years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-03.jpg', 'program-details.html'),
(4, 1, 1, 'First School (1 - 2 Years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-04.jpg', 'program-details.html'),
(5, 1, 1, 'Preschool (2 – 3 years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-05.jpg', 'program-details.html'),
(6, 1, 1, 'Kindergarten (3 – 5 years)', 'Kindergarten is an early childhood educational where environment where most young children.', 'assets/img/inner/program/program-06.jpg', 'program-details.html');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `page_id`, `position`, `name`, `designation`, `image`) VALUES
(5, 4, 1, 'sivasankaran K', 'tasfd ', 'assets/img/home-1/team/team-01.jpg'),
(6, 4, 1, 'tasdfa ', 'atasfd asdf', 'assets/img/home-1/team/team-01.jpg'),
(7, 4, 1, 'tasdf asdf', 'tasdf', 'assets/img/home-1/team/team-01.jpg'),
(8, 4, 1, 'tasdf asdf', 'tasdf', 'assets/img/home-1/team/team-01.jpg'),
(9, 1, 1, 'Siri Byri , ', 'Student', 'assets/img/home-1/team/team-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `page_id`, `position`, `name`, `role`, `content`, `image`, `rating`) VALUES
(1, 1, 1, 'Marvin McKinney', 'Product Manager', '“ Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.', 'assets/img/home-1/testimonial/client-01.png', 5),
(2, 1, 1, 'Lauren Janet', 'Founder CEO', '“ Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.', 'assets/img/home-1/testimonial/client-02.png', 5),
(3, 1, 1, 'Ramon Joshua', 'Product Manager', '“ Working with several word the templates the last years only can say this is best every level use it for my reviews that I hav already are company and reviews.', 'assets/img/home-1/testimonial/client-03.png', 5),
(9, 1, 5, 'Siri Byri', 'Student', 'Sir has taught me for about 2 months now, and my overall experience has been amazing so far. Jagan Sir explains every topic with patience and answers all my questions until I understand it clearly.', 'assets/uploads/1774905170_client_04.png', 5),
(10, 1, 5, 'Razaak', 'Parent', 'I started taking Chemistry coaching from Jaganshyam sir,he is very adaptive and explains the concepts clearly.', 'assets/uploads/1774905241_client_05.png', 5),
(11, 1, 5, 'Srikanth Reddy', 'Parent', 'Jaganshyam sir is an amazing chemistry teacher. He has a special talent in mesmerizing students of CBSE/ICSE/IB/State Board of 9th to 12th students and he is a master in chemistry.', 'assets/uploads/1774905336_client_01.png', 5),
(12, 1, 5, 'Suresh', 'Parent', 'My child improved his scores in chemistry after taking Jagan sir classes at Jagans JS Acadmy. Thanks for your tutoring. Thank you so much for your support. Highly recommended to all.', 'assets/uploads/1774905447_client_02.png', 5),
(16, 1, 6, 'Shri Ki', '517 Review', 'Finest and the best coaching centre near JP Nagar... Absolutely experienced and skilled teachers, very friendly teachers, excellent study materials and guidance from the faculties... Best for overall growth of the student...!!!\r\n1. CBSE & STATE 10th board\r\n2. 1st and 2nd PUC ( both science and commerce)\r\n3. Private (individual) coaching is available with highly qualified teachers.\r\n4. CET and NEET training is provided with utmost quality study materials.\r\n5. Friendly teachers and are available to help the students with their valuable guidance...!!!', 'assets/uploads/1774906326_unnamed.png', 5),
(17, 1, 6, 'Medha Bharadwaj', '2 Review', 'Guys honestly don\'t go here, it\'s a terrible place. The teaching is okay and they give a lot of stress to the kids. They don\'t even teach well and they don\'t have extremely good results to show also. Not worth spending your money here. I would rather you guys join elsewhere or go watch YouTube, it\'s better than the teachers here.', 'assets/uploads/1774906443_unnamed__1_.png', 5),
(18, 1, 6, 'Naksha Surya', '5 Review', 'I have studied here for 3 years, I had a very good experience in this academy. Teachers are fully experienced, skilled, and friendly with students. They even conduct labs which will be very useful. It is the best academy in J.P Nagar.', 'assets/uploads/1774906517_unnamed__2_.png', 5),
(19, 1, 6, 'Akshatha Kamath', '4 Review', 'Best coaching you can find in Bangalore. Absolutely experienced , skilled and friendly teachers. Helps you learn the academics and values both.One of the best academy I\'ve visited till date and best option for individual attention of the student and is an excellent place to gain knowledge\r\nPositive<br>\r\nCommunication, Quality, Professionalism, Value', 'assets/img/home-1/testimonial/client-01.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_2_section`
--

CREATE TABLE `testimonial_2_section` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `sub_title` varchar(255) DEFAULT 'Tesimonials',
  `title` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonial_2_section`
--

INSERT INTO `testimonial_2_section` (`id`, `page_id`, `position`, `sub_title`, `title`, `created_at`) VALUES
(1, 1, 1, 'Tesimonials', 'What Our Clients are Saying <br> About Us', '2026-03-30 21:07:17'),
(2, 1, 5, 'Tesimonials', 'Hear from Our Achievers – Success Stories that Inspire', '2026-03-30 21:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `top_categories`
--

CREATE TABLE `top_categories` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `delay` varchar(50) DEFAULT '0.2s',
  `link` varchar(255) DEFAULT 'courses-details.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_categories`
--

INSERT INTO `top_categories` (`id`, `page_id`, `position`, `name`, `icon`, `delay`, `link`) VALUES
(1, 1, 1, 'Web Development', 'assets/img/home-1/category/icon-01.png', '0.2s', 'courses-details.html'),
(2, 1, 1, 'App Development', 'assets/img/home-1/category/icon-02.png', '0.2s', 'courses-details.html'),
(3, 1, 1, 'IT and Software', 'assets/img/home-1/category/icon-03.png', '0.2s', 'courses-details.html'),
(4, 1, 1, 'UI/UX Design', 'assets/img/home-1/category/icon-04.png', '0.2s', 'courses-details.html'),
(5, 1, 1, 'Photography', 'assets/img/home-1/category/icon-05.png', '0.2s', 'courses-details.html'),
(6, 1, 1, 'Graphic Design', 'assets/img/home-1/category/icon-06.png', '0.2s', 'courses-details.html'),
(7, 5, 2, 'tas f', 'assets/img/home-1/category/icon-01.png', '0.2s', 'courses-details.html');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `file_path`, `file_type`, `file_size`, `created_at`) VALUES
(1, 'libellule789-girl-2771936.jpg', 'assets/uploads/1774594095_libellule789_girl_2771936.jpg', 'jpg', 705374, '2026-03-27 06:48:15'),
(2, 'home-hero-girl.png', 'assets/uploads/1774883932_home_hero_girl.png', 'png', 160558, '2026-03-30 15:18:52'),
(3, 'home-hero-boy.png', 'assets/uploads/1774883944_home_hero_boy.png', 'png', 109496, '2026-03-30 15:19:04'),
(4, 'home-aboutus-1.png', 'assets/uploads/1774884060_home_aboutus_1.png', 'png', 417540, '2026-03-30 15:21:00'),
(5, 'home-aboutus-2.png', 'assets/uploads/1774884067_home_aboutus_2.png', 'png', 83914, '2026-03-30 15:21:07'),
(6, 'home-aboutus-3.png', 'assets/uploads/1774884076_home_aboutus_3.png', 'png', 130792, '2026-03-30 15:21:16'),
(7, 'client-01.png', 'assets/uploads/1774885254_client_01.png', 'png', 346, '2026-03-30 15:40:54'),
(8, 'whychoose-1.png', 'assets/uploads/1774886418_whychoose_1.png', 'png', 281102, '2026-03-30 16:00:18'),
(9, 'whychoose-2.png', 'assets/uploads/1774886427_whychoose_2.png', 'png', 90080, '2026-03-30 16:00:27'),
(10, 'whychoose-3.png', 'assets/uploads/1774886437_whychoose_3.png', 'png', 135362, '2026-03-30 16:00:37'),
(11, 'whychoose-3.png', 'assets/uploads/1774905160_whychoose_3.png', 'png', 135362, '2026-03-30 21:12:40'),
(12, 'client-04.png', 'assets/uploads/1774905170_client_04.png', 'png', 91653, '2026-03-30 21:12:50'),
(13, 'client-05.png', 'assets/uploads/1774905241_client_05.png', 'png', 91280, '2026-03-30 21:14:01'),
(14, 'client-01.png', 'assets/uploads/1774905336_client_01.png', 'png', 79620, '2026-03-30 21:15:36'),
(15, 'client-02.png', 'assets/uploads/1774905447_client_02.png', 'png', 105245, '2026-03-30 21:17:27'),
(16, 'unnamed.png', 'assets/uploads/1774906326_unnamed.png', 'png', 8098, '2026-03-30 21:32:06'),
(17, 'unnamed (1).png', 'assets/uploads/1774906443_unnamed__1_.png', 'png', 11270, '2026-03-30 21:34:03'),
(18, 'unnamed (2).png', 'assets/uploads/1774906517_unnamed__2_.png', 'png', 13054, '2026-03-30 21:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `sub_title` varchar(255) DEFAULT 'Why Choose Us',
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT 'assets/img/home-1/choose-us/choose-1.png',
  `thumb_1` varchar(255) DEFAULT 'assets/img/home-1/choose-us/choose-2.png',
  `thumb_2` varchar(255) DEFAULT 'assets/img/home-1/choose-us/choose-3.png',
  `counter_value` int(11) DEFAULT 92,
  `counter_text` varchar(255) DEFAULT 'Customizable Courses.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `page_id`, `position`, `sub_title`, `title`, `description`, `main_image`, `thumb_1`, `thumb_2`, `counter_value`, `counter_text`) VALUES
(1, 1, 1, 'Why Choose Us', 'Learning That Aligns With Your Personal Goals.', 'Unlock your full potential with education tailored to your personal aspirations. Learn, grow, and achieve success.', 'assets/img/home-1/choose-us/choose-1.png', 'assets/img/home-1/choose-us/choose-2.png', 'assets/img/home-1/choose-us/choose-3.png', 92, 'Customizable Courses.'),
(2, 1, 3, 'Why Choose JS Academy', 'Where success begins and learning missions are accomplished', 'JAGANS JS ACADEMY started its journey from June 6th 2010 onwards with Passion and Commitment with only 2 students.<br>\r\nStarted its Edu-Tech Start Up for Coaching and Tuitions segments in Hybrid Model right from day of its inception with dedicated system & thriving for Top Results and Scores for aspiring students right from high School to College Level.<br>\r\nWith Top Level Seasoned Teachers in All Curriculums right from CBSE,ICSE,ISC,IGCSE &IB; focussing on Core Subjects like Math,Physics,Chemistry and Biology,Including Languages JAGANS JS ACADEMY strives hard for catalyzing confidence levels of students in Academic and over all Performance progress', 'assets/uploads/1774886418_whychoose_1.png', 'assets/uploads/1774886427_whychoose_2.png', 'assets/uploads/1774886437_whychoose_3.png', 4500, 'Jagans J S Acdemy');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us_features`
--

CREATE TABLE `why_choose_us_features` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `delay` varchar(50) DEFAULT NULL,
  `style_class` varchar(100) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `why_choose_us_features`
--

INSERT INTO `why_choose_us_features` (`id`, `page_id`, `position`, `title`, `description`, `icon`, `delay`, `style_class`) VALUES
(1, 1, 1, 'Early Learning', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-01.svg', '0.6s', ''),
(2, 1, 1, 'Art and Craft', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-02.svg', '0.8s', ''),
(3, 1, 1, 'Brain Train', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-03.svg', '0.9s', ''),
(4, 1, 1, 'Music Area', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-04.svg', '0.9s', ''),
(5, 1, 1, 'Early Learning', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-01.svg', '0.6s', ''),
(6, 1, 1, 'Art and Craft', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-02.svg', '0.8s', 'style-2'),
(7, 1, 1, 'Brain Train', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-03.svg', '0.9s', 'style-2'),
(8, 1, 1, 'Music Area', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-04.svg', '0.9s', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cta`
--
ALTER TABLE `cta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_reviews_section`
--
ALTER TABLE `google_reviews_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marquee_items`
--
ALTER TABLE `marquee_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `pricing_features`
--
ALTER TABLE `pricing_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_2_section`
--
ALTER TABLE `testimonial_2_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_categories`
--
ALTER TABLE `top_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us_features`
--
ALTER TABLE `why_choose_us_features`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cta`
--
ALTER TABLE `cta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_reviews_section`
--
ALTER TABLE `google_reviews_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marquee_items`
--
ALTER TABLE `marquee_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pricing_features`
--
ALTER TABLE `pricing_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `testimonial_2_section`
--
ALTER TABLE `testimonial_2_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `top_categories`
--
ALTER TABLE `top_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `why_choose_us_features`
--
ALTER TABLE `why_choose_us_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pricing_features`
--
ALTER TABLE `pricing_features`
  ADD CONSTRAINT `pricing_features_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
