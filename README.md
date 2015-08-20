# Тестовое задание для Yell.ru

## Задание 1

Конфиг nginx в файле nginx.conf
Стартовая страница: http://yell.dev/shape/index

![Начальный экран](https://raw.githubusercontent.com/ramilexe/yell-test-task/master/pic1.png)


## Задание 2

Таблица книг:
```
CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Название книги',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB;
```

Таблица авторов:
```
CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'ФИО автора',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB;
```

Таблица связей много-ко-многим для книг и авторов:
```
CREATE TABLE `book_to_author` (
  `book_to_author_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL COMMENT 'ID книги',
  `author_id` int(11) NOT NULL COMMENT 'ID автора',
  PRIMARY KEY (`book_to_author_id`)
) ENGINE=InnoDB;
```

## Задание 3

Для MySQL верно следующее решение.
```
SELECT
	d1.type, value
FROM data d1
INNER JOIN (
	SELECT
		type, MAX(date) AS date
	FROM data
	GROUP BY type
) AS d2 ON (d1.type = d2.type AND d1.date=d2.date)
```

Если же использовать Postgresql, то можно использовать window-функции:

```
WITH t AS (
	SELECT
		type,
		date,
		value,
		rank() OVER(PARTITION BY type ORDER BY date DESC) AS rank
	FROM data
)
SELECT type, value
FROM t
WHERE rank = 1
```