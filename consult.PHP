<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

<!--session start-->

    <?php
session_start();
if(!isset($_SESSION['inicio_sesion']) || $_SESSION['inicio_sesion'] !== true){
    session_unset();
    session_destroy();
    header('location: index.php');
    exit();
}

require_once("conn.php");


//create table

$sqlSelect = "SELECT IdUsuarios, Identificacion, Nombre, CorreoElectronico, Contraseña, Rol FROM Usuarios ";
$result = $conn->query($sqlSelect);

if($result->num_rows > 0){

    ?>


    <div class="container">
        <a class="close" href="index.php">Cerrar Sesion</a>
        <div class="head">
            <button class="button"><a href="./update.php?id=8">Insert</a></button>
        </div>
        <div>
            <h1 id="Registro">Database Records</h1>
        </div>
        <br>
        <table class="table" border="1">
            <tr class="tr">
                <th class="tableUNo">Identification</th>
                <th class="tableUNo">Name</th>
                <th class="tableUNo">Email Addres</th>
                <th class="tableUNo">Password</th>
                <th class="tableUNo">Role</th>
            </tr>

    </div>

    <?php

//show data 

    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row["Identificacion"] . "</td>";
        echo "<td>" . $row["Nombre"] . "</td>";
        echo "<td>" . $row["CorreoElectronico"] . "</td>";
        echo "<td>" . $row["Contraseña"] . "</td>";
        echo "<td>" . $row["Rol"] . "</td>";
        echo "<td>";
        echo "<a href='update.php?id=" . $row["IdUsuarios"] . "'>Update</a>";
        echo " | ";
        echo "<form action='deleteProcess.php' method='POST' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row["IdUsuarios"] . "'>";
        echo "<input type='submit' value='Delete' class='button'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        
    }
}else{
    echo "No se encontraron registros";
}
?>


</body>

</html>