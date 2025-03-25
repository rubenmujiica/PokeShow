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
            gap: 18px;
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

        h2 {
            color: #1a1a1c;
            margin: 20px;
            text-shadow: 3px 3px 5px #e60012; /* Sombra roja */
        }

        .perfil-completo {
            margin: 40px;
            text-align: left;
        }

        button {
            display: block;
            width: fit-content; /* Que solo ocupe lo necesario */
            margin: 20px auto; /* Centrarlo */
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            background-color: #e60012; 
            border: none;
            border-radius: 8px; 
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #cc0010; /* Un rojo más oscuro */
            transform: scale(1.05); /* Efecto sutil de agrandado */
        }
        
        .perfil{
            /* Posicionar el div en el centro */
            max-width: 90%;  /* Que no ocupe toda la pantalla en móviles */
            width: 600px;  /* Un ancho adecuado en pantallas grandes */
            margin: 100px auto; /* Centrar horizontalmente y dar espacio arriba/abajo */
            
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            width: 1000px;
            padding: 30px;
            border: 2px solid #e60012;
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

    <div class="perfil">
        <h2>Este es tu perfil</h2>
        <p class="perfil-completo">Nombre: <?php //Nombre?></p>
        <p class="perfil-completo">Apellidos: <?php //Apellidos?></p>
        <p class="perfil-completo">Correo electrónico: <?php //Correo?></p>
        <p class="perfil-completo">Nickname: <?php //Nickname?></p>
        <p class="perfil-completo">Contraseña: <?php //Conraseña?></p>
        <button>¿Quieres cambiar tu contraseña?</button>
    </div>

</body>
</html>