<?php

class Cargo
{
    private $idCargo;
    private $codigoCargo;
    private $descripcion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idCargo
    public function getIdCargo()
    {
        return $this->idCargo;
    }
    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;
    }

    //codigoCargo
    public function getCodigoCargo()
    {
        return $this->codigoCargo;
    }
    public function setCodigoCargo($codigoCargo)
    {
        $this->codigoCargo = $codigoCargo;
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
    public function getfechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setfechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //fechaModificacion
    public function getfechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setfechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }


    //idUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1)
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
        $sentenciaSql = "CALL Agregar_cargo('$this->codigoCargo',
                            '$this->descripcion',
                            '$this->estado',
                            $this->idUsuarioCreacion,
                            $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_cargo('$this->idCargo',
                            '$this->codigoCargo',
                            '$this->descripcion',
                            '$this->estado',
                            $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM cargo 
                            WHERE cargo = $this->cargo";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * FROM cargo $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idCargo !=''){
            $condicion=$whereAnd.$condicion." id_cargo  = $this->idCargo";
            $whereAnd = ' AND ';
        }
        if($this->codigoCargo !=''){
                $condicion=$condicion.$whereAnd." codigoCargo LIKE '%$this->codigoCargo%' ";
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

        unset($this->idCargo);
        unset($this->codigoCargo);
        unset($this->descripcion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
