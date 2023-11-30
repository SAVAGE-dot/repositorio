<?php 

 class UserController{
 	private $user;
 	public function __construct(){
 		$this->user=new UserModel();
 	}
	 public function listar(){
	 
	 	$this->user->getUsers();
	 }
	 public function create($datos_vista){
	 	$this->user->register($datos_vista);
	 }
 }
 ?>