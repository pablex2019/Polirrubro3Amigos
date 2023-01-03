<?php
    // Include config file
    require_once "../config.php";
    
    if(!empty($_POST)){
        if(isset($_POST["descripción"]) && isset($_POST["cantidad"])){
            if($_POST["descripción"]!="" && $_POST["cantidad"]!=""){
                $articulopreconsulta = "SELECT COUNT(*) FROM articulo where descripción = \"$_POST[descripción]\"";
                $articulopreconsulta = $link->query($articulopreconsulta);
                $row = $articulopreconsulta->fetch_row();
                $precio_venta=$_POST["precio_venta"];
                $precio_costo=$_POST["precio_costo"];
                if($precio_venta!=""||$precio_costo!=""){
                    $precio_venta = $_POST["precio_venta"];
                    $precio_costo = $_POST["precio_costo"];
                } else {
                    $precio_venta = NULL;
                    $precio_costo = NULL;
                }
                if($row[0] < 1 ){

                    $sql = "Insert into articulo (descripción,cantidad,precio_costo,precio_venta,estado,CATEGORÍA_id) 
                            value (\"$_POST[descripción]\",\"$_POST[cantidad]\",\"$precio_costo\",\"$precio_venta\",0,\"$_POST[categoría]\")";
                    $query = $link->query($sql);
                    if($query!=null){
                        print "<script>alert(\"Agregado exitosamente.\");window.location='../article.php';</script>";
                    }else{
                        print "<script>alert(\"No se pudo agregar.\");window.location='../article.php';</script>";
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