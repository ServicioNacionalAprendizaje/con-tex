<?php

class Rol
{
    private $idRol;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idRol
    public function getIdRol()
    {
        return $this->idRol;
    }
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    //descripcion
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //fechaModificacion
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setfechaModificacion($fechaModificacion)
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
        $sentenciaSql = "CALL Agregar_rol(
                             '$this->descripcion'
                            ,'$this->estado'
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_rol(
                             '$this->descripcion'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            , $this->idRol)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM rol 
                            WHERE id_rol = $this->idRol";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM rol $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idRol !=''){
            $condicion=$whereAnd.$condicion." id_rol  = $this->idRol";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
                $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
                $whereAnd = ' AND ';
        }        
        // if($this->estado!=''){
        //         if ($whereAnd == ' AND '){
        //         $condicion=$condicion.$whereAnd." seg_usu.estado = '$this->estado'";
        //         $whereAnd = ' AND ';
        //         }
        //         else{
        //         $condicion=$whereAnd.$condicion." seg_usu.estado = '$this->estado'";
        //         $whereAnd = ' AND ';
        //         }
        //     }
        // if($this->fechaActivacion!=''){
        //         $condicion=$condicion.$whereAnd." seg_usu.fecha_activacion = '$this->fechaActivacion' ";
        //         $whereAnd = ' AND ';
        // }
        // if($this->fechaExpiracion!=''){
        //         $condicion=$condicion.$whereAnd." seg_usu.fecha_expiracion = '$this->fechaExpiracion' ";
        //         $whereAnd = ' AND ';
        // }
        return $condicion;
    }

    public function __destruct()
    {
        unset($this->idRol);
        unset($this->descripcion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
