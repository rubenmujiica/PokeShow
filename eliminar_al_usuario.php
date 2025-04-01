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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_usuario"])) {
    $id_usuario = intval($_POST["id_usuario"]);

    // Verificar si el botón de eliminar fue presionado
    if (isset($_POST["eliminar"])) {
        // Eliminar usuario de la base de datos
        $sql_delete = "DELETE FROM usuario WHERE ID_Usuario = $id_usuario";
        if ($conn->query($sql_delete) === TRUE) {
            header("Location: gestion-usuarios.php");
        } else {
            echo "<script>alert('Error al eliminar usuario');</script>";
        }
    }

    // Verificar si el botón de editar fue presionado
    if (isset($_POST["editar"])) {
        // Lógica para editar usuario
        $_SESSION['editar-usuarios'] = $id_usuario;
        header("Location: editar-usuarios.php");
        
    }
}

$conn->close();

?>