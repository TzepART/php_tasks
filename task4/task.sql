SELECT id INTO @prev_id FROM library_data_base.test ORDER BY test.id limit 1;
SELECT id INTO @prev_id FROM library_data_base.test WHERE (id - @prev_id) > 1 ORDER BY test.id limit 1;
SELECT @prev_id as 'FROM', @prev_id := id as 'TO'  FROM library_data_base.test as test
WHERE (id - @prev_id) > 1 ORDER BY test.id;