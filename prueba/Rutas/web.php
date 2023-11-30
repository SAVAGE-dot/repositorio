<?php 
 // menejo de rutas
 $ruta= $_SERVER['REQUEST_URI'];
 $request_uri = explode ("/", $ruta);
 $metodo=end($request_uri);
 require_once("autoload.php");

if(strpos($ruta,"bibli")){
   if(strpos($ruta,"listar"))
   {
      $mod_bibli->listar();
   }else if(strpos($ruta,"create")){
      $mod_bibli->create($_POST);
   }else if(strpos($ruta,"delete")){

      $mod_bibli->delete($_POST["idlibro"]);
   }else if(strpos($ruta, "activar")){
      $mod_bibli->activar($_POST["activacion"]);
   }else if(strpos($ruta,"editar")){
     $mod_bibli->editar($_POST);
   }

}
   else{
	   http_response_code(404);  
   }
?>