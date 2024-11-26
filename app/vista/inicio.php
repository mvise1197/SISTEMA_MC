<?php
session_start();

// Verificar si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="inicio-container">
        <h1>Bienvenido, <?= htmlspecialchars($usuario['nombre']); ?></h1>
        <p>Rol: <?= htmlspecialchars($usuario['tipo']); ?></p>
        <a href="../controlador/AutenticacionController.php?accion=logout" class="logout-btn">Cerrar Sesión</a>
    </div>
</body>
</html>
