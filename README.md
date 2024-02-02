1. Устанавливаем зависимости

        composer install
2. Вставляем свои данные в .env

3. В .env изменяем

        MAIL_MAILER=log

4. Генерируем ключ

        php artisan key:generate

5. Накатываем миграции

        php artisan migrate

6. Добавляем в таблицу роли

       php artisan db:seed

7. Запускаем очереди

       php artisan queue:work

8. Запускаем приложение

       php artisan serve

9. Рабочие ссылки для теста

        http://127.0.0.1:8000/api/requests 

   
10. Два тестовых пользователя уже зареганы, их токены

        manager_token123456 - manager
        user_token123456 -user  
