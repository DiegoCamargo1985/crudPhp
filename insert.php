<?php
require_once("conn.php");


// User values that need to be escaped
if($_SERVER['REQUEST_METHOD'] =="POST"){
    $accion = $_POST["accion"];
    $id= $_POST['id'];

switch($accion){

//Insert data

    case "Insert":
        
$Identificacion= mysqli_real_escape_string($conn,$_POST['Identificacion']);
$Nombre = mysqli_real_escape_string($conn, $_POST['Nombre'] );
$CorreoElectronico = mysqli_real_escape_string($conn, $_POST['CorreoElectronico'] );
$Contraseña= mysqli_real_escape_string($conn,  $_POST['Contraseña'] );
$Rol= mysqli_real_escape_string($conn, $_POST['Rol'] );

//SQL query with escaped values

$sqlInsert = "INSERT INTO usuarios VALUES (null, '$Identificacion','$Nombre', '$CorreoElectronico', '$Contraseña', '$Rol')";

if($conn->query($sqlInsert) ===TRUE){
    echo "<script> alert ('Registro Insertado Correctamente');  window.history.back();</script>" . "<br>";
}else{
    echo "<script> alert ('Error al Insertar el registro');  window.history.back();</script>" . $conn->error;
}
    break;

//Update data
    case "Update":
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            $id= $_POST['id'];            
            
        $Identificacion= mysqli_real_escape_string($conn, $_POST['Identificacion']);
        $Nombre = mysqli_real_escape_string($conn, $_POST['Nombre']);
        $CorreoElectronico = mysqli_real_escape_string($conn, $_POST['CorreoElectronico']);
        $Contraseña = mysqli_real_escape_string($conn, $_POST['Contraseña']);
        $Rol = mysqli_real_escape_string($conn, $_POST['Rol']);
        
        
        $sqlSelect = "SELECT Identificacion from usuarios WHERE IdUsuarios = $id";
            $resul = $conn->query($sqlSelect);

            if($resul ->num_rows >0){
                $row = $resul->fetch_assoc();
                $ID = $row['Identificacion'];

                if($ID == '74085046'){
                    echo "<script> alert ('No se puede modificar este usuario');  window.history.back();</script>";
                }else{
                    $sqlUpdate = "UPDATE usuarios SET Identificacion='$Identificacion', Nombre='$Nombre', CorreoElectronico='$CorreoElectronico', Contraseña='$Contraseña', Rol='$Rol' WHERE IdUsuarios=$id";
        
                    if($conn->query($sqlUpdate)  === TRUE){
                        echo "<script> alert ('Registro actualizado Correctamente');  window.history.back();</script>";   
                        }else{
                            echo "<script> alert ('Error al Actualizar el registro');  window.history.back();</script>" . $conn->error;
                        }
                    
                }
            }
        
        
     
        } else{
            echo "Acceso Invalido";
        }

}

}

//Cerrar conexion 
$conn ->close();
?>