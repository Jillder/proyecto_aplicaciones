<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../rutas/login.html");
    exit();
}

if (!isset($_GET['id'])) {
    header("location: ../rutas/login.html");
    exit();
}

$id_usuario = $_GET['id'];

include 'conexion.php'; 

$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al eliminar el usuario']);
}

$stmt->close();
$conexion->close();
?>
