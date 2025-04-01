<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado y si la variable de sesión "editar-usuarios" está establecida
if (!isset($_SESSION["editar-usuarios"])) {
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
    $apellidos = mysqli_real_escape_string($conn, $_POST["apellidos"]);
    $correo = mysqli_real_escape_string($conn, $_POST["correo"]);
    $nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
    $saldo = mysqli_real_escape_string($conn, $_POST["saldo"]);

    // Obtener el ID de usuario desde la variable de sesión
    $id_usuario = $_SESSION["editar-usuarios"];

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE usuario SET Nombre = '$nombre', Apellidos = '$apellidos', Correo = '$correo', Nickname = '$nickname',  Saldo = '$saldo' WHERE ID_Usuario = $id_usuario";

    if ($conn->query($sql_update) === TRUE) {
        // Redirigir a la página de gestión de usuarios con un mensaje de éxito
        header("Location: gestion-usuarios.php");
        exit;
    } else {
        echo "<script>alert('Error al actualizar los datos: " . $conn->error . "'); window.location.href='gestion-usuarios.php';</script>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
