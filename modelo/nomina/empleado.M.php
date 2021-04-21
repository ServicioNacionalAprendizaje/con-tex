<?php

class Empleado{

    private $idEmpleado;
    private $idCargo;
    private $correoInstitucional;
    private $fechaIngreso;
    private $arl;
    private $salud;
    private $pension;
    private $idPersona;
    private $estado;

    //idEmpleado
    public function getIdEmpleado(){return $this->idFormulario;}
    public function setIdEmpleado($idEmpleado){$this->idEmpleado = $idEmpleado;}

    //idCargo
    public function getIdCargo(){return $this->idCargo;}
    public function setIdCargo($idCargo){$this->idCargo = $idCargo;}

    //correoInstitucional
    public function getCorreoInstitucional(){return $this->correoInstitucional;}
    public function setCorreoInstitucional($correoInstitucional){$this->correoInstitucional = $correoInstitucional;}

    //fechaIngreso
    public function getFechaIngreso(){return $this->fechaIngreso;}
    public function setFechaIngreso($fechaIngreso){$this->fechaIngreso = $fechaIngreso;}

    //arl
    public function getArl(){return $this->arl;}
    public function setArl($arl){$this->arl = $arl;}

    //salud
    public function getSalud(){return $this->salud;}
    public function setSalud($salud){$this->salud = $salud;}

    //pension
    public function getPension(){return $this->pension;}
    public function setPension($pension){$this->pension = $pension;}

    //idPersona
    public function getIdPersona(){return $this->idPersona;}
    public function setIdPension($idPersona){$this->idPersona = $idPersona;}

    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
        $sentenciaSql = "CALL Agregar_empleado('$this->idCargo'
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                            ,'$this->idPersona'
                            ,'$this->estado')";
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
    }

    public function Modificar(){
        $sentenciaSql = "CALL Modificar_empleado('$this->idCargo'
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                            ,'$this->idPersona'
                            ,'$this->estado')";       
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            empleado 
        WHERE 
            id_empleado = $this->idEmpleado";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
           *
        FROM
            empleado $condicion";        		
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    private function obtenerCondicion(){}

    public function __destruct() {
        
        unset($this->idEmpleado);
        unset($this->idCargo);
        unset($this->correoInstitucional);
        unset($this->fechaIngreso);
        unset($this->arl);
        unset($this->salud);
        unset($this->pension);
        unset($this->idPersona);
        unset($this->estado);
        unset($this->conn);
    }

}
