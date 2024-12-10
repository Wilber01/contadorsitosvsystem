<?php
session_start();

// Verificar si ya está logueado
if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
    header("Location: ./views/template/index.php");
    exit();
}

// Incluir archivos necesarios
require_once './config/config.php';

// Inicializar conexión
$database = new Database();
$conexion = $database->getConnection();

// Manejar inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = isset($_POST['usuario']) ? htmlspecialchars(strip_tags($_POST['usuario'])) : "";
    $contrasena = isset($_POST['contrasena']) ? md5(htmlspecialchars(strip_tags($_POST['contrasena']))) : "";

    try {
        // Consulta preparada PDO
        $consulta = "SELECT * FROM users WHERE username = :usuario AND password = :contrasena";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        $usuarioRegistrado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioRegistrado) {
            // Establecer variables de sesión
            $_SESSION["userName"] = $usuarioRegistrado['name'];
            $_SESSION["userRole"] = $usuarioRegistrado['role'];
            $_SESSION["userEmail"] = $usuarioRegistrado['email'];
            $_SESSION["userId"] = $usuarioRegistrado['user_id'];

            // Redirigir
            header("Location: ./views/template/index.php");
            exit();
        } else {
            $error = "Inicio de sesión fallido. Verifica tus credenciales.";
        }
    } catch(PDOException $e) {
        $error = "Error en la consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Inter:300');

        body {
            padding: 0;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .vid-container {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .bgvid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -100;
        }

        .inner-container {
            width: 400px;
            height: 400px;
            position: absolute;
            top: calc(50vh - 200px);
            left: calc(50vw - 200px);
            overflow: hidden;
            border-radius: 7px;
        }

        .box {
            position: absolute;
            height: 100%;
            width: 100%;
            color: #fff;
            background: rgba(0, 0, 0, 0.28);
            padding: 30px 0px;
            border-radius: 7px;
        }

        .box h1 {
            text-align: center;
            margin: 30px 0;
            font-size: 30px;
        }

        .box input {
            display: block;
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            border-radius: 7px;
            border: 0;
        }

        input::placeholder {
            color: rgb(182, 171, 163);
        }

        .signup {
            color: rgb(182, 171, 163) !important;
        }

        .box input:focus,
        .box input:active,
        .box button:focus,
        .box button:active {
            outline: none;
        }

        .box button {
            background: #2d2f36;
            border: 0;
            color: #fff;
            padding: 10px;
            font-size: 20px;
            width: 330px;
            margin: 20px auto;
            display: block;
            cursor: pointer;
            border-radius: 7px;
        }

        .box button:active {
            background: #000000;
        }

        .box p {
            font-size: 14px;
            text-align: center;
        }

        .box p span {
            cursor: pointer;
            color: #666;
        }

        @media screen and (max-width: 986px) {
            .inner-container {
                width: 90%;
                left: 5%;
                top: calc(50vh - 200px);
            }

            .box input,
            .box button {
                width: 90%;
                max-width: 300px;
                margin: 20px auto;
            }
        }

        @media screen and (min-width: 986px) {
            .bgvid.back {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="vid-container">
        <video id="Video1" class="bgvid back" autoplay="true" muted="muted" preload="auto" loop>
            <source src="videoLogin.mp4" type="video/mp4">
        </video>
        <div class="inner-container">
            <div class="box">
                <h1>Iniciar sesión</h1>
                <form action="" method="POST">
                    <input type="text" name="usuario" placeholder="Usuario" required />
                    <input type="password" name="contrasena" placeholder="Contraseña" required />
                    <button type="submit">Iniciar sesión</button>
                    <?php

                    if (isset($error)) {
                        echo '<p>' . htmlspecialchars($error) . '</p>';
                    }

                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>