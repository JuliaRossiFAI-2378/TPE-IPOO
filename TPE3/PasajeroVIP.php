<?php
class PasajeroVIP extends Pasajero{
    private $numeroViajero;
    private $cantidadMillas;

    public function __construct($nombre, $asiento, $ticket, $numeroViajero, $millas){
        parent::__construct($nombre, $asiento, $ticket);
        $this->numeroViajero = $numeroViajero;
        $this->cantidadMillas = $millas;
    }
    public function getNumeroViajero(){
        return $this->numeroViajero;
    }
    public function setNumeroViajero($nuevoNumeroViajero){
        $this->numeroViajero = $nuevoNumeroViajero;
    }
    public function getCantidadMillas(){
        return $this->cantidadMillas;
    }
    public function setCantidadMillas($nuevoCantidadMillas){
        $this->cantidadMillas = $nuevoCantidadMillas;
    }
    
    public function darPorcentajeIncremento(){
        $porcentaje = 0.35;
        if ($this->getCantidadMillas()>300){
            $porcentaje = 0.30;
        }
        return $porcentaje;
    }
    public function __toString(){
        $cad = parent::__toString()."\n Numero de viajero: ".$this->getNumeroViajero().
        "\n Cantidad de millas: ".$this->getCantidadMillas();
        return $cad;
    }
}
?>