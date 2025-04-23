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

        h1, h2 {
            color:rgb(255, 255, 255);
            margin-top: 50px;
            text-shadow: 3px 3px 5px #e60012; /* Sombra roja */
        }
        .carrusel-wrapper {
            overflow: hidden; /* Oculta las cartas que se salen del contenedor */
            width: 100%; /* Asegura que ocupe todo el ancho disponible */
            position: relative;
        }

        .carrusel {
            display: flex; /* Alinea las cartas en fila */
            animation: slide 10s linear infinite; /* Ajustamos la duración para reiniciar más rápido */
        }

        .carta {
            flex: 0 0 250px; /* Cada carta tiene un tamaño fijo de 250px */
            margin-right: 15px; /* Espacio entre las cartas */
            border-radius: 10px; /* Bordes redondeados */
            overflow: hidden; /* Oculta cualquier parte de la imagen que sobresalga */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra ligera para dar profundidad */
        }

        .carta img {
            width: 100%; /* La imagen ocupa todo el tamaño del div */
            height: auto; /* Mantiene la relación de aspecto de la imagen */
        }

        /* Animación para el movimiento del carrusel */
        @keyframes slide {
            0% {
                transform: translateX(0); /* Empieza desde la primera carta */
            }
            100% {
                transform: translateX(-50%); /* Desplaza hasta la mitad de las cartas para crear el bucle infinito */
            }
        }

        .info-seccion {
            background-color: rgba(254, 4, 4, 0.7);
            color: white;
            padding: 20px;
            margin: 40px auto;
            width: 80%;
            border-radius: 10px;
            border: 8px solid white; /* Borde blanco de grosor medio */
        }


        .info-seccion p {
            font-size: 16px;
            line-height: 1.5;
        }

        .youtube_juego{
            width: 100%;
            display: flex;
            justify-content: center;
            height: 250px;
            gap: 125px;
            transition: 0.3s;
        }

        .youtube_juego li{
            position:relative;
            overflow: hidden;
            flex: 0 0 150px;
            border-radius: 50px;
            cursor: pointer;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .youtube_juego li img{
            position: absolute;
            top: 50%;
            left: 50%;
            translate: -50% -50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .youtube_juego li, .youtube_juego li img{
            transition: 0.3s;
        }
        .youtube_juego li .content{
            transition: 1.5s ease;
        }

        .youtube_juego span{
            text-align: center;
            width: 75%
        }
        .youtube_juego p{
            color: #ddd;
            font-size: 20px;
            width: 100%;
        }
        .youtube_juego li .content{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            color: #fff;
            padding: 15px;
            background: linear-gradient(0deg, rgb(0 0 0 / 70%) 10%,rgb(255 255 255 / 0%) 100%);
            opacity: 0;
            visibility: hidden;
        }
        .youtube_juego:hover{
            gap: 125px;
        }

        .youtube_juego li .content span{
            position: absolute;
            z-index: 3;
            left: 50%;
            bottom: 0px;
            translate: -50%;
            scale: 0.85;
            visibility: hidden;
            opacity: 0;
        }
        .youtube_juego li:hover{
            flex: 0 1 300px;
            scale: 1.1;
            z-index: 10;
            opacity: 1;
        }

        .youtube_juego li:hover .content{
            opacity: 1;
            visibility: visible;
        }

        .youtube_juego li:hover span{
            scale: 1;
            opacity: 1;
            visibility: visible;
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

    <h1>¡Bienvenido a PokeShop!</h1>

    <div class="carrusel-wrapper">
        <div class="carrusel">
            <div class="carta"><img src="imgs/charizard.webp" alt="Charizard"></div>
            <div class="carta"><img src="imgs/pikachu.jpg" alt="Pikachu"></div>
            <div class="carta"><img src="imgs/snorlax.jpg" alt="Snorlax"></div>
            <div class="carta"><img src="imgs/gengar.png" alt="Gengar"></div>
            <div class="carta"><img src="imgs/eeve.jpg" alt="Eevee"></div>
            <div class="carta"><img src="imgs/bulbasur.jpg" alt="Bulbasaur"></div>
            <div class="carta"><img src="imgs/blaziken.png" alt="Blaziken"></div>

            <!-- Duplicamos las cartas para crear el efecto infinito -->
            <div class="carta"><img src="imgs/charizard.webp" alt="Charizard"></div>
            <div class="carta"><img src="imgs/pikachu.jpg" alt="Pikachu"></div>
            <div class="carta"><img src="imgs/snorlax.jpg" alt="Snorlax"></div>
            <div class="carta"><img src="imgs/gengar.png" alt="Gengar"></div>
            <div class="carta"><img src="imgs/eeve.jpg" alt="Eevee"></div>
            <div class="carta"><img src="imgs/bulbasur.jpg" alt="Bulbasaur"></div>
            <div class="carta"><img src="imgs/blaziken.png" alt="Blaziken"></div>
        </div>
    </div>
    <h2> ¡Pikachu, Bulbasur, Charizard y muchos más están de vuelta!
    <div class="info-seccion">
        <h2>¿Qué puedes hacer en PokeShop?</h2>
        <p>⭐ Comprar cartas exclusivas de Pokémon y ampliar tu colección.</p>
        <p>⭐ Vender tus cartas a otros entrenadores y ganar monedas virtuales.</p>
        <p>⭐ Administrar y exhibir tu colección en tu perfil personal.</p>
        <p>⭐ Conectar con otros fans del universo Pokémon.</p>
    </div>
    <h2>Por si no los recuerdas...</h2>
    <ul class="youtube_juego">
        <li>
            <a href="https://www.youtube.com/@OfficialPoke%CC%81monTV" target="_blank">
                <img src="imgs/capitulo.jpg" alt="YouTube">
                <div class="content">
                    <span>
                        <p>POKEMON TV</p>
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="https://play.pokemonshowdown.com/" target="_blank">
                <img src="imgs/combate.webp" alt="Juego Pokémon">
                <div class="content">
                    <span>
                        <p>POKEMON SHOWDOWN</p>
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="https://play.google.com/store/apps/details?id=com.nianticlabs.pokemongo&hl=es" target="_blank">
                <img src="imgs/pokemon_go.jpg" alt="Pokemon GO">
                <div class="content">
                    <span>
                        <p>POKEMON GO</p>
                    </span>
                </div>
            </a>
        </li>
    </ul>
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
