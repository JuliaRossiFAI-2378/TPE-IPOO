<?php

class Pasajero{
    private $nombre;
    private $numeroAsiento;
    private $numeroTicket;

    public function __construct($nombre,$asiento,$ticket){
        $this->nombre = $nombre;
        $this->numeroAsiento = $asiento;
        $this->numeroTicket = $ticket;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nuevoNombre){
        $this->nombre = $nuevoNombre;
    }
    public function getNumeroAsiento(){
        return $this->numeroAsiento;
    }
    public function setNumeroAsiento($nuevoNumeroAsiento){
        $this->numeroAsiento = $nuevoNumeroAsiento;
    }
    public function getNumeroTicket(){
        return $this->numeroTicket;
    }
    public function setNumeroTicket($nuevoNumeroTicket){
        $this->numeroTicket = $nuevoNumeroTicket;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 0.1;
        return $porcentaje;
    }

    public function __toString(){
        $cad = "Nombre: ".$this->getNombre()."\n Asiento: ".$this->getNumeroAsiento().
        "\n Ticket: ".$this->getNumeroTicket();
        return $cad;
    }
}
?>