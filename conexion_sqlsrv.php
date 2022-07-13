<?php
   
    //Configurar datos de acceso a la Base de datos
    /* $host = "localhost";
    $dbname = "agenda"; */
    //$dbuser = "sa";
    //$userpass = "ajuan102030";
    
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $db = "horasextras";

//configuracion de la DSN
$dsn = 'mysql:host='.$host.';dbname='.$db;

//configuracion de la instancia PDO
$conn = new PDO($dsn, $usuario, $password);

// AGREGAR setatribute de manera global 

//$conn-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
    //$dsn = "sqlsrv:Server=JUANK311\\INSTSQLSERVER;Database=HorasExtras"; $dbuser; $userpass;
    
    try{
     //Crear conexión a postgress
     //$conn = new PDO($dsn);
    
     //Mostgrar mensaje si la conexión es correcta
     if($conn){
    //echo "Conectado a la base  correctamente!"; 
     echo "\n";
     }
    }catch (PDOException $e){
     //Si hay error en la conexión mostrarlo
     echo $e->getMessage();
    }

 