-- Create phalcon default database
CREATE SCHEMA condop DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Change root password
USE mysql;
UPDATE mysql.user SET Password=PASSWORD('batatafrita') WHERE User='root';

-- Allow root access from 192.168.50.1
GRANT ALL PRIVILEGES ON *.* TO 'root'@'192.168.50.1'IDENTIFIED BY 'batatafrita' WITH GRANT OPTION;
FLUSH PRIVILEGES;
