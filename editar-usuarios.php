<?php
session_start();
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pokeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT Nombre, Apellidos, Correo, Nickname, Saldo FROM usuario WHERE ID_Usuario = {$_SESSION["editar-usuarios"]}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Guardar cada campo en una variable
$nombre = $row["Nombre"];
$apellidos = $row["Apellidos"];
$correo = $row["Correo"];
$nickname = $row["Nickname"];
$saldo = $row["Saldo"];

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

    <div class="form-container">
    <form action="guardar-cambios.php" method="POST">
        <!-- Nombre -->
        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>

        <!-- Apellidos -->
        <div class="input-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
        </div>

        <!-- Correo -->
        <div class="input-group">
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
        </div>

        <!-- Nickname -->
        <div class="input-group">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" value="<?php echo $nickname; ?>" required>
        </div>


        <!-- Saldo -->
        <div class="input-group">
            <label for="saldo">Saldo</label>
            <input type="number" id="saldo" name="saldo" value="<?php echo $saldo; ?>" required>
        </div>

        <!-- Botón de guardar -->
        <div class="form-actions">
            <button type="submit" class="guardar-btn">Guardar Cambios</button>
        </div>
    </form>
    </div>

<style>
    .form-container {
        background-color: white; /* Fondo semitransparente */
        padding: 30px;
        border-radius: 15px;
        border: 2px solid #e60012;
        width: 400px;
        margin: 50px auto;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        color: rgb(219, 57, 71);
        margin-bottom: 20px;
        font-size: 2em;
    }

    .input-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        font-size: 1.1em;
        color: rgb(219, 57, 71);
        margin-bottom: 5px;
    }

    .input-group input {
        padding: 10px;
        font-size: 1em;
        border: 2px solid rgb(219, 57, 71);
        border-radius: 10px;
        outline: none;
        transition: border-color 0.3s;
    }

    .input-group input:focus {
        border-color: #e60012; /* Rojo cuando está enfocado */
    }

    .form-actions {
        display: flex;
        justify-content: center;
    }

    .guardar-btn {
        background-color: rgb(219, 57, 71);
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 1.1em;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .guardar-btn:hover {
        background-color: #e60012;
        transform: scale(1.05);
    }
</style>

    
 
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