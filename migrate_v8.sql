-- Eduex Migration Script v8 (Update Why Choose Us for Nano Version)
USE jagan;

ALTER TABLE why_choose_us ADD COLUMN sub_title VARCHAR(255) DEFAULT 'Why Choose Us' AFTER position;
ALTER TABLE why_choose_us_features ADD COLUMN page_id INT DEFAULT 1 AFTER id, ADD COLUMN position INT DEFAULT 1 AFTER page_id;

-- Insert some default data for features if empty
INSERT IGNORE INTO why_choose_us_features (page_id, position, title, description, icon, delay, style_class) VALUES 
(1, 1, 'Early Learning', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-01.svg', '0.6s', ''),
(1, 1, 'Art and Craft', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-02.svg', '0.8s', 'style-2'),
(1, 1, 'Brain Train', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-03.svg', '0.9s', 'style-2'),
(1, 1, 'Music Area', 'At the heart of our online community stands.', 'assets/img/home-1/choose-us/icon-04.svg', '0.9s', '');
