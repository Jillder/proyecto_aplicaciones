<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../rutas/login.html");
    exit();
}

include 'conexion.php';

$nombre = $_POST['nombre'];
$correo_restaurante = $_POST['correo_restaurante'];
$numero_restaurante = $_POST['numero_restaurante'];
$disponibilidad = $_POST['disponibilidad'];
$foto = $_FILES['foto'];

if ($foto['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $foto['tmp_name'];
    $name = basename($foto['name']);
    $upload_dir = '../uploads/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $upload_file = $upload_dir . $name;
    
    if (move_uploaded_file($tmp_name, $upload_file)) {
        $sql = "INSERT INTO restaurantes (nombre, numero_restaurante, correo_restaurante, disponibilidad, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("sssss", $nombre, $numero_restaurante, $correo_restaurante, $disponibilidad, $upload_file);

        if ($stmt->execute()) {
            header("location: ../rutas/cuenta_admin.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al subir la foto.";
    }
} else {
    echo "Error en la carga del archivo.";
}

$conexion->close();
?>
