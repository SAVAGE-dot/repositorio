<?php 
    class AdminController{
        private $Admin;
        public function __construct(){
            $this->Admin = new AdministradorModel();
        }
        public function listar(){
            $this->Admin->getAdmin();
        }
        public function create($datos_vista){
            $this->Admin->register($datos_vista);
        }
        public function delete($idProducto){
            $this->Admin->deletemodel($idProducto);
            
        }
        public function activar($idProducto){
            $this->Admin->activarmodel($idProducto);

        }
        public function editar($idProducto){
            $this->Admin->editarmodel($idProducto);
        }
    
}

 ?>