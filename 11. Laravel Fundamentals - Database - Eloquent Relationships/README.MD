### 10. Database Eloquent Relationships
#### One to One relationship:
In migration create posts table change this
```
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table -> integer('user_id') -> unsigned();
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}
```
Run this after to change database
```
php artisan migrate:refresh
```
In app/Models/User.php add this function
```
...
public function post()
{
    return $this -> hasOne(Post::class);
}
```
To find one user's post add this route
```
Route::get('/user/{id}/post', function ($id) {
    return User::find($id) -> post;
});
```
#### Inverse relation:
In app/Models/Post.php add this function
```
...
public function user()
{
    return $this -> belongsTo(User::class);
}
```
To find post's user add this route
```
Route::get('/post/{id}/user', function ($id) {
    return Post::find($id) -> user;
});
```


#### One to Many relationship:
In app/Models/User.php add this function
```
public function posts()
{
    return $this -> hasMany(Post::class);
}
```
To find posts's user add this route
```
Route::get('/posts', function () {
    $user = User::find(1);

    foreach($user -> posts as $post) {
       echo  $post -> title . '<br>';
    }
    // return $user;
});
```
#### Many to Many relationship:
Create Role model
```
php artisan make:model Role -m
```
Create user_roles migration
```
php artisan make:migration create_users_roles_table --create=role_user
```
Change create_roles_table migration
```
...
public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->timestamps();
    });
}
```
Change create_user_roles_table migration
```
...
public function up()
{
    Schema::create('role_user', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('role_id');
        $table->timestamps();
    });
}
```
Migrate it
```
php artisan migrate
```

In app/Models/User.php add this function
```
public function roles()
{
    return $this -> belongsToMany(Role::class);
}
```

Add this route to get user's roles
```
Route::get('/user/{id}/roles', function ($id) {
    $roles = User::find($id) -> roles;
    return $roles;
});
```
#### Querying intermediate table:
Add this function to Models/Role.php
```
...
public function users()
{
    return $this->belongsTo(User::class);
}
```
Change roles function in Models/User.php
```
public function roles()
{
    return $this -> belongsToMany(Role::class) -> withPivot('created_at', 'updated_at');
}
```
Add this route
```
Route::get('/user/{id}/pivot', function ($id) {
    $user = User::find($id);
    foreach($user->roles as $role){
        echo $role -> pivot;
    }
});

```
#### Has many through relation:
Create model Country and migration
```
php artisan make:model Country -m
```
Create user migration "add_country_id_column_to_user"
```
php artisan make:migration add_country_id_column_to_user --table=users
```
Add this to this migration
```
...
public function up()
{
    Schema::table('user', function (Blueprint $table) {
        $table->integer('country_id');
    });
}
public function down()
{
    Schema::table('user', function (Blueprint $table) {
        //
        $table->drop('country_id');
    });
}
...
```
In migration create country table add this column
```
$table->string('name');
```
In model Country add this function
```
public function posts()
{
    return $this->hasManyThrough(Post::class, User::class);
}
```

Add this route to test relation ship, it can get post without foreign key
```
Route::get('/user/country', function () {
    $country = Country::find(4);
    foreach($country->posts as $post){
        return $post->title;
    }
});
```
#### Polymorphic relation:
create model Photo and migration
```
php artisan make:model Photo -m
```
change create Photo migration function to this
```
...
public function up()
{
    Schema::create('photos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('path');
        $table->integer('imageable_id');
        $table->string('imageable_type');
        $table->timestamps();
    });
}
```
Delete this column from migration create post table
```
$table -> integer('user_id') -> unsigned();
```
Refresh migration
```
php artisan migrate:refresh
```
In model Photo add this function
```
public function imageable() {
    return $this->morphTo();
}
```
In model Post and User and this function
```
public function photos()
{
    return $this->morphMany(Photo::class, 'imageable');
}
```
Test it in Route with
```
Route::get('/user/photos', function () {
    $user = User::find(2);
    foreach($user->photos as $photo){
        return $photo;
    }
});

Route::get('/post/photos', function () {
    $post = Post::find(2);
    foreach($post->photos as $photo){
        return $photo;
    }
});
```

#### Polymorphic inverser:
Add this route
```
Route::get('/photo/{id}/post', function ($id) {
    $photo = Photo::findOrFail($id);
    $imageable = $photo->imageable;
    return $imageable;
});
```
#### Polymorphic relation many to many - retrieving:
Create model Video and migration
```
php artisan make:model Video -m 
```
Change this to Video migration
```
public function up()
{
    Schema::create('videos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->timestamps();
    });
}
```
Create model Tag and migration
```
php artisan make:model Tag -m 
```
Change this to Tag migration
```
public function up()
{
    Schema::create('videos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->timestamps();
    });
}
```
Create model Taggable and migration
```
php artisan make:model Taggable -m 
```
Change this to Taggable migration
```
public function up()
{
    Schema::create('taggables', function (Blueprint $table) {
        $table->integer('tag_id');
        $table->integer('taggable_id');
        $table->integer('taggable_type');
        $table->timestamps();
    });
}
```
Add function to app/Models/Tag
```
public function posts()
{
    return $this->morphedByMany(Post::class, 'taggable');
}
public function videos()
{
    return $this->morphedByMany(Video::class, 'taggable');
}
```
Add function to app/Models/Post and app/Models/Video
```
public function tags()
{
    return $this->morphToMany(Tag::class, 'taggable');
}
```
Migrate all
```
php artisan migrate
```
Check morph
```
Route::get('/post/tag', function () {
    $post = Post::find(1);
    foreach ($post->tags as $tag) {
        echo $tag -> name;
    }
});
Route::get('/tag/post', function () {
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post -> title;
    }
});
```