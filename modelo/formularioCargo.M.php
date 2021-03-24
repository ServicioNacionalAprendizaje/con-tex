<?php

class cargo{
    private $id_cargo;
    private $codigo_cargo;
    private $descripcion;
    private $estado;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $id_usuario_creacion;
    private $id_usuario_modificacion;
    public $conn=null;

    //id_cargo
    public function getId_cargo(){return $this->id_cargo;}
    public function setId_cargo($id_cargo){$this->id_cargo = $id_cargo;}

    //codigo_cargo
    public function getCodigo_cargo(){return $this->codigo_cargo;}
    public function setCodigo_cargo($codigo_cargo){$this->codigo_cargo = $codigo_cargo;}

    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;} 

    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}


    //fecha_creacion
    public function getFecha_creacion(){ return $this->fecha_creacion;}
    public function setFecha_creacion($fecha_creacion) { $this->fecha_creacion =$fecha_creacion;}

    //fecha_modificacion
    public function getFecha_modificacion(){ return $this->fecha_modificacion;}
    public function setFecha_modificacion($fecha_modificacion) { $this->fecha_modificacion =$fecha_modificacion;}

    //$id_usuario_creacion
    public function getId_usuario_creacion(){ return $this->id_usuario_creacion;}
    public function setId_usuario_creacion($id_usuario_creacion = 1) { $this->id_usuario_creacion =$id_usuario_creacion;}

    //id_usuario_modificacion
    public function getId_usuario_modificacion(){ return $this->id_usuario_modificacion;}
    public function setId_usuario_modificacion($id_usuario_modificacion = 1) { $this->id_usuario_modificacion =$id_usuario_modificacion;}

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
