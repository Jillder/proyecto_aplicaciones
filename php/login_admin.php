<?php
class Autenticacion {
    private $conexion;

    public function __construct($conexion) {
        session_start();
        $this->conexion = $conexion;
    }

    public function autenticarUsuario($correo, $contrasena) {

        $verificarLogin = mysqli_query($this->conexion, "SELECT * FROM administradores WHERE correo='$correo' AND contrasena='$contrasena'");

        if(mysqli_num_rows($verificarLogin) > 0){
            $row = mysqli_fetch_assoc($verificarLogin);
            
            $_SESSION['usuario'] = $correo;

            header("location: ../rutas/cuenta_admin.php");
        } else {
            header("location: ../rutas/login_admin.html");
        }
    }
}

include 'conexion.php';

$autenticacion = new Autenticacion($conexion);

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$autenticacion->autenticarUsuario($correo, $contrasena);

?>