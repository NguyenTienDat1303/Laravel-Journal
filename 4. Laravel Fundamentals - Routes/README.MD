### 1. Laravel Structure Overview
#### Create project:
Create Laravel project:
```
laravel new blog-course
```  
start Laravel project:
```
php artisan serve
```  
#### Structure Overview:
#### Route Introduction:
Routes in:
```
blog-course/routes/web.php
```  
Change it to:
```  
Route::get('/', function () {
    return "Laravel tutorial";
});
```  
Parameter router:
```
Route::get('/post/{id}', function ($id) {
    return "Hi id $id";
});
```  
Name router:
```
Route::get('/admin/post/example', array('as' => 'admin.home', function () {
    $url = route('admin.home');
    return "this url is ".$url;
}));
```  
*Route **/admin/post/example** has name is  **admin.home***