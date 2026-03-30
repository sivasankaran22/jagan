CREATE DATABASE IF NOT EXISTS jagan;
USE jagan;

-- 0. Pages Table
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pages (filename, title) VALUES ('index.php', 'Home Page');

-- 1. Hero Table
CREATE TABLE IF NOT EXISTS hero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    sub_title VARCHAR(255) DEFAULT 'High Quality Education',
    title TEXT,
    description TEXT,
    btn_text VARCHAR(100) DEFAULT 'Explore More',
    btn_link VARCHAR(255) DEFAULT 'courses-details.html',
    image VARCHAR(255) DEFAULT 'assets/img/home-1/hero/hero-img.png',
    shape_image VARCHAR(255) DEFAULT 'assets/img/home-1/hero/hero-shape.png'
);

INSERT INTO hero (page_id, title, description) VALUES 
(1, 'Learning Is The Core <br> Of Your Success.', 'Unlock your full potential with education tailored to your personal aspirations. Learn, grow, and achieve success.');

-- 2. About Table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    sub_title VARCHAR(255) DEFAULT 'About Us',
    title TEXT,
    description TEXT,
    list_items TEXT,
    image_main VARCHAR(255) DEFAULT 'assets/img/home-1/about/about-1.png',
    image_thumb VARCHAR(255) DEFAULT 'assets/img/home-1/about/about-2.png',
    btn_text VARCHAR(100) DEFAULT 'About More',
    btn_link VARCHAR(255) DEFAULT 'about.html'
);

INSERT INTO about (page_id, title, description, list_items) VALUES 
(1, 'Empowering Your Future Through Excellence.', 'There are many variations of passages of the Ipsum available, but the majority have suffered alteration in some form, by injected humour.', 'Flexible Classes, Learn From Anywhere, Unlimited Resources With Strong Support');

-- 3. Top Categories Table
CREATE TABLE IF NOT EXISTS top_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(255) NOT NULL,
    delay VARCHAR(50) DEFAULT '0.2s',
    link VARCHAR(255) DEFAULT 'courses-details.html'
);

INSERT INTO top_categories (page_id, name, icon) VALUES 
(1, 'Web Development', 'assets/img/home-1/category/icon-01.png'),
(1, 'App Development', 'assets/img/home-2/category/icon-02.png'),
(1, 'IT and Software', 'assets/img/home-1/category/icon-03.png'),
(1, 'UI/UX Design', 'assets/img/home-1/category/icon-04.png');

-- 4. Courses Table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL,
    rating INT DEFAULT 5,
    lessons VARCHAR(50) NOT NULL,
    students VARCHAR(50) NOT NULL,
    instructor_name VARCHAR(100) NOT NULL,
    instructor_img VARCHAR(255) NOT NULL,
    price VARCHAR(50) DEFAULT 'Free'
);

-- 5. Discount Table
CREATE TABLE IF NOT EXISTS discount (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title TEXT,
    description TEXT,
    bg_image VARCHAR(255) DEFAULT 'assets/img/home-1/discount/bg-img.jpg',
    btn_1_text VARCHAR(100) DEFAULT 'Become a Student',
    btn_1_link VARCHAR(255) DEFAULT 'contact.html',
    btn_2_text VARCHAR(100) DEFAULT 'Become a Teacher',
    btn_2_link VARCHAR(255) DEFAULT 'team.html'
);

INSERT INTO discount (page_id, title, description) VALUES 
(1, 'Act Fast: 50% Off for the <br> First 50 Students!', 'The ability to learn at my own pace was a game-changer for me. The flexible schedule allowed me to balance my studies with work and personal life, making it possible.');

-- 6. Why Choose Us Table
CREATE TABLE IF NOT EXISTS why_choose_us (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title TEXT,
    description TEXT,
    main_image VARCHAR(255) DEFAULT 'assets/img/home-1/choose-us/choose-1.png',
    thumb_1 VARCHAR(255) DEFAULT 'assets/img/home-1/choose-us/choose-2.png',
    thumb_2 VARCHAR(255) DEFAULT 'assets/img/home-1/choose-us/choose-3.png',
    counter_value INT DEFAULT 92,
    counter_text VARCHAR(255) DEFAULT 'Customizable Courses.'
);

-- 7. Testimonials Table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    name VARCHAR(255),
    role VARCHAR(255),
    content TEXT,
    image VARCHAR(255),
    rating INT DEFAULT 5
);

-- 8. Team Table
CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- 9. News Table
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title TEXT,
    category VARCHAR(100),
    image VARCHAR(255),
    date_post VARCHAR(100) DEFAULT '09 May, 2025',
    comments INT DEFAULT 0,
    link VARCHAR(255) DEFAULT 'news-details.html'
);

-- 10. CTA Table
CREATE TABLE IF NOT EXISTS cta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title TEXT,
    bg_image VARCHAR(255) DEFAULT 'assets/img/home-1/cta/cta-bg.jpg',
    placeholder VARCHAR(255) DEFAULT 'Enter your email',
    btn_text VARCHAR(100) DEFAULT 'Subscribe Now'
);

-- 11. Marquee Table
CREATE TABLE IF NOT EXISTS marquee_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    text VARCHAR(255),
    icon VARCHAR(255) DEFAULT 'assets/img/home-1/icon1.png'
);

-- 12. Programs Table
CREATE TABLE IF NOT EXISTS programs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    link VARCHAR(255) DEFAULT 'program-details.html'
);

-- 13. Pricing Table
CREATE TABLE IF NOT EXISTS pricing_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    title VARCHAR(255),
    price_monthly VARCHAR(50),
    price_yearly VARCHAR(50),
    description TEXT,
    is_popular BOOLEAN DEFAULT FALSE,
    btn_text VARCHAR(100) DEFAULT 'Get Started'
);
