<?php
/**
 * GenerarPago
 */
class GenerarPago
{
    private $idGenerarPago;
    private $idEmpleado;
    private $fechaInicio;
    private $fechaFin;
    private $fechaPago;
    private $valorPago;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de GenerarPago
     * @access public
     * @return integer $idGenerarPago
     */
    public function getIdGenerarPago()
    {
        return $this->IdGenerarPago;
    }
    
    /**
     * Colocar el id de GenerarPago
     * @access public
     * @param integer $idGenerarPago
     * @return void
     */
    public function setIdGenerarPago($idGenerarPago)
    {
        $this->idGenerarPago = $idGenerarPago;
    }
    
    /**
     * Obtener el idEmpleado de GenerarPago
     * @access public
     * @return integer $idEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    
    /**
     * Colocar el idEmpleado de GenerarPago
     * @access public
     * @param integer $idEmpleado
     * @return void
     */
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }
    
    /**
     * Obtener la fecha de inicio de GenerarPago
     * @access public
     * @return mixed $fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }
    
    /**
     * Colocar la fecha de inicio de GenerarPago
     * @access public
     * @param mixed $fechaInicio
     * @return void
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }
    
    /**
     * Obtener la fecha final de GenerarPago
     * @access public
     * @return mixed $fechaFin
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
    
    /**
     * Colocar la fecha final de GenerarPago
     * @access public
     * @param mixed $fechaFin
     * @return void
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }
    
    /**
     * Obtener la fecha de pago de GenerarPago
     * @access public
     * @return mixed $fechaPago
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }
    
    /**
     * Colocar la fecha de pago de GenerarPago
     * @access public
     * @param mixed $fechaPago
     * @return void
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
    }
    
    /**
     * Obtener el valor del pago de GenerarPago
     * @access public
     * @return double $valorPago
     */
    public function getValorIPago()
    {
        return $this->valorPago;
    }
    
    /**
     * Colocar el valor del pago de GenerarPago
     * @access public
     * @param double $valorPago
     * @return void
     */
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;
    }
    
    /**
     * Obtener la fecha de creación de GenerarPago
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de GenerarPago
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de GenerarPago
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de GenerarPago
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que crea a GenerarPago
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que crea a GenerarPago
     * @access public
     * @param integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuairo que hizo la modificación de GenerarPago
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * setIdUsuarioModificacion
     * @access public
     * @param $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1)
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
     * Generar pago entre fechas = fecha inicio y fecha final
     * @access public
     * @return true
     */
    public function GenerarPago()
    {
        $sentenciaSql = "SELECT
                            SUM(pago_dia) AS valor_pago
                            FROM pago_dia
                            WHERE
                                id_empleado = $this->idEmpleado
                            AND estado = '0'
                            AND fecha_pago_dia BETWEEN $this->fechaInicio AND $this->fechaFin";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Pagar los dias sin pagar en PagoDia entre las fechas = fecha inicio y fecha final
     * @access public
     * @param mixed $fechaInicio
     * @param mixed $fechaFin
     * @return void
     */
    public function pagarDias($fechaInicio, $fechaFin)
    {
        $sentenciaSql = "UPDATE
                            pago_dia
                        SET estado = '1'
                        WHERE id_empleado = $this->idEmpleado
                        AND estado = '0'
                        AND fecha_pago_dia BETWEEN $fechaInicio AND $fechaFin";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Agregar GenerarPago a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "INSERT INTO generar_pago(
                            id_empleado
                            ,fecha_inicio
                            ,fecha_fin
                            ,fecha_pago
                            ,valor_pago
                            ,fecha_creacion
                            ,fecha_modificacion
                            ,id_usuario_creacion
                            ,id_usuario_modificacion
                            ) 
                        VALUES (
                            $this->idEmpleado
                            ,$this->fechaInicio
                            ,$this->fechaFin
                            ,$this->fechaPago
                            ,$this->valorPago
                            ,NOW()
                            ,NOW()
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion
                            )";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar GenerarPago en la base de datos
     * @access public
     * @return void
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_generar_pago(
                            '$this->idEmpleado'
                            ,'$this->fechaInicio'
                            ,'$this->fechaFin'
                            ,'$this->fechaPago'
                            ,'$this->valorPago'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idGenerarPago')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Eliminar GenerarPago de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM generar_pago 
                            WHERE id_generar_pago = $this->idGenerarPago";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar GenerarPago en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            gp.id_generar_pago
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,gp.fecha_inicio
                            ,gp.fecha_fin
                            ,gp.valor_pago
                            ,gp.fecha_pago
                            ,e.id_empleado
                            ,e.id_persona
                            ,p.id_persona	
                        FROM persona AS p
                        INNER JOIN empleado AS e ON e.id_persona = p.id_persona
                        INNER JOIN generar_pago AS gp ON gp.id_empleado = e.id_empleado
                        $condicion 
                        ORDER BY gp.fecha_pago DESC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar Empleado en la base de datos
     * @access public
     * @param mixed $nombre
     * @return true
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
     * Obtener la condición WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if ($this->idGenerarPago !='') {
            $condicion=$whereAnd.$condicion." gp.id_generar_pago  = $this->idGenerarPago";
            $whereAnd = ' AND ';
        }
        if ($this->idEmpleado!='') {
            $condicion=$condicion.$whereAnd." gp.id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaInicio!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_inicio = '$this->fechaInicio' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaFin!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_fin = '$this->fechaFin' ";
            $whereAnd = ' AND ';
        }
        if ($this->valorPago!='') {
            $condicion=$condicion.$whereAnd." gp.valor_pago = '$this->valorPago' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaPago!='') {
            $condicion=$condicion.$whereAnd." gp.fecha_pago = '$this->fechaPago' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de GenerarPago y la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idPagoDia);
        unset($this->idEmpleado);
        unset($this->fechaInicio);
        unset($this->fechaFin);
        unset($this->fechaPago);
        unset($this->valorPago);
        unset($this->conn);
    }
}
