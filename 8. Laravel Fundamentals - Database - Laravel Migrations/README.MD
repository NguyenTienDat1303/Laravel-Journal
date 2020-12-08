### 2. Migration
#### Environment configurations:
Configurations file location
```
config/database.php
```

#### Window/Mac Os migration:
Change database name in .env(dotenv)
```
DB_DATABASE=new_cms
```
Create MySql database name new_cms
Migrate database, in project terminal
```
php artisan migrate
```
#### Create migration and dropping them:
Create migration
```
php artisan make:migration create_posts_table --create="posts"
```
Back migrate
```
php artisan migrate:rollback
```
#### Adding columns to existing tables use migrations:
Create migration
```
php artisan make:migration add_is_admin_column_to_posts_tables --table="posts"
```
Add colums to migration
```
public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->integer('is_admin') -> unsigned();
    });
}
```
Run migrate
```
php artisan migrate
```
#### Some more migration commands
Reset migrate, reset to default
```
php artisan migrate:reset
```
Rollback and run again migrate
```
php artisan migrate:refresh
```
Check migrate status
```
php artisan migrate:status
```
Check list migrate with
```
php artisan //below migrate list
```