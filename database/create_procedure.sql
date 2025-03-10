DELIMITER //

CREATE PROCEDURE add_product(
    IN p_productname VARCHAR(255),
    IN p_brand VARCHAR(255),
    IN p_product_date DATE,
    IN p_stocks INT
)
BEGIN
    INSERT INTO product (productname, brand, product_date, stocks) 
    VALUES (p_productname, p_brand, p_product_date, p_stocks);
END;
//

DELIMITER ;

