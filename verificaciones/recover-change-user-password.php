<?php
    require_once "../config.php";

    if(!empty($_POST)){
        if(isset($_POST["dni"])){
            if($_POST["dni"]!=""){
            // Prepare a select statement
            $sql = "SELECT e.dni,e.nombres,e.apellidos,e.correo_electrónico,e.PERFIL_id FROM empleado AS e
            where e.dni = \"$_POST[dni]\"";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($fila = mysqli_fetch_assoc($result)){
                    $dni = $fila["dni"];
                    $nombres = $fila["nombres"];
                    $apellidos = $fila["apellidos"];
                    $correo_electrónico = $fila["correo_electrónico"];
                    $perfil = $fila["PERFIL_id"];
                    
                }
                if($perfil==1){
                    print "<script>alert(\"El dni $dni no puede recuperar su contraseña desde aquí.\");window.location='../forget-user-password.php';</script>";
                }else{
                    header("Location: ../forget-user-password.php?dni=$dni&nombres=$nombres&apellidos=$apellidos&correo_electrónico=$correo_electrónico"); 
                }
            } else {
                header("Location: ../forget-user-password.php?No");   
            }
            }else{
                print "<script>alert(\"Debe ingresar un dni.\");window.location='../register.php';</script>";
            }
        }
    }
?>