<?php
$host = 'localhost';
$dbname = 'usuario';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];


    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $conexion->prepare("UPDATE persona SET Usuario = :usuario, Apellido = :apellido, Correo = :correo, Documento= :documento, Telefono =:telefono, Genero =:genero WHERE id = :usuario_id");
        $consulta->bindParam(':usuario_id', $usuario_id);
        $consulta->bindParam(':usuario', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        $consulta->bindParam(':documento', $documento);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':genero', $genero);
        
        $consulta->execute();

        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error al procesar la solicitud.";
}
?>