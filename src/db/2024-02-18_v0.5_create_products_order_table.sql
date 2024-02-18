USE shop;
CREATE TABLE IF NOT EXISTS products_order (
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  PRIMARY KEY (order_id, product_id),
  FOREIGN KEY (order_id) REFERENCES user_order(id),
  FOREIGN KEY (product_id) REFERENCES product(id)
);