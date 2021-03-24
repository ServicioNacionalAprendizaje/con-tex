<?php
    //Eduardo A. Peña

class FormularioRol{
    private $idFormularioRol;
    private $idRol;
    private $idFormulario;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn=null;

    //idFormularioRol
    public function getIdFormularioRol(){return $this->idFormularioRol;}
    public function setIdFormularioRol($idFormularioRol){$this->idFormularioRol = $idFormularioRol;}

    //idRol
    public function getIdRol(){return $this->idRol;}
    public function setIdRol($idRol){$this->idRol = $idRol;}

    //idFormulario
    public function getIdFormulario(){return $this->idFormulario;}
    public function setIdFormulario(){$this->idFormulario = $idFormulario;}

    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado(){$this->estado = $estado;}

    //fechaCreacion
    public function getFechaCreacion(){return $this->fechaCreacion;}
    public function setFechaCreacion(){$this->fechaCreacion = $fechaCreacion;}

    //fechaModificacion
    public function getFechaModificacion(){ return $this->fechaModificacion;}
    public function setFechaModificacion($fechaModificacion) { $this->fechaModificacion =$fechaModificacion;}

    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion) { $this->idUsuarioModificacion =$idUsuarioModificacion;}

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