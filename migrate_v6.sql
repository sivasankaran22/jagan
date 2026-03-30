-- Eduex Migration Script v6 (Site Settings)
-- This script creates a 'settings' table for site-wide configuration.

CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(100) UNIQUE NOT NULL,
    key_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed basic settings
INSERT IGNORE INTO site_settings (key_name, key_value) VALUES 
('whatsapp_number', '919876543210'),
('phone_number', '+919876543210'),
('support_email', 'support@eduex.com'),
('office_address', '371 7th Ave, New York, NY 10001');
