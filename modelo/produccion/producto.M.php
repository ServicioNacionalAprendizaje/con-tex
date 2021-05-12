<?php

class Producto
{
    private $idProducto;
    private $descripcion;
    private $talla;
    private $estado;
    private $idCategoria;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idProducto
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
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

    //talla
    public function getTalla()
    {
        return $this->talla;
    }
    public function setTalla($talla)
    {
        $this->talla = $talla;
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

    //idCategoria
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    //fechaCreacion
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setfechaCreacion($fechaCreacion = 1)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //fechaModificacion
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setfechaModificacion($fechaModificacion = 1)
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
        $sentenciaSql = "CALL Agregar_producto(
                            '$this->descripcion'
                            ,'$this->talla'
                            ,'$this->estado'
                            , $this->idCategoria
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_producto(
                            '$this->descripcion'
                            ,'$this->talla'
                            ,'$this->estado'
                            , $this->idCategoria
                            ,'$this->idUsuarioModificacion'
                            , $this->idProducto)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM producto 
                            WHERE id_producto = $this->idProducto";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM producto $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idProducto !=''){
            $condicion=$whereAnd.$condicion." id_producto  = $this->idProducto";
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
        unset($this->idProducto);        
        unset($this->descripcion);
        unset($this->talla);
        unset($this->estado);
        unset($this->idCategoria);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
