<?php

class Formulario
{
    private $idFormulario;
    private $descripcion;
    private $etiqueta;
    private $ubicacion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn = null;

    //idFormulario
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }
    public function setIdFormulario($idFormulario)
    {
        $this->idFormulario = $idFormulario;
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

    //etiqueta
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;
    }

    //ubicacion
    public function getUbicacion()
    {
        return $this->ubicacion;
    }
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
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
        $sentenciaSql = "CALL Agregar_formulario(
                            '$this->descripcion'
                            ,'$this->etiqueta'
                            ,'$this->ubicacion'
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_formulario(
                            '$this->descripcion'
                            ,'$this->etiqueta'
                            ,'$this->ubicacion'
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idFormulario)";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM formulario 
                            WHERE id_formulario = $this->idFormulario";
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM formulario
                            $condicion
                            ORDER BY etiqueta DESC";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function validarFormulario()
    {        
        $sentenciaSql = "SELECT 
                            COUNT(f.ubicacion) AS cantidad
                        FROM 
                            formulario AS f
                            INNER JOIN formulario_rol AS fr ON f.id_formulario = fr.id_formulario
                            INNER JOIN rol AS r ON fr.id_rol = r.id_rol
                            INNER JOIN usuario_rol AS ur ON r.id_rol = ur.id_rol
                            INNER JOIN usuario AS u ON ur.id_usuario = u.id_usuario
                        WHERE f.ubicacion LIKE '%/$this->ubicacion%' AND u.id_usuario = $_SESSION[id_login]
                    ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function construirDashboard()
    {      
        $id_usuario = $_SESSION['id_login'];  
        $sentenciaSql = "CALL Obtener_menu('$this->etiqueta',$id_usuario)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idFormulario !=''){
            $condicion=$whereAnd.$condicion." id_formulario  = $this->idFormulario";
            $whereAnd = ' AND ';
        }
        if($this->descripcion !=''){
                $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->descripcion%' ";
                $whereAnd = ' AND ';
        }
        if($this->etiqueta !=''){
            $condicion=$condicion.$whereAnd." etiqueta LIKE '%$this->etiqueta%' ";
            $whereAnd = ' AND ';
        }
        if($this->ubicacion !=''){
            $condicion=$condicion.$whereAnd." ubicacion LIKE '%$this->ubicacion%' ";
            $whereAnd = ' AND ';
        }                
        return $condicion;
    }

    public function __destruct()
    {
        unset($this->formulario);
        unset($this->descripcion);
        unset($this->etiqueta);
        unset($this->ubicacion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
