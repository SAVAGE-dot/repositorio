<?php
class UserModel{
    private $conexion;
    public function __construct() {
        $cn=new conexion();
        $this->conexion=$cn->getConnection();
    }

    public function register($datos_vista){

      try {
         /*$nombre="Ricardi";
         $apellido = "Silva";
         $correo = "ricardosilva@yahoo.es";
         $documento = 6412312;
         $telefono = 2222222;
         $genero = 2;
         */
        $nombre=$datos_vista["nombre"];
        $apellido = $datos_vista["apellido"];
        $correo = $datos_vista["correo"];
        $documento = $datos_vista["documento"];
        $telefono = $datos_vista["telefono"];
        $genero = $datos_vista["genero"];


         $sql='INSERT INTO Usuario (Nombre, Apellido, Correo, Estado, Documento, Telefono, IdGenero) VALUES (?, ?, ?, 1, ?, ?, 1)';
	      $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	      $ejecutar->bindParam(1,$nombre,PDO::PARAM_STR);
	      $ejecutar->bindParam(2,$apellido,PDO::PARAM_STR);
         $ejecutar->bindParam(3,$correo,PDO::PARAM_STR);
         $ejecutar->bindParam(4,$documento,PDO::PARAM_STR);
         $ejecutar->bindParam(5,$telefono,PDO::PARAM_STR);
         $ejecutar->bindParam(6,$genero,PDO::PARAM_STR);
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

	public function getUsers(){
      try {
	    $sql="SELECT u.Id as IdUsuario, u.Nombre as NombreUsuario, u.Apellido, u.Correo, u.Estado as EstadoUsuario, u.Documento, u.Telefono, g.Nombre as Genero, g.Id as IdGenero FROM Usuario as U
       Inner join Genero as G ON g.Id=u.IdGenero
       WHERE u.Estado = 1
       order by u.Id desc";
        $ejecutar=$this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        //$ejecutar->bindParam(1,$name,PDO::PARAM_STR);
        $ejecutar->execute();
        $array=array();
        foreach ($ejecutar as $key ) {
           $array[]=array(
              "Id"=>$key["IdUsuario"],
              "nombre"=>$key["NombreUsuario"],
              "apellido"=>$key["Apellido"],
              "email"=>$key["Correo"],
              "DNI"=>$key["Documento"],
              "Celular"=>$key["Telefono"],
              "Idsexo"=>$key["IdGenero"],
              "sexo"=>$key["Genero"]

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
