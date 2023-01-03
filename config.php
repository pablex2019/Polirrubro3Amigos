<?php
    
    //Credenciales de acceso.
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','polirrubrodev');
   
    //Conectar con la base de datos.
    $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

    //Chequear conexión.

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>