<?php
    require_once "../config.php";
    
    if(!empty($_POST)){
        if($_POST["radio"]=="Usuario"){
            if(isset($_POST["nombre_usuario"]) && isset($_POST["nuevo_nombre_usuario"])){
                if($_POST["nombre_usuario"]!="" && $_POST["nuevo_nombre_usuario"]!=""){
                    
                    $usuario = $_POST["nombre_usuario"];
                    $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
                    $newusuario = $_POST["nuevo_nombre_usuario"];
                    //Obtener empleado dni 
                    $sqlempleado = "SELECT id,dni,clave FROM empleado where usuario = \"$usuario\"";
                    $empleado = $link->query($sqlempleado);
                    $row_empleado = $empleado->fetch_row();
                    if($row_empleado[1]!=NULL){
                            $sql = "UPDATE empleado set usuario=\"$newusuario\"
                                WHERE dni=".$row_empleado[1];
                            $query1 = $link->query($sql);
                            if($query1!=null){
                                print "<script>alert(\"Usuario modificado correctamente.\");window.location='../forget-user-password.php';</script>";
                            }else{
                                print "<script>alert(\"No se pudo actualizar.\");window.location='../forget-user-password.php';</script>";
                            }
                    }else{
                        print "<script>alert(\"No se encontro el usuario ingresado, en el campo usuario actual.\");window.location='../forget-user-password.php';</script>";
                    }
                } else {
                    print "<script>alert(\"Hay campos sin completar.\");window.location='../forget-user-password.php';</script>";
                }
            }
        }else{
            if(isset($_POST["nombre_usuario"]) && isset($_POST["clave"]) && isset($_POST["nueva_clave"])){
                if($_POST["nombre_usuario"]!="" && $_POST["clave"]!="" && $_POST["nueva_clave"]!=""){
                    $usuario = $_POST["nombre_usuario"];
                    $clave = $_POST["clave"];
                    $confirm_clave = $_POST["nueva_clave"];
                    if($clave == $confirm_clave){
                        //Obtener empleado dni 
                        $confirm_clave = password_hash($confirm_clave, PASSWORD_DEFAULT); // Creates a password hash
                        $sqlempleado1 = "SELECT id,dni,clave FROM empleado where usuario = \"$usuario\"";
                        $empleado1 = $link->query($sqlempleado1);
                        $row_empleado1 = $empleado1->fetch_row();
                        if($row_empleado1[1]!=NULL){
                                $sql1 = "UPDATE empleado set clave=\"$confirm_clave\"
                                    WHERE dni=".$row_empleado1[1];
                                $query2 = $link->query($sql1);
                                if($query2!=null){
                                    print "<script>alert(\"Clave modificada correctamente.\");window.location='../forget-user-password.php';</script>";
                                }else{
                                    print "<script>alert(\"No se pudo actualizar.\");window.location='../forget-user-password.php';</script>";
                                }
                        }else{
                            print "<script>alert(\"No se encontro el usuario ingresado, en el campo usuario actual.\");window.location='../forget-user-password.php';</script>";
                        }
                    }else{
                        print "<script>alert(\"Las contraseñas no coinciden\");window.location='../forget-user-password.php';</script>";
                    }
                    
                } else {
                    print "<script>alert(\"Hay campos sin completar.\");window.location='../forget-user-password.php';</script>";
                }
            }
        }
    }
?>