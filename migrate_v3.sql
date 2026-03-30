-- Migration v3: Expand Hero table for nano-hero format
ALTER TABLE hero 
ADD COLUMN IF NOT EXISTS bg_image VARCHAR(255) DEFAULT 'assets/img/home-1/hero/hero-bg.jpg',
ADD COLUMN IF NOT EXISTS shape_1 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/shape-01.png',
ADD COLUMN IF NOT EXISTS shape_2 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/shape-02.png',
ADD COLUMN IF NOT EXISTS shape_3 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/shape-03.png',
ADD COLUMN IF NOT EXISTS shape_4 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/shape-04.png',
ADD COLUMN IF NOT EXISTS shape_5 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/shape-05.png',
ADD COLUMN IF NOT EXISTS student_count VARCHAR(20) DEFAULT '5436',
ADD COLUMN IF NOT EXISTS student_img VARCHAR(255) DEFAULT 'assets/img/home-1/hero/client-img.png',
ADD COLUMN IF NOT EXISTS course_count VARCHAR(20) DEFAULT '5436',
ADD COLUMN IF NOT EXISTS hero_img_1 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/hero-01.png',
ADD COLUMN IF NOT EXISTS hero_img_2 VARCHAR(255) DEFAULT 'assets/img/home-1/hero/hero-02.png';
