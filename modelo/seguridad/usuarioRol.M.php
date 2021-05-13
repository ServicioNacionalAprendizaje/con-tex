<?php

class UsuarioRol
{
    private $idUsuarioRol;
    private $idRol;
    private $idUsuario;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
   

    //idUsuarioRol
    public function getIdUsuarioRol()
    {
        return $this->idUsuarioRol;
    }
    public function setIdUsuarioRol($idUsuarioRol)
    {
        $this->idUsuarioRol = $idUsuarioRol;
    }

    //idRol
    public function getIdRol()
    {
        return $this->idRol;
    }
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    //idUsuario
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    //estado
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
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion=1)
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
        $sentenciaSql = "CALL Agregar_usuario_rol(
                            $this->idUsuario
                            , $this->idRol
                            ,'$this->estado'
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_usuario_rol(
                            $this->idUsuario
                            , $this->idRol
                            ,'$this->estado'
                            , $this->idUsuarioModificacion
                            , $this->idUsuarioRol)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM usuario_rol 
                            WHERE id_usuario_rol = $this->idUsuarioRol";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM usuario_rol $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idUsuarioRol !=''){
            $condicion=$whereAnd.$condicion." id_usuario_rol  = $this->idUsuarioRol";
            $whereAnd = ' AND ';
        }
        // if($this->usuarioRol !=''){
        //     $condicion=$condicion.$whereAnd." usuarioRol LIKE '%$this->usuarioRol%' ";
        //     $whereAnd = ' AND ';
        //     return $condicion;
        // }
        return $condicion;
    }

    public function __destruct()
    {
        unset($this->idUsuarioRol);
        unset($this->idRol);
        unset($this->idUsuario);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
