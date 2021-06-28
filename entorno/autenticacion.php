<?php

/**
 * Autenticacion
 */
class Autenticacion{
    private $usuario;
    private $contrasenia;
    public $conn = null;
        
    /**
     * Obtener el usuario de Autentication
     * @access public
     * @return string $usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    /**
     * Colocar el usuario en Autentication
     * @access public
     * @param mixed $usuario
     * @return void
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
        
    /**
     * Obtener la contrasena de Autentication
     * @access public
     * @return mixed $contrasenia
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    
    /**
     * Colocar la contraseña en Autentication
     * @access public
     * @param mixed $contrasenia
     * @return void
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = md5($contrasenia);
    }
        
    /**
     * Contructor para relizar la conexión a la base de datos
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->conn = new Conexion();
    }
        
    /**
     * Autenticación en la base de datos
     * @access public
     * @return mixed $this->conn->ObtenerObjeto()
     */
    public function autenticar()
    {
        $sentenciaSql = "
                        SELECT * FROM seguridad.fnt_autenticar('$this->usuario', '$this->contrasenia')
                        ";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return $this->conn->obtenerObjeto();
    }
    
        
    /**
     * Obtener el acceso del usuario al formulario
     * @access public
     * @param integer $idUsuario
     * @param mixed $ubicacionFormulario
     * @return mixed $reultado or 0
     */
    public function obtenerAccioFormuUsuar($idUsuario, $ubicacionFormulario )
    {
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
        
    /**
     * obtenerPermiso Centro Formación
     * @access public
     * @param integer $idUsuario
     * @return mixed $_SESSION['centroFormacion']
     */
    public function obtenerPermCentrForma($idUsuario)
    {
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
