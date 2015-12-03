<?php

class Conexion {
    
    private static $instancia;
    private static $cnn;
    
    private function __construct() {
        $dsn="mysql:host=localhost;dbname=sosmovil";
        $username="root";
        $passwd="root";
        $option=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try {
            self::$cnn = new PDO($dsn, $username, $passwd,$option);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }        
    }
    
    public static function saberEstado() {
        if (!isset(self::$instancia)){
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
    public function getConn() {
        return self::$cnn;
    }
    
    public static function cerrarConexion() {
        self::$instancia=null;
    }
    
    
}

