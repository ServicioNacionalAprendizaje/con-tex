<?php

/**
 * Clase Persona
 */
class Persona
{
    private $idPersona;
    private $nombre;
    private $apellido;
    private $tipoDocumento;
    private $documento;
    private $edad;
    private $genero;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtiene el id de persona
     * @access public
     * @return integer $idPersona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Coloca el id de persona
     * @access public
     * @param integer $idPersona
     * @return void
     */
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    
    /**
     * Obtiene el nombre de persona
     * @access public
     * @return string $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }
        
    /**
     * Coloca el nombre de persona
     * @access public
     * @param string $nombre
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Obtiene el apellido de persona
     * @access public
     * @return string $apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }
    
    /**
     * Coloca el apellido de persona
     * @access public
     * @param string $apellido
     * @return void
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    
    /**
     * Obtiene el tipo de documento de persona
     * @access public
     * @return mixed $tipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Coloca el tipo de ducumento a persona
     * @access public
     * @param mixed $tipoDocumento
     * @return void
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

        
    /**
     * Obtiene el documento de persona
     * @access public
     * @return int $documento
     */
    public function getDocumento()
    {
        return $this->documento;
    }
    
    /**
     * Coloca documento a persona
     * @access public
     * @param integer $documento
     * @return void
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }
    
    /**
     * Obtiene la edad de persona
     * @access public
     * @return void
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Coloca la edad de persona
     * @access public
     * @param integer $edad
     * @return void
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }
    
    /**
     * Obtiene el genero de persona
     * @access public
     * @return mixed $genero
     */
    public function getGenero()
    {
        return $this->genero;
    }
    
    /**
     * Obtiene el genero de persona
     * @access public
     * @param mixed $genero
     * @return void
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    
    /**
     * Obtiene el estado de persona
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Coloca el estado a persona
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    
    /**
     * Obtiene la fecha de creación de persona
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Coloca la fecha de creación a persona
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtiene la fecha de modificación de persona
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
        
    /**
     * Coloca la fecha de modificación a persona
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtiene el id del usuario que crea el objeto persona
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Coloca el id del usuario que crea el objeto persona
     * @access public
     * @param mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtiene el id del usuario que modifica el objeto persona
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Coloca el id del usuario que modifica el objeto persona
     * @access public
     * @param mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
    
    /**
     * constructor para realizar la conexion a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    
    /**
     * Agregar persona a la base de datos
     * @ access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_persona(
                             '$this->nombre'
                            ,'$this->apellido'
                            ,'$this->tipoDocumento'
                            , $this->documento
                            , $this->edad
                            ,'$this->genero'
                            ,'$this->estado'
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar persona en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_persona(
                             '$this->nombre'
                            ,'$this->apellido'
                            ,'$this->tipoDocumento'
                            , $this->documento
                            , $this->edad
                            ,'$this->genero'
                            ,'$this->estado'
                            , $this->idUsuarioModificacion
                            , $this->idPersona)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Eliminar persona de la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM persona 
                            WHERE id_persona = $this->idPersona";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consultar persona en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * FROM persona $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obtiene la condición WHERE sql para la búsqueda de persona en la base de datos
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if ($this->idPersona !='') {
            $condicion=$whereAnd.$condicion." id_persona  = $this->idPersona";
            $whereAnd = ' AND ';
        }
        if ($this->nombre !='') {
            $condicion=$condicion.$whereAnd." nombre LIKE '%$this->nombre%' ";
            $whereAnd = ' AND ';
        }
        if ($this->apellido !='') {
            $condicion=$condicion.$whereAnd." apellido LIKE '%$this->apellido%' ";
            $whereAnd = ' AND ';
        }
        if ($this->tipoDocumento !='') {
            $condicion=$condicion.$whereAnd." tipo_documento = '$this->tipoDocumento' ";
            $whereAnd = ' AND ';
        }
        if ($this->documento !='') {
            $condicion=$condicion.$whereAnd." documento = $this->documento ";
            $whereAnd = ' AND ';
        }
        if ($this->genero !='') {
            $condicion=$condicion.$whereAnd." genero = '$this->genero' ";
            $whereAnd = ' AND ';
        }
        if ($this->edad !='') {
            $condicion=$condicion.$whereAnd." edad LIKE '%$this->edad%' ";
            $whereAnd = ' AND ';
        }
        if ($this->estado !='') {
            $condicion=$condicion.$whereAnd." estado = '$this->estado' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de persona
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idPersona);
        unset($this->nombre);
        unset($this->apellido);
        unset($this->tipoDocumento);
        unset($this->documento);
        unset($this->edad);
        unset($this->genero);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
