<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../index.html");
    exit();
}

include 'conexion.php';

$usuarios_sql = "SELECT usuario, correo FROM usuarios";
$reservas_sql = "
    SELECT r.fecha, r.hora, r.tamano_mesa, r.id_restaurante, rest.nombre AS restaurante_nombre
    FROM reservas r
    JOIN restaurantes rest ON r.id_restaurante = rest.id_restaurante
";

$usuarios_result = $conexion->query($usuarios_sql);
$reservas_result = $conexion->query($reservas_sql);

$usuarios = [];
if ($usuarios_result->num_rows > 0) {
    while ($row = $usuarios_result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$reservas = [];
if ($reservas_result->num_rows > 0) {
    while ($row = $reservas_result->fetch_assoc()) {
        $reservas[] = $row;
    }
}

$response = [
    'usuarios' => $usuarios,
    'reservas' => $reservas
];

echo json_encode($response);

$conexion->close();
?>
