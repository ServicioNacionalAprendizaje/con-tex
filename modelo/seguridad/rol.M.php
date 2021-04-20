<?php

class Rol{
    private $idRol;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idRol
    public function getIdRol(){return $this->idRol;}
    public function setIdRol($idRol){$this->idRol = $idRol;}

    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}

     //estado
     public function getEstado(){ return $this->estado;}
     public function setEstado($estado) { $this->estado =$estado;}

     //fechaCreacion
    public function getfechaCreacion(){ return $this->fechaCreacion;}
    public function setfechaCreacion($fechaCreacion = 1) { $this->fechaCreacion =$fechaCreacion;}

    //fechaModificacion
    public function getfechaModificacion(){ return $this->fechaModificacion;}
    public function setfechaModificacion($fechaModificacion = 1) { $this->fechaModificacion =$fechaModificacion;}


    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1) { $this->idUsuarioModificacion =$idUsuarioModificacion;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
    $sentenciaSql = "CAll Agregar_rol('$this->descripcion'
                        ,'$this->estado'
                        ,'$this->idUsuarioCreacion')"
$this->conn->preparar($sentenciaSql);
$this->conn->ejecutar();
return true;
}

public function Modificar(){
    $sentenciaSql = "CALL Modificar_rol('$this->descripcion'
                        ,'$this->estado'
                        ,'$this->idUsuarioModificacion'
                        ,''$this->idRol)"
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
}

public function Eliminar(){
    $sentenciaSql = "DELETE FROM 
        rol 
    WHERE 
        id_rol = $this->idRol";        
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
}

public function Consultar(){
    $condicion = $this->obtenerCondicion();
    $sentenciaSql = "SELECT
       *
    FROM
        rol $condicion";        		
    
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
}
private function obtenerCondicion(){
 
}


public function __destruct() {
    
    unset($this->idRol);
    unset($this->descripcion);
    unset($this->estado);
    unset($this->fechaCreacion);
    unset($this->fechaModificacion);
    unset($this->idUsuarioCreacion);
    unset($this->idUsuarioModificacion);
    unset($this->conn);
}       
}
?>