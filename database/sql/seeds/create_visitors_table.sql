-- Create the visitor table
CREATE TABLE visitor (
    id BIGINT AUTO_INCREMENT PRIMARY KEY COMMENT 'Primärschlüssel',
    ip_address VARCHAR(45) NOT NULL COMMENT 'IP Adresse des Besuchers',
    visit_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt des Besuchs',
    user_agent VARCHAR(255) COMMENT 'Browser Information'
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
COMMENT 'Speichert Besucher-Informationen und Zeitpunkte';

-- Trigger to reorder IDs after deletion
DELIMITER //
CREATE TRIGGER after_visitor_delete
AFTER DELETE ON visitor
FOR EACH ROW
BEGIN
    SET @count = 0;
    UPDATE visitor SET id = (@count:= @count + 1) ORDER BY id;
    ALTER TABLE visitor AUTO_INCREMENT = 1;
END;//
DELIMITER ;

-- Trigger to update timestamp on insert
DELIMITER //
CREATE TRIGGER before_visitor_insert
BEFORE INSERT ON visitor
FOR EACH ROW
BEGIN
    SET NEW.visit_datetime = CURRENT_TIMESTAMP;
END;//
DELIMITER ;




CREATE TABLE visitor (
    id BIGINT AUTO_INCREMENT PRIMARY KEY COMMENT 'Primärschlüssel',
    ip_address VARCHAR(45) NOT NULL COMMENT 'IP Adresse des Besuchers',
    visit_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt des Besuchs',
    user_agent VARCHAR(255) COMMENT 'Browser Information'
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
COMMENT 'Speichert Besucher-Informationen und Zeitpunkte';