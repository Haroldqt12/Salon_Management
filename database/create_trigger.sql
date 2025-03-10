DELIMITER $$

CREATE TRIGGER before_insert_product
BEFORE INSERT ON product
FOR EACH ROW
BEGIN
    -- Set custom_product_id before inserting the product_id
    SET NEW.custom_product_id = CONCAT('P', COALESCE((SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'product'), 1));
END$$

DELIMITER ;
