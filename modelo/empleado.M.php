<?php
    //Eduardo A. Peña

class Empleado{
    private $idEmpleado;
    private $idCargo;
    private $correoInstirucional;
    private $fechaIngreso;
    private $arl;
    private $salud;
    private $pension;
    private $idPersona;
    private $estado;
    public $conn=null;

    //idEmpleado
    public function getidEmpleado(){return $this->idEmpleado;}
    public function setidEmpleado($idEmpleado){$this->idEmpleado = $idEmpleado;
    
    //idCargo
    public function getIdCargo(){return $this->idCargo;}
    public function setIdCargo($idCargo){$this->idCargo = $idCargo;
    
    //correoInstirucional
    public function getCorreoInstirucional(){return $this->correoInstirucional;}
    public function setCorreoInstirucional($correoInstirucional){$this->correoInstirucional = $correoInstirucional;
    
    //fechaIngreso
    public function getFechaIngreso(){return $this->fechaIngreso;}
    public function setFechaIngreso($fechaIngreso){$this->fechaIngreso = $fechaIngreso;

    //arl
    public function getArl(){return $this->arl;}
    public function setArl($arl){$this->arl = $arl;
    
    //salud
    public function getSalud(){return $this->salud;}
    public function setSalud($salud){$this->salud = $salud;}

    //pension
    public function getPension(){return $this->pension;}
    public function setPension($pension){$this->pension = $pension;}
    
    //idPersona
    public function getIdPersona(){return $this->idPersona;}
    public function setIdPersona($idPersona){$this->idPersona = $idPersona;}
    
    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}
    
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
