<?php
    session_start();

    // Verificar si se envió un formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["nombre"])) {
            $aux = 'nombre';
        }

        if (isset($_POST["apellidos"])) {
            $aux = 'apellido';
        }

        if (isset($_POST["correo"])) {
            $aux = 'correo';
        }

        if (isset($_POST["nickname"])) {
            $aux = 'nickname';
        }

        if (isset($_POST["ingresar-saldo"])) {
            $aux = 'saldo';
        }

        if (isset($_POST["cambiar-contrasena"])) {
            $aux = 'contrasena';
        }
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

        .perfil-dentro {
            display: inline-block;
            margin-bottom: 10px; /* Espacio entre los elementos */
        }

        input.perfil-dentro {
            width: 30%; /* Ajusta el ancho del input */
            margin-left: 10px; /* Espacio entre la etiqueta y el input */
        }

        button {
            display: block;
            width: fit-content; /* Que solo ocupe lo necesario */
            margin: 20px auto; /* Centrarlo */
            padding: 15px 20px;
            font-size: 15px;
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
        <a href="gestion-cartas.php">📋 Gestión de cartas</a>
        <a href="gestion-usuarios.php">🛠️ Gestión de usuarios</a>
        <a href="perfil.php">👤 Perfil</a>
        <a href="cerrar_sesion.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </nav>

    <h1>Estás editando tu perfil</h1>

    <?php if($aux != 'saldo' and $aux != 'contrasena'): ?>

    <form action="confirmar-editar-perfil-admin.php" method="post">
        <div class="perfil">
            <p class="perfil-dentro">Introduce tu nuevo <?php echo $aux; ?>:</p>
            <input class="perfil-dentro" type="text" name="<?php echo $aux; ?>" required>
            <button type="submit">Confirmar cambio</button>
        </div>
    </form>

    <?php elseif($aux == 'saldo'): ?>
        <form action="confirmar-editar-perfil-admin.php" method="post">
        <div class="perfil">
            <p class="perfil-dentro">Selecciona un lote de puntos:</p>

            <!-- Opción 1 -->
            <div class="opcion" id="opcion1" onclick="seleccionarOpcion('opcion1')">
                1€ = 10 puntos
            </div>

            <!-- Opción 2 -->
            <div class="opcion" id="opcion2" onclick="seleccionarOpcion('opcion2')">
                5€ = 50 puntos
            </div>

            <!-- Opción 3 -->
            <div class="opcion" id="opcion3" onclick="seleccionarOpcion('opcion3')">
                10€ = 100 puntos
            </div>

            <!-- Campo oculto para enviar la cantidad seleccionada -->
            <input type="hidden" name="cantidad" id="cantidadSeleccionada" value="">

            <button type="submit">Confirmar</button>
        </div>
    </form>

    <style>
        .opcion {
            background-color: white; /* Fondo blanco por defecto */
            padding: 15px;
            margin: 10px 0;
            border: 2px solid rgb(219, 57, 71);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .opcion:hover {
            background-color: #f0f0f0; /* Cambio de color al pasar el ratón */
        }

        .opcion.seleccionado {
            background-color: rgb(219, 57, 71);; /* Fondo rojo cuando se selecciona */
            color: white; /* Color de texto blanco para que se vea bien */
        }
    </style>

    <script>
        // Función para seleccionar una opción y colorear el fondo de rojo
        function seleccionarOpcion(opcion) {
            // Primero, quito el fondo rojo de todas las opciones
            document.getElementById('opcion1').classList.remove('seleccionado');
            document.getElementById('opcion2').classList.remove('seleccionado');
            document.getElementById('opcion3').classList.remove('seleccionado');

            // Luego, coloco el fondo rojo en la opción seleccionada
            document.getElementById(opcion).classList.add('seleccionado');

            // Actualizo el valor del campo oculto para enviar la cantidad seleccionada
            let cantidad = '';
            if (opcion === 'opcion1') {
                cantidad = '10'; // 1€ = 10 puntos
            } else if (opcion === 'opcion2') {
                cantidad = '50'; // 5€ = 50 puntos
            } else if (opcion === 'opcion3') {
                cantidad = '100'; // 10€ = 100 puntos
            }

            // Coloco el valor de la cantidad en el campo oculto
            document.getElementById('cantidadSeleccionada').value = cantidad;
        }
    </script>

    <?php elseif($aux == 'contrasena'): ?>

        <form action="confirmar-editar-perfil-admin.php" method="post">
            <div class="perfil">
                <?php if(isset($_SESSION['error'])): ?>
                    <p style='color:red' ><?php echo $_SESSION['error']; ?></p>
                <?php endif; ?>
                <p class="perfil-dentro">Introduce tu contraseña:</p>
                <input class="perfil-dentro" type="text" name="contrasena" required>
                <button type="submit">Confirmar</button>
            </div>
        </form>

    <?php endif; ?>
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