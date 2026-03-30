-- Migration for Testimonial-2 Widget
USE jagan;

-- Add position column to testimonials if it doesn't exist
SET @dbname = 'jagan';
SET @tablename = 'testimonials';
SET @columnname = 'position';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE TABLE_SCHEMA = @dbname
     AND TABLE_NAME = @tablename
     AND COLUMN_NAME = @columnname) > 0,
  'SELECT 1',
  CONCAT('ALTER TABLE ', @tablename, ' ADD COLUMN ', @columnname, ' INT DEFAULT 1 AFTER page_id;')
));
PREPARE stmt FROM @preparedStatement;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Create table for section-level data (Heading, Subheading)
CREATE TABLE IF NOT EXISTS testimonial_2_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT DEFAULT 1,
    position INT DEFAULT 1,
    sub_title VARCHAR(255) DEFAULT 'Tesimonials',
    title TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default data if empty
INSERT IGNORE INTO testimonial_2_section (page_id, position, sub_title, title) VALUES 
(1, 1, 'Tesimonials', 'What Our Clients are Saying <br> About Us');

-- Update some existing testimonials to have a position if needed, 
-- but mostly we just want the table to exist.
