<?php

class Tarea{

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

    //idTarea
    public function getIdTarea()
    {
        return $this->idTarea;
    }
    public function setIdTarea($idTarea)
    {
        return $this->idTarea=$idTarea;
    }

    //descripcion
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        return $this->descripcion=$descripcion;
    }

    //valorUnitario
    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }
    public function setValorUnitario($valorUnitario)
    {
        return $this->valorUnitario=$valorUnitario;
    }

    //cantidad
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
        return $this->cantidad=$cantidad;
    }

    //idEmpleado
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
    public function setIdEmpleado($idEmpleado)
    {
        return $this->idEmpleado=$idEmpleado;
    }

    //fecha
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        return $this->fecha=$fecha;
    }

    //estadoPago
    public function getEstadoPago()
    {
        return $this->estadoPago;
    }
    public function setEstadoPago($estadoPago)
    {
        return $this->estadoPago=$estadoPago;
    }

    //Estado
    public function getEstado()
    { 
        return $this->estado;
    }
    public function setEstado($estado)
    { 
        $this->estado =$estado;
    }

    //FechaCreacion
    public function getFechaCreacion()
    { 
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion) 
    { 
        $this->fechaCreacion =$fechaCreacion;
    }

    //FechaModificacion
     public function getFechaModificacion()
    { 
         return $this->fechaModificacion;
    }
     public function setFechaModificacion($fechaModificacion) 
    { 
        $this->fechaModificacion =$fechaModificacion;
    }

    //IdUsuarioCreacion
    public function getIdUsuarioCreacion()
    { 
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    { 
        $this->idUsuarioCreacion =$idUsuarioCreacion;
    }

    //IdUsuarioModificacion
    public function getIdUsuarioModificacion()
    { 
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1) 
    { 
        $this->idUsuarioModificacion =$idUsuarioModificacion;
    }

    //conexion
    public function __construct() 
    {
        $this->conn = new Conexion;
    }

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_tarea(
                            '$this->descripcion'
                            ,'$this->valorUnitario'
                            ,'$this->cantidad'
                            ,'$this->fecha'
                            ,'$this->estadoPago'
                            , $this->idEmpleado
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion'
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_tarea(
                            '$this->descripcion'
                            ,'$this->valorUnitario'
                            ,'$this->cantidad'
                            ,'$this->idEmpleado'
                            ,'$this->fecha'
                            ,'$this->estadoPago'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idTarea')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            tarea 
        WHERE 
            id_tarea = $this->idTarea";        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Consultar(){
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
                            INNER JOIN persona AS p ON t.id_empleado = p.id_persona
                            $condicion";        		
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    private function obtenerCondicion(){}

    public function __destruct() {
        
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
?>