<?php

/**
 * Tarea
 */
class Tarea
{
    private $idTarea;
    private $descripcion;
    private $valorUnitario;
    private $cantidad;
    private $idEmpleado;
    private $fecha;
    private $estadoPago;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    
    /**
     * Obtener el id de Tarea
     * @access public
     * @return integer $idTarea
     */
    public function getIdTarea()
    {
        return $this->idTarea;
    }    
    /**
     * Colocar el id de Tarea
     * @access public
     * @param integer $idTarea
     * @return void
     */
    public function setIdTarea($idTarea)
    {
        return $this->idTarea=$idTarea;
    }
    
    /**
     * Cbtener la descripcion de Tarea
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    /**
     * Colocar la descripción de Tarea
     * @access public
     * @param string $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        return $this->descripcion=$descripcion;
    }
    
    /**
     * Obtener el valor unitario de la Tarea
     * @access public
     * @return double $valorUnitario
     */
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }
    
    /**
     * Colocar el valor unitario de la Tarea
     * @access public
     * @param double $valorUnitario
     * @return void
     */
    public function setValorUnitario($valorUnitario)
    {
        return $this->valorUnitario=$valorUnitario;
    }
    
    /**
     * Obtener la cantidad de Tarea
     * @access public
     * @return integer $cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    /**
     * Colocar la cantidad de Tarea
     * @access public
     * @param integer $cantidad
     * @return void
     */
    public function setCantidad($cantidad)
    {
        return $this->cantidad=$cantidad;
    }
    
    /**
     * Obtener el idEmpleado de Tarea
     * @access public
     * @return integer $idEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    
    /**
     * Colocar el idEmpleado de Tarea
     * @access public
     * @param integer $idEmpleado
     * @return void
     */
    public function setIdEmpleado($idEmpleado)
    {
        return $this->idEmpleado=$idEmpleado;
    }
    
    /**
     * Obtener la fecha de la Tarea
     * @access public
     * @return mixed $fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    
    /**
     * Colocar la fecha de la Tarea
     * @access public
     * @param mixed $fecha
     * @return void
     */
    public function setFecha($fecha)
    {
        return $this->fecha=$fecha;
    }
    
    /**
     * Obtiene el estado del pagp de la Tarea
     * @access public
     * @return mixed $estadoPago
     */
    public function getEstadoPago()
    {
        return $this->estadoPago;
    }
    
    /**
     * Colocar el estado del pago de la Tarea
     * @access public
     * @param mixed $estadoPago
     * @return void
     */
    public function setEstadoPago($estadoPago)
    {
        return $this->estadoPago=$estadoPago;
    }
    
    /**
     * Obtener el estado de Tarea
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado de Tarea
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado =$estado;
    }
    
    /**
     * Obtener la fecha de creación de Tarea
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Tarea
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion =$fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de Tarea
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Tarea
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion =$fechaModificacion;
    }
    
    /**
     * Obtener el id del susario que crea a Tarea
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que crea a Tarea
     * @access public
     * @param integer $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion =$idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modifica a Tarea
     * @access public
     * @return integer $idUsuarioModificacion
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
        
    /**
     * Colcoar el id del usuario que modifica a Tarea
     * @access public
     * @param integer $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1)
    {
        $this->idUsuarioModificacion =$idUsuarioModificacion;
    }
    
    /**
     * Constructor para relizar la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion;
    }
    
    /**
     * Agregar Tarea a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_tarea(
                            '$this->descripcion'
                            ,$this->valorUnitario
                            ,$this->cantidad
                            ,'$this->fecha'
                            ,'$this->estadoPago'
                            , $this->idEmpleado
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

        
    /**
     * Modificar Tarea en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_tarea(
                            '$this->descripcion'
                            ,'$this->valorUnitario'
                            ,'$this->cantidad'
                            ,'$this->fecha'
                            ,'$this->estadoPago'
                            ,'$this->idEmpleado'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idTarea')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    
    /**
     * Eliminar Tarea de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM 
            tarea 
        WHERE 
            id_tarea = $this->idTarea";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar Tarea en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
                            t.id_tarea
                            ,t.descripcion
                            ,t.valor_unitario
                            ,t.cantidad
                            ,t.fecha
                            ,t.estado_pago
                            ,t.id_empleado
                            ,p.id_persona
                            ,t.estado
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                        FROM 
                            tarea AS t
                            INNER JOIN empleado AS e ON t.id_empleado = e.id_empleado 
                            INNER JOIN persona AS p ON e.id_persona = p.id_persona 
                            $condicion";
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar empleado en la base de datos
     * @access public
     * @return true
     */
    public function BuscarEmpleado()
    {
        $sentenciaSql = "SELECT 
                            CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,e.id_empleado 
                        FROM persona AS p 
                            INNER JOIN empleado AS e ON p.id_persona = e.id_persona 
                        WHERE p.estado = '1' AND e.estado = '1' AND nombre LIKE '%$this->descripcion%'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Obtener condicion WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if ($this->idTarea !='') {
            $condicion=$whereAnd.$condicion." id_tarea  = $this->idTarea";
            $whereAnd = ' AND ';
        }
        if ($this->descripcion !='') {
            $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->estado!='') {
            if ($whereAnd == ' AND ') {
                $condicion=$condicion.$whereAnd." estado = '$this->estado'";
                $whereAnd = ' AND ';
            } else {
                $condicion=$whereAnd.$condicion." estado = '$this->estado'";
                $whereAnd = ' AND ';
            }
        }
        if ($this->valorUnitario!='') {
            $condicion=$condicion.$whereAnd." valor_unitario = $this->valorUnitario ";
            $whereAnd = ' AND ';
        }
        if ($this->cantidad!='') {
            $condicion=$condicion.$whereAnd." cantidad = $this->cantidad ";
            $whereAnd = ' AND ';
        }
        if ($this->idEmpleado!='') {
            $condicion=$condicion.$whereAnd." id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if ($this->fecha!='') {
            $condicion=$condicion.$whereAnd." fecha = $this->fecha ";
            $whereAnd = ' AND ';
        }
        if ($this->estadoPago!='') {
            $condicion=$condicion.$whereAnd." estadoPago = '$this->estadoPago' ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de Tarea
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idTarea);
        unset($this->descripcion);
        unset($this->valorUnitario);
        unset($this->cantidad);
        unset($this->idEmpleado);
        unset($this->fecha);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
