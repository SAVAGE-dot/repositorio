<?php
class BibliotecarioModel{
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
        $autor = $datos_vista["autor"];
        $año = $datos_vista["año"];
        $editorial = $datos_vista["editorial"];

        // INSERT INTO Libro (Nombre, Autor, Año, Estado, Ideditorial) VALUES ('Checo Perez', 'Juanita', 2023, 1, 3);
         $sql='INSERT INTO Libro (Nombre, Autor, Año, Estado, Ideditorial) VALUES (?, ?, ?, 1, ?)';
	      $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	      $ejecutar->bindParam(1,$nombre,PDO::PARAM_STR);
	      $ejecutar->bindParam(2,$autor,PDO::PARAM_STR);
        $ejecutar->bindParam(3,$año,PDO::PARAM_STR);
        $ejecutar->bindParam(4,$editorial,PDO::PARAM_STR);
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
    public function deletemodel($idLibro) {
      try {
        $sql = 'UPDATE Libro SET Estado = 0 WHERE Id = ?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $idLibro, PDO::PARAM_INT);
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

    public function activarmodel($idLibro) {
      try {
        $sql = 'UPDATE Libro SET Estado = 1 WHERE Id = ?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $idLibro, PDO::PARAM_INT);
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
        $nombre=$data["nombre"];
        $autor = $data["autor"];
        $año = $data["año"];
        $editorial = $data["editorial"];
        $id = $data["Id"];
      try {
        $sql = 'update Libro set Nombre = ?, Autor = ?, Año = ?, Ideditorial = ? where Id=?';
        $ejecutar = $this->conexion->prepare($sql);
        $ejecutar->bindParam(1, $nombre, PDO::PARAM_STR);
        $ejecutar->bindParam(2, $autor, PDO::PARAM_STR);
        $ejecutar->bindParam(3, $año, PDO::PARAM_INT);
        $ejecutar->bindParam(4, $editorial, PDO::PARAM_INT);
        $ejecutar->bindParam(5, $id, PDO::PARAM_INT);
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


	public function getBibli(){
      try {
	    $sql="SELECT L.Id as Id_Libro,L.Nombre AS Nombre_Libro ,L.Autor,L.Año,L.estado as Estado,E.Id as IdEditorial, E.nombre AS Nombre_Editorial
      FROM Libro as L
      INNER JOIN Editorial as E ON E.id = L.Ideditorial;";
        $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ejecutar->execute();
        $array=array();
        foreach ($ejecutar as $key ) {
           $array[]=array(
              "Id"=>$key["Id_Libro"],
              "Nombre"=>$key["Nombre_Libro"],
              "Autor"=>$key["Autor"], 
              "Año"=>$key["Año"],
              "Estado"=>$key["Estado"],
              "IdEditorial"=>$key["IdEditorial"],
              "Editorial"=>$key["Nombre_Editorial"]                            
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