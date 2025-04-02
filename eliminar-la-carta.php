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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_carta"])) {
    $id_carta = intval($_POST["id_carta"]);

    // Verificar si el botón de eliminar fue presionado
    if (isset($_POST["eliminar"])) {
        // Eliminar usuario de la base de datos
        $sql_delete = "DELETE FROM carta WHERE ID_Carta = $id_carta";
        if ($conn->query($sql_delete) === TRUE) {
            header("Location: gestion-cartas.php");
        } else {
            echo "<script>alert('Error al eliminar la carta');</script>";
        }
    }

    // Verificar si el botón de editar fue presionado
    if (isset($_POST["editar"])) {
        // Lógica para editar usuario
        $_SESSION['editar-cartas'] = $id_carta;
        header("Location: editar-cartas.php");
        
    }
}

$conn->close();

?>