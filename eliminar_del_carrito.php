<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_carta"])) {
    $id_carta = intval($_POST["id_carta"]);

    // Eliminar la carta del carrito
    if (isset($_SESSION["Carrito"])) {
        $_SESSION["Carrito"] = array_filter($_SESSION["Carrito"], function($id) use ($id_carta) /* Se utiliza use ($id_carta) para que pueda acceder fuera de alcance */ {
            return $id != $id_carta;
        });
    }

    // Volver a la página principal
    header("Location: carrito.php"); // Ajusta "carrito.php" a la página donde muestras las cartas
    exit();
}
?>
