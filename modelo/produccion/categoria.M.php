<?php

/**
 * Categoria
 */
class Categoria
{
    private $idCategoria;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de Categoria
     * @access public
     * @return integer $idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    
    /**
     * Colocar el id de Categoria
     * @access public
     * @param mixed $idCategoria
     * @return void
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }
        
    /**
     * Obtener la descripción de Categoria
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
        
    /**
     * Colocar la descipcion de Categoria
     * @access public
     * @param mixed $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
        
    /**
     * Obtener el estado de Categoria
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar estado en Categoria
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
        
    /**
     * Obtener la fecha de creación de Categoria
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Categoria
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
        
    /**
     * Obtener la fecha de modificación de Categoria
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Categoria
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
        
    /**
     * Obtener el id del usuario que hizo la iteración del objeto Categoria
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración del objeto Categoria
     * @access public
     * @param mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
        
    /**
     * Obtener el id del usuario que hizo la modificación de Categoria
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la modificación de Categoria
     * @access public
     * @param mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
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
     * Agregar Categoria a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_categoria(
                            '$this->descripcion'
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }    
    /**
     * Modificar Categoria en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_categoria(
                            '$this->descripcion'
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idCategoria)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Eliminar Categoria de la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM categoria 
                            WHERE id_categoria = $this->idCategoria";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }    
    /**
     * Consultar Categoria en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT *

                            FROM categoria

                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obtener la condicón WHERE para añadirle en la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idCategoria !=''){
            $condicion=$whereAnd.$condicion." id_categoria  = $this->idCategoria";
            $whereAnd = ' AND ';
        }
        if($this->idCategoria !=''){
            $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }        
        return $condicion;
    }
        
    /**
     * Destruye los atributos de Categoria
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idCategoria);
        unset($this->descripcion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}