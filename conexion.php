<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$db   = "pasteleria";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        "error" => "Error de conexión"
    ]));
}
?>
