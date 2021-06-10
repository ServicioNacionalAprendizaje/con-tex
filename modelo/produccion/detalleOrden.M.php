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
    

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            detalle_orden 
        WHERE 
            id_detalle_orden = $this->idDetalleOrden";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar(){
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
        if($this->idDetalleOrden !=''){
            $condicion=$whereAnd.$condicion." d.id_detalle_orden  = $this->idDetalleOrden";
            $whereAnd = ' AND ';
        }
        if($this->valorInventario !=''){
            $condicion=$condicion.$whereAnd." d.valor_inventario = $this->valorInventario";
            $whereAnd = ' AND ';
        }
        if($this->valorVenta !=''){
            $condicion=$condicion.$whereAnd." d.valor_venta = $this->valorVenta";
            $whereAnd = ' AND ';
        }
        if($this->cantidad !=''){
            $condicion=$condicion.$whereAnd." d.cantidad = $this->cantidad";
            $whereAnd = ' AND ';
        }
        if($this->idOrden !=''){
            $condicion=$condicion.$whereAnd." d.id_orden = $this->idOrden";
            $whereAnd = ' AND ';
        }
        if($this->idProducto !=''){
            $condicion=$condicion.$whereAnd." d.id_producto = $this->idProducto";
            $whereAnd = ' AND ';
        }
        if($this->estado!=''){
                if ($whereAnd == ' AND '){
                $condicion=$condicion.$whereAnd." d.estado = '$this->estado'";
                $whereAnd = ' AND ';
                }
                else{
                $condicion=$whereAnd.$condicion." d.estado = '$this->estado'";
                $whereAnd = ' AND ';
                }
            }
        if($this->fechaCreacion!=''){
                $condicion=$condicion.$whereAnd." d.fecha_creacion LIKE '%$this->fechaCreacion%' ";
                $whereAnd = ' AND ';
        }
        if($this->fechaModificacion!=''){
                $condicion=$condicion.$whereAnd." d.fecha_modificacion LIKE '%$this->fechaModificacion%' ";
                $whereAnd = ' AND ';
        }
        if($this->idUsuarioCreacion!=''){
            $condicion=$condicion.$whereAnd." d.id_usuario_creacion = $this->idUsuarioCreacion ";
            $whereAnd = ' AND ';
        }
        if($this->idUsuarioModificacion!=''){
            $condicion=$condicion.$whereAnd." d.id_usuario_modificacion = $this->idUsuarioModificacion ";
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