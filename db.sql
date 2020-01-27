CREATE TABLE `LIrdgrzapp`.`jobs` ( 
`id` INT NOT NULL ,
`product_title` VARCHAR(300) NOT NULL , 
`woocommerce-product-details__short-description` LONGTEXT NOT NULL , 
`created_at` DATE NOT NULL , 
`updated_at` DATE NOT NULL , 
`deleted_at` DATE NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;