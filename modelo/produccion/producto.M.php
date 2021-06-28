<?php

/**
 * Producto
 */
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
    
    /**
     * Obtener el id de Producto
     * @access public
     * @return interger $idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    
    /**
     * Colocar el id de Producto
     * @access public
     * @param integer $idProducto
     * @return void
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }
    
    /**
     * Obtener la descripción de Producto
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    /**
     * Colocar la descripción de Producto
     * @access public
     * @param string $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    
    /**
     * Obtener la talla de producto
     * @access public
     * @return mixed $talla
     */
    public function getTalla()
    {
        return $this->talla;
    }
    
    /**
     * Colocar la talla a Producto
     * @access public
     * @param mixed $talla
     * @return void
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }
    
    /**
     * Obtener el estado de Producto
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado a Producto
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener el idCategoria de Producto
     * @access public
     * @return integer $idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    
    /**
     * Colocar idCategoria a Producto
     * @access public
     * @param integer $idCategoria
     * @return void
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }
    
    /**
     * Obtener la categoria de Producto
     * @access public
     * @return string $categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    /**
     * Colocar la categoria a Producto
     * @access public
     * @param mixed $categoria
     * @return void
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    
    /**
     * Obtener la fecha de creación de Producto
     * @access public
     * @return void
     */
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Producto
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de Producto
     * @access public
     * @return mixed $fechaModificación
     */
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Producto
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setfechaModificacion($fechaModificacion = 1)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Colocar el id del usuario que crea a Prodcuto
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que crea a Producto
     * @access public
     * @param integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modifica a Producto
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modifica a Producto
     * @access public
     * @param integer $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
    
    /**
     * Constructor para realizar la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    
    /**
     * Agregar Producto a la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Modificar Producto en la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Eliminar Producto de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM producto 
                            WHERE id_producto = $this->idProducto";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar Producto de la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Obtiene la condición WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
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
    
    /**
     * Destruye los atributos de Producto
     * @access public
     * @return void
     */
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
