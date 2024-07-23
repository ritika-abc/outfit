-- Create categories table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

-- Insert sample data into categories table
INSERT INTO categories (category_name) VALUES 
('Category 1'),
('Category 2'),
('Category 3');

-- Create subcategories table
CREATE TABLE subcategories (
    subcategory_id INT AUTO_INCREMENT PRIMARY KEY,
    subcategory_name VARCHAR(255) NOT NULL,
    category_fk INT,
    FOREIGN KEY (category_fk) REFERENCES categories(category_id)
);

-- Insert sample data into subcategories table
INSERT INTO subcategories (subcategory_name, category_fk) VALUES 
('Subcategory 1A', 1),
('Subcategory 1B', 1),
('Subcategory 2A', 2),
('Subcategory 2B', 2),
('Subcategory 3A', 3),
('Subcategory 3B', 3);

-- Create inner_categories table
CREATE TABLE inner_categories (
    inner_category_id INT AUTO_INCREMENT PRIMARY KEY,
    inner_category_name VARCHAR(255) NOT NULL,
    subcategory_fk INT,
    FOREIGN KEY (subcategory_fk) REFERENCES subcategories(subcategory_id)
);

-- Insert sample data into inner_categories table
INSERT INTO inner_categories (inner_category_name, subcategory_fk) VALUES 
('Inner Category 1A1', 1),
('Inner Category 1A2', 1),
('Inner Category 1B1', 2),
('Inner Category 1B2', 2),
('Inner Category 2A1', 3),
('Inner Category 2A2', 3),
('Inner Category 2B1', 4),
('Inner Category 2B2', 4),
('Inner Category 3A1', 5),
('Inner Category 3A2', 5),
('Inner Category 3B1', 6),
('Inner Category 3B2', 6);

-- Create micro_categories table
CREATE TABLE micro_categories (
    micro_category_id INT AUTO_INCREMENT PRIMARY KEY,
    micro_category_name VARCHAR(255) NOT NULL,
    inner_category_fk INT,
    FOREIGN KEY (inner_category_fk) REFERENCES inner_categories(inner_category_id)
);

-- Insert sample data into micro_categories table
INSERT INTO micro_categories (micro_category_name, inner_category_fk) VALUES 
('Micro Category 1A1X', 1),
('Micro Category 1A2X', 2),
('Micro Category 1B1X', 3),
('Micro Category 1B2X', 4),
('Micro Category 2A1X', 5),
('Micro Category 2A2X', 6),
('Micro Category 2B1X', 7),
('Micro Category 2B2X', 8),
('Micro Category 3A1X', 9),
('Micro Category 3A2X', 10),
('Micro Category 3B1X', 11),
('Micro Category 3B2X', 12);

-- Create products table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    micro_category_fk INT,
    FOREIGN KEY (micro_category_fk) REFERENCES micro_categories(micro_category_id)
);

-- Insert sample data into products table
INSERT INTO products (product_name, micro_category_fk) VALUES 
('Product 1A1X1', 1),
('Product 1A1X2', 1),
('Product 1A2X1', 2),
('Product 1A2X2', 2),
('Product 1B1X1', 3),
('Product 1B1X2', 3),
('Product 1B2X1', 4),
('Product 1B2X2', 4),
('Product 2A1X1', 5),
('Product 2A1X2', 5),
('Product 2A2X1', 6),
('Product 2A2X2', 6),
('Product 2B1X1', 7),
('Product 2B1X2', 7),
('Product 2B2X1', 8),
('Product 2B2X2', 8),
('Product 3A1X1', 9),
('Product 3A1X2', 9),
('Product 3A2X1', 10),
('Product 3A2X2', 10),
('Product 3B1X1', 11),
('Product 3B1X2', 11),
('Product 3B2X1', 12),
('Product 3B2X2', 12);
