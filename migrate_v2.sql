-- Eduex Migration Script v2 (Updated with positions)
-- This script adds page_id and position to enable page-specific and multiple-instance widgets.

ALTER TABLE hero ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE about ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE top_categories ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE courses ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE discount ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE why_choose_us ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE testimonials ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE team ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE news ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE cta ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE marquee_items ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE programs ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;
ALTER TABLE pricing_plans ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;

-- Create the pages table if not exists
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    widgets_json TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ensure index.php (Home) is registered
INSERT IGNORE INTO pages (id, filename, title) VALUES (1, 'index.php', 'Home Page');
