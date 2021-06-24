<?php
/**
 * Usuario
 */
class Usuario
{
    private $idUsuario;
    private $usuario;
    private $contrasenia;
    private $fechaActivacion;
    private $fechaExpiracion;
    private $idPersona;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    
    /**
     * Obtener el id de usuario
     * @access public
     * @return integer $idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    
    /**
     * Colocar el id a usuario
     * @access public
     * @param mixed $idUsuario
     * @return void
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    
    /**
     * Obtener el nombre de usuario
     * @access public
     * @return void
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    /**
     * Colocar el nombre de usuario
     * @access public
     * @param mixed $usuario
     * @return string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    
    /**
     * Obtener la contraseña de usuario
     * @access public
     * @return mixed $contrasenia
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    
    /**
     * Colocar la contraseña a usuario
     * @access public
     * @param mixed $contrasenia
     * @return void
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }
    
    /**
     * Obtener la fecha de activacion de usuario
     * @access public
     * @return mixed $fechaActivacion
     */
    public function getFechaActivacion()
    {
        return $this->fechaActivacion;
    }
    
    /**
     * Colocar la fecha de activación a usuario
     * @access public
     * @param mixed $fechaActivacion
     * @return void
     */
    public function setFechaActivacion($fechaActivacion)
    {
        $this->fechaActivacion = $fechaActivacion;
    }
    
    /**
     * Obtener la fecha de expiración de usuario
     * @access public
     * @return mixed $fechaExpiracion
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }
    
    /**
     * Colocar la fecha de expiración a usuario
     * @access public
     * @param mixed $fechaExpiracion
     * @return void
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
    }
    
    /**
     * Obtener el id de persona de usuario
     * @access public
     * @return integer $idPersona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    
    /**
     * Colocar el id de persona a usuario
     * @access public
     * @param integer $idPersona=1
     * @return void
     */
    public function setIdPersona($idPersona=1)
    {
        $this->idPersona = $idPersona;
    }
    
    /**
     * Obtener el estado de usuario
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado a usuario
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de usuario
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación a usuario
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de usuario
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación a usuario
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la iteración del objeto usuario
     * @access public
     * @return void
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración del objeto usuario
     * @access public
     * @param $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modificó el objeto usuario
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modificó el objeto usuario
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
     * Agregar usuario a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_usuario(
                            '$this->usuario'
                            ,'$this->contrasenia'
                            ,'$this->fechaActivacion'
                            ,'$this->fechaExpiracion'
                            ,$this->idPersona
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar usuario en la base de datos
     * @access public
     * @return void
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_usuario(
                             '$this->usuario'
                            ,'$this->contrasenia'
                            ,'$this->fechaActivacion'
                            ,'$this->fechaExpiracion'
                            ,$this->idPersona
                            ,'$this->estado'
                            ,$this->idUsuario
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Eliminar usuario de la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM usuario 
                            WHERE id_usuario = $this->idUsuario";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consultar usuario en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                        u.id_usuario
                        ,u.usuario
                        ,u.contrasenia
                        ,u.fecha_activacion
                        ,u.fecha_expiracion
                        ,u.estado
                        ,p.id_persona
                        ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                    FROM 
                        usuario AS u                        
                        INNER JOIN persona AS p ON u.id_persona = p.id_persona
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Restablecer la contraseña de usuario
     * @access public
     * @return true
     */
    public function Restablecer()
    {
        $sentenciaSql = "UPDATE usuario 
                         SET id_usuario = $this->idUsuario
                            ,contrasenia = '$this->contrasenia' 
                            ,fecha_modificacion = NOW() 
                            ,id_usuario_modificacion = $this->idUsuario
                         WHERE id_usuario = $this->idUsuario;
                        ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Construye la carpeta del usuario
     * @access public
     * @return true
     */
    public function construirCarpeta()
    {
        $sentenciaSql = "CALL Obtener_carpeta($this->idUsuario)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consulta las credenciales de usuario y contraseña en la base de datos para el inicio de sesión
     * @access public
     * @return true
     */
    public function login()
    {
        $sentenciaSql = "CALL Obtener_login('$this->usuario','$this->contrasenia')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obtiene la condicion WHERE para agregar a la $sentenciaSql y ejecutar la $sentenciaSql con condición
     * @access public
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if ($this->idUsuario !='') {
            $condicion=$whereAnd.$condicion." u.id_usuario  = $this->idUsuario";
            $whereAnd = ' AND ';
        }
        if ($this->usuario !='') {
            $condicion=$condicion.$whereAnd." u.usuario LIKE '%$this->usuario%' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaActivacion !='') {
            $condicion=$condicion.$whereAnd." u.fecha_activacion LIKE '%$this->fechaActivacion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaExpiracion !='') {
            $condicion=$condicion.$whereAnd." u.fecha_expiracion LIKE '%$this->fechaExpiracion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->estado !='') {
            $condicion=$condicion.$whereAnd." u.estado = '$this->estado' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de usuario
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idUsuario);
        unset($this->usuario);
        unset($this->contrasenia);
        unset($this->fechaActivacion);
        unset($this->fechaExpiracion);
        unset($this->idPersona);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
