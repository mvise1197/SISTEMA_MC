<?php
require_once 'Database.php';

class Autenticacion
{
    private $conexion;

    public function __construct()
    {
        // Instancia de la conexión a la base de datos
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function verificarCredenciales($username, $password)
    {
        // Consulta para verificar el usuario
        $sql = "SELECT * FROM Personal WHERE Usuario = ? LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
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
        return false;
    }
}
