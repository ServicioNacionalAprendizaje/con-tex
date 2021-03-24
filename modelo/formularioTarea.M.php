<?php

class cargo{
    private $id_tarea;
    private $descripcion;
    private $valor_unitario;
    private $cantidad;
    private $id_empleado;
    private $fecha;
    private $estado_pago;
    public $conn=null;

    //id_tarea
    public function getId_tarea(){return $this->id_tarea;}
    public function setId_tarea($id_tarea){$this->id_tarea = $id_tarea;}

    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;} 

    //valor_unitario
    public function getValor_unitario(){return $this->valor_unitario;}
    public function setValor_unitario($valor_unitario){$this->valor_unitario = $valor_unitario;}


    //cantidad
    public function getCantidad(){ return $this->cantidad;}
    public function setCantidad($cantidad) { $this->cantidad =$cantidad;}

    //id_empleado
    public function getId_empleado(){ return $this->id_empleado;}
    public function setId_empleado($id_empleado) { $this->id_empleado =$id_empleado;}

    //fecha
    public function getFecha(){ return $this->fecha;}
    public function setFecha($fecha = 1) { $this->fecha =$fecha;}

    //estado_pago
    public function getEstado_pago(){ return $this->estado_pago;}
    public function setEstado_pago($estado_pago = 1) { $this->estado_pago =$estado_pago;}

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
