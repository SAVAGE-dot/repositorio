<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head class="p-3 mb-2 bg-black text-white">
<body class="p-3 mb-2 bg-black text-white">
    <style>
        .a {
            text-decoration: none;
            color: inherit;
            }
    </style>
    <p>CRUD de Usuarios</p>
    
    <?php
    $host = 'localhost';
    $dbname = 'usuario';
    $username = 'root';
    $password = '';

    try {
        // Crear conexión PDO
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configurar el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Consulta para obtener todos los usuarios
        $consulta = $conexion->query("SELECT * FROM persona order by id desc");
        
        // Mostrar los usuarios en una tabla HTML
        echo '<table border="1" class="table table-striped table-hover">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Estado</th><th>Documento</th><th>Telefono</th><th>Genero</th><th>Acciones</th></tr>';
        
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
                echo '<td>' . $fila['id'] . '</td>';            
                echo '<td>' . (isset($fila['usuario']) ? $fila['usuario'] : '') . '</td>';
                echo '<td>' . (isset($fila['apellido']) ? $fila['apellido'] : '') . '</td>';
                echo '<td>' . (isset($fila['correo']) ? $fila['correo'] : '') . '</td>';
                if($fila['estado']==1){
                    echo '<td class="table-success">Activo</td>';
                }else{
                    echo '<td class="table-danger">Inactivo</td>';
                }
                
                //echo '<td>' . (isset($fila['estado']) ? $fila['estado']==1?'Activo':'Inactivo' : '') . '</td>';
                echo '<td>' . (isset($fila['documento']) ? $fila['documento'] : '') . '</td>';
                echo '<td>' . (isset($fila['telefono']) ? $fila['telefono'] : '') . '</td>';
                if($fila['genero']=="F"){
                    echo '<td>Femenino</td>';
                }else{
                    echo '<td>Masculino</td>';
                }
                // echo '<td>' . (isset($fila['genero']) ? $fila['genero'] : '') . '</td>';
                echo '<td>';
                // echo '<a href="Editar.php?id=' . $fila['id'] . '">Editar</a> | ';
                echo '<button type="button" class="btn btn-warning"><a class="a" href="Editar.php?id=' . $fila['id'] . '">EDITAR</a></button>  ';
                // echo '<a href="Eliminar.php?id=' . $fila['id'] . '">Eliminar</a> | ';
                echo '<button type="button" class="btn btn-danger"><a class="a" href="Eliminar.php?id=' . $fila['id'] . '">ELIMINAR</a></button>  ';
                // echo '<a href="Activar.php?id=' . $fila['id'] . '">Activar</a>';
                echo '<button type="button" class="btn btn-success"><a class="a" href="Activar.php?id=' . $fila['id'] . '">ACTIVAR</a></button>  ';
                echo '</td>';
            echo '</tr>';
                 
        }
        
        echo '</table>';
    } catch(PDOException $e) {
        // Mostrar cualquier error de conexión
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
    ?>

    <br>
    <a href="crear.php" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Crear Nuevo Usuario</a>
</body>
</html>