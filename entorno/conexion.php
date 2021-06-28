<?php
require('configuracion.php');

/**
 * Conexion
 */
class Conexion{
    
    public $conn = null;
    public $recordSet = null;
    public $sentenciaSql = null;
    private $message = null;
        
    /**
     * Constructor para realizar la conexión a la base de datos
     * @return void
     */
    function __construct() {        
        /* Connect using Windows Authentication. */        
        $this->conn = mysqli_connect(SERVERNAME, USER, PASSWORD, DATABASE);
        if (!$this->conn) {
            $this->message = connect_error();        
            $error = $this->obtenerError();			
            throw new Exception('No fué posible conectar a la base de datos: '.$error);
        }
    }
        
    /**
     * Prepara la $sentenciaSql para ejecutarla
     * @access public
     * @param mixed $sentenciaSql 
     * @return void
     */
    public function Preparar($sentenciaSql){
        $this->sentenciaSql = $sentenciaSql;
    }
    
    /**
     * Ejecuta la $sentenciaSql
     * @access public
     * @return void
     */
    public function Ejecutar() {
        $this->recordSet = mysqli_query($this->conn, $this->sentenciaSql);        
        if(!$this->recordSet){            
            $error = $this->ObtenerError();
            throw new Exception('No fué posible guardar la información. '.$error['message'], E_USER_ERROR);
        }
    }
        
    /**
     * Obtiene el objeto de la $sentenciaSql
     * @access public
     * @return void
     */
    public function ObtenerObjeto() {
        return mysqli_fetch_object($this->recordSet);
    }
        
    /**
     * Obtiene el arreglo de la $sentenciaSql
     * @access public
     * @return void
     */
    public function ObtenerArray() {
        return mysqli_fetch_array($this->recordSet);
    }
        
    /**
     * Obtiene filas de la $sentenciaSql
     * @access public
     * @return void
     */
    public function ObtenerRow() {
        return mysqli_fetch_row($this->recordSet);
    }
    
    /**
     * Obtener el número de registros
     * @access public
     * @return void
     */
    public function ObtenerNumeroRegistros(){
        return mysqli_num_rows($this->recordSet);
    }
    
    /**
     * Obtener Registros
     * @access public
     * @return void
     */
    public function ObtenerRegistros(){
        return mysqli_fetch_all($this->recordSet);
    }
        
    /**
     * Obtener los nombres de columnas
     * @access public
     * @return mixed $arrNombreColumnas
     */
    public function ObtenerNombreColumnas(){
        $arrNombreColumnas = array();
        foreach(sqlsrv_field_metadata($this->recordSet) as $fieldData) {
            $nombreColumna = $fieldData['Name'];
            $arrNombreColumnas[] = $nombreColumna;
        }
        return $arrNombreColumnas;
    }
        
    /**
     * Obtener Error
     * @access private
     * @return mixed $resultado
     */
    private function ObtenerError(){
        $resultado = array();
        if( $errors = mysqli_error_list($this->conn)){
            foreach( $errors as $error){
                $resultado['SQLSTATE'] = $error['sqlstate'];
                $resultado['code'] = $error['errno'];
                $resultado['message'] = $error['error'];
            }
        }
        return $resultado;
    }
        
    /**
     * Destruye la conexión a la base de datos
     * @return void
     */
    function __destruct() {        
        // if ($this->recordSet)                           
        //     mysqli_stmt_free_result($this->recordSet);

        if ($this->conn)
            mysqli_close($this->conn);
    }
    
}
?>
