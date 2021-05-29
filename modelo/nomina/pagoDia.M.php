<?php

class pagoDia
{

    private $idPagoDia;
    private $idEmpleado;
    private $pagoDia;
    private $fechaPago;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idPagoDia
    public function getIdPagoDia()
    {
        return $this->idPagoDia;
    }
    public function setIdPagoDia($idPagoDia)
    {
        $this->idPagoDia = $idPagoDia;
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

    //pagoDia
    public function getPagoDia()
    {
        return $this->pagoDia;
    }
    public function setPagoDia($pagoDia)
    {
        $this->pagoDia = $pagoDia;
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

    //fechaPago
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
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

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_pago_dia(
                            '$this->idEmpleado'
                            ,'$this->pagoDia'
                            ,'$this->fechaPago'
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_pago_dia(
                            '$this->idEmpleado'
                            ,'$this->pagoDia'
                            ,'$this->fechaPago'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idPagoDia')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM pagoDia 
                            WHERE id_pago_dia = $this->idPagoDia";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            pd.id_pago_dia
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,pd.pago_dia
                            ,pd.fecha_pago
                            ,pd.estado
                            ,e.id_empleado
                            ,e.id_persona
                            ,p.id_persona	
                        FROM persona AS p
                        INNER JOIN empleado AS e ON e.id_persona = p.id_persona
                        INNER JOIN pago_dia AS pd ON pd.id_empleado = e.id_empleado
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
    }

    public function __destruct()
    {

        unset($this->idPagoDia);
        unset($this->idEmpleado);
        unset($this->pagoDia);
        unset($this->fechaPago);
        unset($this->estado);
    }
}
