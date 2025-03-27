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

    $stmt = $pdo->prepare("SELECT * FROM carta WHERE ID_Usuario = ?");
    $stmt->execute([$_SESSION['ID_Usuario']]);
    $mis_cartas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        .contenedor_mis_cartas {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            gap:20px;
        }
        .carta_pokemon {
            background: #ffffff; /* Fondo blanco */
            border: 3px solid #d92c2c; /* Borde rojo */
            border-radius: 12px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin-top: 26px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease-in-out;
        }

        .carta_pokemon:hover {
            transform: scale(1.05);
            box-shadow: 6px 6px 12px rgba(217, 44, 44, 0.5);
        }

        .carta_pokemon h2 {
            font-size: 18px;
            font-weight: bold;
            /* color: #d92c2c; Rojo para resaltar el título */
            margin-bottom: 10px;
        }

        .carta_pokemon img {
            border-radius: 8px;
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            height: auto;
        }

        .carta_pokemon p {
            font-size: 14px;
            color: #333; /* Texto oscuro para mejor lectura */
            margin: 10px 0;
            font-weight: bold;
            white-space: nowrap;
        }

        .carta_pokemon.seleccionada {
            background: #d92c2c;
            color: white;
            border-color: white;
        }
        button {
            display: inline-block;
            width: fit-content; /* Que solo ocupe lo necesario */
            margin: 40px 30px; /* Centrarlo */
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            background-color: rgb(219, 57, 71);
            border: none;
            border-radius: 8px; 
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color:rgb(144, 7, 18); /* Un rojo más oscuro */
            transform: scale(1.05); /* Efecto sutil de agrandado */
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

    <h1>¡Tu colección Pokemon!</h1>
    <form method="GET" action = "form_carta.php">
        <div class="contenedor_mis_cartas">
            <!-- <img src="imgs/groudon.png" width="" -->
            <?php
                foreach($mis_cartas as $carta) {
                    // if($carta["en_venta"] == 1) {
                        echo '<article class = "carta_pokemon">';
                        echo '<h2>' . $carta["Nombre"] . '</h2>';
                        echo '<img src="' . $carta["Imagen"] . '" alt="Imagen de la carta" width=200>';
/*                         echo '<p>Tipo: ' . $carta["Tipo"] . '</p>';   
                        echo '<p>PS: ' . $carta["PS"] . '</p>';   
                        echo '<p>Ataque: ' . $carta["Ataque"] . '</p>';   
                        echo '<p>Precio: ' . $carta["Precio"] . ' puntos</p>'; */
/*                         echo '<input type="checkbox" name="cartas_seleccionadas[]" value="' . $carta['ID_Carta'] . '" hidden>';   */
                        echo '</article>'; 
                    // }
                }
            ?>
        </div>
        <button type="submit" class="boton_anadir">Añadir carta</button>
    </form>

</body>
</html>