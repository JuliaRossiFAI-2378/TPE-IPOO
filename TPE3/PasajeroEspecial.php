<?php
class PasajeroEspecial extends Pasajero{
    private $servicioEspecial;
    private $asistenciaEspecial;
    private $comidaEspecial;

    public function __construct($nombre,$asiento,$ticket,$servicio,$asistencia,$comida){
        parent::__construct($nombre,$asiento,$ticket);
        $this->servicioEspecial = $servicio;
        $this->asistenciaEspecial = $asistencia;
        $this->comidaEspecial = $comida;
    }
    public function getServicioEspecial(){
        return $this->servicioEspecial;
    }
    public function setServicioEspecial($nuevoServicioEspecial){
        $this->servicioEspecial = $nuevoServicioEspecial;
    }
    public function getAsistenciaEspecial(){
        return $this->asistenciaEspecial;
    }
    public function setAsistenciaEspecial($nuevoAsistenciaEspecial){
        $this->asistenciaEspecial = $nuevoAsistenciaEspecial;
    }
    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }
    public function setComidaEspecial($nuevoComidaEspecial){
        $this->comidaEspecial = $nuevoComidaEspecial;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 0.15;
        if (($this->getServicioEspecial() && $this->getAsistenciaEspecial()) || 
            ($this->getServicioEspecial() && $this->getComidaEspecial()) ||
            ($this->getAsistenciaEspecial() && $this->getComidaEspecial())){
                $porcentaje = 0.30;
            }
        return $porcentaje;
    }
    public function __toString(){
        $cad = parent::__toString()."\n Requiere servicio especial: ".$this->getServicioEspecial().
        "\n Requiere asistencia especial: ".$this->getAsistenciaEspecial()."\n Requiere comida especial: ".
        $this->getComidaEspecial();
        return $cad;
    }
}
?>