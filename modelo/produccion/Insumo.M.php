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
    
    /**
     * Colocar el id de Insumo
     * @access public
     * @param  integer $idInsumo
     * @return void
     */
    public function setIdInsumo($idInsumo)
    {
        $this->idInsumo = $idInsumo;
    }
    
    /**
     * Obtener la descripcion de Insumo
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    /**
     * Colocar la descripcion de Insumo
     * @access public
     * @param  string $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    
    /**
     * Obtener la cantidad de Insumo
     * @access public
     * @return integer $cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    /**
     * Colocar la cantidad de Insumo
     * @access public
     * @param  mixed $cantidad
     * @return void
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    
    /**
     * Obtener la categoria de Insumo
     * @access public
     * @return integer $idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    
    /**
     * Colocar la categoria de Insumo
     * @access public
     * @param  mixed $idCategoria
     * @return void
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }
    
    /**
     * Obtener la categoria de Insumo
     * @access public
     * @return string $categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    /**
     * Colocar la categoria de Insumo
     * @access public
     * @param  mixed $categoria
     * @return void
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    
    /**
     * Obtener el estado de Insumo
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado de Insumo
     * @access public
     * @param  mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de Insumo
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Insumo
     * @access public
     * @param  mixed $fechaCreacion
     * @return void
     */
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de Insumo
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Insumo
     * @access public
     * @param  mixed $fechaModificacion
     * @return void
     */
    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la iteración del objeto Insumo
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración del objeto Insumo
     * @access public
     * @param  mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modificó Insumo
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la modificación de Insumo
     * @access public
     * @param  mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
    
    /**
     * Contructor para realizar la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    
    /**
     * Agregar Insumo a la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Modificar Insumo en la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Eliminar Insumo de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM insumo 
                            WHERE id_insumo = $this->idInsumo";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar Insumo en la base de datos
     * @access public
     * @return void
     */
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
    
    /**
     * Obtener la condición WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condición
     */
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
    
    /**
     * Destruye los atributos de Insumo
     * @access public
     * @return void
     */
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
