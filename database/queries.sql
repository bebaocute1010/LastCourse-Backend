-- Xóa bill_detail có product không tồn tại trong bảng
DELETE FROM bill_details WHERE product_id NOT IN (SELECT id FROM products) OR bill_id NOT IN (SELECT id FROM bills)

-- Xóa bill không có detail
DELETE FROM bills WHERE id NOT IN (SELECT bill_id FROM bill_details)

-- update total bills
UPDATE bills SET total = (SELECT SUM(price * quantity) FROM bill_details WHERE bill_id = bills.id)