<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="login" method="POST">
        @csrf
        <input type="text" name="name" id="">
        <br>
        <input type="email" name="email" id="">
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>