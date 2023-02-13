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
                    <form id="enviarmail" action="verificaciones/sendmail-user.php" method="post">
                        <input type="hidden" id="correo_electrónico2" name="correo_electrónico2" class="form-control" value="<?php if(isset($_GET['correo_electrónico'])){ echo $_GET['correo_electrónico'];} ?>">
                        <input id="boton1" name="botones" type="submit" class="btn btn-success" value="Recuperar Usuario">
                    </form><br>
                    <input id="boton2" name="botones" type="submit" class="btn btn-success" value="Cambiar Usuario y/o Contraseña" onclick="changeUserPass()">
                </div>
                <?php
                    if(isset($_GET['id'])){
                        if($_GET['id']=='Ok'){
                            echo "<div class=\"form-group\">";
                            echo    "<p id=\"mensaje\" stlye=\"display:block\">Se envió un mail a su correo electronico con el usuario que usted registro.</p>";
                            echo "</div>";
                        }
                    }
                ?>
                <form action="verificaciones/changeuserpassword.php" method="post">
                    <div class="form-group">
                        <label for="cambiar" id="cambiartitulo" style="display:none">Cambiar</label>

                        <input type="radio" name="radio" id="radio" onclick="changeUser()" value="Usuario" style="display:none"/>
                        <label for="usuario" style="display:none" id="usuariotitulochange" >Usuario</label>

                        <input type="radio" name="radio" id="radio2" onclick="changePassword()" value="Contraseña" style="display:none"/>
                        <label for="clave" style="display:none" id="clavetitulochange">Contraseña</label>
                    </div>
                    <div class="form-group">
                        <label id="usuarioactualtitulo" style="display:none">Usuario actual</label>
                        <input id="usuarioactualcampo"style="display:none" type="text" name="nombre_usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label id="usuarioactualtitulo2"style="display:none">Nuevo usuario</label>
                        <input id="usuarioactualcampo2"style="display:none" type="text" name="nuevo_nombre_usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label id="passwordtitulo" style="display:none">Contraseña</label>
                        <input id="passwordcampo" style="display:none" type="password" name="clave" class="form-control">
                    </div>
                    <div class="form-group">
                        <label id="passwordtitulo2" style="display:none">Confirmar Nueva contraseña</label>
                        <input id="passwordcampo2" style="display:none" type="password" name="nueva_clave" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="button_ingresar" style="width:100%;display:none" type="submit" class="btn btn-primary" value="Guardar">
                        <a id="cancelar"style="display:none" class="btn btn-default" href="login.php" onclick="ocultarChangeUserPass()">Cancelar</a>
                    </div>
                    <div class="form-group">
                        <a id="cancelar" class="btn btn-default" href="login.php">Volver al login</a>
                    </div>
                </form>
        </section>
    </div>
    </body>
    <script>
        function changeUserPass(){
            var contenedor1 = document.getElementById("cambiartitulo").style.display="block";
            var contenedor2 = document.getElementById("radio").style.display="inline";
            var contenedor2 = document.getElementById("radio2").style.display="inline";
            var contenedor3 = document.getElementById("usuariotitulochange").style.display="inline";
            //var contenedor4 = document.getElementById("radio").style.display="inline";
            var contenedor5 = document.getElementById("clavetitulochange").style.display="inline";
            var contenedor6 = document.getElementById("mensaje").style.display="none";
        }
        function changeUser() {
            //Usuario Actual
            var contenedor7 = document.getElementById("usuarioactualtitulo").style.display="block";
            var contenedor7 = document.getElementById("usuarioactualcampo").style.display="block";
            //Nuevo usuario
            var contenedor7 = document.getElementById("usuarioactualtitulo2").style.display="block";
            var contenedor7 = document.getElementById("usuarioactualcampo2").style.display="block";
            //Contraseña
            var contenedor7 = document.getElementById("passwordtitulo").style.display="none";
            var contenedor7 = document.getElementById("passwordcampo").style.display="none";
            //Confirmar contraseña
            var contenedor7 = document.getElementById("passwordtitulo2").style.display="none";
            var contenedor7 = document.getElementById("passwordcampo2").style.display="none";
            document.querySelectorAll('[name=clavechange]').forEach((x) => x.checked=false);
            var contenedor7 = document.getElementById("button_ingresar").style.display="block";
        }
        function changePassword() {
            //Usuario actual
            var contenedor7 = document.getElementById("usuarioactualtitulo").style.display="block";
            var contenedor7 = document.getElementById("usuarioactualcampo").style.display="block";
            //Nuevo usuario
            var contenedor7 = document.getElementById("usuarioactualtitulo2").style.display="none";
            var contenedor7 = document.getElementById("usuarioactualcampo2").style.display="none";
            //Contraseña
            var contenedor7 = document.getElementById("passwordtitulo").style.display="block";
            var contenedor7 = document.getElementById("passwordcampo").style.display="block";
            //Confirmar contraseña
            var contenedor7 = document.getElementById("passwordtitulo2").style.display="block";
            var contenedor7 = document.getElementById("passwordcampo2").style.display="block";
            document.querySelectorAll('[name=usuariochange]').forEach((x) => x.checked=false);
            var contenedor7 = document.getElementById("button_ingresar").style.display="block";
        }
    </script>