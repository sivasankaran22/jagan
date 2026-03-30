-- Eduex Migration Script v4 (SEO & Social Tags)
-- This script adds metadata columns for SEO and social media sharing.

ALTER TABLE pages 
ADD COLUMN meta_description TEXT AFTER title,
ADD COLUMN og_title VARCHAR(255) AFTER meta_description,
ADD COLUMN og_description TEXT AFTER og_title,
ADD COLUMN og_image VARCHAR(255) AFTER og_description,
ADD COLUMN twitter_card VARCHAR(50) DEFAULT 'summary_large_image' AFTER og_image;

-- Set some defaults for the Home page
UPDATE pages SET 
    meta_description = 'Eduex - Premium Education & Kindergarten Platform',
    og_title = 'Eduex Education',
    og_description = 'Empowering your future through excellence in education.',
    og_image = 'assets/img/logo/og-image.jpg'
WHERE filename = 'index.php';
