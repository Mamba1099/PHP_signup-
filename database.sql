CREATE DATABASE IF NOT EXISTS Logins;

USE Logins;

CREATE TABLE IF NOT EXISTS Info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255)
);

-- If the root user already exists, use ALTER USER to change the password
-- you can alter or use the one you have already created
-- before you try it delete your database then create your database again
-- for the user change it and use the one you want juu this is kinda mine🤣
ALTER USER 'mamba'@'localhost' IDENTIFIED BY 'Mamba@100#';

GRANT ALL PRIVILEGES ON Logins.* TO 'root' @'localhost';

FLUSH PRIVILEGES;