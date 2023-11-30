<?php 
 // menejo de rutas
 $ruta= $_SERVER['REQUEST_URI'];
 $request_uri = explode ("/", $ruta);
 $metodo=end($request_uri);
 require_once("autoload.php");

if(strpos($ruta,"user"))
{
   if(strpos($ruta,"listar"))
   {

    // lamamos al controlador
      $mod_user->listar();
   }
   else if(strpos($ruta,"create")){
      $mod_user->create($_POST);
   }
   else if(strpos($ruta,"delete")){

      echo "estoy en el metodo eliminar usuario";
      exit;     
         // $mod_user->create($_POST);
   }

   else if(strpos($ruta,"update")){
      echo "Estoy en el Metodo Actualizar";
      exit;
   }else
   {
	  http_response_code(404);
      

   }	   	
}
else{
	http_response_code(404);
   
}

 ?>