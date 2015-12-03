<?php
require_once 'conf/ModelSql.php';

class UsuarioModel extends ModelSql {
    
    protected $tabla = "users";
   
    protected $campos = array(
        "name",
        "password",
        "email",
        "nombre_completo",
        "celular",
        "direccion"
        );
    
}