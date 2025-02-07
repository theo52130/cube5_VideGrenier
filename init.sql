CREATE DATABASE IF NOT EXISTS mydatabase;
USE mydatabase;

CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO items (name, description, price) VALUES
    ('Ordinateur portable', 'Un super ordinateur pour coder', 999.99),
    ('Souris gaming', 'Souris RGB avec 6 boutons', 79.99),
    ('Clavier mecanique', 'Clavier avec switches blue', 129.99),
    ('Ecran 27"', 'Ecran 4K HDR', 399.99);