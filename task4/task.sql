SELECT id INTO @prev_id FROM library_data_base.test ORDER BY test.id limit 1;
SELECT temp.prev_id as 'FROM', temp.current_id as 'TO' FROM
	(SELECT (id - @prev_id) as diff, @prev_id as prev_id, @prev_id := id as current_id
	FROM library_data_base.test as test
	ORDER BY test.id) as temp
WHERE temp.diff >1;