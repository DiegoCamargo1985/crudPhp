<?php
//datos de conexion a la base de datos 

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "compania";

// crear una conexion

$conn = new mysqli($servername, $username, $password, $dbname);

//verfificat la conexion 
if($conn ->connect_error){
    die("error de conexion: " .$conn->connect_error);
}else{

}


?>