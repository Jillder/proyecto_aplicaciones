<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
} else {
    header("location: login.html");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <link rel="stylesheet" href="../css/cuenta.css">
</head>
<body style="background-color: black;"></body>
<body>
    <button id="user-button"><?php echo $user; ?></button>
    <h1>Reservas</h1>
    <table id="reservas-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tamaño de Mesa</th>
                <th>Nombre del Restaurante</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    
    <button id="btn_logout" onclick="window.location.href = '../php/logout.php';">Cerrar Sesion</button>

    <script src="../js/cuenta.js"></script>
</body>
</html>