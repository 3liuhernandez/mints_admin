<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mints Auth</title>
</head>
<body>
    <form action="{{route('login.post')}}" method="post">
        @csrf
        <label for="email">Username</label>
        <input type="text" name="email" id="email" placeholder="Ingrese E-mail">
        <br/>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Ingrese contraseña">
        <br/>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>