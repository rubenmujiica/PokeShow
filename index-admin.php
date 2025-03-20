<?php
// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: auth.php");
    exit; // Termina el script si no está logueado
}
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
            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background-color: white;
            text-align: center;
        }

        nav {
            background-color: #e60012;
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
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
            color: #1a1a1c;
            margin-top: 50px;
            text-shadow: 3px 3px 5px #e60012; /* Sombra roja */
        }

        .contenedor {
            display: flex;
            justify-content: center; /* Centra los divs horizontalmente */
            align-items: center; /* Alinea los divs verticalmente */
            gap: 70px; /* Espaciado entre los divs */
            flex-wrap: wrap; /* Permite que se acomoden en varias líneas si no caben */
            border: 2px solid red;
            margin-top: 50px;
        }

        .carta {
            width: 30%; /* Se ajustan al 30% del ancho del contenedor */
            max-width: 300px; /* Máximo tamaño para evitar que sean demasiado grandes */
            min-width: 200px; /* Mínimo tamaño para evitar que sean demasiado pequeños */
            aspect-ratio: 3/4; /* Mantiene la proporción de cada carta */
            background-color: white; /* Solo para visualización */
            border: 2px solid black;
            border-radius: 10px;
            margin: 50px;
        }
    </style>
</head>
<body>

    <nav>
        <img src="logo.png" alt="Logo Pokémon">
        <p>PokeShop</p>
        <a href="index.php">🏠 Inicio</a>
        <a href="comprar.html">🛒 Comprar</a>
        <a href="vender.html">📦 Vender</a>
        <a href="perfil.html">👤 Perfil</a>
        <a href="cerrar_sesion.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>

    <h1>¡Bienvenido a PokeShop!</h1>

    <div class="contenedor">
        <div class="carta"></div>
        <div class="carta"></div>
        <div class="carta"></div>
    </div>

</body>
</html>
