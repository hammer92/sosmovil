<?php 
require_once '../controller/UsuarioController.php';
//require_once '../controller/HomeController.php';
//require_once '../controller/TemaController.php';
//require_once '../model/UsuarioModel.php';

class Ruta 
{
	
	public function __construct()	{            
            $url = $_SERVER['REQUEST_URI'];
            
            $variable = explode("/", $url,3);            
            
            if (isset($variable[2])){
                $ruta=$variable[2];
            }else{
                $ruta= null;
            }
            
            switch ($variable[1]) {
                case null:
                    new HomeController($ruta);
                    break;
                case "usuario":                    
                    new UsuarioController($ruta);                    
                    break;
                case "tema":                    
                    new TemaController($ruta);                    
                    break;
                case "md5":                    
                    echo md5("contrasena");                    
                    break;
                default:
                    echo "404--";
                    break;
            }
	}       
}

new Ruta();

 