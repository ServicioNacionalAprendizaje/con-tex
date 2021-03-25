<?php
require('configuracion.php');

class Conexion{
    
    public $conn = null;
    public $recordSet = null;
    public $sentenciaSql = null;
    private $message = null;
    
    function __construct() {        
        /* Connect using Windows Authentication. */        
        $this->conn = mysqli_connect(SERVERNAME, USER, PASSWORD, DATABASE);
        if (!$this->conn) {
            $this->message = connect_error();        
            $error = $this->obtenerError();			
            throw new Exception('No fué posible conectar a la base de datos: '.$error);
        }
    }
    
    public function Preparar($sentenciaSql){
        $this->sentenciaSql = $sentenciaSql;
    }

    public function Ejecutar() {
        $this->recordSet = mysqli_query($this->conn, $this->sentenciaSql, MYSQLI_STORE_RESULT);        
        if(!$this->recordSet){            
            $error = $this->ObtenerError();
            throw new Exception('No fué posible guardar la información. '.$error['message'], E_USER_ERROR);
        }
    }
    
    public function ObtenerObjeto() {
        return mysqli_fetch_object($this->recordSet);
    }
    
    public function ObtenerArray() {
        return mysqli_fetch_array($this->recordSet);
    }
    
    public function ObtenerRow() {
        return mysqli_fetch_row($this->recordSet);
    }
    public function ObtenerNumeroRegistros(){
        return mysqli_num_rows($this->recordSet);
    }
    public function ObtenerNombreColumnas(){
        $arrNombreColumnas = array();
        foreach(sqlsrv_field_metadata($this->recordSet) as $fieldData) {
            $nombreColumna = $fieldData['Name'];
            $arrNombreColumnas[] = $nombreColumna;
        }
        return $arrNombreColumnas;
    }
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
    function __destruct() {        
        // if ($this->recordSet)                           
        //     mysqli_stmt_free_result($this->recordSet);

        if ($this->conn)
            mysqli_close($this->conn);
    }
    
}
?>
