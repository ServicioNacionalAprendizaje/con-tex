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
   
    
    /**
     * Obtiene el id de UsuarioRol
     * @access public
     * @return integer $idUsuarioRol
     */
    public function getIdUsuarioRol()
    {
        return $this->idUsuarioRol;
    }
    
    /**
     * Colocar el id de UsuarioRol
     * @access public
     * @param integer $idUsuarioRol
     * @return void
     */
    public function setIdUsuarioRol($idUsuarioRol)
    {
        $this->idUsuarioRol = $idUsuarioRol;
    }
    
    /**
     * Obtiene el idRol de UsuarioRol
     * @access public
     * @return integer idRol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }
    
    /**
     * Colocar el idRol en UsuarioRol
     * @access public
     * @param mixed $idRol
     * @return void
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }
    
    /**
     * Obtener el idUsuario de UsuarioRol
     * @access public
     * @return integer $idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    
    /**
     * Colocar el idUsuario en UsuarioRol
     * @access public
     * @param mixed $idUsuario
     * @return void
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    
    /**
     * Obtener el estado de UsuarioRol
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado en UsarioRol
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de UsuarioRol
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
        
    /**
     * Colocar la fecha de creación de UsuarioRol
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de UsuarioRol
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de UsuarioRol
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la iteración del objeto UsuarioRol
     * @access public
     * @return void
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración del objeto UsuarioRol
     * @access public
     * @param $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la modificación del objeto UusuarioRol
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
        
    /**
     * Colocar el id del usuario que hizo la modificación del objeto UsuarioRol
     * @access public
     * @param mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion=1)
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
     * Agregar UsuarioRol a la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Modificar UsuarioRol en la base de datos
     * @access public
     * @return true
     */
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
    
    /**
     * Eliminar UsuarioRol de la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM usuario_rol 
                            WHERE id_usuario_rol = $this->idUsuarioRol";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consultar UsuarioRol en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            ur.id_usuario_rol
                            ,u.id_usuario
                            ,u.usuario AS nombre_usuario
                            ,r.id_rol
                            ,r.descripcion AS descripcion_rol
                            ,ur.estado
                            ,ur.fecha_creacion
                            ,ur.fecha_modificacion
                            ,ur.id_usuario_creacion
                            ,ur.id_usuario_modificacion
                        FROM
                            rol AS r
                        INNER JOIN usuario_rol AS ur ON r.id_rol = ur.id_rol
                        INNER JOIN usuario AS u ON ur.id_usuario = u.id_usuario
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Obtiene la condición WHERE para añadirla en la $sentenciaSql
     * @access public
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idUsuarioRol !=''){
            $condicion=$whereAnd.$condicion." id_usuario_rol  = $this->idUsuarioRol";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de UsuarioRol
     * @access public
     * @return void
     */
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
