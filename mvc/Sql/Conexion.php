<?php 
class conexion
{        
    public $_connection;
    private static $_instance; //The single instance
    private  $servidor="localhost";
    private $usuario="sa";
    private $password="Desarrollo2023";
    private $bd="Trabajadores"; 
    // Constructor
    public function __construct()
    {
        $this->_connection =new PDO("sqlsrv:Server=".$this->servidor .";DataBase=".$this->bd."","".$this->usuario ."","".$this->password."");
        // Error handling
        $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->_connection->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
    }
     public function getConnection()
    {
        return $this->_connection;
    }
}



 ?>