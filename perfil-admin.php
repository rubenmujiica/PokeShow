<?php session_start();
unset($_SESSION['error']); //Borramos esta variable para que no haya conflictos luego
unset($_SESSION['error2']); //Borramos esta variable para que no haya conflictos luego
// ?>

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


        .perfil-completo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            margin: 40px;
            text-align: left;
        }

        .botones-principales {
            display: inline-block;
            width: fit-content; /* Que solo ocupe lo necesario */
            margin: 20px 30px; /* Centrarlo */
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

        .botones-principales:hover {
            background-color:rgb(144, 7, 18); /* Un rojo más oscuro */
            transform: scale(1.05); /* Efecto sutil de agrandado */
        }
        
        .perfil{
            /* Posicionar el div en el centro */
            max-width: 90%;  /* Que no ocupe toda la pantalla en móviles */
            width: 600px;  /* Un ancho adecuado en pantallas grandes */
            margin: 50px auto; /* Centrar horizontalmente y dar espacio arriba/abajo */
            
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            width: 1000px;
            padding: 30px;
            border: 2px solid #e60012;
        }

        .editar {
            background: none;
            border: none;
            cursor: pointer;
            color: rgb(219, 57, 71);
            font-size: 18px;
        }
        .editar:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <nav>
        <img src="logo.png" alt="Logo Pokémon">
        <p>PokeShop</p>
        <a href="index-admin.php">🏠 Inicio</a>
        <a href="gestion-cartas.php">📋 Gestión de cartas</a>
        <a href="gestion-usuarios.php">🛠️ Gestión de usuarios</a>
        <a href="perfil-admin.php">👤 Perfil</a>
        <a href="cerrar_sesion.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>

    <h1>Este es tu perfil</h1>

    <form action="editar-perfil-admin.php" method="post">
        <div class="perfil">
            <p class="perfil-completo">Nombre: <?php echo $_SESSION['Nombre'] ?>
                <button type='submit' class="editar" name="nombre"><i class="fa-solid fa-pen"></i></button>
            </p>
            <p class="perfil-completo">Apellidos: <?php echo $_SESSION['Apellidos'] ?>
                <button type='submit' class="editar" name="apellidos"><i class="fa-solid fa-pen"></i></button>
            </p>
            <p class="perfil-completo">Correo electrónico: <?php echo $_SESSION['Correo'] ?>
                <button type='submit' class="editar" name="correo"><i class="fa-solid fa-pen"></i></button>
            </p>
            <p class="perfil-completo">Nickname: <?php echo $_SESSION['usuario'] ?>
                <button type='submit' class="editar" name="nickname"><i class="fa-solid fa-pen"></i></button>
            </p>
            <p class="perfil-completo">Contraseña: ****</p>
            <p class="perfil-completo">Saldo en la cuenta: <?php echo $_SESSION['Saldo'] ?></p>
            <div>
                <button type='submit' class="botones-principales" name="ingresar-saldo">Ingresar saldo</button>
                <button type='submit' class="botones-principales" name="cambiar-contrasena">¿Quieres cambiar tu contraseña?</button>
            </div>
        </div>
    </form>

</body>
</html>