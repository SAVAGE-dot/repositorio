<?php
$host = 'localhost';
$dbname = 'usuario';
$username = 'root';
$password = '';

if(isset($_GET['id']) && !empty($_GET['id'])) {

    $usuario_id = $_GET['id'];

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $consulta = $conexion->prepare("DELETE FROM persona WHERE id = :usuario_id");
        $consulta = $conexion->prepare("UPDATE persona set estado=0 WHERE id = :usuario_id");
        $consulta->bindParam(':usuario_id', $usuario_id);
        $consulta->execute();
        
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>