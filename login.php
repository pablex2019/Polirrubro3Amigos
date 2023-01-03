<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polirrubro 3 Amigos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="estilos/login.css">

</head>
<body>
    <div id="contenedor">
        <header id="cabecera">
            <label for="título">Polirrubro 3 Amigos</label>
        </header>
        <main>
            <form action="verificaciones/login.php" method="post">
                <div class="form-group">
                    <label for="Usuario">Usuario</label><br>
                    <input type="text" name="usuario" id="usuario" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Contraseña">Contraseña</label><br>
                    <input type="password" name="clave" id="clave" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Acceder" id="acceder">
                </div>
            </form>
        </main>
    </div>
</body>
</html>