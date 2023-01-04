<?php
    require_once "../config.php";

    if(!empty($_POST)){
        if(isset($_POST["dni"])){
            if($_POST["dni"]!=""){
            // Prepare a select statement
            $sql = "SELECT e.dni,e.nombres,e.apellidos,e.PERFIL_id FROM empleado AS e
            where e.dni = \"$_POST[dni]\"";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($fila = mysqli_fetch_assoc($result)){
                    $dni = $fila["dni"];
                    $nombres = $fila["nombres"];
                    $apellidos = $fila["apellidos"];
                    $perfil = $fila["PERFIL_id"];
                    
                }
                if($perfil==1){
                    print "<script>alert(\"El dni $dni no puede ser registrado aquí.\");window.location='../register.php';</script>";
                }else{
                    header("Location: ../register.php?dni=$dni&nombres=$nombres&apellidos=$apellidos"); 
                }
            } else {
                header("Location: ../register.php?No");   
            }
            }else{
                print "<script>alert(\"Debe ingresar un dni.\");window.location='../register.php';</script>";
            }
        }
    }
?>