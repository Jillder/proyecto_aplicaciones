<?php
class Autenticacion {
    private $conexion;

    public function __construct($conexion) {
        session_start();
        $this->conexion = $conexion;
    }

    public function autenticarUsuario($correo, $contrasena) {
        $contrasenaHash = hash('sha512', $contrasena);

        $verificarLogin = mysqli_query($this->conexion, "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasenaHash'");

        if(mysqli_num_rows($verificarLogin) > 0){
            $row = mysqli_fetch_assoc($verificarLogin);
            
            $_SESSION['usuario'] = $correo;
            $_SESSION['nombre_completo'] = $row['nombre_completo'];
            $_SESSION['user'] = $row['usuario'];
            $_SESSION['id_user'] = $row['id_user'];

            header("location: ../rutas/menu.php");
        } else {
            header("location: ../index.html");
        }
    }
}

include 'conexion.php';

$autenticacion = new Autenticacion($conexion);

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$autenticacion->autenticarUsuario($correo, $contrasena);

?>