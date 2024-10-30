**1\. Описание проекта**

Данный проект представляет собой веб-приложение с формой обратной связи, где пользователи могут отправлять сообщения. Администратор может авторизоваться в системе, просматривать, помечать и удалять сообщения пользователей.

**2\. Требования**

- **Web-сервер**: Apache, Nginx или другой с поддержкой PHP.
- **PHP**: версия 7.0 или выше.
- **База данных**: MySQL или MariaDB.

**3\. Настройка базы данных**

**3.1. Импорт готовой базы данных**

Вы можете импортировать готовую базу данных из файла related_files/feedback_db.sql.

**Используя phpMyAdmin:**

1. Откройте phpMyAdmin (<http://localhost/phpmyadmin/>).
2. Создайте новую базу данных feedback_db.
3. Выберите созданную базу данных.
4. Перейдите на вкладку **"Импорт"**.
5. Нажмите **"Выбрать файл"** и выберите feedback_db.sql из папки related_files.
6. Нажмите **"Выполнить"**.

**3.2. Используя файл миграции**

Если предпочитаете создать базу данных с нуля, используйте файл миграции related_files/migrations/initial_migration.sql.

**Используя командную строку:**

mysql -u root -p < related_files/migrations/initial_migration.sql

**4\. Настройка подключения к базе данных**

В файле db.php проверьте параметры подключения к базе данных

**5\. Доступ к панели администратора**

**Вход в систему**

- Перейдите по ссылке **"Модерация"** в верхнем правом углу главной страницы или откройте <http://localhost/login.php>.
- Введите учетные данные администратора:
  - **Имя пользователя**: admin
  - **Пароль**: 123456

**Создание собственного администратора**

Если вы хотите создать собственного администратора с другим паролем:

1. Откройте файл related_files/hasher.php в редакторе кода.
2. Измените строку:

$password = '123456'; // Ваш пароль

Укажите желаемый пароль.

1. Запустите скрипт hasher.php в браузере:

<http://localhost/related_files/hasher.php>

1. Скопируйте сгенерированный хэш пароля.
2. В базе данных выполните SQL-запрос для обновления пароля администратора:

UPDATE users SET password = 'скопированный_хэш' WHERE username = 'admin';