USE coregroup;
SELECT count(`resources`.`product_id`) AS quantity, products.product, resources.product_id, products.category, resources.price FROM coregroup.resources AS t1
                            INNER JOIN resources ON t1.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` <= 0;
SELECT count(`resources`.`product_id`) AS quantity, product, category, resources.price AS price, resources.product_id FROM products
                            INNER JOIN resources ON `resources`.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` IS NULL
                            GROUP BY resources.product_id;