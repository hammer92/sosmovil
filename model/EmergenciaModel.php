<?php
require_once 'conf/ModelSql.php';

class EmergenciaModel extends ModelSql {
    
    protected $tabla = "emergencias";
   
    protected $campos = array(
        "foto",
        "latitud",
        "longitud",
        "direccion",
        "id_usuario"
        );
    
}