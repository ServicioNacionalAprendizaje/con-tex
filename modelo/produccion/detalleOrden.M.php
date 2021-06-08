<?php

class DetalleOrden{

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
    
    //idDetalleOrden
    public function getIdDetalleOrden(){return $this->idDetalleOrden;}
    public function setIdDetalleOrden($idDetalleOrden){return $this->idDetalleOrden=$idDetalleOrden;}

    //valorInventario
    public function getValorInventario(){return $this->valorInventario;}
    public function setValorInventario($valorInventario){return $this->valorInventario=$valorInventario;}

    //valorVenta
    public function getValorVenta(){return $this->valorVenta;}
    public function setValorVenta($valorVenta){return $this->valorVenta=$valorVenta;}

    //cantidad
    public function getCantidad(){return $this->cantidad;}
    public function setCantidad($cantidad){return $this->cantidad=$cantidad;}

    //idOrden
    public function getIdOrden(){return $this->idOrden;}
    public function setIdOrden($idOrden){return $this->idOrden=$idOrden;}

    //idProducto
    public function getIdProducto(){return $this->idProducto;}
    public function setIdProducto($idProducto){return $this->idProducto=$idProducto;}

    //estado
    public function getEstado(){ return $this->estado;}
    public function setEstado($estado) { $this->estado =$estado;}


    //fechaCreacion
    public function getfechaCreacion(){ return $this->fechaCreacion;}
    public function setfechaCreacion($fechaCreacion) { $this->fechaCreacion =$fechaCreacion;}

    //fechaModificacion
    public function getfechaModificacion(){ return $this->fechaModificacion;}
    public function setfechaModificacion($fechaModificacion) { $this->fechaModificacion =$fechaModificacion;}


    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion) { $this->idUsuarioModificacion =$idUsuarioModificacion;}

    //conexion
    public function __construct() 
    {
        $this->conn = new Conexion;
    }

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
    

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            orden 
        WHERE 
            id_orden = $this->idOrden";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar(){
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

    public function BuscarProducto(){
        $sentenciaSql = "SELECT 
                            p.descripcion 
                            ,p.id_producto 
                        FROM producto AS p 
                        WHERE p.estado = '1' AND p.descripcion LIKE '%$this->idProducto%'
                        -- GROUP BY p.id_persona;";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idOrden !=''){
            $condicion=$whereAnd.$condicion." o.id_orden  = $this->idOrden";
            $whereAnd = ' AND ';
        }
        if($this->fechaOrden !=''){
                $ordenDate = date("Y-m-d", strtotime($this->fechaOrden));
                $condicion=$condicion.$whereAnd." o.fecha_orden LIKE '%$ordenDate%' ";
                $whereAnd = ' AND ';
        }
        if($this->fechaEntrega !=''){
            $entregaDate = date("Y-m-d", strtotime($this->fechaEntrega));
            $condicion=$condicion.$whereAnd." o.fecha_entrega LIKE '%$entregaDate%' ";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
            $condicion=$condicion.$whereAnd." o.descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }
        if($this->idCliente !=''){
            $condicion=$condicion.$whereAnd." o.id_cliente = $this->idCliente ";
            $whereAnd = ' AND ';
        }
        if($this->idEmpleado !=''){
            $condicion=$condicion.$whereAnd." o.id_empleado = $this->idEmpleado ";
            $whereAnd = ' AND ';
        }
        if($this->estado!=''){
                if ($whereAnd == ' AND '){
                $condicion=$condicion.$whereAnd." o.estado = '$this->estado'";
                $whereAnd = ' AND ';
                }
                else{
                $condicion=$whereAnd.$condicion." o.estado = '$this->estado'";
                $whereAnd = ' AND ';
                }
            }
        if($this->fechaCreacion!=''){
                $condicion=$condicion.$whereAnd." o.fecha_creacion LIKE '%$this->fechaCreacion%' ";
                $whereAnd = ' AND ';
        }
        if($this->fechaModificacion!=''){
                $condicion=$condicion.$whereAnd." o.fecha_modificacion LIKE '%$this->fechaModificacion%' ";
                $whereAnd = ' AND ';
        }
        if($this->idUsuarioCreacion!=''){
            $condicion=$condicion.$whereAnd." o.id_usuario_creacion = $this->idUsuarioCreacion ";
            $whereAnd = ' AND ';
        }
        if($this->idUsuarioModificacion!=''){
            $condicion=$condicion.$whereAnd." o.id_usuario_modificacion = $this->idUsuarioModificacion ";
            $whereAnd = ' AND ';
        }
        return $condicion;
    }

    public function __destruct() {
        
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
?>