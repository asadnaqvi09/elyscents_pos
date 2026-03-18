-- Admin user (Username: admin123 | Password: admin123)
-- Password hashed using password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO users (username, password_hash) VALUES 
('admin123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample Products (8 Perfumes)
-- Stock values are varied for Testing (In Stock, Low Stock, Out of Stock)
INSERT INTO products (sku, name_en, name_ur, category, size, cost_price, sale_price, stock) VALUES
('CHN-5-EDP-100', 'Chanel No. 5', 'شینل نمبر ۵', 'Women', '100ml', 35000.00, 45000.00, 12),
('DIO-JAD-EDP-50', 'Dior J\adore', 'دیور جادور', 'Women', '50ml', 30000.00, 38000.00, 8),
('GUC-BLO-EDT-100', 'Gucci Bloom', 'گوچی بلوم', 'Women', '100ml', 22000.00, 28000.00, 15),
('JUN-J-EDT-100', 'J. Junaid J.', 'جے جنید جے', 'Men', '100ml', 3500.00, 4500.00, 25),
('LOC-ROS-ATT-12', 'Local Rose Attar', 'لوکل گلاب عطر', 'Unisex', '12ml', 800.00, 1200.00, 50),
('VER-ERO-EDT-100', 'Versace Eros', 'ورساچے ایروس', 'Men', '100ml', 17000.00, 22000.00, 6),
('CHN-COCO-EDP-100', 'Chanel Coco Mademoiselle', 'شینل کوکو', 'Women', '100ml', 38000.00, 48000.00, 0),
('DIO-SAU-EDT-100', 'Dior Sauvage', 'دیور ساواج', 'Men', '100ml', 28000.00, 35000.00, 20);

-- Sample Customers (6 People)
-- Points and Total Spent reflect different Tiers (Gold, Silver, Bronze)
INSERT INTO customers (name, phone, email, birthday, preferences, loyalty_points, total_spent) VALUES
('Ahmed Khan', '0300-1234567', 'ahmed@email.com', '1985-03-15', 'Woody,Oriental', 2500, 125000.00),
('Fatima Ali', '0301-9876543', 'fatima@email.com', '1990-07-22', 'Floral,Fresh', 850, 45000.00),
('Usman Tariq', '0321-4567890', NULL, '1988-11-05', 'Oriental', 120, 12000.00),
('Sara Malik', '0333-7891234', 'sara@email.com', '1992-01-30', 'Floral,Woody', 1800, 89000.00),
('Bilal Ahmed', '0300-5556667', NULL, '1987-09-12', 'Fresh', 85, 8500.00),
('Ayesha Siddiqui', '0345-1112223', 'ayesha@email.com', '1995-05-18', 'Floral', 670, 67000.00);

-- Default Settings
-- Tax Rate and Store details for receipts
INSERT INTO settings (`key`, `value`) VALUES
('store_name', 'Elyscents Perfume Store'),
('store_name_ur', 'ایلیسینٹس پرفیوم سٹور'),
('address', '12-B Gulberg III, Lahore'),
('phone', '042-35781234'),
('currency', 'PKR'),
('tax_rate', '0.17'),
('tax_name', 'GST'),
('receipt_header', 'Thank you for shopping at Elyscents'),
('receipt_footer', 'Visit again! Exchange within 7 days with receipt'),
('low_stock_threshold', '5'),
('loyalty_enabled', 'true'),
('points_per_100', '1'),
('theme', 'purple');