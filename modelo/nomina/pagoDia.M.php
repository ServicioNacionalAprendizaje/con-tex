<?php

class pagoDia{

    private $idPagoDia;
    private $idEmpleado;
    private $pagoDia;

    //idPagoDia
    public function getIdPago(){return $this->idPagoDia;}
    public function setIdPago($idPagoDia){$this->idPagoDia = $idPagoDia;}

    //idEmpleado
    public function getIdEmpleado(){return $this->idEmpleado;}
    public function setIdEmpleado($idEmpleado){$this->idEmpleado = $idEmpleado;}

    //pagoDia
    public function getPagoDia(){return $this->pagoDia;}
    public function setPagoDia($pagoDia){$this->pagoDia = $pagoDia;}
}
?>