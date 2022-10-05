USE coregroup;
SELECT count(DISTINCT `resources`.`product_id`) AS quantity, product, category, resources.price AS price, resources.product_id FROM products
                            INNER JOIN resources ON `resources`.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` IS NULL
                            GROUP BY resources.product_id;
SELECT orders.*, products.product AS product, employees.username AS username FROM `orders` as orders
                LEFT JOIN employees ON orders.ordered_by = employees.employee_id
                JOIN products ON orders.product_id = products.product_id;
SELECT *, employees.username FROM orders
	JOIN employees on employees.employee_id = orders.ordered_by;                