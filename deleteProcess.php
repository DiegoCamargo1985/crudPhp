<?php
require_once("conn.php");


if($_SERVER["REQUEST_METHOD"] ==="POST"){
    
    if(isset($_POST['id']) && is_numeric($_POST['id'])){
            $id=$_POST['id'];

        //consult for delete elements

        $sqlselected = "SELECT Identificacion, CorreoElectronico from usuarios WHERE IdUsuarios = $id";
        $result = $conn->query($sqlselected);

        if($result -> num_rows === 1){
            $row = $result->fetch_assoc();
            $identificacion = $row['Identificacion'];
            $correoElectronico = $row['CorreoElectronico'];

        //validate data

            if($identificacion == 74085046 && $correoElectronico == "diego@gmail.com"){
                echo "<script> alert ('No se puede Eliminar este usuario');  window.history.back();</script>";

            }else{
        
        //Query the database
                $sqlDelete = "DELETE FROM usuarios WHERE IdUsuarios =$id";
    
                if($conn ->query( $sqlDelete ) === TRUE ){
                    echo "<script> alert ('Registro Eliminado Correctamente');  window.history.back();</script>";
                }else{
                    echo "<script> alert ('Error al Eiminar este Usuario');  window.history.back();</script>; . $conn->error";
                }

            }


    
        }else{
            echo "Id no valido";
        }
    }else{
        echo "Acceso  invalido";
    }
            }
    

//close conection

$conn->close();


?>