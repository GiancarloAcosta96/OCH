<?php
$servername = "localhost";
$database = "bdonechannel";
$username = "root";
$password = "";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "SELECT id_usuario,personal,id_rol FROM usuario 
WHERE usuario='sdavila' and 'sdavila'= clave ";
 
  $result = mysqli_query($conexion, $sql);

  $num_row = mysqli_num_rows($result);


 while ( $data =mysqli_fetch_array($result)) {
 	# code...
    $_SESSION["user"] = $data["personal"];
    $_SESSION ["idusu"]=$data["id_usuario"];
    $_SESSION ["rol"]=$data["id_rol"];
    
    echo "1";
  }

mysqli_close($conexion);

?>


