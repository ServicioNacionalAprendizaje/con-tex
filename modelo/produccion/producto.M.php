<?php

class Producto
{
    private $idProducto;
    private $descripcion;
    private $talla;
    private $estado;
    private $idCategoria;
    private $categoria;
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

    //categoria
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
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
        $sentenciaSql = "SELECT
                            p.id_producto
                            ,p.descripcion
                            ,c.id_categoria
                            ,c.descripcion AS descripcion_cat
                            ,p.talla
                            ,p.estado
                        FROM
                            producto AS p
                        INNER JOIN categoria AS c ON c.id_categoria = p.id_categoria
                        $condicion
                        ORDER BY descripcion ASC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idProducto !=''){
            $condicion=$whereAnd.$condicion." p.id_producto  = $this->idProducto";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
            $condicion=$condicion.$whereAnd." p.descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }
        if($this->talla !=''){
            $condicion=$condicion.$whereAnd." p.talla LIKE '%$this->talla%' ";
            $whereAnd = ' AND ';
        } 
        if($this->idCategoria!=''){
            $condicion=$condicion.$whereAnd." c.id_categoria = '$this->idCategoria'";
            $whereAnd = ' AND ';
        }
        if($this->estado!=''){
            $condicion=$condicion.$whereAnd." p.estado = '$this->estado'";
            $whereAnd = ' AND ';
        }
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
