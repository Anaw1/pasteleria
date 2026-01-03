<?php
$host = "sql202.infinityfree.com";
$user = "if0_40818103";
$pass = "anawus124";
$db   = "if0_40818103_pasteleria";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        "error" => "Error de conexión"
    ]));
}
?>
