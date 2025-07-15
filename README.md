Тестовое задание

Стек технологий для выполнения задания
- Laravel 12
- MySQL
- Docker

Задание
Создать 2 таблицы
- chats
- messages

Заполнить таблицы тестовыми данными
- Создать 100 чатов.
- Для каждого чата создать от 10 до 100 сообщений с рандомными датами и текстами различной длины.

Реализовать REST API метод, который позволит получить список чатов порциями по 20 шт. за один запрос.

Список должен быть отсортирован по time последнего сообщения в чате по убыванию (чтобы "свежие" чаты были вверху списка).

Для каждого чата в списке должен выводиться обрезанный текст последнего сообщения (до 100 символов).

Обязательные требования
- Ответ REST API метода должен быть в формате json.
- Проект должен разворачиваться и работать через docker-compose. Для этого можно использовать Laravel Sail или собственную сборку.

Инструкция:
1. git clone
2. docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v "$(pwd):/var/www/html" \
   -w /var/www/html \
   laravelsail/php84-composer:latest \
   composer install --ignore-platform-reqs
3. cp .env.example .env
4. /vendor/bin/sail build --no-cache
5. /vendor/bin/sail up
6. /vendor/bin/sail artisan key:generate
7. /vendor/bin/sail artisan migrate
8. /vendor/bin/sail artisan db:seed --class=DatabaseSeeder
