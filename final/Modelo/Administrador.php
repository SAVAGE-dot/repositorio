<?php
class AdministradorModel{
    //Conexion
    private $conexion;
    public function __construct() {
    	//parent::__construct();
        $cn=new conexion();
        $this->conexion=$cn->getConnection();
    }

    public function register($datos_vista){
      try {
        $nombre=$datos_vista["nombre"];
        $categoria = $datos_vista["categoria"];
        $precio = $datos_vista["precio"];

        // insert into Producto(Nombre,Precio,Estado,IdCategoria) values ('Glacitas',10.4,1)
         $sql='INSERT INTO Producto (Nombre, Precio, Estado, IdCategoria) VALUES (?, ?, 1, ?)';
	      $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	      $ejecutar->bindParam(1,$nombre,PDO::PARAM_STR);
	      $ejecutar->bindParam(2,$precio,PDO::PARAM_BOOL);
          $ejecutar->bindParam(3,$categoria,PDO::PARAM_STR);
	      $ejecutar->execute();      	
           header('Content-Type: application/json; charset=utf-8');
           echo json_encode(array(
            "success"=>true,
            "message"=>"Exitoso"
           ));

      } catch (Exception $e) {
      	  return;
      }

    }
    public function deletemodel($idProducto) {
      try {
        $sql = 'UPDATE Producto SET Estado = 0 WHERE Id = ?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $idProducto, PDO::PARAM_INT);
        $ejecutar->execute();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>true,
         "message"=>"Actualizacion exitosa"
        ));
      } catch(PDOException $e) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>false,
         "message"=>"Erro al actualizar datos"
        ));
      }
    }

    public function activarmodel($idProducto) {
      try {
        $sql = 'UPDATE Producto SET Estado = 1 WHERE Id = ?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $idProducto, PDO::PARAM_INT);
        $ejecutar->execute();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>true,
         "message"=>"Actualizacion exitosa"
        ));
      } catch(PDOException $e) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>false,
         "message"=>"Erro al actualizar datos"
        ));
      }
    }
    public function editarmodel($data) {
        $nombre=$data["Nombre"];
        $categoria = $data["categoria"];
        $precio = $data["Precio"];
        $id = $data["Id"];
      try {
        $sql = 'update Producto set Nombre = ?, Precio = ?, IdCategoria = ? where Id=?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $nombre, PDO::PARAM_STR);
        $ejecutar->bindParam(2, $precio, PDO::PARAM_STR);
        $ejecutar->bindParam(3, $categoria, PDO::PARAM_INT);
        $ejecutar->bindParam(4, $id, PDO::PARAM_INT);
        $ejecutar->execute();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>true,
         "message"=>"Actualizacion exitosa"
        ));
      } catch(PDOException $e) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
         "success"=>false,
         "message"=>"Erro al editar datos",
         "data"=>$e
        ));
      }
    }


	public function getAdmin(){
      try {
	    $sql="SELECT P.Id as Id_Producto,P.Nombre AS Nombre_Producto ,C.Id as IdCategoria,C.Nombre AS Categoria,P.Precio,P.Estado
        FROM Producto as P
        INNER JOIN Categoria as C ON C.Id = P.IdCategoria;";
        $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ejecutar->execute();
        $array=array();
        foreach ($ejecutar as $key ) {
           $array[]=array(
              "Id"=>$key["Id_Producto"],
              "Nombre"=>$key["Nombre_Producto"],
              "IdCategoria"=>$key["IdCategoria"], 
              "Categoria"=>$key["Categoria"],
              "Precio"=>$key["Precio"],
              "Estado"=>$key["Estado"],                        
           );
        }
        //return $array;
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($array);
      } catch (Exception $e) {
      	  return;
      }

    }
  
  }
?>