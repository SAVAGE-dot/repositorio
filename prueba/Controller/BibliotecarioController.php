<?php 
    class BibliController{
        private $bibli;
        public function __construct(){
            $this->bibli = new BibliotecarioModel();
        }
        public function listar(){
            $this->bibli->getBibli();
        }
        public function create($datos_vista){
            $this->bibli->register($datos_vista);
        }
        public function delete($idLibro){
            $this->bibli->deletemodel($idLibro);
            
        }
        public function activar($idLibro){
            $this->bibli->activarmodel($idLibro);

        }
        public function editar($idLibro){
            $this->bibli->editarmodel($idLibro);
        }
    
}

 ?>