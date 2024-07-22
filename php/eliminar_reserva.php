<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
    $id_user = $_SESSION['id_user'];
} else {
    header("location: ../rutas/login.html");
    exit();
}

if (!isset($_POST['id'])) {
    header("location: ../rutas/login.html");
    exit();
}

$id_reserva = $_POST['id'];

include 'conexion.php'; 

$sql = "DELETE FROM reservas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_reserva, $id_user);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al eliminar la reserva']);
}

$stmt->close();
$conexion->close();
?>
