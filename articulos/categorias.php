<?php
    require_once "../config.php";
    $html = '';
    
    if(isset($_POST['id_rubro'])){
        $id_rubro = $_POST['id_rubro'];
        if($id_rubro == 0){
            $html .= '<option value="0">Seleccione</option>';
            echo $html;
        }else{
            $result = $link->query(
                "SELECT c.id as id,c.descripción as descripción FROM categoría as c
                JOIN rubro as r ON r.id = c.RUBRO_id
                WHERE c.RUBRO_id = ".$id_rubro." ORDER BY c.descripción ASC"
            );
            if ($result->num_rows > 0) {
                $html .= '<option value="0">Seleccione</option>';
                while ($row = $result->fetch_assoc()) {              
                    $html .= '<option value="'.$row['id'].'">'.$row['descripción'].'</option>';
                }
            }
            echo $html;
        }
    }
    if(isset($_POST['id_rubroEdit'])){
        $id_rubroEdit = $_POST['id_rubroEdit'];
        if($id_rubroEdit == 0){
            $html .= '<option value="0">Seleccione</option>';
            echo $html;
        }else{
            $result = $link->query(
                "SELECT c.id as id,c.descripción as descripción FROM categoría as c
                JOIN rubro as r ON r.id = c.RUBRO_id
                WHERE c.RUBRO_id = ".$id_rubroEdit." ORDER BY c.descripción ASC"
            );
            if ($result->num_rows > 0) {
                $html .= '<option value="0">Seleccione</option>';
                while ($row = $result->fetch_assoc()) {              
                    $html .= '<option value="'.$row['id'].'">'.$row['descripción'].'</option>';
                }
            }
            echo $html;
        }
    }
?>