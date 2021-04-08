<?php

class GenerarPago{

    private $idGenerarPago;
    private $valorPago;
    private $deduccion;
    private $fechaInicio;
    private $fechaFin;
    private $idEmpleado;

    //idGenerarPago
    public function getIdGenerarPago(){return $this->iddGenerarPago;}
    public function setIdGenerarPago($idGenerarPago){$this->idGenerarPago = $idGenerarPago;}

    //valorPago
    public function getValorPago(){return $this->valorPago;}
    public function setValorPago($valorPago){$this->valorPago = $valorPago;}

    //deduccion
    public function getDeduccion(){return $this->deduccion;}
    public function setDeduccion($deduccion){$this->deduccion = $deduccion;}

    //fechaInicio
    public function getFechaInicio(){return $this->fechaInicio;}
    public function setFechaInicio($fechaInicio){$this->fechaInicio = $fechaInicio;}

    //fechaFin
    public function getFechaFin(){return $this->fechaFin;}
    public function setFechaFin($fechaFin){$this->fechaFin = $fechaFin;}

    //idEmpleado
    public function getIdEmpleado(){return $this->IdEmpleado;}
    public function setIdEmpleado($idEmpleado){$this->idEmpleado = $idEmpleado;}

    //conexion
    public function __contruct() {$this->conn = new Conexion();}

    //Agregar
    public function Agregar(){
        $sentenciaSql = "INSERT INTO generar_pago(
            id_generar_pago
            ,valor_pago
            ,deduccion
            ,fecha_inicio
            ,fecha_fin
            ,id_empleado
        )
        VALUES (
            '$this->idGenerarPago'
            ,'$this->valorPago'
            ,'$this->deduccion'
            ,'$this->fechaInicio'
            ,'$this->fechaFin'
            ,'$this->idEmpleado'
        )";

    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;
    }

    public function Modificar(){
        $sentenciaSql = "UPDATE generar_pago SET
        valor_pago = '$this->usuario',
        deduccion = '$this->deduccion',
        fecha_inicio = '$this->fechaInicio',
        fecha_fin = '$this->fechaFin',
        id_empleado = '$this->idEmpleado'
        WHERE id_generar_pago = $this->getIdGenerarPago";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM
            generar_pago
        WHERE
            id_generar_pago = $this->idGenerarPago";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejectutar();
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
            *
        FROM
            generar_pago $condicion";
    }
}
?>