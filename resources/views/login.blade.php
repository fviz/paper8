<!doctype html>
<html lang=" ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
<form method="post" action="/login">
    @csrf
    {{ $errors->first() }}<br>
    <input type="text" name="email">
    <input type="password" name="password">
    <button type="submit">login</button>
</form>
</body>
</html>
