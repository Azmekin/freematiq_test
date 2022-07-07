Пошаговый процесс разворацивания проекта:
 1 Установка убунту
 2 Установка сервера XAMPP
 3 Установка YII2-Advanced (composer так и не запустился. Скачал архив, и этот проект через архив устанавливается)
 4 Закинуть папку с проектом в opt/lampp/htdocs 
 Установить нормальный юрл, через редактуру файла httpd-vhosts

***

        <VirtualHost *:80>
        ServerName frontend.test
        DocumentRoot "/path/to/yii-application/frontend/web/"
        
        <Directory "/path/to/yii-application/frontend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>
    
    <VirtualHost *:80>
        ServerName backend.test
        DocumentRoot "/path/to/yii-application/backend/web/"
        
        <Directory "/path/to/yii-application/backend/web/">
            # use mod_rewrite for pretty URL support
            RewriteEngine on
            # If a directory or a file exists, use the request directly
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            # Otherwise forward the request to index.php
            RewriteRule . index.php

            # use index.php as index file
            DirectoryIndex index.php

            # ...other settings...
            # Apache 2.4
            Require all granted
            
            ## Apache 2.2
            # Order allow,deny
            # Allow from all
        </Directory>
    </VirtualHost>


***
 (Настроить url для сайта не вышло, кидал на начальную страницу xammp. Путь указывал и полный, и локальный. 3 день уже пытался заставить это просто работать, не стал дальше мучать. Открывал через адрес http://localhost/advanced/frontend/web)
 5 Провести миграции для yii2, rbac (не успел провести миграцию на postgresql, файл лежит для mysql)
 6 Создать 2 пользователя (через функционал сайта). Одной из них дать роль "admin" (в базе данных). 

 Что не сделано:
 1.1 Не сконфигурированно для postgresql (Установка не отработала нормально, боялся слишком долго провозиться с установкой и не успеть в срок. Решил закончить позже. Работать с ней умею. Через pgAdmin получше, через консоль похуже)
 1.2 MySQL разрешил вход только под стандартным пользователем root (Думал успею перенести на PostgreSQL) 
 2 Нет обработки загруженных эксель файлов (через архив spreadsheet-reader работать не захотел)
 3 Нет списка нарушителей (не успел)
