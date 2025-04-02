<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado y si la variable de sesión "editar-usuarios" está establecida
if (!isset($_SESSION["editar-cartas"])) {
    header("Location: login.php"); // Redirigir si no está logueado
    exit;
}

// Conectar a la base de datos
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "pokeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibieron todos los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);
    $ps = mysqli_real_escape_string($conn, $_POST["ps"]);
    $ataque = mysqli_real_escape_string($conn, $_POST["ataque"]);
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
    $precio = mysqli_real_escape_string($conn, $_POST["precio"]);
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $venta = mysqli_real_escape_string($conn, $_POST["en_venta"]);

    // Obtener el ID de usuario desde la variable de sesión
    $id_carta = $_SESSION["editar-cartas"];

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE carta SET ID_Usuario = '$usuario', en_venta = '$venta', Nombre = '$nombre', Tipo = '$tipo',  PS = '$ps', Ataque = '$ataque', Precio = '$precio', Descripcion = '$descripcion' WHERE ID_Carta = $id_carta";

    if ($conn->query($sql_update) === TRUE) {
        // Redirigir a la página de gestión de usuarios con un mensaje de éxito
        header("Location: gestion-cartas.php");
        exit;
    } else {
        echo "<script>alert('Error al actualizar los datos: " . $conn->error . "'); window.location.href='gestion-usuarios.php';</script>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>