<?php

require_once("conn.php");


session_start();
//"Check if the user has submitted the login form.

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $Identificacion = $_POST['Identificacion'];
    $contrasena = $_POST['contrasena'];

    $sqlSeleted = "SELECT Identificacion, Contraseña FROM usuarios where Identificacion = 74085046 ";
    $result = $conn->query($sqlSeleted);
    
    if($result ->num_rows >0){
    $row = $result->fetch_assoc();
    $ID = $row['Identificacion'];
    $Pass = $row['Contraseña'];

    
    if($Identificacion === $ID & $contrasena === $Pass){

//Set session variable.

$_SESSION['Identificacion'] = $Identificacion;
$_SESSION['inicio_sesion'] = true;

header('location: consult.php');//Redirect to the control panel
exit();
    
}else{
    $mensaje = "<script> alert ('Error de Usuario');  window.history.back();</script>";
}}     }       

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>
    <div class="containerIndex">
        <div class="tittle">
            <h1 id="inicio">Log in</h1>
        </div>
        <?php
if(isset($mensaje)){?>
        <p class="credencial"><?php echo $mensaje ?></p>
        <?php }?>
        <div class="form">
            <form class="formOne" action="" method="POST">
                <label for="Identificacion">User:</label>
                <input type="text" name="Identificacion" require><br>Password</label>
                <input type="password" name="contrasena" required><br>

                <input class="button" type="submit" value="Log in">
            </form>
        </div>
    </div>
</body>

</html>