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
    
    //idGenerarPago
    public function getIdGenerarPago()
    {
        return $this->idGenerarPago;
    }
    public function setIdGenerarPago($idGenerarPago)
    {
        $this->idGenerarPago = $idGenerarPago;
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


    //fechaInicio
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
    //idEmpleado
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
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
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }

    //conexion
    public function __contruct()
    {
        $this->conn = new Conexion();
    }

    //Generar valor pago
    public function Generar()
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
    }

    //Agregar
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_generar_pago('$this->valorPago'
                            ,'$this->fechaInicio'
                            ,'$this->fechaFin'
                            ,'$this->fechaPago'
                            ,'$this->idEmpleado'
                            ,'$this->idUsuarioCreacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_generar_pago('$this->valorPago'
                            ,'$this->fechaInicio'
                            ,'$this->fechaFin'
                            ,'$this->fechaPago'
                            ,'$this->idEmpleado'
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
        $this->conn->ejectutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM generar_pago $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        // $whereAnd = " WHERE ";
        // $condicion = " ";
        // if($this->idEmpleado !=''){
        //     $condicion=$whereAnd.$condicion." pd.id_pago_dia  = $this->idPagoDia";
        //     $whereAnd = ' AND ';
        // }
    }

    public function __destruct()
    {
        unset($this->idGenerarPago);
        unset($this->valorPago);
        unset($this->fechaInicio);
        unset($this->fechaFin);
        unset($this->fechaPago);
        unset($this->idEmpleado);
        unset($this->conn);
    }
}
