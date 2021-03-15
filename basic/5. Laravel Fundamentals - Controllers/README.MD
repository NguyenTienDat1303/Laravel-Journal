### 2. Controller (app/Http/Controllers)
#### Creating controller:
from terminal:
```
php artisan make:controller PostController
```  
from terminal with resourse:
```
php artisan make:controller --resource PostController
```  
#### Routing controller:
use controller function in routes:
```
Route::get('/post', [PostController::class, 'index']);
```  
#### Passing data:
in routes
```
Route::get('/post/{id}', [PostController::class, 'index']);
```  
in controller function
```  
public function index($id)
{
    return "its working the number is " . $id;
}
```  
#### Resource and Controllers:
use resource route
```
Route::resource('posts', PostController::class);
```
show route list
```  
php artisan route:list
```  
