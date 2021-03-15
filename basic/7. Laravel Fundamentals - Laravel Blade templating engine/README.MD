### 2. Laravel Blade template engine
#### Master layout setup:
create app.blade.php in resources/views/layouts:
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('footer')
</body>
</html>
```  
#### Blade feature:
in views/post.blade.php
```
@extends('layouts.app')
@section('content')
    <h1>Post Page {{$id}} {{$name}} {{$password}}</h1>
@endsection
```
Child view use ***extends***  to inherit view
User operator in blade (views/contact.blade.php)
```
@extends('layouts.app')
@section('content')
    <h1>Contact Page</h1>
    @if (count($people))
        @foreach ($people as $person)
            <li>{{$person}}</li>
        @endforeach
    @endif

@endsection
```