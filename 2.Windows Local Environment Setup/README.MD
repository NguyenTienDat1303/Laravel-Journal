### 1. Tools
#### Download XAMPP:
```
https://www.apachefriends.org/index.html
```  
#### Download Visual Studio Code :
```
https://code.visualstudio.com/
```  
#### Download PhpStorm (instead of Visual Studio Code):
```
https://www.jetbrains.com/phpstorm/
```  
#### Download Composer:
```
https://getcomposer.org/download/
```  
### 2. Using MySQL
#### Set Mysql variable to Path:
```
YourDirectory\XAMPP\mysql\bin
```  
#### Run MySQL from cmd:
```
mysql -uroot -p
```  
*Password is empty*

Show database in MySQL:
```
show databases;
```  
Create database in MySQL:
```
create database yourdatabasename;
create database my_db;
```  
Use your database in MySQL:
```
user yourdatabasename;
user my_db;
```  
### 4. Installing Laravel
#### Create project via composer:
```
composer create-project --prefer-dist laravel/laravel blog
```  
#### Download the Laravel installer using Composer:
```
composer global require laravel/installer
```  
#### Create project via Laravel Installer:
```
laravel new blog
``` 
