<?php
   
    //Configurar datos de acceso a la Base de datos
    /* $host = "localhost";
    $dbname = "agenda"; */
    $dbuser = "sa";
    $userpass = "ajuan102030";
    
    $dsn = "sqlsrv:Server=JUANK311\\INSTSQLSERVER;Database=HorasExtras"; $dbuser; $userpass;
    
    try{
     //Crear conexión a postgress
     $conn = new PDO($dsn);
    
     //Mostgrar mensaje si la conexión es correcta
     if($conn){
    //echo "Conectado a la base  correctamente!"; 
     echo "\n";
     }
    }catch (PDOException $e){
     //Si hay error en la conexión mostrarlo
     echo $e->getMessage();
    }

 