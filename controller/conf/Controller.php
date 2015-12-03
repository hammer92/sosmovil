<?php
require_once 'IController.php';
abstract class  Controller implements IController {


    public function __construct($ruta) {
        $variable = explode("/", $ruta,2);
        
        switch ($variable[0]) {
            case null:
                $this->index();
                break;			
            case "crear":
                $this->create();
                break;			
            case "eliminar":
                $this->delete($variable[1]);
                break;			
            case "detalle":
                $this->read($variable[1]);
                break;			
            case "actualizar":
                $this->update($variable[1]);
                break;			
            default:
                echo "404 controller";
                break;
        }
    }

    abstract public function create();

    abstract public function delete($id);

    abstract public function index();

    abstract public function read($id);

    abstract public function update($id);
    
    public function page($row, $page){
        $totalrow = $row;
        if (!isset($page)) {
            $inicio = 0;
            $page =1;                            
        }else{
            $inicio = ($page-1)*$totalrow;
        }
        return $inicio;
    }

}
