<?php

class Persona
{
    private $idPersona;
    private $nombre;
    private $apellido;
    private $edad;
    private $genero;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idpersona
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    //nombre
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    //apellido
    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    //edad
    public function getEdad()
    {
        return $this->edad;
    }
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    //genero
    public function getGenero()
    {
        return $this->genero;
    }
    public function setGenero($genero)
    {
        $this->genero = $genero;
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
        $sentenciaSql = "CALL Agregar_persona(
                             '$this->nombre'
                            ,'$this->apellido'
                            , $this->edad
                            ,'$this->genero'
                            ,'$this->estado'
                            , $this->idUsuarioCreacion
                            , $this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_persona(
                             '$this->nombre'
                            ,'$this->apellido'
                            ,'$this->edad'
                            ,'$this->genero'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            , $this->idPersona)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM persona 
                            WHERE id_persona = $this->idPersona";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * FROM persona $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idPersona !=''){
            $condicion=$whereAnd.$condicion." id_persona  = $this->idPersona";
            $whereAnd = ' AND ';
        }
        if($this->nombre !=''){
                $condicion=$condicion.$whereAnd." nombre LIKE '%$this->nombre%' ";
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

        unset($this->idPersona);
        unset($this->nombre);
        unset($this->apellido);
        unset($this->edad);
        unset($this->genero);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
