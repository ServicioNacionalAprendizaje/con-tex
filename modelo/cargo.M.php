<?php
    //Eduardo A. Peña

class Cargo{
    private $idCargo;
    private $codigoCargo;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn=null;

    //idCargo
    public function getIdCargo(){return $this->idCargo;}
    public function setIdCargo($idCargo){$this->idCargo = $idCargo;}
    
    //codigoCargo
    public function getCodigoCargo(){return $this->codigoCargo;}
    public function setCodigoCargo($codigoCargo){$this->codigoCargo = $codigoCargo;}
    
    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
    
    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}
    
    //fechaCreacion
    public function getFechaCreacion(){return $this->fechaCreacion;}
    public function setFechaCreacion($fechaCreacion){$this->fechaCreacion = $fechaCreacion;}

    //fechaModificacion
    public function getFechaModificacion(){return $this->fechaModificacion;}
    public function setFechaModificacion($fechaModificacion){$this->fechaModificacion = $fechaModificacion;}

    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion){$this->idUsuarioCreacion = $idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion){$this->idUsuarioModificacion = $idUsuarioModificacion;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
       
    }

    public function Modificar(){
       
    }

    public function Eliminar(){
       
    }

    public function Consultar(){
       
    }
    private function obtenerCondicion(){
     
        
    }


    public function __destruct() {
       
    }       
}
?>