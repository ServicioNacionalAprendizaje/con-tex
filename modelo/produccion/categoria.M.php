<?php
class Categoria
{
    private $idCategoria;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idCategoria
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }
    //descripcion
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    
    //estado
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    //fechaCreacion
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }
    //fechaModificacion
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }
    //idUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }
    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }
    //conexion
    public function __construct()
    {
        $this->conn = new Conexion();
    }

public function Agregar()
    {
$sentenciaSql = "CALL Agregar_categoria(
                            '$this->descripcion'
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_categoria(
                            '$this->descripcion'
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idCategoria)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM categoria 
                            WHERE id_categoria = $this->idCategoria";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT *

                            FROM categoria

                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idCategoria !=''){
            $condicion=$whereAnd.$condicion." id_categoria  = $this->idCategoria";
            $whereAnd = ' AND ';
        }
        if($this->idCategoria !=''){
            $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
            $whereAnd = ' AND ';
        }        
        // if($this->estado!=''){
        //         if ($whereAnd == ' AND '){
        //         $condicion=$condicion.$whereAnd." seg_usu.estado = '$this->estado'";
        //         $whereAnd = ' AND ';
        //         }
        //         else{
        //         $condicion=$whereAnd.$condicion." seg_usu.estado = '$this->estado'";
        //         $whereAnd = ' AND ';
        //         }
        //     }
        // if($this->fechaActivacion!=''){
        //         $condicion=$condicion.$whereAnd." seg_usu.fecha_activacion = '$this->fechaActivacion' ";
        //         $whereAnd = ' AND ';
        // }
        // if($this->fechaExpiracion!=''){
        //         $condicion=$condicion.$whereAnd." seg_usu.fecha_expiracion = '$this->fechaExpiracion' ";
        //         $whereAnd = ' AND ';
        // }
        return $condicion;
    }
    public function __destruct()
    {
        unset($this->idCategoria);
        unset($this->descripcion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}