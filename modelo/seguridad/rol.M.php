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

    $sentenciaSql = "INSERT INTO pago_dia(
        id_empleado
        ,pago_dia
        ,estado
        ,fecha_creacion
        ,fecha_modificacion
        ,id_usuario_creacion
        ,id_usuario_modificacion
        ) 
    VALUES (
        $this->idEmpleado,
        '$this->pagoDia',
        '$this->estado',
        '$this->fechaCreacion',
        '$this->fechaModificacion',
        '$this->idUsuarioCreacion',
        '$this->idUsuarioModificacion'
        )";

$this->conn->preparar($sentenciaSql);
$this->conn->ejecutar();
return true;
}

public function Modificar(){
    $sentenciaSql = "UPDATE pago_dia SET 
    id_empleado = '$this->idEmpleado'
    pago_dia = '$this->pagoDia'
    estado = '$this->estado'
    fecha_creacion = '$this->fechaCreacion'
    fecha_modificacion = '$this->fechaModificacion'
    id_usuario_creacion = '$this->idUsuarioCreacion'
    id_usuario_modificacion = '$this->idUsuarioModificacion' 
    WHERE id_pago_dia = $this->idPagoDia ";        
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
}

public function Eliminar(){
    $sentenciaSql = "DELETE FROM 
        pago_dia 
    WHERE 
        id_pago_dia = $this->idPagoDia";        
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
}

public function Consultar(){
    $condicion = $this->obtenerCondicion();
    $sentenciaSql = "SELECT
       *
    FROM
        pago_dia $condicion";        		
    
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
}
private function obtenerCondicion(){
    
    
}


public function __destruct() {
    
    unset($this->idEmpleado);
    unset($this->pagoDia);
    unset($this->estado);
    unset($this->fechaCreacion);
    unset($this->fechaModificacion);
    unset($this->idUsuarioCreacion);
    unset($this->idUsuarioModificacion);
    unset($this->conn);
}       
}
?>