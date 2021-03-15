### 10. Tinker
#### Create data:
Terminal
```
$post = new Post;
$post->title = "new title";
$post->content = "new content";
$post->is_admin = 1;
$post->save();
```
#### Find data using constraints:
Terminal
```
Post::where('id', 3) -> first();
Post::whereId(3) -> first();
```
#### Update and delete:
Terminal
```
$post = Post::find(3);
$post->title="phptitle updated";
$post->save();
```
Delete soft
```
$post->delete();
```
Force delete
```
$post->forceDelete();
```