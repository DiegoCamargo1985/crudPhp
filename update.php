<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <a class="close" href="index.php">Cerrar Sesion</a>
    <div class="headUp">
        <button class="button"><a href="./consult.PHP">Consult</a></button>
    </div>

    <div class="tiltleRegistro">

        <h1 id="Registro">Record</h1>
    </div>
    <?php
    //close sesion
session_start();
if(!isset($_SESSION['inicio_sesion']) || $_SESSION['inicio_sesion'] !== true){
    session_unset();
    session_destroy();
    header('location: index.php');
    exit();
}


    require_once("conn.php");
//Query the database
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelected = "SELECT * FROM usuarios WHERE IdUsuarios = $id";
        $result = $conn ->query($sqlSelected);
        
    }  if($result->num_rows >0){
        $row = $result ->fetch_assoc();
    
    
    ?>

<!--Retrieve data using the POST method.-->

    <div class="containerCenter">

        <div class="containerForm">
            <form action="insert.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['IdUsuarios']?>"><br>
                <label for="Identificacion">Identificatio</label>
                <input type="text" name="Identificacion" value="<?php echo $row['Identificacion']?>"><br>
                <label for="Nombre">Name</label>
                <input type="text" name="Nombre" value="<?php echo $row['Nombre']?>"><br>
                <label for="CorreoElectronico">Email Addres</label>
                <input type="text" name="CorreoElectronico" value="<?php echo  $row['CorreoElectronico']?>"><br>
                <label for="Contraseña">Password</label>
                <input type="text" name="Contraseña" value="<?php echo $row['Contraseña']?>"><br>
                <label for="Rol">Role</label>
                <select name="Rol" id="Rol">
                    <option value="Administrador" <?php if ($row['Rol'] === 'Administrador') echo ' selected'; ?>>
                        Administrador</option>
                    <option value="Cliente" <?php if ($row['Rol'] === 'Cliente') echo ' selected'; ?>>Cliente</option>
                </select>
                <input class="button" type="submit" name="accion" value="Insert">
                <input class="button" type="submit" name="accion" value="Update">
            </form>
        </div>

    </div>

    <?php
    

 } else{
echo "No se encontro el registro";
    }
//close conexion
$conn ->close() ;   
    ?>

</body>

</html>