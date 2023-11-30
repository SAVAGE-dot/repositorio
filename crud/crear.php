
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php

$host = 'localhost';
$dbname = 'usuario';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->prepare("INSERT INTO persona (usuario, apellido, correo, estado, documento, telefono, genero) VALUES (:usuario, :apellido, :correo, 1, :documento, :telefono, :genero)");
        
        // Ejecutar la consulta con los valores
        $consulta->bindParam(':usuario', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        $consulta->bindParam(':documento', $documento);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':genero', $genero);
        
        // Ejecutar la consulta preparada
        $consulta->execute();
        
        // Redirigir a la página principal después de la inserción
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se enviaron datos del formulario, mostrar el formulario para crear un nuevo usuario
    echo '<form method="post">';
    echo 'Nombre: <input type="text" class="form-control" name="nombre" placeholder="Por favor, introduce tu Nombre"><br>';
    echo 'Apellido: <input type="text" class="form-control" name="apellido" placeholder="Por favor, introduce tu Apellido"><br>';
    echo 'Correo: <input type="email" class="form-control" name="correo" placeholder="Por favor, introduce tu Correo"><br>';
    echo 'documento: <input type="number" class="form-control" pattern="[0-9]{12}" name="documento" placeholder="Por favor, introduce tu DNI"><br>';
    echo 'telefono: <input type="number" class="form-control" pattern="[0-9]{9}" name="telefono" placeholder="Por favor, introduce tu numero Telefonico"><br>';
    echo '  <select name="genero">
                <option value="M" >Masculino</option>
                <option value="F" >Femenino</option>
            </select>';
    echo '<br><br><input type="submit" value="Crear Usuario">';
    echo '</form>';
}
?>
