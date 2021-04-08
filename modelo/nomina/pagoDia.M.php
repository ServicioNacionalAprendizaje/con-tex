<?php

class pagoDia{

    private $idPagoDia;
    private $idEmpleado;
    private $pagoDia;

    //idPagoDia
    public function getIdPago(){return $this->idPagoDia;}
    public function setIdPago($idPagoDia){$this->idPagoDia = $idPagoDia;}

    //idEmpleado
    public function getIdEmpleado(){return $this->idEmpleado;}
    public function setIdEmpleado($idEmpleado){$this->idEmpleado = $idEmpleado;}

    //pagoDia
    public function getPagoDia(){return $this->pagoDia;}
    public function setPagoDia($pagoDia){$this->pagoDia = $pagoDia;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
        $sentenciaSql = "INSERT INTO pagoDia(
            id_empleado
            ,pago_dia
            ) 
        VALUES (
            '$this->usuario'
            ,'$this->contrasenia' 
            )";

    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
    }

    public function Modificar(){
        $sentenciaSql = "UPDATE pagoDia SET 
        id_empleado = '$this->idEmpleado',
        pago_dia = '$this->pagoDia',
        WHERE id_usuario = $this->idUsuario ";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            pagoDia
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
    private function obtenerCondicion(){}

    public function __destruct() {
        
        unset($this->idPagoDia);
        unset($this->idEmpleado);
        unset($this->pagoDia);
    }
}
?>