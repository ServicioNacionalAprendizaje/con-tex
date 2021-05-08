<?php
class Empleado
{
    private $idEmpleado;
    private $idCargo;
    private $correoInstitucional;
    private $fechaIngreso;
    private $arl;
    private $salud;
    private $pension;
    private $idPersona;
    private $sueldoBasico;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;

    //idEmpleado
    public function getIdEmpleado()
    {
        return $this->idFormulario;
    }
    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;
    }
    //idCargo
    public function getIdCargo()
    {
        return $this->idCargo;
    }
    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;
    }
    //correoInstitucional
    public function getCorreoInstitucional()
    {
        return $this->correoInstitucional;
    }
    public function setCorreoInstitucional($correoInstitucional)
    {
        $this->correoInstitucional = $correoInstitucional;
    }
    //fechaIngreso
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    }
    //arl
    public function getArl()
    {
        return $this->arl;
    }
    public function setArl($arl)
    {
        $this->arl = $arl;
    }
    //salud
    public function getSalud()
    {
        return $this->salud;
    }
    public function setSalud($salud)
    {
        $this->salud = $salud;
    }
    //pension
    public function getPension()
    {
        return $this->pension;
    }
    public function setPension($pension)
    {
        $this->pension = $pension;
    }
    //idPersona
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }
    //sueldoBasico
    public function getSueldoBasico()
    {
        return $this->sueldoBasico;
    }
    public function setSueldoBasico($sueldoBasico)
    {
        $this->sueldoBasico = $sueldoBasico;
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
$sentenciaSql = "CALL Agregar_empleado(
                            $this->idCargo
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                             ,$this->idPersona
                             ,$this->sueldoBasico
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_empleado('$this->idCargo'
                            ,'$this->correoInstitucional'
                            ,'$this->fechaIngreso'
                            ,'$this->arl'
                            ,'$this->salud'
                            ,'$this->pension'
                            ,$this->idPersona
                            ,$this->sueldoBasico
                            ,'$this->estado'
                            ,$this->idUsuarioModificacion
                            ,$this->idEmpleado)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM empleado 
                            WHERE id_empleado = $this->idEmpleado";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                            e.id_empleado
                            ,e.correo_institucional
                            ,e.fecha_ingreso
                            ,e.arl
                            ,e.salud
                            ,e.pension
                            ,e.estado
                            ,c.id_cargo
                            ,c.descripcion
                            ,p.id_persona
                            ,e.sueldo_basico
                            ,CONCAT(p.nombre,' ',p.apellido) AS nombre
                        FROM 
                            empleado AS e
                            INNER JOIN cargo AS c ON e.id_cargo = c.id_cargo
                            INNER JOIN persona AS p ON e.id_persona = p.id_persona 
                        $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";
        if($this->idEmpleado !=''){
            $condicion=$whereAnd.$condicion." id_empleado  = $this->idEmpleado";
            $whereAnd = ' AND ';
        }
        // if($this->idCargo !=''){
        //         $condicion=$condicion.$whereAnd." descripcion LIKE '%$this->idCargo%' ";
        //         $whereAnd = ' AND ';
        // }        
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
        unset($this->idEmpleado);
        unset($this->idCargo);
        unset($this->correoInstitucional);
        unset($this->fechaIngreso);
        unset($this->arl);
        unset($this->salud);
        unset($this->pension);
        unset($this->idPersona);
        unset($this->estado);
        unset($this->conn);
    }
}