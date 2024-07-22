<?php
session_start();


include '../php/conexion.php';

$sql = "SELECT * FROM restaurantes";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurantes</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            .restaurante {
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 20px;
                padding: 10px;
                display: flex;
                align-items: center;
            }
            .restaurante img {
                max-width: 150px;
                border-radius: 5px;
                margin-right: 20px;
            }
            .restaurante h2 {
                margin: 0 0 10px;
            }
            .restaurante a {
                text-decoration: none;
                color: #000;
                display: block;
            }
        </style>
    </head>
    <body>
        <h1>Restaurantes</h1>';

    while ($row = $resultado->fetch_assoc()) {
        $id_restaurante = htmlspecialchars($row['id_restaurante']);  
        echo '<div class="restaurante">
                <a href="reserva.php?id=' . $id_restaurante . '">
                    <img src="' . htmlspecialchars($row['foto']) . '" alt="' . htmlspecialchars($row['nombre']) . '">
                    <div>
                        <h2>' . htmlspecialchars($row['nombre']) . '</h2>
                        <p>Correo: ' . htmlspecialchars($row['correo_restaurante']) . '</p>
                        <p>Número: ' . htmlspecialchars($row['numero_restaurante']) . '</p>
                        <p>Disponibilidad: ' . htmlspecialchars($row['disponibilidad']) . '</p>
                    </div>
                </a>
              </div>';
    }

    echo '</body>
    </html>';
} else {
    echo '<p>No se encontraron restaurantes.</p>';
}

$conexion->close();
?>
