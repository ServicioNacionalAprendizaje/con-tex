<?php

/**
 * FormularioRol
 */
class FormularioRol
{
    private $idFormularioRol;
    private $idRol;
    private $idFormulario;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
   
    
    /**
     * Obtener el id de FormularioRol
     * @access public
     * @return integer $idFormularioRol
     */
    public function getIdFormularioRol()
    {
        return $this->idFormularioRol;
    }
    
    /**
     * Colocar el id de FormularioRol
     * @access public
     * @param  integer $idFormularioRol
     * @return void
     */
    public function setIdFormularioRol($idFormularioRol)
    {
        $this->idFormularioRol = $idFormularioRol;
    }
    
    /**
     * Obtiene el idRol de FormularioRol
     * @access public
     * @return integer idRol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }
    
    /**
     * Colocar el idRol de FormularioRol
     * @access public
     * @param  mixed $idRol
     * @return void
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }
    
    /**
     * Obtener idFormulario de FormularioRol
     * @access public
     * @return integer $idFormulario
     */
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }
    
    /**
     * Colocar el idFormulario de FormularioRol
     * @access public
     * @param  mixed $idFormulario
     * @return void
     */
    public function setIdFormulario($idFormulario)
    {
        $this->idFormulario = $idFormulario;
    }
    
    /**
     * Obtener el estado de FormularioRol
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado a FormularioRol
     * @access public
     * @param  mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de FormularioRol
     * @access public
     * @return mixed $idFormularioRol
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de FormularioRol
     * @access public
     * @param  mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de FormularioRol
     * @access public
     * @return void
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de FormularioRol
     * @access public
     * @param  mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la iteración del objeto FormularioRol
     * @access
     * @return void
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración del objeto FormularioRol
     * @access public
     * @param  integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modificó el objeto FormularioRol
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
        
    /**
     * Colocar el id del usuario que modificó al objeto FormularioRol
     * @access public
     * @param integer $idUsuarioModificacion=1
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion=1)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
    
    /**
     * Constructor para realizar la conexion a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    
    /**
     * Agregar FormularioRol a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion'
                            ,'$this->idUsuarioModificacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar FormularioRol en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idFormularioRol')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Eliminar FormularioRol de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM formulario_rol 
                            WHERE id_formulario_rol = $this->idFormularioRol";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consultar FormularioRol en la base de datos
     * @access public
     * @return void
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            fr.id_formulario_rol
                            ,r.id_rol
                            ,r.descripcion AS descripcion_rol
                            ,f.id_formulario
                            ,f.descripcion AS descripcion_formulario
                            ,fr.estado
                            ,fr.fecha_creacion
                            ,fr.fecha_modificacion
                            ,fr.id_usuario_creacion
                            ,fr.id_usuario_modificacion
                        FROM
                            formulario AS f
                        INNER JOIN formulario_rol AS fr ON f.id_formulario = fr.id_formulario
                        INNER JOIN rol AS r ON fr.id_rol = r.id_rol
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Obtener la condición WHERE para añadirla a la $sentenciaSql
     * @access public
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if ($this->idFormularioRol !='') {
            $condicion=$whereAnd.$condicion." id_formulario_rol  = $this->idFormularioRol";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de FormularioRol
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idFormularioRol);
        unset($this->idRol);
        unset($this->idFormulario);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
