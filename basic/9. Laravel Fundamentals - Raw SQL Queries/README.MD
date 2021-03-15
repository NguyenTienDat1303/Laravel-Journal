### 9. Raw SQL queries
#### Insert data:
In routes/web.php
```
Route::get('/insert', function() {
    DB::insert('insert into posts(title, body, is_admin) value(?, ?, ?)', ['Php Laravel', 'Laravel is cool', 1]);
});
```
#### Read data:
In routes/web.php
```
Route::get('/read', function() {
    $results = DB::select('select * from posts where id = ?', ['*']);
    foreach ($results as $post) {
        return $post -> title;
    }
    // return $result;
});
```
#### Update data:
In routes/web.php
```
Route::get('/update', function() {
    $results = DB::update('update posts set title = "Update title" where id = ?', [2]);
    return $results;
});
```
#### Delete data:
In routes/web.php
```
Route::get('/update', function() {
    $results = DB::update('update posts set title = "Update title" where id = ?', [2]);
    return $results;
});
```

