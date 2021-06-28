<?php

/**
 * Orden
 */
class Orden
{
    private $idOrden;
    private $fechaOrden;
    private $fechaEntrega;
    private $descripcion;
    private $idCliente;
    private $idEmpleado;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
        
    /**
     * Obtener el id de Orden
     * @access public
     * @return integer $idOrden
     */
    public function getIdOrden()
    {
        return $this->idOrden;
    }
    
    /**
     * Coloar el id a Orden
     * @access public
     * @param mixed $idOrden
     * @return void
     */
    public function setIdOrden($idOrden)
    {
        return $this->idOrden=$idOrden;
    }
    
    /**
     * Obtener la feca de Orden
     * @access public
     * @return mixed $fechaOrden
     */
    public function getFechaOrden()
    {
        return $this->fechaOrden;
    }
    
    /**
     * Colocar la fecha de Orden
     * @access public
     * @param mixed $fechaOrden
     * @return void
     */
    public function setFechaOrden($fechaOrden)
    {
        return $this->fechaOrden=$fechaOrden;
    }
    
    /**
     * Obtener la fecha de entraga de Orden
     * @access public
     * @return mixed $fechaEntrega
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }
    
    /**
     * Colocar la fecha de entrega de Orden
     * @access public
     * @param mixed $fechaEntrega
     * @return void
     */
    public function setFechaEntrega($fechaEntrega)
    {
        return $this->fechaEntrega=$fechaEntrega;
    }
    
    /**
     * Obtener la descripcion de Orden
     * @access public
     * @return string $descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    /**
     * Colocar la descripcion de Orden
     * @access public
     * @param mixed $descripcion
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        return $this->descripcion = $descripcion;
    }
    
    /**
     * Obtener el idCliente de Orden
     * @access public
     * @return integer $idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }
    
    /**
     * Colocar el idCliente a Orden
     * @access public
     * @param integer $idCliente
     * @return void
     */
    public function setIdCliente($idCliente)
    {
        return $this->idCliente=$idCliente;
    }
    
    /**
     * Ibtener idEmpleado de Orden
     * @access public
     * @return integer $idEmpleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    
    /**
     * Colocar idEmpleado de Orden
     * @access public
     * @param mixed $idEmpleado
     * @return void
     */
    public function setIdEmpleado($idEmpleado)
    {
        return $this->idEmpleado = $idEmpleado;
    }
    
    /**
     * Obtener es estado de Orden
     * @access public
     * @return mixed $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado de Orden
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado =$estado;
    }
    
    /**
     * Obtener la fecha de creación de Orden
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de Orden
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion =$fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de Orden
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de Orden
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion =$fechaModificacion;
    }
    
    /**
     * Obtener el id del Usuario que creó la Orden
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del usuario que creó la Orden
     * @access public
     * @param mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion =$idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que modificó la Orden
     * @access public
     * @return void
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que modificó la Orden
     * @access public
     * @param mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion =$idUsuarioModificacion;
    }
    
    /**
     * Constructor para realizar la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion;
    }
    
    /**
     * Agregar Orden a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $ordenDate = date("Y-m-d H:i:s", strtotime($this->fechaOrden));
        $entregaDate = date("Y-m-d H:i:s", strtotime($this->fechaEntrega));
        $sentenciaSql = "CALL Agregar_orden('$ordenDate'
                                            ,'$entregaDate'
                                            ,'$this->descripcion'
                                            ,$this->idCliente
                                            ,$this->idEmpleado
                                            ,'$this->estado'
                                            ,$this->idUsuarioCreacion
                                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Modificar Orden en la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $ordenDate = date("Y-m-d H:i:s", strtotime($this->fechaOrden));
        $entregaDate = date("Y-m-d H:i:s", strtotime($this->fechaEntrega));
        $sentenciaSql = "CALL Modificar_orden('$ordenDate'
                                             ,'$entregaDate'
                                             ,'$this->descripcion'
                                             ,$this->idCliente
                                             ,$this->idEmpleado
                                             ,'$this->estado'
                                             ,$this->idUsuarioModificacion
                                             ,$this->idOrden)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
        
    /**
     * Eliminar Orden de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM 
            orden 
        WHERE 
            id_orden = $this->idOrden";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar Orden en la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                                o.id_orden
                                ,o.id_empleado
                                ,o.id_cliente
                                ,o.fecha_orden
                                ,o.fecha_entrega
                                ,o.descripcion
                                ,o.estado
                                ,CONCAT(pe.nombre,' ',pe.apellido) AS nombreEmpleado
                                ,CONCAT(pc.nombre,' ',pc.apellido) AS nombreCliente
                        FROM 
                             orden AS o
                             INNER JOIN empleado AS e ON o.id_empleado = e.id_empleado
                             INNER JOIN cliente AS c ON o.id_cliente = c.id_cliente
                             INNER JOIN persona AS pe ON e.id_persona = pe.id_persona
                             INNER JOIN persona AS pc ON c.id_persona = pc.id_persona ".$condicion;
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar empleado encargado de la Orden
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
     * Buscar cliente para la Orden
     * @access public
     * @return true
     */
    public function BuscarCliente()
    {
        $sentenciaSql = "SELECT 
                            CONCAT(p.nombre,' ',p.apellido) AS nombre
                            ,c.id_cliente 
                        FROM persona AS p 
                        INNER JOIN cliente AS c ON p.id_persona = c.id_persona 
                        WHERE p.estado = '1' AND c.estado = '1' AND nombre LIKE '%$this->descripcion%'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Obtener la condicón WHERE para añadirla a la $sentenciaSql
     * @access private
     * @return mixed $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if ($this->idOrden !='') {
            $condicion=$whereAnd.$condicion." o.id_orden  = $this->idOrden";
            $whereAnd = ' AND ';
        }
        if ($this->fechaOrden !='') {
            $ordenDate = date("Y-m-d", strtotime($this->fechaOrden));
            $condicion=$condicion.$whereAnd." o.fecha_orden LIKE '%$ordenDate%' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaEntrega !='') {
            $entregaDate = date("Y-m-d", strtotime($this->fechaEntrega));
            $condicion=$condicion.$whereAnd." o.fecha_entrega LIKE '%$entregaDate%' ";
            $whereAnd = ' AND ';
        }
        if ($this->descripcion !='') {
            $condicion=$condicion.$whereAnd." o.descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->idCliente !='') {
            $condicion=$condicion.$whereAnd." o.id_cliente = $this->idCliente ";
            $whereAnd = ' AND ';
        }
        if ($this->idEmpleado !='') {
            $condicion=$condicion.$whereAnd." o.id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if ($this->estado!='') {
            if ($whereAnd == ' AND ') {
                $condicion=$condicion.$whereAnd." o.estado = '$this->estado'";
                $whereAnd = ' AND ';
            } else {
                $condicion=$whereAnd.$condicion." o.estado = '$this->estado'";
                $whereAnd = ' AND ';
            }
        }
        if ($this->fechaCreacion!='') {
            $condicion=$condicion.$whereAnd." o.fecha_creacion LIKE '%$this->fechaCreacion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaModificacion!='') {
            $condicion=$condicion.$whereAnd." o.fecha_modificacion LIKE '%$this->fechaModificacion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->idUsuarioCreacion!='') {
            $condicion=$condicion.$whereAnd." o.id_usuario_creacion = $this->idUsuarioCreacion ";
            $whereAnd = ' AND ';
        }
        if ($this->idUsuarioModificacion!='') {
            $condicion=$condicion.$whereAnd." o.id_usuario_modificacion = $this->idUsuarioModificacion ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destrue los atributos de Orden
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idOrden);
        unset($this->fechaOrden);
        unset($this->fechaEntrega);
        unset($this->descripcion);
        unset($this->idCliente);
        unset($this->idEmpleado);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
