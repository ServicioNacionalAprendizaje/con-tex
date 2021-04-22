<?php

class pagoDia
{

    private $idPagoDia;
    private $idEmpleado;
    private $pagoDia;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idPagoDia
    public function getIdPago()
    {
        return $this->idPagoDia;
    }
    public function setIdPago($idPagoDia)
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
    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_pago_dia('$this->idEmpleado'
                            ,'$this->pagoDia'
                            ,'$this->idUsuarioCreacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_pago_dia('$this->idEmpleado'
                            ,'$this->pagoDia'
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
        $sentenciaSql = "SELECT * 
                            FROM pago_dia $condicion";
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
    }
}
