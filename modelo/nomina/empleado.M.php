<?php
/**
 * Empleado
 */
class Empleado
{
    private $idEmpleado;
    private $idCargo;
    private $correoInstitucional;
    private $fechaIngreso;
    private $arl;
    private $salud;
    private $pension;
    private $idPersona;
    private $sueldoBasico;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de Empleado
     * @access public
     * @return integer $idEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    
    /**
     * Colocar el id de Empleado
     * @access public
     * @param integer $idEmpleado
     * @return void
     */
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }
        
    /**
     * Obtener idCargo de Empleado
     * @access public
     * @return integer $idCargo
     */
    public function getIdCargo()
    {
        return $this->idCargo;
    }
    
    /**
     * Colocar idCargo de Empleado
     * @access public
     * @param integer $idCargo
     * @return void
     */
    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;
    }
        
    /**
     * Obtener el correo institucional de Empleado
     * @access public
     * @return string $correoInstitucional
     */
    public function getCorreoInstitucional()
    {
        return $this->correoInstitucional;
    }
    
    /**
     * Colocar el correo institucional de Empleado
     * @access public
     * @param string $correoInstitucional
     * @return void
     */
    public function setCorreoInstitucional($correoInstitucional)
    {
        $this->correoInstitucional = $correoInstitucional;
    }
        
    /**
     * Obtener la fecha de ingreso de Empleado
     * @access public
     * @return mixed $fechaIngreso
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }
    
    /**
     * Colocar la fecha de ingreso de Empleado
     * @access public
     * @param mixed $fechaIngreso
     * @return void
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    }
        
    /**
     * Obtener la ARL de Empleado
     * @access public
     * @return string $arl
     */
    public function getArl()
    {
        return $this->arl;
    }
    
    /**
     * Colocar la ARL de Empleado
     * @access public
     * @param string $arl
     * @return void
     */
    public function setArl($arl)
    {
        $this->arl = $arl;
    }
        
    /**
     * Obtener la EPS  de Emplado
     * @access public
     * @return string $salud
     */
    public function getSalud()
    {
        return $this->salud;
    }
    
    /**
     * Colocar la EPS de Empleado
     * @access public
     * @param string $salud
     * @return void
     */
    public function setSalud($salud)
    {
        $this->salud = $salud;
    }
        
    /**
     * Obtener la pensión de Empleado
     * @access public
     * @return string $pension
     */
    public function getPension()
    {
        return $this->pension;
    }
    
    /**
     * Colocar la pensión de Empleado
     * @access public
     * @param string $pension
     * @return void
     */
    public function setPension($pension)
    {
        $this->pension = $pension;
    }
        
    /**
     * Obtener el idPersona de Empleado
     * @access public
     * @return integer $idPersona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    
    /**
     * Colocar el idPersona a Empleado
     * @access public
     * @param integer $idPersona
     * @return void
     */
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
        
    /**
     * Obtener el sueldo básico de Empleado
     * @access public
     * @return double $sueldoBasico
     */
    public function getSueldoBasico()
    {
        return $this->sueldoBasico;
    }
    
    /**
     * Colocar el sueldo básico a Empleado
     * @access public
     * @param double $sueldoBasico
     * @return void
     */
    public function setSueldoBasico($sueldoBasico)
    {
        $this->sueldoBasico = $sueldoBasico;
    }
        
    /**
     * Obtener el estado de Empleado
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado a Empleado
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
        
    /**
     * Obtener la fecha de creación de Empleado
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Empleado
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
        
    /**
     * Obtener la fecha de modificación de Empleado
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Empleado
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
        
    /**
     * Obtener el id del ususario que crea a Empleado
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usario que crea a Empleado
     * @access public
     * @param integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
        
    /**
     * Obtener el id del usuario que modifica a Empleado
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modificó a Empleado
     * @access public
     * @param integer $idUsuarioModificacion
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
     * Agregar Empleado a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
    $sentenciaSql = "CALL Agregar_empleado(
                            $this->idCargo
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                             ,$this->idPersona
                             ,$this->sueldoBasico
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar Empleado en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_empleado('$this->idCargo'
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                            ,$this->idPersona
                            ,$this->sueldoBasico
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idEmpleado)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Eliminar Empleado de la base de datos
     * @access public
     * @return true
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM empleado 
                            WHERE id_empleado = $this->idEmpleado";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Consultar Empleado en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                            e.id_empleado
                            ,e.correo_institucional
                            ,e.fecha_ingreso
                            ,e.arl
                            ,e.salud
                            ,e.pension
                            ,e.estado
                            ,c.id_cargo
                            ,c.descripcion
                            ,p.id_persona
                            ,e.sueldo_basico
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                        FROM 
                            empleado AS e
                            INNER JOIN cargo AS c ON e.id_cargo = c.id_cargo
                            INNER JOIN persona AS p ON e.id_persona = p.id_persona 
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar Correo de Empleado
     * @access public
     * @return void
     */
    public function BuscarCorreo(){
        $sentenciaSql = "SELECT e.correo_institucional, u.id_usuario 
                        FROM empleado AS e 
                        INNER JOIN persona AS p ON e.id_persona = p.id_persona 
                        INNER JOIN usuario AS u ON u.id_persona = e.id_persona 
                        WHERE e.estado = '1'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obtener la condicion WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idEmpleado !=''){
            $condicion=$whereAnd.$condicion." id_empleado  = $this->idEmpleado";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de Empleado y la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idEmpleado);
        unset($this->idCargo);
        unset($this->correoInstitucional);
        unset($this->fechaIngreso);
        unset($this->arl);
        unset($this->salud);
        unset($this->pension);
        unset($this->idPersona);
        unset($this->estado);
        unset($this->conn);
    }
}