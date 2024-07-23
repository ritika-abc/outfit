 -- Create categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

-- Create subcategories table
CREATE TABLE subcategories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subcategory_name VARCHAR(255) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Create inner_categories table
CREATE TABLE inner_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inner_category_name VARCHAR(255) NOT NULL,
    subcategory_id INT,
    FOREIGN KEY (subcategory_id) REFERENCES subcategories(id)
);

-- Create micro_categories table
CREATE TABLE micro_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    micro_category_name VARCHAR(255) NOT NULL,
    inner_category_id INT,
    FOREIGN KEY (inner_category_id) REFERENCES inner_categories(id)
);

-- Create products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    micro_category_id INT,
    FOREIGN KEY (micro_category_id) REFERENCES micro_categories(id)
);
