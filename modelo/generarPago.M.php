<?php

class GenerarPago{
    private $idGenerarPago;
    private $valorPago;
    private $deduccion;
    private $fechaInicio;
    private $FechaFin;
    private $idEmpleado;
    
   
    public $conn=null;

    //IdGenerarPago
    public function getIdGenerarPago(){return $this->idGenerarPago;}
    public function setIdGenerarPago($idGenerarPago){$this->idGenerarPago = $idGenerarPago;}

    //ValorPago
    public function getValorPago(){return $this->valorPago;}
    public function setValorPago($valorPago){$this->valorPago = $valorPago;}

    //Deduccion
    public function getDeduccion(){return $this->deduccion;}
    public function setDeduccion($deduccion){$this->deduccion = $deduccion;} 

    //FechaInicio
    public function getFechaInicio(){ return $this->fechaInicio;}
    public function setFechaInicio($fechaInicio = 1) { $this->fechaInicio =$fechaInicio;}

    //FechaFin
    public function getFechaFin(){ return $this->fechaFin;}
    public function setFechaFin($fechaFin) { $this->fechaFin =$fechaFin;}

    //IdEmpleado
    public function getIdEmpleado(){ return $this->idEmpleado;}
    public function setIdEmpleado($idEmpleado = 1) { $this->idEmpleado =$idEmpleado;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    $sentenciaSql = "INSERT INTO orden(
        valorPago
        ,deduccion
        ,fechaInicio
        ,fechaFin
        ,idEmpleado
        ) 
    VALUES (
        '$this->valorPago',
        '$this->deduccion', 
        '$this->fechaInicio',
        '$this->fechaFin',
        '$this->idEmpleado',
        )";

$this->conn->preparar($sentenciaSql);
$this->conn->ejecutar();
return true;
}
    public function Modificar(){
    $sentenciaSql = "UPDATE orden SET 
    valorPago = '$this->valorPago', 
    deduccion = '$this->deduccion', 
    fechaInicio = '$this->fechaInicio', 
    fechaFin = '$this->fechaFin',
    idEmpleado = '$this->idEmpleado',
    
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
     private function obtenerCondicion(){ 

  }

    public function __destruct() {
        
        unset($this->valorPago);
        unset($this->deduccion);
        unset($this->fechaInicio);
        unset($this->fechaFin);
        unset($this->idEmpleado);
      
?>
