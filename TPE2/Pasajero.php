<?php
/**Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga 
 * los atributos nombre, apellido, numero de documento y teléfono. */
class Pasajero{
    private $nombre;
    private $apellido;
    private $numeroDoc;
    private $telefono;

    public function __construct($nombrePasajero,$apellidoPasajero,$dni,$numTelefono){
        $this->nombre = $nombrePasajero;
        $this->apellido = $apellidoPasajero;
        $this->numeroDoc = $dni;
        $this->telefono = $numTelefono;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nuevoNombre){
        $this->nombre = $nuevoNombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($nuevoApellido){
        $this->apellido = $nuevoApellido;
    }
    public function getNumeroDoc(){
        return $this->numeroDoc;
    }
    public function setNumeroDoc($nuevoNumeroDoc){
        $this->numeroDoc = $nuevoNumeroDoc;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($nuevoTelefono){
        $this->telefono = $nuevoTelefono;
    }
    public function __toString(){
        $cad = "Nombre: ".$this->getNombre()."\nApellido: ".$this->getApellido().
        "\nNumero de documento: ".$this->getNumeroDoc()."\nNumero de telefono: ".$this->getTelefono();
        return $cad; 
    }
}
?> 