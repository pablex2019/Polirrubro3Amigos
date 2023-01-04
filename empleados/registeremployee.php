<?php
    require_once "../config.php";

    if(!empty($_POST)){
        if(isset($_POST["dni"]) && isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["nombre_usuario"]) && isset($_POST["clave"]) && isset($_POST["confirm_clave"])){
            if($_POST["dni"]!="" && $_POST["nombres"]!="" && $_POST["apellidos"]!="" && $_POST["nombre_usuario"]!="" && $_POST["clave"]!="" && $_POST["confirm_clave"]!=""){
                //Obtener Empleado
                $sqlempleado = "SELECT id,dni,usuario,clave FROM empleado where dni = \"$_POST[dni]\"";
                $empleado = $link->query($sqlempleado);
                $row_empleado = $empleado->fetch_row();
                //Verificar si existe el usuario que ingreso el empleado
                $empleadopreconsulta = "SELECT COUNT(*) FROM empleado where usuario=\"$_POST[nombre_usuario]\"";
                $empleadoconsulta = $link->query($empleadopreconsulta);
                $row = $empleadoconsulta->fetch_row();

                if($row[0]<1){

                    $clave = $_POST["clave"];
                    $confirm_clave = $_POST["confirm_clave"];

                    if($clave==$confirm_clave){
                        $clave = password_hash($clave, PASSWORD_DEFAULT); // Creates a password hash
                        $sql = "UPDATE empleado set usuario=\"$_POST[nombre_usuario]\", clave=\"$clave\"
                                WHERE dni=".$row_empleado[1];
                        $query = $link->query($sql);
                        if($query!=null){
                            print "<script>alert(\"Usuario y contraseña creados exitosamente.\");window.location='../login.php';</script>";
                        } else {
                            print "<script>alert(\"No se pudo crear el usuario.\");window.location='../register.php';</script>";
                        }
                    }else{
                        print "<script>alert(\"Las contraseñas no coinciden en ambos campos.\");window.location='../register.php';</script>";
                    }
                }else{
                    print "<script>alert(\"Ya se encuentra registrado un usuario, para otra persona.\");window.location='../register.php';</script>";
                }
            } else {
                print "<script>alert(\"Hay campos sin completar.\");window.location='../register.php';</script>";
            }
        }
    }
?>