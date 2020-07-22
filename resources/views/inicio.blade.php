<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectito Login</title>

    <link rel="stylesheet" href="/css/login.css">

</head>
<body>
    
    <div class="wrapper fadeInDown">
        <div id="formContent">
            
            <div><h1>Inicia sesión</h1></div>
            
            <!-- Login Form -->
            <!--
            <form action="#" method="post">
                <input type="text" id="login" class="fadeIn second" name="login" placeholder="Usuario">
                <input type="text" id="password" class="fadeIn third" name="login" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Aceptar">
            </form>
            -->
            <form action="#" method="POST">
                {{ csrf_field() }}
                <input type="text" id="login" class="fadeIn second" name="login" placeholder="Usuario">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Aceptar">
            </form>
        </div>
    </div>

</body>
</html>