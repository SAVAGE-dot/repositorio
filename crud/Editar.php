<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<?php
$host = 'localhost';
$dbname = 'usuario';
$username = 'root';
$password = '';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $usuario_id = $_GET['id'];
    $estado=1;

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $conexion->prepare("SELECT * FROM persona WHERE id = :usuario_id ");
        $consulta->bindParam(':usuario_id', $usuario_id);
       // $consulta->bindParam(':estado', $estado);
        $consulta->execute();
        
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            echo '<form method="post" action="Actualizar.php">';
            echo '<input type="hidden" name="id" value="' . $usuario['id'] . '">';
            echo 'Nombre: <input type="text" class="form-control" name="nombre" value="' . $usuario['usuario'] . '"><br>';
            echo 'Apellido: <input type="text" class="form-control" name="apellido" value="' . $usuario['apellido'] . '"><br>';
            echo 'Correo: <input type="email" class="form-control" name="correo" value="' . $usuario['correo'] . '"><br>';
            echo 'Documento: <input type="number" class="form-control" name="documento" value="' . $usuario['documento'] . '"><br>';
            echo 'Telefono: <input type="number" class="form-control" name="telefono" value="' . $usuario['telefono'] . '"><br>';
            echo 'Genero:   <select name="genero"> <br>';
                            if($usuario['genero']=="M"){
                             echo ' <option value="M" selected>Masculino</option>';
                            }else{
                              echo ' <option value="M">Masculino</option>';
                            }
                               
                            if($usuario['genero']=="F"){
                                echo ' <option value="F" selected>Femenino</option>';
                               }else{
                                 echo ' <option value="F">Femenino</option>';
                               }
            echo            ' </select> <br><br>';
            echo '<input type="submit" value="Actualizar">';
            echo '</form>';
        } else {
            echo "No se encontró el usuario con el ID proporcionado.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>