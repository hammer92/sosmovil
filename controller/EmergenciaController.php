<?php
require_once 'conf/Controller.php';
require_once '../model/EmergenciaModel.php';

class EmergenciaController extends Controller {
    private static $model;
    
    
    public function __construct($ruta) {
        self::$model =new EmergenciaModel();       
        parent::__construct($ruta);                
    }
    public function create() {
        $ini = self::$model->insert($_POST)->save();   
        print_r($ini);
        
    }

    public function delete($id) {
        
    }

    public function index() {        
        
        $ini = self::$model->select()->toJson();    
        print_r($ini);
        
    }

    public function read($id) {
        echo 'detalle';
    }

    public function update($id) {
        
    }

}
