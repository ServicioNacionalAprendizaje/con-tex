<?php
class Usuario{
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
    public $conn=null;

    //idUsuario
    public function getIdUsuario(){return $this->idUsuario;}
    public function setIdUsuario($idUsuario){$this->idUsuario = $idUsuario;}

    //usuario
    public function getUsuario(){return $this->usuario;}
    public function setUsuario($usuario){$this->usuario = $usuario;}

    //contrasenia
    public function getContrasenia(){return $this->contrasenia;}
    public function setContrasenia($contrasenia){$this->contrasenia = $contrasenia;} 

    //fechaActivacion
    public function getFechaActivacion(){ return $this->fechaActivacion;}
    public function setFechaActivacion($fechaActivacion) { $this->fechaActivacion =$fechaActivacion;}

    //FechaExpiracion
    public function getFechaExpiracion(){ return $this->fechaExpiracion;}
    public function setFechaExpiracion($fechaExpiracion) { $this->fechaExpiracion =$fechaExpiracion;}

    //IdPersona
    public function getIdPersona(){ return $this->idPersona;}
    public function setIdPersona($idPersona = 1) { $this->idPersona =$idPersona;}

    //Estado
    public function getEstado(){ return $this->estado;}
    public function setEstado($estado = 1) { $this->estado =$estado;}

    //FechaCreacion
    public function getFechaCreacion(){ return $this->fechaCreacion;}
    public function setFechaCreacion($fechaCreacion = 1) { $this->fechaCreacion =$fechaCreacion;}

    //FechaModificacion
     public function getFechaModificacion(){ return $this->fechaModificacion;}
     public function setFechaModificacion($fechaModificacion = 1) { $this->fechaModificacion =$fechaModificacion;}

    //IdUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion = 1) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //IdUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion = 1) { $this->idUsuarioModificacion =$idUsuarioModificacion;}


    //conexion
    public function __construct() {$this->conn = new Conexion();}


    public function Agregar(){
        $sentenciaSql = "INSERT INTO usuario(
            usuario
            ,contrasenia
            ,fecha_activacion
            ,fecha_expiracion
            ,id_persona
            ,estado
            ,fecha_creacion
            ,fecha_modificacion
            ,id_usuario_creacion
            ,id_usuario_modificacion
            ) 
        VALUES (
            '$this->usuario'
            ,'$this->contrasenia'
            ,$this->fechaActivacion
            ,$this->fechaExpiracion
            ,$this->idPersona
            ,$this->estado
            ,CURDATE()
            ,CURDATE()
            ,1
            ,1          
            )";
        
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Modificar(){
        $sentenciaSql = "UPDATE usuario SET 
        usuario = '$this->usuario'
            ,contrasenia = '$this->contrasenia'
            ,fecha_activacion = '$this->fechaActivacion'
            ,fecha_expiracion = '$this->fechaExpiracion'
            ,id_persona = '$this->idPersona'
            ,estado = '$this->estado'
            ,fecha_modificacion = '$this->fechaModificacion'
            ,id_usuario_modificacion = '$this->idUsuarioModificacion' 
        WHERE id_usuario = $this->idUsuario ";

        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            usuario 
        WHERE 
            id_usuario = $this->idUsuario";   

        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
           *
        FROM
            usuario $condicion";        		
        
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }
    private function obtenerCondicion(){
        
        
    }


    public function __destruct() {        
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
?>