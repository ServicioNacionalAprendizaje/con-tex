<?php

/**
 * DetalleOrden
 */
class DetalleOrden
{
    private $idDetalleOrden;
    private $valorInventario;
    private $valorVenta;
    private $cantidad;
    private $idOrden;
    private $idProducto;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
        
    /**
     * Obtener el id de DetalleOrden
     * @access public
     * @return integer $idDetalleOrden
     */
    public function getIdDetalleOrden()
    {
        return $this->idDetalleOrden;
    }
    
    /**
     * Colocar el id de DetalleOrden
     * @param mixed $idDetalleOrden
     * @access public
     * @return void
     */
    public function setIdDetalleOrden($idDetalleOrden)
    {
        return $this->idDetalleOrden=$idDetalleOrden;
    }
    
    /**
     * Obtener el valor de inventario de DetalleOrden
     * @access public
     * @return double $valorInventario
     */
    public function getValorInventario()
    {
        return $this->valorInventario;
    }
        
    /**
     * setValorInventario
     * @access public
     * @param double $valorInventario
     * @return void
     */
    public function setValorInventario($valorInventario)
    {
        return $this->valorInventario=$valorInventario;
    }
    
    /**
     * Obtener el valor de venta de DetalleOrden
     * @access public
     * @return double $valorVenta
     */
    public function getValorVenta()
    {
        return $this->valorVenta;
    }
    
    /**
     * Colocar el valor de venta de DetalleOrden
     * @access public
     * @param mixed $valorVenta
     * @return double $valorVenta
     */
    public function setValorVenta($valorVenta)
    {
        return $this->valorVenta=$valorVenta;
    }
    
    /**
     * Obtener la cantidad de DetalleOrden
     * @access public
     * @return void
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
    /**
     * Colocar la cantidad de DetalleOrden
     * @access public
     * @param mixed $cantidad
     * @return void
     */
    public function setCantidad($cantidad)
    {
        return $this->cantidad=$cantidad;
    }
    
    /**
     * Obtener el idOrden de DetalleOrden
     * @access public
     * @return void
     */
    public function getIdOrden()
    {
        return $this->idOrden;
    }
    
    /**
     * Colocar el idOrden de DetalleOrden
     * @access public
     * @param mixed $idOrden
     * @return void
     */
    public function setIdOrden($idOrden)
    {
        return $this->idOrden=$idOrden;
    }
    
    /**
     * Obtener el idProducto de DetalleOrden
     * @access public
     * @return integer $idProducto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    
    /**
     * Colcoar el idProducto de DetalleOrden
     * @access public
     * @param mixed $idProducto
     * @return void
     */
    public function setIdProducto($idProducto)
    {
        return $this->idProducto=$idProducto;
    }
    
    /**
     * Obtener el estado de DetalleOrden
     * @access public
     * @return void
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Colocar el estado de DetalleOrden
     * @access public
     * @param mixed $estado
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado =$estado;
    }
    
    /**
     * Obtener la fecha de creación de DetalleOrden
     * @access public
     * @return mixed $fechaCreacion
     */
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    
    /**
     * Colocar la fecha de creación de DetalleOrden
     * @access public
     * @param mixed $fechaCreacion
     * @return void
     */
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion =$fechaCreacion;
    }
    
    /**
     * Obtener la fecha de modificación de DetalleOrden
     * @access public
     * @return mixed $fechaModificacion
     */
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    
    /**
     * Colocar la fecha de modificación de DetalleOrden
     * @access public
     * @param mixed $fechaModificacion
     * @return void
     */
    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion =$fechaModificacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la iteración del objeto DetalleOrden
     * @access public
     * @return integer $idUsuarioCreacion
     */
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    
    /**
     * Colocar el id del ususario que hizo la iteración del objeto DetalleOrden
     * @access public
     * @param mixed $idUsuarioCreacion
     * @return void
     */
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion =$idUsuarioCreacion;
    }
    
    /**
     * Obtener el id del usuario que hizo la modificación de DetalleOrden
     * @access public
     * @return void
     */
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    
    /**
     * Colocar el id del usuario que hizo la modificación de DetalleOrden
     * @access public
     * @param mixed $idUsuarioModificacion
     * @return void
     */
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion =$idUsuarioModificacion;
    }
    
    /**
     * Constructor para realizar la conexion con la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion;
    }
    
    /**
     * Agregar DetalleOrden a la base de datos
     * @access public
     * @return true
     */
    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_detalle_orden($this->valorInventario
                                            ,$this->valorVenta
                                            ,$this->cantidad
                                            ,$this->idOrden
                                            ,$this->idProducto
                                            ,'$this->estado'
                                            ,$this->idUsuarioCreacion
                                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

        
    /**
     * Modificar DetalleoRden de la base de datos
     * @access public
     * @return true
     */
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_detalle_orden($this->valorInventario
                                             ,$this->valorVenta
                                             ,$this->cantidad
                                             ,$this->idOrden
                                             ,$this->idProducto
                                             ,'$this->estado'
                                             ,$this->idUsuarioModificacion
                                             ,$this->idDetalleOrden)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    
    /**
     * Eliminar DetalleOrden de la base de datos
     * @access public
     * @return void
     */
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM 
            detalle_orden 
        WHERE 
            id_detalle_orden = $this->idDetalleOrden";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }
    
    /**
     * Consultar DetalleOrden de la base de datos
     * @access public
     * @return true
     */
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                            d.id_detalle_orden
                            ,d.valor_inventario
                            ,d.valor_venta
                            ,d.cantidad
                            ,d.id_orden
                            ,d.id_producto
                            ,d.estado
                            ,p.descripcion AS nombre_producto 
                        FROM 
                            detalle_orden AS d 
                            INNER JOIN producto AS p ON d.id_producto = p.id_producto ".$condicion;
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Buscar productos para añadir a DetalleOrden
     * @access public
     * @return true
     */
    public function BuscarProducto()
    {
        $sentenciaSql = "SELECT 
                            p.descripcion 
                            ,p.id_producto 
                        FROM producto AS p 
                        WHERE p.estado = '1' AND p.descripcion LIKE '%$this->idProducto%'";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    /**
     * Obtener condición WHERE para añadir a la $sentenciaSql
     * @access private
     * @return $condicion
     */
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if ($this->idDetalleOrden !='') {
            $condicion=$whereAnd.$condicion." d.id_detalle_orden  = $this->idDetalleOrden";
            $whereAnd = ' AND ';
        }
        if ($this->valorInventario !='') {
            $condicion=$condicion.$whereAnd." d.valor_inventario = $this->valorInventario";
            $whereAnd = ' AND ';
        }
        if ($this->valorVenta !='') {
            $condicion=$condicion.$whereAnd." d.valor_venta = $this->valorVenta";
            $whereAnd = ' AND ';
        }
        if ($this->cantidad !='') {
            $condicion=$condicion.$whereAnd." d.cantidad = $this->cantidad";
            $whereAnd = ' AND ';
        }
        if ($this->idOrden !='') {
            $condicion=$condicion.$whereAnd." d.id_orden = $this->idOrden";
            $whereAnd = ' AND ';
        }
        if ($this->idProducto !='') {
            $condicion=$condicion.$whereAnd." d.id_producto = $this->idProducto";
            $whereAnd = ' AND ';
        }
        if ($this->estado!='') {
            if ($whereAnd == ' AND ') {
                $condicion=$condicion.$whereAnd." d.estado = '$this->estado'";
                $whereAnd = ' AND ';
            } else {
                $condicion=$whereAnd.$condicion." d.estado = '$this->estado'";
                $whereAnd = ' AND ';
            }
        }
        if ($this->fechaCreacion!='') {
            $condicion=$condicion.$whereAnd." d.fecha_creacion LIKE '%$this->fechaCreacion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->fechaModificacion!='') {
            $condicion=$condicion.$whereAnd." d.fecha_modificacion LIKE '%$this->fechaModificacion%' ";
            $whereAnd = ' AND ';
        }
        if ($this->idUsuarioCreacion!='') {
            $condicion=$condicion.$whereAnd." d.id_usuario_creacion = $this->idUsuarioCreacion ";
            $whereAnd = ' AND ';
        }
        if ($this->idUsuarioModificacion!='') {
            $condicion=$condicion.$whereAnd." d.id_usuario_modificacion = $this->idUsuarioModificacion ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }
    
    /**
     * Destruye los atributos de DetalleOrden
     * @access public
     * @return void
     */
    public function __destruct()
    {
        unset($this->idDetalleOrden);
        unset($this->valorInventario);
        unset($this->valorVenta);
        unset($this->cantidad);
        unset($this->idOrden);
        unset($this->idProducto);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
