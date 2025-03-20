<?php
// Evitar salida de contenido antes de los headers
session_start();

// Configuración de la base de datos
$host = "localhost";
$dbname = "pokeshop"; 
$username = "usuario"; 
$password = ""; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Función para verificar si un usuario existe
function usuario_existe($pdo, $nickname, $contrasena) {
    $stmt = $pdo->prepare("SELECT Contrasena FROM usuario WHERE Nickname = ?");
    $stmt->execute([$nickname]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user && password_verify($contrasena, $user['Contrasena']);
}

// Función para registrar un nuevo usuario
function registrar_usuario($pdo, $nombre, $apellidos, $correo, $nickname, $contrasena) {
    $stmt = $pdo->prepare("SELECT ID_Usuario FROM usuario WHERE Nickname = ?");
    $stmt->execute([$nickname]);
    if ($stmt->fetch()) {
        return false; // Usuario ya existe
    }

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuario (Nombre, Apellidos, Correo, Nickname, Contrasena) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$nombre, $apellidos, $correo, $nickname, $hash]);
}

// Verificar si se envió un formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["registro"])) {
        // Procesar registro
        $nombre = $_POST["nombre"] ?? '';
        $apellidos = $_POST["apellidos"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $nickname = $_POST["nickname"] ?? '';
        $contrasena = $_POST["contrasena"] ?? '';

        if ($nombre && $apellidos && $correo && $nickname && $contrasena) {
            if (registrar_usuario($pdo, $nombre, $apellidos, $correo, $nickname, $contrasena)) {
                echo "<p style='color: green; margin-top:40px;'>Registro exitoso. Ahora puedes iniciar sesión.</p>";
            } else {
                echo "<p style='color: red; margin-top:40px;'>El usuario ya existe. Intente con otro nickname.</p>";
            }
        } else {
            echo "<p style='color: red; margin-top:40px;'>Todos los campos son obligatorios.</p>";
        }
    } elseif (isset($_POST["login"])) {
        // Procesar inicio de sesión
        $nickname = $_POST["nickname"] ?? '';
        $contrasena = $_POST["contrasena"] ?? '';

        if (usuario_existe($pdo, $nickname, $contrasena)) {
            if($nickname == 'admin'){
                $_SESSION["usuario"] = $nickname;
                header("Location: index-admin.php");
                exit;
            }
            else{
                $_SESSION["usuario"] = $nickname;
                header("Location: index.php");
                exit;
            }
            
        } else {
            echo "<p style='color: red; margin-top:40px;'>Usuario o contraseña incorrectos.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión o registrarse</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background-color: #f8f8f8;
            text-align: center;
        }


        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
            margin-top: 50px;
            padding: 20px;
        }

        .form-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 30px;
            text-align: left;
            border: 2px solid #e60012;
        }

        .form-box h2 {
            color: #e60012;
            margin-bottom: 20px;
        }

        .form-box label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-box button {
            width: 100%;
            padding: 10px;
            background-color: #e60012;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-box button:hover {
            background-color: #b5000b;
        }

        .form-box p {
            color: #e60012;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <!-- Formulario de Inicio de Sesión -->
        <div class="form-box">
            <h2>Iniciar Sesión</h2>
            <form method="POST">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" required>

                <button type="submit" name="login">Iniciar sesión</button>
            </form>
            <p>Si no tienes una cuenta regístrate</p>
        </div>

        <!-- Formulario de Registro -->
        <div class="form-box">
            <h2>Registrarse</h2>
            <form method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" required>

                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" required>

                <label for="nickname_registro">Nickname:</label>
                <input type="text" name="nickname" id="nickname_registro" required>

                <label for="contrasena_registro">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena_registro" required>

                <button type="submit" name="registro">Registrarse</button>
            </form>
        </div>
    </div>

</body>
</html>

