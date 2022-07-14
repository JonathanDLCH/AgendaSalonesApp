<?php
$servername = "localhost";
$database = "u224039572_salones_meso";
$username = "u224039572_sistemas";
$password = "sysUMA2022";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_errno){
    echo "Fallo la conexion a MySQL: ".$conn->connect_error;
}

return $conn;
?>