<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
} else {
    header("location: ../index.html");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body style="background-color: black;"></body>
<body>
    <div class = "caja_trasera">
        <h1>Perfil de Usuario</h1>
        <table>
            <tr>
                <th>Usuario</th>
                <td><?php echo $user; ?></td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td><?php echo $nombre_completo; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $correo; ?></td>
            </tr>
        </table>
        <button id="btn_logout" onclick="window.location.href = '../php/logout.php';">Cerrar Sesion</button>
    </div>

</body>
</html>