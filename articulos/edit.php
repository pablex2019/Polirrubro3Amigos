<?php
    // Include config file
    require_once "../config.php";

    if(!empty($_POST)){
        session_start();
            if($_SESSION["perfil"]== 4){
                if(isset($_POST["cantidadEdit2"]) && $_POST["cantidadEdit2"]!=""){
                    $sql = "update articulo set cantidad=\"$_POST[cantidadEdit2]\"
                            where id=".$_POST["idEdit"];
                    $query1 = $link->query($sql);
                    if($query1!=null){
                        print "<script>alert(\"Actualizado correctamente.\");window.location='../article.php';</script>";
                    }else{
                        print "<script>alert(\"No se pudo actualizar.\");window.location='../article.php';</script>";
                    }
                }else{
                    print "<script>alert(\"No se puedo realizar la modificación, porque el campo Cantidad esta incompleto.\");window.location='../article.php';</script>";
                }
            }else{
                if($_SESSION["perfil"]== 1){
                    if(isset($_POST["descripciónEdit"]) && isset($_POST["cantidadEdit"])){
                        if($_POST["descripciónEdit"]!="" && $_POST["cantidadEdit"]!=""){
                            $precio_venta=$_POST["precio_ventaEdit"];
                            $precio_costo=$_POST["precio_costoEdit"];
                            if($precio_venta!=""||$precio_costo!=""){
                                $precio_venta = $_POST["precio_ventaEdit"];
                                $precio_costo = $_POST["precio_costoEdit"];
                            } else {
                                $precio_venta = NULL;
                                $precio_costo = NULL;
                            }
                            $sql = "update articulo set descripción=\"$_POST[descripciónEdit]\",cantidad=\"$_POST[cantidadEdit]\", precio_costo=\"$_POST[precio_costoEdit]\",
                            precio_venta=\"$_POST[precio_ventaEdit]\",estado=0, CATEGORÍA_id=\"$_POST[categoríaEdit]\"
                            where id=".$_POST["idEdit"];

                            $query2 = $link->query($sql);
                            if($query2!=null){
                                print "<script>alert(\"Actualizado correctamente.\");window.location='../article.php';</script>";
                            }else{
                                print "<script>alert(\"No se pudo actualizar.\");window.location='../article.php';</script>";
                            }
                        }else{
                            print "<script>alert(\"No se puedo agregar, porque hay campos incompletos.\");window.location='../article.php';</script>";
                        }
                    }
                }
            }
    }
?>