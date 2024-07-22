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
    <title>Agregar Restaurante</title>
    <link rel="stylesheet" href="../css/formulario.css">
</head>
<body>
    <h1>Agregar Restaurante</h1>
    <form action="../php/process_restaurant.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="correo_restaurante">Correo:</label>
        <input type="email" id="correo_restaurante" name="correo_restaurante" required>
        
        <label for="numero_restaurante">Número de Teléfono:</label>
        <input type="text" id="numero_restaurante" name="numero_restaurante" required>
        
        <label for="disponibilidad">Disponibilidad (meses):</label>
        <input type="text" id="disponibilidad" name="disponibilidad" required>
        
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>
        
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
