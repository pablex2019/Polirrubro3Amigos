<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema Integral Académico</title>
        <link rel="stylesheet" href="estilos/forget-user-password.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div id="contenedor">
        <heder id="cabecera">
            <label for="title">Recuperar usuario y/o Cambiar usaurio o contraseña</label>
        </heder>
        <section id="contendido">
                <form role="search" action="verificaciones/consultemployee2.php"  method="post">
                    <div class="form-group">
                        <label>Ingrese su Dni</label>
                        <div class="row">
                            <div class="col-xs-10">
                                <input type="text" name="dni" class="form-control" value="">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <label>Correo electrónico</label>
                    <input type="text" id="correo_electrónico" name="correo_electrónico" class="form-control" value="<?php if(isset($_GET['correo_electrónico'])){ echo $_GET['correo_electrónico'];} ?>" readonly>
                    <span class="help-block"><?php if(isset($_GET['No'])){ echo "No se encontro el correo electrónico de la persona";} ?></span>
                </div>
                <div class="form-group">
                    <form id="enviarmail" action="verificaciones/retrieve-user-change-user-password.php" method="post">
                        <input type="hidden" id="correo_electrónico" name="correo_electrónico" class="form-control" value="<?php if(isset($_GET['apellidos'])){ echo $_GET['apellidos'];} ?>">
                        <input id="boton1" name="botones" type="submit" class="btn btn-success" value="Recuperar Usuario">
                    </form><br>
                    <input id="boton2" name="botones" type="submit" class="btn btn-success" value="Cambiar Usuario y/o Contraseña" onclick="changeUserPass()">
                </div>
                <?php
                    if(isset($_GET['id'])){
                        if($_GET['id']=='Ok'){
                            echo "<div class=\"form-group\">";
                            echo    "<p>Se envió un mail a su correo electronico con el usuario que usted registro.</p>";
                            echo "</div>";
                        }
                    }
                ?>
                <div class="form-group">
                    <label id="usuarioactualtitulo" style="display:none">Ingrese su nombre de usuario actual</label>
                    <input id="usuarioactualcampo"style="display:none" type="text" name="nombre_usuario" class="form-control">
                </div>
                <div class="form-group">
                    <label id="usuarioactualtitulo2"style="display:none">Ingrese su nuevo nombre de usuario o puede ser el mismo en caso de no querer cambiarlo.</label>
                    <input id="usuarioactualcampo2"style="display:none" type="text" name="nuevo_nombre_usuario" class="form-control">
                </div>
                <div class="form-group">
                    <label style="display:none">Nueva contraseña</label>
                    <input style="display:none" type="password" name="clave" class="form-control">
                </div>
                <div class="form-group">
                    <label style="display:none">Confirmar nueva contraseña</label>
                    <input style="display:none" type="password" name="nueva_clave" class="form-control">
                </div>
                <div class="form-group">
                    <br><input id="button_ingresar" style="width:20%;display:none" type="submit" class="btn btn-primary" value="Guardar">
                    <a style="display:none" class="btn btn-default" href="login.php">Cancelar</a>
                </div>
                <div class="form-group">
                    <a id="cancelar" class="btn btn-default" href="login.php">Volver al login</a>
                </div>
        </section>
    </div>
    </body>
    <script>
        function changeUserPass(){
            var contenedor1 = document.getElementById("usuarioactualtitulo").style.display="block";
            var contenedor2 = document.getElementById("usuarioactualcampo").style.display="block";
            var contenedor3 = document.getElementById("usuarioactualtitulo2").style.display="block";
            var contenedor4 = document.getElementById("usuarioactualcampo2").style.display="block";

        }
    </script>