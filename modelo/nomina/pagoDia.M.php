<?php
/**
 * PagoDia
 */
class PagoDia
{

    private $idPagoDia;
    private $idEmpleado;
    private $pagoDia;
    private $fechaPago;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de PagoDia
     * @access public
     * @return integer $idPagoDia
     */
    public function getIdPagoDia()
    {
        return $this->idPagoDia;
    }
    
    /**
     * Colocar el id de PagoDia
     * @access public
     * @param mixed $idPagoDia
     * @return void
     */
    public function setIdPagoDia($idPagoDia)
    {
        $this->idPagoDia = $idPagoDia;
    }
    
    /**
     * Obtener el idEmpleado de PagoDia
     * @access public
     * @return integer $idEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    
    /**
     * Colocar el idEmpleado de PagoDia
     * @access public
     * @param mixed $idEmpleado
     * @return void
     */
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }
    
    /**
     * Obtener el valor del pago del día
     * @access public
     * @return void
     */
    public function getPagoDia()
    {
        return $this->pagoDia;
    }
    
    /**
     * Colocar el valor del pago del día
     * @access public
     * @param mixed $pagoDia
     * @return void
     */
    public function setPagoDia($pagoDia)
    {
        $this->pagoDia = $pagoDia;
    }
    
    /**
     * Obtener la fecha de pago
     * @access public
     * @return mixed $fechaPago
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }
    
    /**
     * Colacar la fecha de pago
     * @access public
     * @param mixed $fechaPago
     * @return void
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }
    
    /**
     * Obtener el estado de PagoDia
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado de PagoDia
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    
    /**
     * Obtener la fecha de creación de Pago Día
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de PagoDía
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de PagoDía
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de PagoDía
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que crea PagoDía
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que crea PagoDía
     * @access public
     * @param integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de PagoDía
     * @access public
     * @return integer $idUsuarioModificación
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modifica a PagoDía
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
     * Agregar PagoDía a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_pago_dia(
                            '$this->idEmpleado'
                            ,'$this->pagoDia'
                            ,'$this->fechaPago'
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion'
                            ,'$this->idUsuarioModificacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar PagoDía en la base de datos
     * @access public
     * @return void
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_pago_dia(
                            '$this->idEmpleado'
                            ,'$this->pagoDia'
                            ,'$this->fechaPago'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idPagoDia')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Eliminar PagoDia de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM pago_dia 
                            WHERE id_pago_dia = $this->idPagoDia";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar PagoDia en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            pd.id_pago_dia
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,pd.pago_dia
                            ,pd.fecha_pago_dia
                            ,pd.estado
                            ,e.id_empleado
                            ,e.id_persona
                            ,p.id_persona	
                        FROM persona AS p
                        INNER JOIN empleado AS e ON e.id_persona = p.id_persona
                        INNER JOIN pago_dia AS pd ON pd.id_empleado = e.id_empleado
                        $condicion 
                        ORDER BY pd.fecha_pago_dia DESC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar Empleado en la base de datos
     * @access public
     * @param mixed $nombre
     * @return void
     */
    public function BuscarEmpleado($nombre)
    {
        $sentenciaSql = "SELECT 
                            CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,e.id_empleado 
                        FROM persona AS p 
                            INNER JOIN empleado AS e ON p.id_persona = e.id_persona 
                        WHERE p.estado = '1' AND e.estado = '1' AND nombre LIKE '%$nombre%'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obntener la condición WHERE para añadirlo a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idPagoDia !=''){
            $condicion=$whereAnd.$condicion." pd.id_pago_dia  = $this->idPagoDia";
            $whereAnd = ' AND ';
        }
        if($this->idEmpleado!=''){
            $condicion=$condicion.$whereAnd." pd.id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if($this->fechaPago!=''){
            $condicion=$condicion.$whereAnd." pd.fecha_pago_dia = '$this->fechaPago' ";
            $whereAnd = ' AND ';
        }
        if($this->estado!=''){
            $condicion=$condicion.$whereAnd." pd.estado = '$this->estado' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de PagoDia y la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idPagoDia);
        unset($this->idEmpleado);
        unset($this->pagoDia);
        unset($this->fechaPago);
        unset($this->estado);
        unset($this->conn);
    }
}
