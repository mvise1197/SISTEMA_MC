<?php
session_start();
require_once '../modelo/Autenticacion.php';

class AutenticacionController
{
    public function login($username, $password)
    {
        $auth = new Autenticacion();
        $usuario = $auth->verificarCredenciales($username, $password);

        if ($usuario) {
            $_SESSION['usuario'] = [
                'id' => $usuario['idPersonal'],
                'nombre' => $usuario['Nombre'],
                'tipo' => $usuario['idTipo_Usuario']
            ];
            header('Location: ../vista/inicio.php');
            exit;
        } else {
            header('Location: ../vista/login.php?error=1');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ../vista/login.php');
        exit;
    }

    public function registrarUsuario($nombre, $apellidos, $usuario, $clave, $idTipo_Usuario, $idInstitucion)
    {
        $auth = new Autenticacion();
    
        if ($auth->registrarUsuario($nombre, $apellidos, $usuario, $clave, intval($idTipo_Usuario), intval($idInstitucion))) {
            header('Location: ../vista/login.php?registered=1'); 
            exit;
        } else {
            header('Location: ../vista/registro.php?error=1');
            exit;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new AutenticacionController();

    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $controller->login($_POST['username'], $_POST['password']);
    } elseif (isset($_POST['action']) && $_POST['action'] == 'register') {
        $controller->registrarUsuario($_POST['nombre'], $_POST['apellidos'], $_POST['usuario'], $_POST['clave'], $_POST['tipo_usuario'], 1);
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $controller = new AutenticacionController();
    $controller->logout();
}
?>