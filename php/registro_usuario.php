<?php

include 'conexion.php';

abstract class Verificador {
    protected $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    abstract public function verificar($valor);
}

class VerificadorCorreo extends Verificador {
    public function verificar($correo) {
        $verificar_correo = $this->conexion->query("SELECT * FROM usuarios WHERE correo = '$correo'");
        return $verificar_correo->num_rows > 0;
    }
}

class VerificadorUsuario extends Verificador {
    public function verificar($usuario) {
        $verificar_usuario = $this->conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        return $verificar_usuario->num_rows > 0;
    }
}

class RegistroUsuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($nombre_completo, $correo, $usuario, $contrasena) {
        $contrasena = hash('sha512', $contrasena);

        $verificadorCorreo = new VerificadorCorreo($this->conexion);
        $verificadorUsuario = new VerificadorUsuario($this->conexion);

        if ($verificadorCorreo->verificar($correo)) {
            $this->mostrarAlerta("Este correo ya está registrado, intenta con otro diferente", "../index.html");
            return false;
        }

        if ($verificadorUsuario->verificar($usuario)) {
            $this->mostrarAlerta("Este usuario ya está registrado, intenta con otro diferente", "../index.html");
            return false;
        }

        $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
                VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";

        $ejecutar = $this->conexion->query($query);

        if ($ejecutar) {
            $this->mostrarAlerta("Usuario almacenado exitosamente", "../rutas/menu.php");
            return true;
        } else {
            $this->mostrarAlerta("Ocurrió un error al registrarse.", "../index.php");
            return false;
        }
    }

    private function mostrarAlerta($mensaje, $urlRedireccion) {
        echo "
            <script>
                alert('$mensaje');
                window.location.replace('$urlRedireccion');
            </script>
        ";
            exit;
    }
}

$registroUsuario = new RegistroUsuario($conexion);

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$registroUsuario->registrarUsuario($nombre_completo, $correo, $usuario, $contrasena);

?>