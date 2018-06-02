-- SQL который вернет список книг, написанный
-- 3-мя соавторами. Результат: книга - количество соавторов.
SELECT b.id as book_id, b.title, b.year, ba.count_authors FROM library_data_base.book as b
	inner join
		(SELECT book_has_author.book_id as book_id, count(book_has_author.author_id) as count_authors
			FROM library_data_base.book_has_author group by book_id) as ba
	on b.id = ba.book_id
where ba.count_authors > 3
order by ba.count_authors DESC;