<?php
    require_once "../config.php";
    $id = $_POST['id'];
    $sql = "SELECT a.id as id,a.descripción,a.cantidad,a.precio_costo,a.precio_venta, r.id as id_rubro,c.id as id_categoría, a.id as id,a.descripción, a.cantidad 
    FROM articulo as a 
    JOIN categoría as c ON c.id = a.CATEGORÍA_id 
    JOIN rubro as r ON r.id = c.RUBRO_id 
    WHERE a.estado = 0 and a.id = $id 
    ORDER BY a.descripción ASC LIMIT 1"; 
    $resultado = $link->query($sql);
    $rows = $resultado->num_rows;

    $articulos = [];

    if($rows>0){
        $articulos = $resultado->fetch_array();
    }
    echo json_encode($articulos,JSON_UNESCAPED_UNICODE);
?>