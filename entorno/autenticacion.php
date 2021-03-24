<?php
class Autenticacion{
    private $usuario;
    private $contrasenia;
    public $conn = null;
    
    //usuario
    public function getUsuario(){return $this->usuario;}
    public function setUsuario($usuario){$this->usuario = $usuario;}
    
    //contrasenia
    public function getContrasenia(){return $this->contrasenia;}
    public function setContrasenia($contrasenia){
        $this->contrasenia = md5($contrasenia);
    }
    
    //Conexion
    public function __construct(){$this->conn = new Conexion();}
    
    public function autenticar(){
        $sentenciaSql = "
                        SELECT * FROM seguridad.fnt_autenticar('$this->usuario', '$this->contrasenia')
                        ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return $this->conn->obtenerObjeto();
    }
    
    
    
          public function obtenerAccioFormuUsuar($idUsuario, $ubicacionFormulario ){
        $sentenciaSql = "
                         SELECT contratacion.fne_obtener_accio_form_usuar    ($idUsuario , '$ubicacionFormulario') AS reultado;
                        ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        if ($rw = $this->conn->obtenerObjeto()){
            return $rw->reultado; 
        }else{
            return 0;
        }
    }
    
    public function obtenerPermCentrForma($idUsuario){
        $idCentroFormacion = '';
        $sentenciaSql = "
                        SELECT * FROM seguridad.fnt_obtener_permi_centr_forma    ('$idUsuario') AS reultado;
                        ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        
        while($centroFormacion = $this->conn->obtenerObjeto()){
            $idCentroFormacion = $idCentroFormacion.','.$centroFormacion->id_centro_formacion;
        }
        $idCentroFormacion = substr($idCentroFormacion, 1);

        if ($idCentroFormacion!=null)
            $_SESSION['centroFormacion']=$idCentroFormacion;

        else{ 
            $_SESSION['centroFormacion']='0';
        }
        return $_SESSION['centroFormacion'];
    }
}

?>
