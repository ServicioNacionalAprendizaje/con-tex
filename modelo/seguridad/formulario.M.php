<?php

/**
 * Formulario
 */
class Formulario
{
    private $idFormulario;
    private $descripcion;
    private $etiqueta;
    private $ubicacion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn = null;
    
    /**
     * Obtener el id de Formulario
     * @access public
     * @return integer $idFormulario
     */
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }

    /**
     * Colocar el id de Formulario
     * @access public
     * @param  mixed $idFormulario
     * @return void
     */
    public function setIdFormulario($idFormulario)
    {
        $this->idFormulario = $idFormulario;
    }

    /**
     * Obtener la descripcion de Formulario
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }   

    /**
     * Colocar la descripcion de Formulario
     * @access public
     * @param  mixed $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
   
    /**
     * Obtener etiqueta de Formulario
     * @access public
     * @return string $etiqueta
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    } 

    /**
     * Colocar etiqueta a Formulario
     * @access public
     * @param  string $etiqueta
     * @return void
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;
    }
    
    /**
     * Obtiene ubicacion de Formulario
     * @access public
     * @return void
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    } 

    /**
     * Coloca ubicacion a Formulario
     * @access public
     * @param  mixed $ubicacion
     * @return void
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }
     
    /**
     * Obtener estado a Formulario
     * @access public
     * @return void
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar estado a Formulario
     * @access public
     * @param  mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de Formulario
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Formulario
     * @access public
     * @param  mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de Formulario
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Formulario
     * @access public
     * @param  mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
     
    /**
     * Obtener el id del usuario que hizo la iteración de Formulario
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la iteración de Formulario
     * @access public
     * @param  mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
        
    /**
     * Obtener el id del usuario que modificó el objeto Formulario
     * @access public
     * @return void
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modificó el objeto Formulario
     * @access public
     * @param  mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
     
    /**
     * Construir para la hacer la conexion a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
    
    /**
     * Agregar Formulario a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_formulario(
                            '$this->descripcion'
                            ,'$this->etiqueta'
                            ,'$this->ubicacion'
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }
    
    /**
     * Modificar Formulario en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_formulario(
                            '$this->descripcion'
                            ,'$this->etiqueta'
                            ,'$this->ubicacion'
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idFormulario)";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }
    
    /**
     * Eliminar Formulario en la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM formulario 
                            WHERE id_formulario = $this->idFormulario";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }
    
    /**
     * Consultar Formulario en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM formulario
                            $condicion
                            ORDER BY etiqueta DESC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Validar la ubicacion del formulario
     * @access public
     * @return true
     */
    public function validarFormulario()
    {        
        $sentenciaSql = "SELECT 
                            COUNT(f.ubicacion) AS cantidad
                        FROM 
                            formulario AS f
                            INNER JOIN formulario_rol AS fr ON f.id_formulario = fr.id_formulario
                            INNER JOIN rol AS r ON fr.id_rol = r.id_rol
                            INNER JOIN usuario_rol AS ur ON r.id_rol = ur.id_rol
                            INNER JOIN usuario AS u ON ur.id_usuario = u.id_usuario
                        WHERE f.ubicacion LIKE '%/$this->ubicacion%' AND u.id_usuario = $_SESSION[id_login]
                    ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Construir el dashboard para seleccionar los formularios
     * @access public
     * @return true
     */
    public function construirDashboard()
    {      
        $id_usuario = $_SESSION['id_login'];  
        $sentenciaSql = "CALL Obtener_menu('$this->etiqueta',$id_usuario)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Obtiene la condicion WHERE para agregarla a la $sentenciaSql
     * @access public
     * @return $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idFormulario !=''){
            $condicion=$whereAnd.$condicion." id_formulario  = $this->idFormulario";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
                $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
                $whereAnd = ' AND ';
        }
        if($this->etiqueta !=''){
            $condicion=$condicion.$whereAnd." etiqueta LIKE '%$this->etiqueta%' ";
            $whereAnd = ' AND ';
        }
        if($this->ubicacion !=''){
            $condicion=$condicion.$whereAnd." ubicacion LIKE '%$this->ubicacion%' ";
            $whereAnd = ' AND ';
        }                
        return $condicion;
    }
    
    /**
     * Destruye los atributos de Formulario
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->formulario);
        unset($this->descripcion);
        unset($this->etiqueta);
        unset($this->ubicacion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
