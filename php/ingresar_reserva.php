<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
    $id_user = $_SESSION['id_user'];
} else {
    header("location: ../index.html");
    exit();
}

include 'conexion.php';

$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$personas = $_POST['personas'];
$id_restaurante = $_POST['restaurant-id'];

$sql = "INSERT INTO reservas(fecha, hora, tamano_mesa, id_restaurante, id_usuario) VALUES(?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("ssiii", $fecha, $hora, $personas, $id_restaurante, $id_user);

if ($stmt->execute()) {
    header("location: ../rutas/cuenta.php");
    exit();
} else {
    echo "Error al realizar la reserva: " . $stmt->error;
}

$stmt->close();
$conexion->close();