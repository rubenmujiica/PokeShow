<?php
// Verificar si el usuario está logueado
session_start();
unset($_SESSION['editar-cartas']);

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

$sql = "SELECT ID_Carta, ID_Usuario, en_venta, Nombre, Tipo, PS, Ataque, Precio, Descripcion, Imagen FROM carta";
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
            display: flex;
            align-items: center;
            border: 2px solid red;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            background-color: white;
            max-width: 1500px;
            position: relative; /* Esto es necesario para posicionar los botones en la esquina */
            width: 900px;
        }

        .carta_imagen {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 15px;
        }

        /* Tamaño de las imágenes incrementado */
        .carta_imagen img {
            width: 250px;  /* Aumento de tamaño */
            height: 370px; /* Aumento de tamaño */
            object-fit: cover; /* Ajusta la imagen sin distorsionarla */
        }

        .carta_id {
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }

        .carta_info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .carta_info p {
            margin-bottom: 10px;
            text-align: left;
            max-width: 400px;
            word-wrap: break-word; /* Esto hace que el texto se rompa cuando sea necesario */
        }

        .contenedor_botones {
            position: absolute; /* Cambié de relative a absolute para moverlos en la esquina */
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            z-index: 10; /* Asegúrate de que los botones estén encima de la carta */
        }

        .eliminar_usuario, .editar {
            background-color: transparent; /* Sin fondo */
            color: inherit; /* Mantener el color heredado */
            border: none; /* Eliminar borde */
            font-size: 18px;
            cursor: pointer;
            border-radius: 50%; /* Circular */
            width: 30px; /* Aumento de tamaño de los botones */
            height: 30px; /* Aumento de tamaño de los botones */
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

    <h1>Gestiona las cartas de la web</h1>
    
    <div class="contenedor_usuarios">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='carta_usuario'>";
            
            // Contenedor de la imagen con el ID encima
            echo "<div class='carta_imagen'>";
            echo "<p class='carta_id'><strong>ID:</strong> " . $row["ID_Carta"] . "</p>";
            echo "<img src='" . $row["Imagen"] . "' alt='" . $row["Nombre"] . "'>";
            echo "</div>";
            
            // Contenedor de la información de la carta
            echo "<div class='carta_info'>";
            echo "<p><strong>Pertenece al usuario:</strong> " . $row["ID_Usuario"] . "</p>";
            echo "<p><strong>¿En venta?:</strong> " . $row["en_venta"] . "</p>";
            echo "<p><strong>Nombre:</strong> " . $row["Nombre"] . "</p>";
            echo "<p><strong>Tipo:</strong> " . $row["Tipo"] . "</p>";
            echo "<p><strong>PS:</strong> " . $row["PS"] . "</p>";
            echo "<p><strong>Ataque:</strong> " . $row["Ataque"] . "</p>";
            echo "<p><strong>Precio:</strong> " . $row["Precio"] . "</p>";
            echo "<p><strong>Descripción:</strong> " . $row["Descripcion"] . "</p>";
            echo "</div>";

            // Botones
            echo '<form method="POST" action="eliminar-la-carta.php">';
            echo '<input type="hidden" name="id_carta" value="' . $row["ID_Carta"] . '">';
            echo '<div class="contenedor_botones">';
            echo '<button type="submit" class="editar" name="editar" value="editar"><i class="fa-solid fa-pen"></i></button>';
            echo '<button type="submit" class="eliminar_usuario" name="eliminar" value="eliminar">✖</button>';
            echo '</div>';
            echo '</form>';

            echo "</div>"; // Fin carta_usuario
        }
    } else {
        echo "<p>No hay cartas en la web.</p>";
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
            </a>
        </div>
    </div>
    </footer>
</body>
</html>
