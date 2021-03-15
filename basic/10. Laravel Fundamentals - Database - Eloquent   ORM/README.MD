### 10. Database Eloquent
#### Reading data:
Create model in app/Models
```
class Post extends Model
{
    //custom table name
    // protected $table = 'posts';
    //custom id
    // protected $primaryKey = 'id';

}
```
#### Read data:
In routes/web.php
```
Route::get('/e-read', function() {
    $post = Post::all();
    return $post;
});
```
#### Find data by primary key:
In routes/web.php
```
Route::get('/e-find', function() {
    $post = Post::find(1);
    return $post;
});
```
#### Find data with constraint:
In routes/web.php
```
Route::get('/e-findwhere', function() {
    $posts = Post::where('id', 1) -> orderBy('id', 'desc') -> take(1) -> get();
    return $posts;
});
```
#### Saving Data:
In routes/web.php
```
Route::get('/e-basic-insert', function() {
    $post = new Post;
    $post -> title = 'new ORM title';
    $post -> body = 'Eloquent content';
    $post -> is_admin = 0;
    $post -> save();
});
```
#### Find and Saving Data:
In routes/web.php
```
Route::get('/e-basic-save', function() {
    $post = Post::find(1);
    $post -> title = 'new ORM 1 title updated';
    $post -> body = 'Eloquent content';
    $post -> is_admin = 0;
    $post -> save();
});

```

#### Create Data:
Fix Model like this
```
class Post extends Model
{
    ...
    protected $fillable = [
        'title', 'body', 'is_admin'
    ];
}

```
In routes/web.php
```
Route::get('/e-create', function() {
    Post::create(['title' => 'The create method', 'body' => 'New Eloquent body', 'is_admin' => 1]);
});

```
#### Update Data:
In routes/web.php
```
Route::get('/e-update', function() {
    Post::where('id', 1) -> where('is_admin', 0) -> update(['title' => 'Eloquent Updated title', 'body' => 'is updated']);
});
```

#### Delete Data:
In routes/web.php
```
Route::get('/e-delete', function() {
    Delete one
    $post = Post::destroy(1);
    Delete more
    Post::destroy([4,5]);
    Post::where('is_admin', 0) -> delete();
});
```


#### SoftDelete Data:
Fix class like this 
```
    ...
    use SoftDeletes;
    ...
    protected $date = ['deleted_at'];
    ...
``` 
In migrate file
```
public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        ...
        $table -> softDeletes();
    });
}
public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        ...
        $table -> dropColumn('deleted_at');
    });
}
```
In routes/web.php
```
Route::get('/e-soft-delete', function() {
    $post = Post::destroy(3);
});
```
#### Get Trash Data:
In routes/web.php
```
Route::get('/e-trash', function() {
    $post = Post::withTrashed() -> get();
    return $post;
});
```
#### Restore Trash Data:
In routes/web.php
```
Route::get('/e-restore', function() {
    $post = Post::withTrashed() -> where('is_admin', 1) -> restore();
    return $post;
});
```
#### Force delete Data:
In routes/web.php
```
Route::get('/e-force-delete', function() {
    $post = Post::withTrashed() -> where('is_admin', 0) -> forceDelete();
    return $post;
});
```


