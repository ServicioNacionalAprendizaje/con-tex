<?php
require('configuracion.php');

class Conexion{
    
    public $conn = null;
    public $recordSet = null;
    public $sentenciaSql = null;
    private $message = null;
    
    function __construct() {        
         /* Connect using Windows Authentication. */        
        $this->conn = mysqli(SERVERNAME, array( "Database"=>DATABASE, "UID"=>USER, "PWD"=>PASSWORD) );
        if (!$this->conn) {
            $this->message = connect_error();        
            $error = $this->obtenerError();			
        throw new Exception('No fué posible conectar a la base de datos: ', E_USER_ERROR);
    }
    
    public function preparar($sentenciaSql){
        $this->sentenciaSql = $sentenciaSql;
    }

    public function ejecutar() {
        $this->recordSet = mysqli_query($this->conn, $this->sentenciaSql, array(), array('Scrollable' => SQLSRV_CURSOR_KEYSET) );        
        if(!$this->recordSet){            
            $error = $this->obtenerError();
            throw new Exception('No fué posible guardar la información. '.$error['message'], E_USER_ERROR);
        }
    }
    
    public function obtenerObjeto() {
        return mysqli_fetch_object($this->recordSet);
    }
    
    public function obtenerArray() {
        return mysqli_fetch_array($this->recordSet);
    }
    
    public function obtenerRow() {
        return mysqli_fetch_row($this->recordSet);
    }
    public function obtenerNumeroRegistros(){
        return mysqli_num_rows($this->recordSet);
    }
    public function obtenerNombreColumnas(){
        $arrNombreColumnas = array();
        foreach(sqlsrv_field_metadata($this->recordSet) as $fieldData) {
            $nombreColumna = $fieldData['Name'];
            $arrNombreColumnas[] = $nombreColumna;
        }
        return $arrNombreColumnas;
    }
    private function obtenerError(){
        $resultado = array();
        if( ($errors = mysqli_errors() ) != null){
            foreach( $errors as $error){
                $resultado['SQLSTATE'] = $error[ 'SQLSTATE'];
                $resultado['code'] = $error[ 'code'];
                $resultado['message'] = $error[ 'message'];
            }
        }
        return $resultado;
    }
    function __destruct() {
        
        if ($this->recordSet)
            mysqli_free_stmt($this->recordSet);
        
        if ($this->conn)
            mysqli_close($this->conn);
    }
    
}
?>
