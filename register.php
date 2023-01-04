<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema Integral Académico</title>
        <link rel="stylesheet" href="estilos/register.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div id="contenedor">
        <heder id="cabecera">
            <label for="title">Registrarse</label>
        </heder>
        <section id="contendido">
                <form role="search" action="verificaciones/consultemployee.php"  method="post">
                    <div class="form-group">
                        <label>Ingrese su Dni</label>
                        <div class="row">
                            <div class="col-xs-9">
                                <input type="text" name="dni" class="form-control" value="">
                            </div>
                            <div class="col-xs-3">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="register" action="empleados/registeremployee.php" method="post">
                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" name="dni" class="form-control" value="<?php if(isset($_GET['dni'])){ echo $_GET['dni'];} ?>" readonly>
                        <span class="help-block"><?php if(isset($_GET['No'])){ echo "No se encontro el dni de la persona";} ?></span>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombres" class="form-control" value="<?php if(isset($_GET['nombres'])){ echo $_GET['nombres'];} ?>" readonly>
                        <span class="help-block"><?php if(isset($_GET['No'])){ echo "No se encontro el nombre de la persona";} ?></span>
                    </div> 
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellidos" class="form-control" value="<?php if(isset($_GET['apellidos'])){ echo $_GET['apellidos'];} ?>" readonly>
                        <span class="help-block"><?php if(isset($_GET['No'])){ echo "No se encontro el apellido de la persona";} ?></span>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control">
                        <span class="help-block"></span>
                    </div>    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="clave" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="confirm_clave" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <a class="btn btn-default" href="login.php">Cancelar</a>
                    </div>
                </form> 
        </section>
    </div>
    </body>