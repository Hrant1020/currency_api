
## Task 1
# Построение Базы 


```sh
CREATE TABLE users (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250),
  `last_name` varchar(250),
  `age` tinyint(3) UNSIGNED,
   PRIMARY KEY (`id`)
);

CREATE TABLE books (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250),
  `autor` varchar(250),
   PRIMARY KEY (`id`)
);


CREATE TABLE user_books (
  `id` int(11) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) UNSIGNED NOT NULL,
   PRIMARY KEY (`id`)
);

INSERT INTO users VALUES
(1, 'Ivan', 'Ivanov', 7),
(2, 'Marina', 'Ivanova', 17),
(3, 'Peter', 'Petrow', 16),
(4, 'Elena', 'Petrowa', 14);


INSERT INTO books VALUES
(1, 'Romeo and Juliet', 'William Shakespeare'),
(2, 'Hamlet', 'William Shakespeare'),
(3, 'War and Peace', 'Leo Tolstoy'),
(4, 'Anna Karenina', 'Leo Tolstoy');

INSERT INTO user_books VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 3, 3),
(7, 3, 4),
(8, 4, 1),
(9, 4, 4);
```
### Ответ
```sh
SELECT users.`id`, 
       CONCAT(users.`first_name`, ' ' ,users.`last_name`) as Name,
       books.`autor` AS AUTOR,
       GROUP_CONCAT(books.`name`) as Books
       FROM users
JOIN user_books ON users.`id` = user_books.`user_id`
JOIN books  ON books.`id` = user_books.`book_id`
WHERE
users.`age` BETWEEN 7 AND 17
GROUP BY users.`id` 
HAVING 
COUNT(books.`id`) = 2 AND  max(AUTOR) = min(AUTOR)
```
### Посмотреть работу запроса
[https://www.db-fiddle.com/f/oYyxReqQNcoqD9sJmKNKt8/0](https://www.db-fiddle.com/f/oYyxReqQNcoqD9sJmKNKt8/0)


## Task 2
[GithHub repository](https://github.com/Hrant1020/currency_api)

### Для Получения Валютных Курсов
```sh
php artisan migrate
php artisan fetch-rates
```
### Что не успел
- Нормально Протестировать
- Код рефакторинг
- Использование Strict Type Hinting
- Генерация PHPDOC
- Нормальная Валидация
- response  может содержать  цифру e 

