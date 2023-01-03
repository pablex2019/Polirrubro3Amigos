<?php
    // Include config file
    require_once "../config.php";
    
    if(!empty($_POST)){
        if(isset($_POST["dni"]) && isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["correo_electrónico"])){
            if($_POST["dni"]!=" " && $_POST["nombres"]!=" " && $_POST["apellidos"]!=" " && $_POST["correo_electrónico"]!=" "){
                $empleadopreconsulta = "SELECT COUNT(*) FROM empleado where dni = \"$_POST[dni]\"";
                $empleadoconsulta = $link->query($empleadopreconsulta);
                $row = $empleadoconsulta->fetch_row();
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];
                if($usuario!=""||$clave!=""){
                    $usuario = $_POST["usuario"];
                    $clave = password_hash($_POST["clave"],PASSWORD_DEFAULT);
                } else {
                    $usuario = NULL;
                    $clave = NULL;
                }
                if($row[0] < 1 ){
                    $sql = "Insert into empleado (dni,nombres,apellidos,correo_electrónico,usuario,clave,estado,PERFIL_id) 
                            value (\"$_POST[dni]\",\"$_POST[nombres]\",\"$_POST[apellidos]\",\"$_POST[correo_electrónico]\",\"$usuario\",
                            \"$clave\",0,\"$_POST[perfil]\")";
                    $query = $link->query($sql);
                    if($query!=null){
                        print "<script>alert(\"Agregado exitosamente.\");window.location='../employee.php';</script>";
                    }else{
                        print "<script>alert(\"No se pudo agregar.\");window.location='../employee.php';</script>";
                    }
                }else{
                    print "<script>alert(\"Ya se encuentra registrado, lo que quiere agregar.\");window.location='../employee.php';</script>";
                }
                
            }else{
                print "<script>alert(\"No se puedo agregar, porque hay campos incompletos.\");window.location='../employee.php';</script>";
            }
        }
    }
?>