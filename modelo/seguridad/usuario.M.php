<?php
//esneider
class Usuario
{
    private $idUsuario;
    private $usuario;
    private $contrasenia;
    private $fechaActivacion;
    private $fechaExpiracion;
    private $idPersona;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    

    //idUsuario
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    //usuario
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    //contrasenia
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    //fechaActivacion
    public function getFechaActivacion()
    {
        return $this->fechaActivacion;
    }
    public function setFechaActivacion($fechaActivacion)
    {
        $this->fechaActivacion = $fechaActivacion;
    }

    //FechaExpiracion
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
    }

    //IdPersona
    public function getIdPersona()
    {
        return $this->idPersona;
    }
    public function setIdPersona($idPersona=1)
    {
        $this->idPersona = $idPersona;
    }

    //Estado
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    //FechaCreacion
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //FechaModificacion
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    //IdUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //IdUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion=1)
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
        $sentenciaSql = "CALL Agregar_usuario(
                            '$this->usuario'
                            ,'$this->contrasenia'
                            ,'$this->fechaActivacion'
                            ,'$this->fechaExpiracion'
                            ,$this->idPersona
                            ,'$this->estado'
                            ,$this->idUsuarioCreacion
                            ,$this->idUsuarioModificacion)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_usuario(
                             '$this->usuario'
                            ,'$this->contrasenia'
                            ,'$this->fechaActivacion'
                            ,'$this->fechaExpiracion'
                            ,$this->idPersona
                            ,'$this->estado'
                            ,$this->idUsuario)";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM usuario 
                            WHERE id_usuario = $this->idUsuario";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * FROM usuario $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function construirDashboard()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT 
                            f.id_formulario
                            ,f.ubicacion
                            ,f.etiqueta
                        FROM 
                            usuario AS u
                            INNER JOIN usuario_rol AS ur ON u.id_usuario = ur.id_usuario
                            INNER JOIN rol AS r ON ur.id_rol = r.id_rol
                            INNER JOIN formulario_rol AS fr ON r.id_rol = fr.id_rol
                            INNER JOIN formulario AS f ON fr.id_formulario = f.id_formulario
                            $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    
    
    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->idUsuario !=''){
            $condicion=$whereAnd.$condicion." id_usuario  = $this->idUsuario";
            $whereAnd = ' AND ';
        }
        if($this->usuario !=''){
                $condicion=$condicion.$whereAnd." usuario LIKE '%$this->usuario%' ";
                $whereAnd = ' AND ';
        }

        return $condicion;
    }

    public function __destruct()
    {

        unset($this->idUsuario);
        unset($this->usuario);
        unset($this->contrasenia);
        unset($this->fechaActivacion);
        unset($this->fechaExpiracion);
        unset($this->idPersona);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
