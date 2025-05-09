<?php
// Verificar si el usuario está logueado
session_start();
unset($_SESSION['editar-usuarios']);

if (!isset($_SESSION["usuario"])) {
    header("Location: auth.php");
    exit; // Termina el script si no está logueado
}

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pokeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT ID_Usuario, Nombre, Apellidos, Correo, Nickname, Saldo FROM usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeShop</title>
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
            background-color: white;
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

        

        h1 {
            color: rgb(255, 255, 255);
            margin-top: 50px;
            text-shadow: 3px 3px 5px #e60012; /* Sombra roja */
        }

        .contenedor_usuarios {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }
        .carta_usuario {
            position: relative;
            background: #ffffff;
            border: 3px solid #d92c2c;
            border-radius: 12px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            margin: 18px;
            padding: 15px;
            text-align: center;
            width: 90%;
            max-width: 1500px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease-in-out;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .carta_usuario:hover {
            transform: scale(1.05);
            box-shadow: 6px 6px 12px rgba(217, 44, 44, 0.5);
        }
        .carta_usuario p {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            white-space: normal;
            overflow: visible;
            text-align: center;
            word-break: break-word;
            max-width: 100%;
        }

        .contenedor_botones {
            position: absolute;
            top: 5px;
            right: 5px;
            display: flex;
            gap: 2px;
            z-index: 10; /* Asegúrate de que el contenedor esté encima de otros elementos */
        }

        .eliminar_usuario, .editar {
            position: relative;
            background-color: transparent; /* Sin fondo */
            color: inherit; /* Mantener el color heredado */
            border: none; /* Eliminar borde */
            font-size: 16px;
            cursor: pointer;
            border-radius: 50%; /* Circular */
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0; /* Eliminar cualquier padding */
            box-sizing: border-box;
            transition: background 0.3s ease;
            z-index: 11;
        }

        .editar i {
            background-color: blue;
            border-radius: 50%; /* Hace circular el ícono */
            width: 100%; /* Asegura que el ícono ocupe el 100% del botón */
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: rgb(74, 74, 239);
        }

        .eliminar_usuario{
            color: white;
            background-color: rgb(219, 57, 71);
        }

        .editar i:hover {
            background-color: darkblue;
        }

        .eliminar_usuario:hover {
            background-color: darkred;
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
        <a href="index-admin.php">🏠 Inicio</a>
        <a href="gestion-cartas.php">📝 Gestión de cartas</a> <!-- Aprobar/rechazar cartas en venta, editar o eliminar listados. -->
        <a href="gestion-usuarios.php"> 🛠️ Gestión de Usuarios</a> <!-- Agregar, editar, suspender o eliminar usuarios. -->
        <a href="perfil-admin.php">👤 Perfil</a>
        <a href="cerrar_sesion.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>

    <h1>Gestiona los usuarios de la web</h1>

    <div class="contenedor_usuarios">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='carta_usuario'>";
                echo "<p><strong>ID:</strong> " . $row["ID_Usuario"] . " | ";
                echo "<strong>Nombre:</strong> " . $row["Nombre"] . " | ";
                echo "<strong>Apellidos:</strong> " . $row["Apellidos"] . " | ";
                echo "<strong>Correo:</strong> " . $row["Correo"] . " | ";
                echo "<strong>Nickname:</strong> " . $row["Nickname"] . " | ";
                echo "<strong>Saldo:</strong> " . $row["Saldo"] . "</p>";
                echo '<form method="POST" action="eliminar_al_usuario.php">';
                echo '<input type="hidden" name="id_usuario" value="' . $row["ID_Usuario"] . '">';
                echo '<div class="contenedor_botones">';
                echo '<button type="submit" class="editar" name="editar" value="editar"><i class="fa-solid fa-pen"></i></button>';
                echo '<button type="submit" class="eliminar_usuario" name="eliminar" value="eliminar">✖</button>';
                echo '</div>';
                echo '</form>';
                echo "</div>";
            }
        } else {
            echo "<p>No hay usuarios registrados.</p>";
        }
        $conn->close();
        ?>
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