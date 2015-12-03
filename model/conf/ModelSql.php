<?php
require_once 'IModel.php';
require_once 'Conexion.php';
 class ModelSql extends Conexion implements IModel {
    
    protected $tabla;
    protected $pk="id";
    protected $campos = [];
    private static $sql;
    private static $con;
    private static $ins=null;
    
    public function __construct() {
       self::$con = self::saberEstado();
        
    }
    
    function db() {
        if (!isset(self::$ins)) {
            $miclase = get_class($this);
            self::$ins = new $miclase;
        }
        return self::$ins;
    }
    
    public function all() {
        $this->select();
    }

    public function between($col, $berween = array()) {
        self::$sql.=" $col BETWEEN ".  join(" AND ", $berween);
        return $this->db();
    }

    public function count() {
        $this->select(array(" COUNT($this->pk) as total"));
        return $this->db();
    }

    public function create($create = array()) {
        self::$sql = "INSERT INTO ".$this->tabla." ( ".join(" , ", $this->campos).") VALUES (".join(" , ", $create).")";
        return $this->db();
    }

    public function insert($create = array()) {
        self::$sql = "INSERT INTO ".$this->tabla." ( ".join(" , ",array_keys($create)).") VALUES ('".join("' , '", $create)."')";
        return $this->db();
    }

    public function delete($id, $delete = NULL) {
        if (isset($delete)) {
            self::$sql = "DELETE FROM ".$this->tabla;
            $this->where($delete);
        }else{
            self::$sql = "DELETE FROM ".$this->tabla;
            $this->where(array("$this->pk","=","$id"));            
        }
        return $this->db();
    }
    
    public function find($id) {
        self::$sql = $this->select()->where(array($this->pk,"=",$id));
        return $this->db();
    }

    public function groupBy($groupby = array()) {
        self::$sql.= " GROUP BY ".join(" , ", $groupby);
        return $this->db();
    }

    public function innerJoin($tabla, $innerjoin = array()) {
        self::$sql.=" INNER JOIN $tabla ON ".join(" = ", $innerjoin);
        return $this->db();
    }

    public function leftJoin($tabla, $leftjoin = array()) {
        self::$sql.=" LEFT JOIN $tabla ON ".join(" = ", $leftjoin);
        return $this->db();        
    }

    public function like($like = array()) {
        self::$sql.= " WHERE ".join(" LIKE ", $like);
        return $this->db();
    }

    public function mand($mand = array()) {
        self::$sql.=" AND ".join(" ", $mand);
        return $this->db();
    }

    public function mor($mor = array()) {
        self::$sql.=" OR ".join(" ", $mor);
        return $this->db();
    }

    public function orderBy($orderby = array()) {
        self::$sql.=" ORDER BY ".join(" , ",$orderby);
        return $this->db();
    }  

    public function rightJoin($tabla, $righjoin = array()) {
        self::$sql.=" RIGH JOIN $tabla ON ".join(" = ", $righjoin);
        return $this->db();
    }  

    public function select($select = NULL) {
        self::$sql = "SELECT ";
        if(isset($select)){
            self::$sql.=join(" , ", $select);
        }  else {
            self::$sql.=join(" , ", $this->campos);            
        }
        self::$sql.=" FROM ".$this->tabla;
        return $this->db();        
    }   

    public function update($update = NULL) {
        
    }

    public function where($where = NULL) {
        if (isset($where)) {
            self::$sql.=" WHERE ".join(" ", $where);
        }  else {
            self::$sql.=" WHERE ";            
        }
        return $this->db();
    }
    
    function limit($limit = NULL) {
        self::$sql.=" LIMIT ".join(" , ", $limit);
        return $this->db();
    }

    public function query($sql) {
        self::$sql = $sql;
        $this->save();
    }
    
    public function sql() {
        echo self::$sql;
    }
    
    public function toArray() {
        $value = $this->exec(TRUE);
        return $value;
    }

    public function toJson() {        
        $value = $this->exec(TRUE);
        if (empty($value)) {
            $value = array("mensaje"=>"No hay datos para mostrar");
        }
        return json_encode($value);
    }
    
    public function save() {
        $value = $this->exec();
        return $value;        
    }   
    
    public function exec($tipo = FALSE) {
     $con = self::$con->getConn()->prepare(self::$sql);
     $res = $con->execute();
     if ($res) {
         if ($tipo) {
             $res = $con->fetchAll(PDO::FETCH_ASSOC);
         }
     }else{
         $res = $con->errorInfo();
     }
     self::cerrarConexion();
     return $res;
    }

}
