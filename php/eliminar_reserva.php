<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
    $id_user = $_SESSION['id_user'];
} else {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

// Verificar si se recibió un ID válido de reserva
if (!isset($_POST['id'])) {
    header("HTTP/1.1 400 Bad Request");
    exit();
}

$id_reserva = $_POST['id'];

include 'conexion.php'; // Incluir el archivo de conexión a la base de datos

// Preparar la consulta para eliminar la reserva
$sql = "DELETE FROM reservas WHERE id = ? ";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_reserva);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Si se elimina correctamente, devolver una respuesta JSON con éxito
    echo json_encode(['success' => true]);
} else {
    // Si hay un error, devolver una respuesta JSON con el mensaje de error
    echo json_encode(['success' => false, 'error' => 'Error al eliminar la reserva']);
}

$stmt->close();
$conexion->close();
?>
