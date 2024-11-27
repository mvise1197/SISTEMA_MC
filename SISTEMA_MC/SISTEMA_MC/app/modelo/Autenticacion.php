<?php
require_once 'Database.php';

class Autenticacion
{
    private $conexion;

    public function __construct()
    {
        // Instancia de la conexión a la base de datos
        $db = new Database();
        $this->conexion = $db->getConnection(); // Obtiene la conexión
    }

    public function verificarCredenciales($username, $password)
    {
        // Consulta para verificar el usuario
        $sql = "SELECT * FROM Personal WHERE Usuario = ? LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $this->conexion->error);
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            // Verificar la contraseña encriptada
            if (password_verify($password, $usuario['Clave'])) {
                return $usuario;
            }
        }
        return false; // Credenciales inválidas
    }

    public function registrarUsuario($nombre, $apellidos, $usuario, $clave, $idTipo_Usuario, $idInstitucion)
{
    // Encriptar la contraseña
    $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);

    // Consulta para insertar el nuevo usuario
    $sql = "INSERT INTO Personal (Nombre, Apellidos, Usuario, Clave, idTipo_Usuario, idInstitucion) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Preparar y ejecutar la consulta
    if ($stmt = $this->conexion->prepare($sql)) {
        // Define las variables para el binding
        $tipoUsuario = intval($idTipo_Usuario);
        $institucionId = intval($idInstitucion);

        // Asegúrate de usar variables para todos los parámetros
        $stmt->bind_param('ssssis', 
            $nombre, 
            $apellidos, 
            $usuario, 
            $claveEncriptada, 
            $tipoUsuario, 
            $institucionId
        );

        if ($stmt->execute()) {
            return true; // Registro exitoso
        } else {
            die("Error al registrar usuario: " . $stmt->error); // Manejo de error más detallado
        }
        // Cerrar el statement después de usarlo
        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $this->conexion->error); // Manejo de error más detallado
    }
}
}
?>