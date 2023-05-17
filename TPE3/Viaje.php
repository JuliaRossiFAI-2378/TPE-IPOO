<?php
class Viaje{
    private $codigoViaje;
    private $destinoViaje;
    private $cantMaxPasajeros;
    private $cantidadActualPasajeros;
    private $responsable;
    private $pasajeros = [];
    private $costoViaje;
    private $costoPasajeros;

    public function __construct($codigo, $destino, $maxPasajeros,$responsable,$objPas,$costoViaje,$costoPasajeros){
        $this->codigoViaje = $codigo;
        $this->destinoViaje = $destino;
        $this->cantMaxPasajeros = $maxPasajeros;
        $this->responsable = $responsable;
        $this->pasajeros = $objPas;
        $this->cantidadActualPasajeros = count($objPas);        
        $this->costoViaje = $costoViaje;
        $this->costoPasajeros = $costoPasajeros;
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
        return $this->cantidadActualPasajeros;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function getResponsable(){
        return $this->responsable;
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
    public function setPasajeros ($nuevosPasajeros){
        $this->pasajeros=$nuevosPasajeros;
    }
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function setCostoViaje($nuevoCostoViaje){
        $this->costoViaje = $nuevoCostoViaje;
    }
    public function getCostoPasajeros(){
        return $this->costoPasajeros;
    }
    public function setCostoPasajeros($nuevoCostoPasajeros){
        $this->costoPasajeros = $nuevoCostoPasajeros;
    }
    /** Modifica los datos de un pasajero, tomando el numero de pasajero, el dato a modificar y su nuevo valor
     * @param INT $numeroPasajero
     * @param STRING $datoAModificar
     * @param STRING $nuevoValor
     */
    public function modificarDatosPasajero($numeroPasajero,$datoAModificar,$nuevoValor){
        $i=0;
        $encontro = false;
        while ($i<$this->getCantidadPasajerosViaje() && !$encontro){
            if ($nuevoValor == $this->pasajeros[$i]["numero de documento"]){
                $encontro = true;
            }
            $i++;
        }
        if (!$encontro){
            $objPasajero[$numeroPasajero][$datoAModificar] = $nuevoValor; 
            echo "El ".$datoAModificar." fue cambiado exitosamente.\n";
        } else{
            echo "Ya hay un pasajero con ese documento, verifique que sea correcto o cambie el documento del pasajero ".$i.
                " antes de proceder con esta operacion.\n";
        }

    }
    /** Agrega un nuevo pasajero siempre y cuando no se haya alcanzado al maximo de pasajeros
     * @param Pasajero $nuevoPasajero
     */
    /*tanto aca como en modificarDatosPasajero tomo el numero de documento como un string en caso de que
    la persona sea proveniente de un pais cuyos documentos usen una letra o algo similar*/
    public function agregarNuevoPasajero($nuevoPasajero){
        $losPasajeros = $this->getPasajeros();
        $losPasajeros [] = $nuevoPasajero;
        $this->setPasajeros($losPasajeros);
        echo "El pasajero fue registrado exitosamente.\n";
        $this->cantidadActualPasajeros++;        
    }
    /** Elimina un pasajero de la lista mediante el uso de su indice
     * @param INT $indicePasajero
     */
    public function eliminarPasajero($indicePasajero){
        \array_splice($this->pasajeros,$indicePasajero,1);
        echo "\nEl pasajero fue eliminado exitosamente.\n";
        $this->cantidadActualPasajeros--;
    }
    /** Muestra en pantalla los datos del viaje
     * @return STRING
     */
    public function __toString(){
        $infoViaje = "El codigo del viaje es: ".$this->codigoViaje."\nEl destino del viaje es: ".$this->destinoViaje.
        "\nLa cantidad maxima de pasajeros es: ".$this->cantMaxPasajeros."\nLa cantidad de pasajeros es: ".
        $this->cantidadActualPasajeros."\n";
        return $infoViaje;
    }

    public function venderPasaje($objPasajero){
        $hayPasajes = $this->hayPasajesDisponibles();
        $costoFinal = 0;
        $incremento = $objPasajero->darPorcentajeIncremento();
        $nuevoCostoAbonado = $this->getCostoPasajeros();
        if ($hayPasajes){
            $this->agregarNuevoPasajero($objPasajero);
            $costoFinal = $this->getCostoViaje();
            $incremento *= $costoFinal;
            $costoFinal += $incremento;
            $nuevoCostoAbonado += $costoFinal;
            $this->setCostoPasajeros($nuevoCostoAbonado);
        }else echo "\nEste viaje ya ha alcanzado su maxima capacidad, no se pueden vender mas pasajes.";
        return $costoFinal;
    }
    public function hayPasajesDisponibles(){
        $cantPasajeros = $this->getCantidadPasajerosViaje();
        $maxPasajeros = $this->getCantMaxPasajeros();
        $hayDisponibilidad = false;
        if ($cantPasajeros < $maxPasajeros){
            $hayDisponibilidad = true;
        }
        return $hayDisponibilidad;
    }
}
?> 