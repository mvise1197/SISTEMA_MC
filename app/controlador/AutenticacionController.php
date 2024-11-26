<?php
session_start();
require_once '../modelo/Autenticacion.php';

class AutenticacionController
{
    public function login($username, $password)
    {
        // Instancia del modelo de autenticación
        $auth = new Autenticacion();

        // Verificar credenciales
        $usuario = $auth->verificarCredenciales($username, $password);

        if ($usuario) {
            // Almacenar datos del usuario en la sesión
            $_SESSION['usuario'] = [
                'id' => $usuario['idPersonal'],
                'nombre' => $usuario['Nombre'],
                'tipo' => $usuario['idTipo_Usuario']
            ];
            // Redirigir a la página de inicio
            header('Location: ../vista/inicio.php');
        } else {
            // Redirigir de nuevo al login con un mensaje de error
            header('Location: ../vista/login.php?error=1');
        }
    }

    public function logout()
    {
        // Destruir la sesión
        session_destroy();
        // Redirigir al login
        header('Location: ../vista/login.php');
    }
}
