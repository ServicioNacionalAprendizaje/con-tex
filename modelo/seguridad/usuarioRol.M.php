<?php

class UsuarioRol
{
    private $idUsuarioRol;
    private $idUsuario;
    private $idRol;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    public $conn = null;

    //IdUsuario
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    //IdRol
    public function getIdRol()
    {
        return $this->idRol;
    }
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    //Estado
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    //FechaCreacion
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion = 1)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //FechaModificacion
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    //IdUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //IdUsuarioModificacion
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
        $sentenciaSql = "CALL Agregar_usuario_rol('$this->idUsuario'
                            ,'$this->idRol'
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_usuario_rol('$this->idUsuario'
                            ,'$this->idRol'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idUsuarioRol')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM orden 
                            WHERE id_orden = $this->idOrden";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM orden $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    private function obtenerCondicion()
    {
    }

    public function __destruct()
    {

        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
