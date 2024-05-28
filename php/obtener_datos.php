<?php
session_start();

if (isset($_SESSION['usuario'])) {   
}else {header("location: ../index.html");
}


include 'conexion.php';

$usuarios_sql = "SELECT usuario, correo FROM usuarios";
$reservas_sql = "SELECT fecha, hora, tamano_mesa, id_restaurante FROM reservas";

$usuarios_result = $conexion->query($usuarios_sql);
$reservas_result = $conexion->query($reservas_sql);

$usuarios = [];
if ($usuarios_result->num_rows > 0) {
    while($row = $usuarios_result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$reservas = [];
if ($reservas_result->num_rows > 0) {
    while($row = $reservas_result->fetch_assoc()) {
        $reservas[] = $row;
    }
}

$response = [
    'usuarios' => $usuarios,
    'reservas' => $reservas
];

echo json_encode($response);

$conexion->close();
