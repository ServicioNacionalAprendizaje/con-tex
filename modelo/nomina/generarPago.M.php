<?php

class GenerarPago
{
    private $idGenerarPago;
    private $idEmpleado;
    private $fechaInicio;
    private $fechaFin;
    private $fechaPago;
    private $valorPago;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idPagoDia
    public function getIdGenerarPago()
    {
        return $this->IdGenerarPago;
    }
    public function setIdGenerarPago($idGenerarPago)
    {
        $this->idGenerarPago = $idGenerarPago;
    }

    //idEmpleado
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }

    //pagoInicio
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    //fechaFin
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    //fechaPago
    public function getFechaPago()
    {
        return $this->fechaPago;
    }
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }

    //valorPago
    public function getValorPago()
    {
        return $this->valorPago;
    }
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;
    }

    //fechaCreacion
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //fechaModificacion
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    //idUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }

    //conexion
    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function GenerarPago()
    {
        $sentenciaSql = "SELECT
                            SUM(pago_dia) AS valor_pago
                            FROM pago_dia
                            WHERE
                                id_empleado = $this->idEmpleado
                            AND estado = '0'
                            AND fecha_pago_dia BETWEEN $this->fechaInicio AND $this->fechaFin";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function pagarDias($fechaInicio, $fechaFin)
    {
        $sentenciaSql = "UPDATE
                            pago_dia
                        SET estado = '1'
                        WHERE id_empleado = $this->idEmpleado
                        AND estado = '0'
                        AND fecha_pago_dia BETWEEN $fechaInicio AND $fechaFin";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_generar_pago(
                            '$this->idEmpleado'
                            ,'$this->fechaInicio'
                            ,'$this->fechaFin'
                            ,'$this->fechaPago'
                            ,'$this->valorPago'
                            ,'$this->idUsuarioCreacion'
                            ,'$this->idUsuarioModificacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_generar_pago(
                            '$this->idEmpleado'
                            ,'$this->fechaInicio'
                            ,'$this->fechaFin'
                            ,'$this->fechaPago'
                            ,'$this->valorPago'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idGenerarPago')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM generar_pago 
                            WHERE id_generar_pago = $this->idGenerarPago";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            gp.id_generar_pago
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,gp.fecha_inicio
                            ,gp.fecha_fin
                            ,gp.valor_pago
                            ,gp.fecha_pago
                            ,e.id_empleado
                            ,e.id_persona
                            ,p.id_persona	
                        FROM persona AS p
                        INNER JOIN empleado AS e ON e.id_persona = p.id_persona
                        INNER JOIN generar_pago AS gp ON gp.id_empleado = e.id_empleado
                        $condicion 
                        ORDER BY gp.fecha_pago DESC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function BuscarEmpleado($nombre)
    {
        $sentenciaSql = "SELECT 
                            CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,e.id_empleado 
                        FROM persona AS p 
                            INNER JOIN empleado AS e ON p.id_persona = e.id_persona 
                        WHERE p.estado = '1' AND e.estado = '1' AND nombre LIKE '%$nombre%'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if ($this->idGenerarPago !='') {
            $condicion=$whereAnd.$condicion." gp.id_generar_pago  = $this->idGenerarPago";
            $whereAnd = ' AND ';
        }
        if ($this->idEmpleado!='') {
            $condicion=$condicion.$whereAnd." gp.id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaInicio!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_inicio = '$this->fechaInicio' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaFin!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_fin = '$this->fechaFin' ";
            $whereAnd = ' AND ';
        }
        if ($this->valorPago!='') {
            $condicion=$condicion.$whereAnd." gp.valor_pago = '$this->valorPago' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaPago!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_pago = '$this->fechaPago' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }

    public function __destruct()
    {
        unset($this->idPagoDia);
        unset($this->idEmpleado);
        unset($this->fechaInicio);
        unset($this->fechaFin);
        unset($this->fechaPago);
        unset($this->valorPago);
        unset($this->conn);
    }
}
