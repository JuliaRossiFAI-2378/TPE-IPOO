<?php

class Viaje{
    private $codigoViaje;
    private $destinoViaje;
    private $cantMaxPasajeros;
    private $pasajerosViaje;
    private $pasajero=[];

    public function __construct($codigo, $destino, $maxPasajeros, $cantPasajeros){
        $this->codigoViaje=$codigo;
        $this->destinoViaje=$destino;
        $this->cantMaxPasajeros=$maxPasajeros;
        $this->pasajerosViaje=$cantPasajeros;
        for ($i=0;$i<$cantPasajeros;$i++){
            echo "Ingrese el nombre del pasajero ".$i.": ";
            $this->pasajero [$i]["nombre"]=trim(fgets(STDIN));
            echo "Ingrese el apellido del pasajero ".$i.": ";
            $this->pasajero [$i]["apellido"]=trim(fgets(STDIN));
            echo "Ingrese el numero de documento del pasajero ".$i.": ";
            $this->pasajero [$i]["numero de documento"]=trim(fgets(STDIN));
        }
    }
    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestinoViaje(){
        return $this->destinoViaje;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getCantidadPasajerosViaje(){
        return $this->pasajerosViaje;
    }
    public function getDatosDePasajeros(){
        return $this->pasajero;
    }
    /** Modifica el codigo del viaje
     * @param STRING $nuevoCodigo
     */
    public function setCodigoViaje($elCodigo){
        $this->codigoViaje = $elCodigo;
        echo "El codigo del viaje fue cambiado existosamente.\n";
    }
    /** Modifica el destino del viaje
     * @param STRING $nuevoDestino
     */
    public function setDestinoViaje($elDestino){
        $this->destinoViaje = $elDestino;
        echo "El destino fue cambiado exitosamente.\n";
    }
    /** Modifica la cantidad maxima de pasajeros que pueden haber en el viaje
     * @param INT $nuevaCantMax
     */
    public function setCantMaxPasajeros($laCantMax){
        $this->cantMaxPasajeros = $laCantMax;
        echo "La cantidad maxima de pasajeros fue cambiada exitosamente.\n";
    }
    /** Modifica los datos de un pasajero, tomando el numero de pasajero, el dato a modificar y su nuevo valor
     * @param INT $numeroPasajero
     * @param STRING $datoAModificar
     * @param STRING $nuevoValor
     */
    public function modificarDatosPasajero($numeroPasajero,$datoAModificar,$nuevoValor){
        for ($i=0;$i<$this->getCantidadPasajerosViaje();$i++){
            if ($nuevoValor == $this->pasajero[$i]["numero de documento"]){
                echo "Ya hay un pasajero con ese documento, verifique que sea correcto o cambie el documento del pasajero ".$i.
                " antes de proceder con esta operacion.\n";
                break;
            }else{
                $this->pasajero[$numeroPasajero][$datoAModificar] = $nuevoValor; 
                echo "El ".$datoAModificar." fue cambiado exitosamente.\n";
            }
        }       
    }
    /** Agrega un nuevo pasajero siempre y cuando no se haya alcanzado al maximo de pasajeros
     * @param STRING $nombre
     * @param STRING $apellido
     * @param STRING $numeroDoc
     */
    /*tanto aca como en modificarDatosPasajero tomo el numero de documento como un string en caso de que
    la persona sea proveniente de un pais cuyos documentos usen una letra o algo similar*/
    public function agregarNuevoPasajero($nombre,$apellido,$numeroDoc){
        $indice = count($this->pasajero);
        for ($i=0;$i<$indice;$i++){
            if ($this->pasajero[$i]["numero de documento"] == $numeroDoc){
                echo "El pasajero ya estaba ingresado anteriormente.\n";
                break;
            }else{
                $this->pasajero[$indice]["nombre"] = $nombre;
                $this->pasajero[$indice]["apellido"] = $apellido;
                $this->pasajero[$indice]["numero de documento"] = $numeroDoc;
                echo "El pasajero fue registrado exitosamente.\n";
                $this->pasajerosViaje++;
            }
        }        
    }
    /** Elimina un pasajero de la lista mediante el uso de su indice
     * @param INT $indicePasajero
     */
    public function eliminarPasajero($indicePasajero){
        \array_splice($this->pasajero,$indicePasajero,1);
        echo "El pasajero fue eliminado exitosamente.\n";
        $this->pasajerosViaje--;
    }
    /** Muestra en pantalla los datos del viaje
     * @return STRING
     */
    public function __toString(){
        $infoViaje = "El codigo del viaje es: ".$this->codigoViaje."\nEl destino del viaje es: ".$this->destinoViaje.
        "\nLa cantidad maxima de pasajeros es: ".$this->cantMaxPasajeros."\nLa cantidad de pasajeros es: ".
        $this->pasajerosViaje."\n";
        return $infoViaje;
    }
    
}
/** Solicita un numero entre sus parametros y revisa que lo ingresado realmente sea un numero 
 * @param INT $minimo
 * @param INT $maximo
 * @return INT
*/
function solicitarNumeroEntre($minimo,$maximo){
    $numero = trim(fgets(STDIN));
    while (!($numero>=$minimo && $numero<=$maximo) && !(is_numeric($numero))){
        echo "Debe ingresar un numero que este entre ".$minimo." y ".$maximo.": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}
?>