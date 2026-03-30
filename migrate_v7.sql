-- Eduex Migration Script v7 (Update About Widget for New Design)
USE jagan;

ALTER TABLE about 
ADD COLUMN image_3 VARCHAR(255) DEFAULT 'assets/img/home-1/about/about-03.png' AFTER image_thumb,
ADD COLUMN counter1_val VARCHAR(50) DEFAULT '25' AFTER image_3,
ADD COLUMN counter1_text VARCHAR(255) DEFAULT 'Year of Experience' AFTER counter1_val,
ADD COLUMN counter2_val VARCHAR(50) DEFAULT '500' AFTER counter1_text,
ADD COLUMN counter2_text VARCHAR(255) DEFAULT 'Class Completed' AFTER counter2_val,
ADD COLUMN counter3_val VARCHAR(50) DEFAULT '100' AFTER counter2_text,
ADD COLUMN counter3_text VARCHAR(255) DEFAULT 'Experts Instructors' AFTER counter3_val,
ADD COLUMN author_image VARCHAR(255) DEFAULT 'assets/img/home-1/about/client-01.png' AFTER counter3_text,
ADD COLUMN author_name VARCHAR(255) DEFAULT 'Ronald Richards' AFTER author_image,
ADD COLUMN author_designation VARCHAR(255) DEFAULT 'Co, Founder' AFTER author_name;
