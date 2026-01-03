<?php
header("Content-Type: application/json");
require "conexion.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // 📌 Mostrar todos los pedidos
    case "GET":
        $sql = "SELECT * FROM pedidos";
        $res = $conn->query($sql);
        $datos = [];

        while ($row = $res->fetch_assoc()) {
            $datos[] = $row;
        }
        echo json_encode($datos);
        break;

    // 📌 Agregar pedido
    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data["cliente"] || !$data["estado"]) {
            echo json_encode(["error"=>"Datos incompletos"]);
            exit;
        }

        $sql = "INSERT INTO pedidos 
        (cliente, estado, pastel_basico, pastel_mediano, pastel_grande)
        VALUES (
            '{$data['cliente']}',
            '{$data['estado']}',
            {$data['pastel_basico']},
            {$data['pastel_mediano']},
            {$data['pastel_grande']}
        )";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje"=>"Pedido registrado"]);
        } else {
            echo json_encode(["error"=>"No se pudo registrar"]);
        }
        break;

    // 📌 Modificar pedido por ID
    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "UPDATE pedidos SET
            cliente='{$data['cliente']}',
            estado='{$data['estado']}',
            pastel_basico={$data['pastel_basico']},
            pastel_mediano={$data['pastel_mediano']},
            pastel_grande={$data['pastel_grande']}
            WHERE id={$data['id']}";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje"=>"Pedido actualizado"]);
        } else {
            echo json_encode(["error"=>"No se pudo actualizar"]);
        }
        break;

    // 📌 Eliminar pedido
    case "DELETE":
        $data = json_decode(file_get_contents("php://input"), true);
        $sql = "DELETE FROM pedidos WHERE id={$data['id']}";

        if ($conn->query($sql)) {
            echo json_encode(["mensaje"=>"Pedido eliminado"]);
        } else {
            echo json_encode(["error"=>"No se pudo eliminar"]);
        }
        break;
}
?>
