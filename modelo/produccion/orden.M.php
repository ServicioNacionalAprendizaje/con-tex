<?php

class Orden{

    private $idOrden;
    private $fechaOrden;
    private $fechaEntrega;
    private $descripcion;
    private $idCliente;
    private $idEmpleado;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    //idOrden
    public function getIdOden(){return $this->idOrden;}
    public function setIdOrden($idOrden){return $this->idOrden=$idOrden;}

    //fechaOrden
    public function getFechaOrden(){return $this->fechaOrden;}
    public function setFechaOrden($fechaOrden){return $this->fechaOrden=$fechaOrden;}

    //fechaEntrega
    public function getFechaEntrega(){return $this->fechaEntrega;}
    public function setFechaEntrega($fechaEntrega){return $this->fechaEntrega=$fechaEntrega;}

    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){return $this->descripcion = $descripcion;}

    //idCcliente
    public function getIdCliente(){return $this->idCliente;}
    public function setIdCliente($idCliente){return $this->idcliente=$idCliente;}

    //idEmpleado
    public function getIddEmpleado(){return $this->idEmpleado;}
    public function setIdEmpleado($idEmpleado){return $this->idEmpleado = $idEmpleado;}

    //estado
    public function getEstado(){ return $this->estado;}
    public function setEstado($estado) { $this->estado =$estado;}


    //fechaCreacion
    public function getfechaCreacion(){ return $this->fechaCreacion;}
    public function setfechaCreacion($fechaCreacion) { $this->fechaCreacion =$fechaCreacion;}

    //fechaModificacion
    public function getfechaModificacion(){ return $this->fechaModificacion;}
    public function setfechaModificacion($fechaModificacion) { $this->fechaModificacion =$fechaModificacion;}


    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1) { $this->idUsuarioModificacion =$idUsuarioModificacion;}

    //conexion
    public function __construct() {$this->conn = new Conexion;}
    
    public function Agregar(){
        $sentenciaSql = "INSERT INTO orden(
            fecha_orden
            ,fecha_entrega
            ,descripcion
            ,id_cliente
            ,id_empleado
            ,estado
            ,fecha_creacion
            ,fecha_modificacion
            ,id_usuario_creacion
            ,id_usuario_modificacion
        )
        VALUES(
            '$this->fechaOrden'
            ,'$this->fechaEntrega'
            ,'$this->descripcion'
            ,$this->idCliente
            ,$this->idEmpleado
            ,'$this->estado'
            ,'$this->fechaCreacion'
            ,'$this->fechaModificacion'
            ,$this->idUsuarioCreacion
            ,$this->idUsuarioModificacion
            )";

    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
    }

    public function Modificar(){
        $sentenciaSql = "UPDATE orden SET 
        fecha_orden = '$this->fechaOrden', 
        fecha_entrega = '$this->fechaEmtrega',
        descripcion = '$this->descripcion', 
        id_cliente = '$this->idCliente',
        id_empleado = '$this->idEmpleado'
        estado = '$this->estado'
        fecha_creacion = '$this->fechaCreacion'
        fecha_modificacion = '$this->fechaModificacion'
        id_usuario_creacion = '$this->idUsuarioCreacion'
        id_usuario_modificacion = '$this->idUsuarioModificacion' 
        WHERE id_orden = $this->idOrden ";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            orden 
        WHERE 
            id_orden = $this->idOrden";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
           *
        FROM
            orden $condicion";        		
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    private function obtenerCondicion(){}

    public function __destruct() {
        
        unset($this->idOrden);
        unset($this->fechaOrden);
        unset($this->fechaEntrega);
        unset($this->descripcion);
        unset($this->idCliente);
        unset($this->idEmpleado);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }       
}
?>
