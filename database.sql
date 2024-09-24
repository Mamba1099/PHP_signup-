CREATE DATABASE IF NOT EXISTS Logins;

USE Logins;

CREATE TABLE IF NOT EXISTS Info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255)
);

-- If the root user already exists, use ALTER USER to change the password
ALTER USER 'mamba'@'localhost' IDENTIFIED BY 'Mamba@100#';

GRANT ALL PRIVILEGES ON Logins.* TO 'root' @'localhost';

FLUSH PRIVILEGES;