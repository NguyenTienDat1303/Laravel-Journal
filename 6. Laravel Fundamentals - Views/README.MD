### 2. View (resources/views)
#### Creating views and custom method:
create contact.blade.php file in views folder or nested folder use (views/pages/contact.blade.php):
```
link file ...
```  
in controller add:
```
public function contact()
{
    return view('contact');
}
```  
if use nested folder use
```
public function contact()
{
    return view('pages/contact');
}
```  
in routes/web.php
```
Route::get('/contact', [PostController::class, 'contact']);
```
#### Passing data to views:
in routes/web.php
```
Route::get('/post/{id}/{name}/{password}', [PostController::class, 'show_post']);
```  
in controller function with 3 parameters
```
public function show_post($id, $name, $password)
{
    // return view('post') ->with('id', $id);
    return view('post', compact('id', 'name', 'password'));
}
```  
use data in view like this
```
<h1>Post {{$id}} {{$name}} {{$password}}</h1>
```