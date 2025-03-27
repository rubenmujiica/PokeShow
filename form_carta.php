<?php
session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: auth.php");
        exit; // Termina el script si no está logueado
    }
    // Configuración de la base de datos
    $host = "localhost";
    $dbname = "pokeshop"; 
    $username = "admin"; 
    $password = "admin"; 
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }

    function anadir_carta($pdo, $id_usuario, $nombre, $tipo, $ps, $ataque, $precio, $descripcion, $imagen) {
        $stmt = $pdo->prepare("INSERT INTO carta (ID_Usuario, Nombre, Tipo, PS, Ataque, Precio, Descripcion, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$_SESSION['ID_Usuario'], $nombre, $tipo, $ps, $ataque, $precio, $descripcion, $imagen]);
    }

    $mensaje = ""; // Variable para almacenar el mensaje

        // Verificar si se envió un formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["anadir"])) {
            // Procesar registro
            $id_usuario = $_SESSION['ID_Usuario'];
            $nombre = $_POST["nombre"] ?? '';
            $tipo = $_POST["tipo"] ?? '';
            $ps = $_POST["PS"] ?? '';
            $ataque = $_POST["ataque"] ?? '';
            $precio = $_POST["precio"] ?? '';
            $descripcion = $_POST["desc"] ?? '';
            // Procesar la imagen
            if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {
                $directorio_destino = "imgs/"; // Carpeta donde se guardarán las imágenes
                $nombre_archivo = basename($_FILES["imagen"]["name"]);
                $ruta_completa = $directorio_destino . $nombre_archivo;

                // Mover el archivo subido al directorio
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_completa)) {
                    $imagen = $ruta_completa; // Guardar la ruta en la base de datos
                } else {
                    $mensaje = "<p class='error'>Error al subir la imagen.</p>";
                }
            } else {
                $mensaje = "<p class='error'>Error con la imagen.</p>";
            }


            if ($id_usuario && $nombre && $tipo && $ps && $ataque && $precio && $descripcion && $imagen) {
                if (anadir_carta($pdo, $id_usuario, $nombre, $tipo, $ps, $ataque, $precio, $descripcion, $imagen)) {
                    $mensaje = "<p class='exito'>Carta añadida!.</p>";
                } 
            } else {
                $mensaje = "<p class='error'>Todos los campos son obligatorios.</p>";
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Carta</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            /* Imagen de fondo */
            background-image: url('imgs/fondo2.jpg'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen al tamaño de la pantalla */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */

            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background-color: #f8f8f8;
            text-align: center;
        }

        nav {
            background-color:rgb(219, 57, 71);
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
            border-bottom: 2px solid white;
        }

        nav img {
            height: 50px; /* Ajusta el tamaño del logo */
            
        }

        nav p{
            margin-right: 100px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: black;
            border-radius: 10px;
            transition: transform 0.2s, background-color 0.3s;
            border: 2px solid white;
        }

        nav a:hover {
            background-color: white;
            color: black;
            transform: scale(1.1);
            border: 2px solid #e60012; /* Borde rojo */
        }

        .mensaje-container {
            text-align: center;
            margin: 20px auto;
            width: 80%;
        }

        .exito {
            color: green;
            background-color: #d4edda;
            padding: 10px;
            border: 2px solid green;
            border-radius: 5px;
            display: inline-block;
        }

        .error {
            color: red;
            background-color: #f8d7da;
            padding: 10px;
            border: 2px solid red;
            border-radius: 5px;
            display: inline-block;
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
            width: 700px;
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
        footer {
        background-color: rgb(219, 57, 71);
        padding: 15px;
        text-align: center;
        border-top: 2px solid white;
        margin-top: 50px;
        }
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .footer-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            background-color: black;
            border-radius: 10px;
            transition: transform 0.2s, background-color 0.3s;
            border: 2px solid white;
            margin: 5px;
            display: inline-block;
        }
        .footer-links a:hover {
            background-color: white;
            color: black;
            transform: scale(1.1);
            border: 2px solid #e60012;
        }
        footer p {
            color: white;
            font-weight: bold;
        }
        .footer-social .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .footer-social img {
            width: 75px;
            height: 75px;
            object-fit: contain;
            transition: transform 0.2s;
        }
        .footer-social img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <nav>
        <img src="logo.png" alt="Logo Pokémon">
        <p>PokeShop</p>
        <a href="index.php">🏠 Inicio</a>
        <a href="comprar.php">🛒 Comprar</a>
        <a href="vender.php">📦 Vender</a>
        <a href="carrito.php">🛍️ Carrito</a>
        <a href="coleccion.php">🎴 Mi Colección</a>
        <a href="perfil.php">👤 Perfil</a>
        <a href="cerrar_sesion.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>
    <!-- Mostrar mensaje -->
    <div class="mensaje-container">
        <?php if (!empty($mensaje)) echo $mensaje; ?>
    </div>
    <div class="form-container">
        <!-- Formulario para Añadir Carta -->
        <div class="form-box">
            <h2>Añade tu nuevo pokemon!</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo" required>

                <label for="PS">PS:</label>
                <input type="number" name="PS" id="PS" required>

                <label for="ataque">Ataque:</label>
                <input type="number" name="ataque" id="ataque" required>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" required>

                <label for="desc">Descripción:</label>
                <input type="text" name="desc" id="desc">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>

                <button type="submit" name="anadir">Añadir</button>
            </form>
        </div>
    </div>
    <footer>
    <div class="footer-content">
        <p>&copy; 2025 - PokeShop</p>
        <div class="footer-contact">
            <p>Contacto: pokeshop@gmail.com   |   Teléfono: +34 999 999 999</p>
        </div>
        <div class="footer-links">
            <a href="https://www.pokemon.com/es/legal/condiciones-de-uso">Términos y Condiciones</a>
            <a href="https://www.pokemon.com/es/legal/aviso-de-privacidad">Política de Privacidad</a>
        </div>
        <div class="footer-social">
            <p>Síguenos en redes sociales:</p>
            <a href="https://www.facebook.com/PokemonOficialES?locale=es_ES" target="_blank">
                <img src="imgs\facebook.webp" alt="Facebook" width="175" height="175">
            </a>
            <a href="https://www.instagram.com/pokemon/" target="_blank">
                <img src="imgs\insta.webp" alt="Instagram" width="150" height="150">
            </a>
            <a href="https://x.com/Pokemon_ES_ESP" target="_blank">
                <img src="imgs\twitter.png" alt="Twitter" width="100" height="100">
        </div>
    </div>
    </footer>
</body>
</html>