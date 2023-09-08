-- Xóa bill_detail có product không tồn tại trong bảng
DELETE FROM bill_details WHERE product_id NOT IN (SELECT id FROM products) OR bill_id NOT IN (SELECT id FROM bills);

-- Xóa bill không có detail
DELETE FROM bills WHERE id NOT IN (SELECT bill_id FROM bill_details);

-- Cập nhật total bills
UPDATE bills SET total = (SELECT SUM(price * quantity) FROM bill_details WHERE bill_id = bills.id);

-- Cập nhật rating shop
UPDATE shops SET rating = (SELECT AVG(rating) FROM comments WHERE product_id IN (SELECT id FROM products WHERE shop_id = shops.id)); 

-- Cập nhật rating product có comment
UPDATE products SET rating = (SELECT AVG(rating) FROM comments WHERE product_id = products.id)
 WHERE id IN (SELECT product_id FROM comments);

-- Cập nhật rating product không có comment
UPDATE products SET rating = 0 WHERE id NOT IN (SELECT product_id FROM comments);