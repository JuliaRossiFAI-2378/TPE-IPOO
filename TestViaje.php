<?php
include 'ViajeFeliz.php';
//inicializo el objeto en 0 en caso de que el usuario elija una opcion entre 6 y 9
$objViaje = new Viaje(0,0,0,0);
/** Muestra el menu y pide seleccionar una opcion
 * @return INT
 */
function seleccionarOpcion(){
    echo "[1] Cargar informacion del viaje.\n";
    echo "[2] Modificar codigo del viaje.\n";
    echo "[3] Modificar destino del viaje.\n";
    echo "[4] Modificar cantidad maxima de pasajeros.\n";
    echo "[5] Agregar un pasajero.\n";
    echo "[6] Eliminar un pasajero.\n";
    echo "[7] Modificar el dato de un pasajero.\n";
    echo "[8] Ver la informacion del viaje.\n";
    echo "[9] Ver los datos de los pasajeros.\n";
    echo "[10] Salir.\n";
    echo "Ingrese la opcion del menu que desea elegir: ";
    //Verifica que el numero elegido vaya unicamente entre las opciones del menu
    $opcionMenu = solicitarNumeroEntre(1,10);
    return $opcionMenu;
}

do{
    //Muestra el menu y devuelve la opcion elegida para utilizar en el switch
    $opcion = seleccionarOpcion();
    switch($opcion){
        case 1:
            echo "Ingrese el codigo del viaje: ";
            $codViaje = trim(fgets(STDIN));
            echo "Ingrese el destino del viaje: ";
            $destViaje = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros: ";
            //Ambos utilizan solicitarNumeroEntre para verificar que no se ingresen numeros negativos o caracteres
            $cantidadMaximaPasajeros = solicitarNumeroEntre(1,999);
            echo "Ingrese la cantidad de pasajeros en el viaje: ";
            $pasajerosEnElViaje = solicitarNumeroEntre(0,$cantidadMaximaPasajeros);
            $objViaje = new Viaje($codViaje,$destViaje,$cantidadMaximaPasajeros,$pasajerosEnElViaje);
            break;
        case 2:
            echo "Ingrese el nuevo codigo de viaje: ";
            $nuevoCodigoViaje = trim(fgets(STDIN));
            $objViaje->modificarCodigoViaje($nuevoCodigoViaje);
            break;
        case 3:
            echo "Ingrese el nuevo destino de viaje: ";
            $nuevoDestinoViaje = trim(fgets(STDIN));
            $objViaje->modificarDestinoViaje($nuevoDestinoViaje);
            break;
        case 4:
            echo "Ingrese la nueva cantidad maxima de pasajeros: ";
            //Verifica que lo ingresado no sea un numero negativo o caracteres
            $nuevaCantMaxPasajeros = solicitarNumeroEntre(0,999);
            $objViaje->modificarCantMaxPasajeros($nuevaCantMaxPasajeros);
            break;
        case 5: 
            //Verifica que no se haya alcanzado la cantidad maxima de pasajeros
            if ($objViaje->getCantidadPasajerosViaje()==$objViaje->getCantMaxPasajeros()){
                echo "Ya se ha llegado a la cantidad maxima de pasajeros, no se pueden agregar mas.\n";
            }else{
                echo "Ingrese el nombre del pasajero: ";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero: ";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero: ";
                $documentoPasajero = trim(fgets(STDIN));
                $objViaje->agregarNuevoPasajero($nombrePasajero,$apellidoPasajero,$documentoPasajero);
            }            
            break;
        case 6:
            //Verifica que si hayan pasajeros para eliminar
            if ($objViaje->getCantidadPasajerosViaje()==0){
                echo "No hay pasajeros para eliminar.\n";
            }else{
                //Muestra los pasajeros asi el usuario sabe que numero de pasajero elegir
                print_r($objViaje->getDatosDePasajeros());
                echo "Ingrese que pasajero desea eliminar: ";
                //Solicita un numero que no sobrepase la cantidad de pasajeros
                $numeroDePasajero = solicitarNumeroEntre(0,$objViaje->getCantidadPasajerosViaje()-1);
                $objViaje->eliminarPasajero($numeroDePasajero);
            }
            break;
        case 7:/**Agregar if en caso de que se modifique a un dni ya existente */
            //Verifica que haya pasajeros para modificar
            if ($objViaje->getCantidadPasajerosViaje()==0){
                echo "No hay pasajeros registrados.\n";
            }else{
                //Imprime los pasajeros para que el usuario sepa que numero seleccionar
                print_r($objViaje->getDatosDePasajeros());
                echo "Ingrese el numero de pasajero que desea modificar: ";
                $numPasajero = trim(fgets(STDIN));
                /*Mientras el numero elegido sea mayor o igual a la cantidad de pasajeros o negativo, 
                seguira pidiendo hasta que se ingrese uno valido*/
                while ($numPasajero >= count($objViaje->getDatosDePasajeros()) || $numPasajero < 0){
                    echo "El numero de pasajero no es valido. Ingrese un numero de pasajero valido: ";
                    $numPasajero = trim(fgets(STDIN));
                }
                echo "Ingrese que dato desea modificar: ";
                $datoPasajero = trim(fgets(STDIN));
                /*Si el dato a modificar ingresado no es el nombre, el apellido o el dni, 
                seguira pidiendo dato a modificar hasta que se ingrese uno valido*/
                while (strcasecmp($datoPasajero,"nombre")!=0 && strcasecmp($datoPasajero,"apellido")!=0 && 
                    strcasecmp($datoPasajero,"numero de documento")!=0){
                    echo "El dato ingresado no es valido, debe ser nombre, apellido o numero de documento.\n".
                    "Ingrese el dato a modificar: ";
                    $datoPasajero = trim(fgets(STDIN));
                }
                echo "Ingrese el nuevo dato: ";
                $nuevoDato = trim(fgets(STDIN));
                $objViaje->modificarDatosPasajero($numPasajero,$datoPasajero,$nuevoDato);
            }
            break;
        case 8:
            //Imprime los datos del viaje
            echo $objViaje->__toString();
            break;
        case 9: 
            //Imprime los datos de los pasajeros
            print_r($objViaje->getDatosDePasajeros());
            break;
    }
}while ($opcion!=10);
//Mientras no se elija el 10 como opcion se seguira mostrando el menu y pidiendo elegir opcion
?>