<?php

/**
 * Insumo
 */
class Insumo
{
    private $idInsumo;
    private $descripcion;
    private $cantidad;
    private $estado;
    private $idCategoria;
    private $categoria;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de Insumo
     * @access public
     * @return void
     */
    public function getIdInsumo()
    {
        return $this->idInsumo;
    }

    public function setIdInsumo($idInsumo)
    {
        $this->idInsumo = $idInsumo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }

    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }

    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }

    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }

    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_insumo(
                            '$this->descripcion'
                            ,'$this->cantidad'
                            , $this->idCategoria
                            ,'$this->estado'
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_insumo(
                            '$this->descripcion'
                            ,'$this->cantidad'
                            , $this->idCategoria
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            , $this->idInsumo)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM insumo 
                            WHERE id_insumo = $this->idInsumo";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            i.id_insumo
                            ,i.descripcion
                            ,c.id_categoria
                            ,c.descripcion AS descripcion_cat
                            ,i.cantidad
                            ,i.estado
                        FROM
                            insumo AS i
                        INNER JOIN categoria AS c ON c.id_categoria = i.id_categoria
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

        if($this->idInsumo !=''){
            $condicion=$whereAnd.$condicion." i.id_insumo  = $this->idInsumo";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
            $condicion=$condicion.$whereAnd." i.descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }
        if($this->idCategoria!=''){
            $condicion=$condicion.$whereAnd." c.id_categoria = '$this->idCategoria'";
            $whereAnd = ' AND ';
        }
        if($this->estado!=''){
            $condicion=$condicion.$whereAnd." i.estado = '$this->estado'";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }

    public function __destruct()
    {
        unset($this->idInsumo);        
        unset($this->descripcion);
        unset($this->cantidad);
        unset($this->estado);
        unset($this->idCategoria);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
