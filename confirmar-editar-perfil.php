<?php
session_start();

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

// Verificar si se envió un formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nombre"])) {
        $nuevoValor = $_POST["nombre"];
        $_SESSION['Nombre'] = $nuevoValor;

        // Actualizar la base de datos
        $sql = "UPDATE usuario SET Nombre = :nombre WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nombre' => $nuevoValor, ':id' => $_SESSION["ID_Usuario"]]);
    }

    if (isset($_POST["apellido"])) {
        $nuevoValor = $_POST['apellido'];
        $_SESSION['Apellidos'] = $nuevoValor;

        // Actualizar la base de datos
        $sql = "UPDATE usuario SET Apellidos = :apellidos WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':apellidos' => $nuevoValor, ':id' => $_SESSION["ID_Usuario"]]);
    }

    if (isset($_POST["correo"])) {
        $nuevoValor = $_POST["correo"];
        $_SESSION['Correo'] = $nuevoValor;

        // Actualizar la base de datos
        $sql = "UPDATE usuario SET Correo = :correo WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':correo' => $nuevoValor, ':id' => $_SESSION["ID_Usuario"]]);
    }

    if (isset($_POST["nickname"])) {
        $nuevoValor = $_POST["nickname"];
        $_SESSION['usuario'] = $nuevoValor;

        // Actualizar la base de datos
        $sql = "UPDATE usuario SET Nickname = :nick WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nick' => $nuevoValor, ':id' => $_SESSION["ID_Usuario"]]);
    }

    // Actualizar puntos según el lote seleccionado
    if (isset($_POST['cantidad'])) {

        if($_POST['cantidad'] == 10 or $_POST['cantidad'] == 50 or $_POST['cantidad'] == 100){

        $puntosAumentados = $_POST['cantidad'];

        // Obtener los puntos actuales del usuario
        $sql = "SELECT Saldo FROM Usuario WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $_SESSION["ID_Usuario"]]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $puntosActuales = $usuario['Saldo'];

        // Calcular los nuevos puntos
        $nuevosPuntos = $puntosActuales + $puntosAumentados;
        $_SESSION['Saldo'] = $nuevosPuntos;

        // Actualizar los puntos en la base de datos
        $sql = "UPDATE Usuario SET Saldo = :puntos WHERE ID_Usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':puntos' => $nuevosPuntos, ':id' => $_SESSION["ID_Usuario"]]);

        }

        else{
            $_SESSION['error3'] = 'Seleccione uno de los lotes';
            header("Location: perfil.php");
            exit;
        }
    }
    

    // Confirmar que la contraseña es correcta
    if (isset($_POST['contrasena'])) {
        $aux = $_POST['contrasena'];

        if(password_verify($aux, $_SESSION["Contrasena"])){
            //Esta variable nos permitirá abrir un formulario para introducir nuestra contraseña nueva
            $_SESSION['nueva-contrasena'] = true;
            header("Location: confirmar-contrasena.php");
            exit;
        }

        else{
            $_SESSION['error'] = 'Contraseña incorrecta';
            header("Location: confirmar-contrasena.php");
            exit;
        }
    }

    // Actualizar contraseña
    if (isset($_POST['cambio1']) and isset($_POST['cambio2'])) {
        $aux1 = $_POST['cambio1'];
        $aux2 = $_POST['cambio2'];

        if($aux1 == $aux2){
            //Cambiar contrasena
            unset($_SESSION['nueva-contrasena']); //Borramos esta variable para que no haya conflictos luego
            unset($_SESSION['error']); //Borramos esta variable para que no haya conflictos luego
            unset($_SESSION['error2']); //Borramos esta variable para que no haya conflictos luego

            $nuevoValor = $_POST["cambio1"];
            $hash = password_hash($nuevoValor, PASSWORD_DEFAULT);
            $_SESSION['Contrasena'] = $hash;

            // Actualizar la base de datos
            $sql = "UPDATE Usuario SET Contrasena = :contrasena WHERE ID_Usuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':contrasena' => $hash, ':id' => $_SESSION["ID_Usuario"]]);

            header("Location: perfil.php");
            exit;

        }
        else{
            $_SESSION['error2'] = 'Las contraseñas no coinciden';
            header("Location: confirmar-contrasena.php");
            exit;
        }
    }

    header("Location: perfil.php");
    exit;

}

?>