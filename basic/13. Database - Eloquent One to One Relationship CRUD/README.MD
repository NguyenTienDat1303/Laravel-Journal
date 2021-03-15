### 10. Database
#### Database configuration and migration:
Create project
```
laravel new ontoone
```
Create address table
```
php artisan make:mode Address -m
```
Add this column to Address table
```
$table->increments('id');
$table->integer('user_id') -> unsigned() -> nullable();
$table->string('name');
$table->timestamps();
```
Migrate it
```
php artisan migrate
```
Add this function to model User
```
public function address()
{
    return $this->hasOne(Address::class);
}
```
Add this property to Address
```
protected $fillable = [
        'name'
    ];
```
### Create data
Add this route to add address to user
```
Route::get('/insert', function () {
    $user = User::findOrFail(1);
    $address = new Address(['name' => '1234 LA']);
    echo $user -> address();
    $user -> address() -> save($address);
    return $user -> address();
});
```
### Update data
Use this route to update data
```
Route::get('/update', function () {
    $address = Address::whereUserId(1) -> first();
    $address->name = "4321 updated";
    $address->save();
    return $address;
});
```
### Read data
Use this route to read data
```
Route::get('/read', function () {
    $user = User::findOrFail(1);
    return $user->address->name;
});
```

### Delete data
Use this route to delete address from user
```
Route::get('/delete', function () {
    $user = User::findOrFail(1);
    return $user->address->delete();
});
```