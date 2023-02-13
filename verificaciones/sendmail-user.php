<?php
    // Include config file
    require_once "../config.php";
    
    if(!empty($_POST)){
        if(isset($_POST["correo_electrónico2"])){
            if($_POST["correo_electrónico2"]!=""){
                $verify_mail = "SELECT e.dni,e.usuario,e.correo_electrónico FROM empleado AS e
                        where e.correo_electrónico = \"$_POST[correo_electrónico2]\"";
                $mail_sql = $link->query($verify_mail);
                $row_query = $mail_sql->fetch_row();
                
                //print "<script>alert(\"$row_query[1]\");</script>";

                $message = "Su usuario es: $row_query[1]";

                $mail = "wenmar216@gmail.com";

                $para = "$row_query[2]";
                $asunto = "Recordatorio de usuario";

                $header = 'From: ' . $mail . " \r\n";
                $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
                $header .= "Mime-Version: 1.0 \r\n";
                $header .= "Content-Type: text/plain";


                mail($para,$asunto,utf8_decode($message),$header);

                header("Location:../forget-user-password.php?id=Ok");
            } else {
                print "<script>alert(\"Hay campos sin completar.\");window.location='../forget-user-password.php';</script>";
            }
        } 
    }
    
?>