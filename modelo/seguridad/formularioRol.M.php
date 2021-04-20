<?php
    //Eduardo A. Peña

class FormularioRol{
    private $idFormularioRol;
    private $idRol;
    private $idFormulario;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn=null;

    //idFormularioRol
    public function getIdFormularioRol(){return $this->idFormularioRol;}
    public function setIdFormularioRol($idFormularioRol){$this->idFormularioRol = $idFormularioRol;}

    //idRol
    public function getIdRol(){return $this->idRol;}
    public function setIdRol($idRol){$this->idRol = $idRol;}

    //idFormulario
    public function getIdFormulario(){return $this->idFormulario;}
    public function setIdFormulario(){$this->idFormulario = $idFormulario;}

    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado(){$this->estado = $estado;}

    //fechaCreacion
    public function getFechaCreacion(){return $this->fechaCreacion;}
    public function setFechaCreacion(){$this->fechaCreacion = $fechaCreacion;}

    //fechaModificacion
    public function getFechaModificacion(){ return $this->fechaModificacion;}
    public function setFechaModificacion($fechaModificacion) { $this->fechaModificacion =$fechaModificacion;}

    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){ return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion) { $this->idUsuarioCreacion =$idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){ return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion) { $this->idUsuarioModificacion =$idUsuarioModificacion;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
        $sentenciaSql = "CALL Agregar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idFormularioRol')"
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    return true;     
    }

    public function Modificar(){
        $sentenciaSql = "Call Modificar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idFormularioRol')"
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
        formularioRol 
    WHERE 
        id_Formulario_Rol = $this->idOrden";        
    $this->conn->preparar($sentenciaSql);
    $this->conn->ejecutar();
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
           *
        FROM
            formularioRol $condicion";        		
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    private function obtenerCondicion(){
     
        
    }


    public function __destruct() {
        unset($this->idFormularioRol);
        unset($this->idRol);
        unset($this->idFormulario);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
       
    }       
}
?>