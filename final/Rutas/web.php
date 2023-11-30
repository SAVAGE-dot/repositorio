<?php 
 // menejo de rutas
 $ruta= $_SERVER['REQUEST_URI'];
 $request_uri = explode ("/", $ruta);
 $metodo=end($request_uri);
 require_once("autoload.php");

if(strpos($ruta,"Admin")){
   if(strpos($ruta,"listar"))
   {
      $mod_admin->listar();
   }else if(strpos($ruta,"create")){
      $mod_admin->create($_POST);
   }else if(strpos($ruta,"delete")){

      $mod_admin->delete($_POST["idProducto"]);
   }else if(strpos($ruta, "activar")){
      $mod_admin->activar($_POST["activacion"]);
   }else if(strpos($ruta,"editar")){
     $mod_admin->editar($_POST);
   }
}
   else{
	   http_response_code(404);  
   }
?>