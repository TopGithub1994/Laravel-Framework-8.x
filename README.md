# Laravel Framework 8.x
# Laravel REST API with Sanctum

This is an example of a REST API using auth tokens with Laravel Sanctum

## How to clone Laravel from Github
### 1. เปิด Terminal หรือ cmd แล้วเข้าไปยังโฟลเดอร์เป้าหมายที่ต้องการ
```
cd c:\xampp\htdoc
```
### 2. Clone the repository โดยใช้ git clone [GIT URL] [foldername] และ cd เข้าไปในโฟลเดอร์
```
git clone https://github.com/#
cd laravel_project
```
### 3. Run composer to install all dependencies: เพื่อสร้างโฟลเดอร์ vender ซึ่งเป็น Library ที่สำคัญของโปรเจค (เพราะโดยธรรมชาติ Git จะไม่ Commit โฟลเดอร์ Vender)
```
composer update
```
```
composer install
```
### 4.  Create your .env from .env.example : เพื่อสร้างไฟล์ config ของโปรเจค (เพราะโดยธรรมชาติ Git จะไม่ Commit ไฟล์ .env)
```
copy .env.example .env
```
Or
```
cp .env.example .env
```
### 5. Generate application key : เพื่อสร้าง Key ให้กับ โปรเจค
```
php artisan key:generate
```
### 6.  Update your .env (change database connection properly) : เพื่อสร้าง Connection ให้กับโปรเจคของเรา
```
DB_CONNECTION=mysql          
DB_HOST=127.0.0.1            
DB_PORT=3306                 
DB_DATABASE=mydb       
DB_USERNAME=root             
DB_PASSWORD=
```
### 7. Start Server
```
php artisan serve
```

## Create the table for MySQL
```
php artisan migrate
```
## Command
```
composer create-project laravel/laravel qonnect-laravel
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## Usage

Change the *.env.example* to *.env* and add your database info

For SQLite, add
```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
```

Create a _database.sqlite_ file in the _database_ directory

```
# Run the webserver on port 8000
php artisan serve
```

## Routes

```
# Public

GET   /api/products
GET   /api/products/:id

POST   /api/login
@body: email, password

POST   /api/register
@body: name, email, password, password_confirmation


# Protected

POST   /api/products
@body: name, slug, description, price

PUT   /api/products/:id
@body: ?name, ?slug, ?description, ?price

DELETE  /api/products/:id

POST    /api/logout
```

==Reference== :: https://github.com/bradtraversy/laravel-sanctum-api
