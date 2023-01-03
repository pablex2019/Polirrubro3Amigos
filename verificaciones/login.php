<?php
    if(!empty($_POST)){
        if(isset($_POST["usuario"]) && isset($_POST["clave"])){
            if($_POST["usuario"]!="" && $_POST["clave"]!=""){
                // Include config file
                require_once "../config.php";
                // Initialize the session
                session_start();
                $dbusuario = $dbpassword = NULL;
                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    $usuario = $_POST["usuario"];
                    $clave = $_POST["clave"];
                    
                    $sql = "SELECT * FROM empleado where usuario = \"$usuario\"";
                    $query = $link->query($sql);
                    if($query->num_rows>0){
                        if($row = $query->fetch_array()){

                            $dbusuario = $row["usuario"];
                            $dbpassword = $row["clave"];

                            if(password_verify($clave,$dbpassword)){

                                $_SESSION["username"]=$username;
                                $_SESSION["clave"]=$clave;
                                $_SESSION["perfil"]=$row["PERFIL_id"];
                                $_SESSION["loggedin"] = true;

                                header("location: ../main.php");
                            }else{
                                print "<script>alert(\"Nombre de usuario ó contraseña invalida!.\");window.location='../login.php';</script>";
                            }
                        }
                    }else{
                        print "<script>alert(\"El usaurios ingresado, no existe.\");window.location='../login.php';</script>";
                    }
                    //header("location: ../main.php");
                }
            }else{
                print "<script>alert(\"No se puede loguar debido a que hay campos incompletos.\");window.location='../login.php';</script>";
            }
        }
    }
?>