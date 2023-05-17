<?php
class ResponsableV{
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombreResponsable;
    private $apellidoResponsable;
    
    public function __construct($numeroEmpleado,$numeroLicencia,$nombre,$apellido){
        $this->numeroEmpleado = $numeroEmpleado;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombreResponsable = $nombre;
        $this->apellidoResponsable = $apellido;
    }
    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
    }
    public function setNumeroEmpleado($nuevoNumeroEmpleado){
        $this->numeroEmpleado = $nuevoNumeroEmpleado;
    }
    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }
    public function setNumeroLicencia($nuevoNumeroLicencia){
        $this->numeroLicencia = $nuevoNumeroLicencia;
    }
    public function getNombreResponsable(){
        return $this->nombreResponsable;
    }
    public function setNombreResponsable($nuevoNombreResponsable){
        $this->nombreResponsable = $nuevoNombreResponsable;
    }
    public function getApellidoResponsable(){
        return $this->apellidoResponsable;
    }
    public function setApellidoResponsable($nuevoApellidoResponsable){
        $this->apellidoResponsable = $nuevoApellidoResponsable;
    }

    public function __toString(){
        $cad = "Nombre del responsable: ".$this->getNombreResponsable()."\nApellido del responsable: ".
        $this->getApellidoResponsable()."\nNumero de empleado: ".$this->getNumeroEmpleado().
        "\nNumero de licencia: ".$this->getNumeroLicencia()."\n";
        return $cad;
    }
}
?>