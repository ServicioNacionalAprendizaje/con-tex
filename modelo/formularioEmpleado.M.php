<?php

class cargo{
    private $id_empleado;
    private $id_cargo;
    private $correo_institucional;
    private $fecha_ingreso;
    private $arl;
    private $salud;
    private $pension;
    private $id_persona;
    private $estado;
    public $conn=null;

    //id_empleado
    public function getId_empleado(){return $this->id_empleado;}
    public function setId_empleado($id_empleado){$this->id_empleado = $id_empleado;}

    //id_cargo
    public function getId_cargo(){return $this->id_cargo;}
    public function setId_cargo($id_cargo){$this->id_cargo = $id_cargo;}

    //correo_institucional
    public function getCorreo_institucional(){return $this->correo_institucional;}
    public function setCorreo_institucional($correo_institucional){$this->correo_institucional = $correo_institucional;} 

    //fecha_ingreso
    public function getFecha_ingreso(){return $this->fecha_ingreso;}
    public function setFecha_ingresoo($fecha_ingreso){$this->fecha_ingreso = $fecha_ingreso;}

    //arl
    public function getArl(){ return $this->arl;}
    public function setArl($arl) { $this->arl =$arl;}

    //salud
    public function getSalud(){ return $this->salud;}
    public function setSalud($salud) { $this->salud =$salud;}

    //$pension
    public function getpension(){ return $this->pension;}
    public function setpension($pension = 1) { $this->pension =$pension;}

    //id_persona
    public function getId_persona(){ return $this->id_persona;}
    public function setId_persona($id_persona = 1) { $this->id_persona =$id_persona;}

    //estado
    public function getEstado(){ return $this->estado;}
    public function setEstado($estado = 1) { $this->estado =$estado;}


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
