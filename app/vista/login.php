<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../../public/css/styles.css">
    </head>
    <body>
        <div class="login-container">
            <div class="login-card">
                <h2>Iniciar Sesión</h2>
                <form action="../controlador/AutenticacionController.php" method="POST">
                    <div class="input-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" placeholder="Ingresa tu Usuario" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" placeholder="Ingresa tu Contraseña" required>
                    </div>
                    <div class="options">
                        <label>
                            <input type="checkbox"> Recordar
                        </label>
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" class="login-btn">Iniciar Sesión</button>
                    <p class="create-account">
                        <a href="#">Contactar con Soporte</a>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
