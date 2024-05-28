<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $nombre_completo = $_SESSION['nombre_completo'];
    $correo = $_SESSION['usuario'];
    $user = $_SESSION['user'];
    $id_user = $_SESSION['id_user'];
} else {
    header("location: ../index.html");
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <link rel="stylesheet" href="../css/reserva.css">
</head>
<body>
    <h1>Reserva en <span id="restaurant-name">Restaurante</span></h1>
    <form action="../php/ingresar_reserva.php" method="POST">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
        <label for="personas">Número de personas:</label>
        <input type="number" id="personas" name="personas" required>
        <input type="hidden" id="restaurant-id" name="restaurant-id">
        <button type="submit">Reservar</button>
    </form>
    <script src="../js/reserva.js"></script>

    <script>
        console.log("ID de usuario actual:", <?php echo $id_user; ?>);
    </script>
</body>
</html>