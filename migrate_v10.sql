-- Migration for Google Reviews Widget
USE jagan;

-- Create table for section-level data
CREATE TABLE IF NOT EXISTS google_reviews_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    position INT DEFAULT 1,
    sub_title VARCHAR(255) DEFAULT 'Students Reviews',
    title TEXT,
    google_score VARCHAR(50) DEFAULT '5.0',
    google_icon VARCHAR(255) DEFAULT 'assets/img/home-1/testimonial/icon-01.png',
    btn_text VARCHAR(100) DEFAULT 'All Testimonials',
    btn_link VARCHAR(255) DEFAULT 'testimonial.html',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default data if empty
INSERT IGNORE INTO google_reviews_section (page_id, position, title) VALUES 
(1, 1, 'What Students Say About <br> Our Platform.');
