<?php
session_start();

if (!isset($_SESSION['usuario'])) {
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
    <h1>Usuarios</h1>
    <table id="usuarios-table">
        <thead>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Correo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    
    <button id="btn_logout" onclick="window.location.href = '../php/logout.php';">Cerrar Sesion</button>
    <button id="btn_add_restaurant" onclick="window.location.href = '   add_restaurant.php';">Agregar Restaurante</button>


    <script src="../js/cuenta_admin.js"></script>
</body>
</html>