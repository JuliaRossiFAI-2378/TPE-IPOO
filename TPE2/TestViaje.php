<?php
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';
/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre,
 apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos 
 de la clase Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje, 
 para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. 
  La clase Viaje debe hacer referencia al responsable de realizar el viaje.
Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero.
 Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos.
  Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información 
  del responsable del viaje. */
$responsable = new ResponsableV(0,0,"","");
$viaje = new Viaje(0,"",0,0,[]);
$pasajeros = [];
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
  echo "[10] Ver los datos del responsable.\n";
  echo "[11] Modificar los datos del responsable.\n";
  echo "[12] Salir.\n";
  echo "Ingrese la opcion del menu que desea elegir: ";
  //Verifica que el numero elegido vaya unicamente entre las opciones del menu
  $opcionMenu = solicitarNumeroEntre(1,12);
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
          echo "Ingrese el nombre del responsable del viaje: ";
          $nombreResponsable = trim(fgets(STDIN));
          echo "Ingrese el apellido del responsable del viaje: ";
          $apellidoResponsable = trim(fgets(STDIN));
          echo "Ingrese el numero de licencia del responsable: ";
          $numeroLicencia = trim(fgets(STDIN));
          echo "Ingrese el numero de empleado del responsable: ";
          $numeroEmpleado = trim(fgets(STDIN));
          $responsable = new ResponsableV($numeroEmpleado,$numeroLicencia,$nombreResponsable,$apellidoResponsable);
          $viaje = new Viaje($codViaje,$destViaje,$cantidadMaximaPasajeros,$responsable,$pasajeros);
          break;
      case 2:
          echo "Ingrese el nuevo codigo de viaje: ";
          $nuevoCodigoViaje = trim(fgets(STDIN));
          $viaje->setCodigoViaje($nuevoCodigoViaje);
          break;
      case 3:
          echo "Ingrese el nuevo destino de viaje: ";
          $nuevoDestinoViaje = trim(fgets(STDIN));
          $viaje->setDestinoViaje($nuevoDestinoViaje);
          break;
      case 4:
          echo "Ingrese la nueva cantidad maxima de pasajeros: ";
          //Verifica que lo ingresado no sea un numero negativo o caracteres
          $nuevaCantMaxPasajeros = solicitarNumeroEntre(0,999);
          $viaje->setCantMaxPasajeros($nuevaCantMaxPasajeros);
          break;
      case 5: 
          //Verifica que no se haya alcanzado la cantidad maxima de pasajeros
          if ($viaje->getCantidadPasajerosViaje()==$viaje->getCantMaxPasajeros()){
              echo "Ya se ha llegado a la cantidad maxima de pasajeros, no se pueden agregar mas.\n";
          }else{
              echo "Ingrese el nombre del pasajero: ";
              $nombrePasajero = trim(fgets(STDIN));
              echo "Ingrese el apellido del pasajero: ";
              $apellidoPasajero = trim(fgets(STDIN));
              echo "Ingrese el numero de documento del pasajero: ";
              $documentoPasajero = trim(fgets(STDIN));
              echo "Ingrese el numero de telefono del pasajero: ";
              $telefonoPasajero = trim(fgets(STDIN));
              $nuevoPasajero = new Pasajero($nombrePasajero,$apellidoPasajero,$documentoPasajero,$telefonoPasajero);
              $viaje->agregarNuevoPasajero($nuevoPasajero);
          }            
          break;
      case 6:
          //Verifica que si hayan pasajeros para eliminar
          if ($viaje->getCantidadPasajerosViaje()==0){
              echo "No hay pasajeros para eliminar.\n";
          }else{
              //Muestra los pasajeros asi el usuario sabe que numero de pasajero elegir
              print_r($viaje->getPasajeros());
              echo "Ingrese que pasajero desea eliminar: ";
              //Solicita un numero que no sobrepase la cantidad de pasajeros
              $numeroDePasajero = solicitarNumeroEntre(0,$viaje->getCantidadPasajerosViaje()-1);
              $viaje->eliminarPasajero($numeroDePasajero);
          }
          break;
      case 7:
          //Verifica que haya pasajeros para modificar
          if ($viaje->getCantidadPasajerosViaje()==0){
              echo "No hay pasajeros registrados.\n";
          }else{
              //Imprime los pasajeros para que el usuario sepa que numero seleccionar
              print_r($viaje->getPasajeros());
              echo "Ingrese el numero de pasajero que desea modificar: ";
              $numPasajero = trim(fgets(STDIN));
              /*Mientras el numero elegido sea mayor o igual a la cantidad de pasajeros o negativo, 
              seguira pidiendo hasta que se ingrese uno valido*/
              while ($numPasajero >= count($viaje->getPasajeros()) || $numPasajero < 0){
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
              $viaje->modificarDatosPasajero($numPasajero,$datoPasajero,$nuevoDato);
          }
          break;
      case 8:
          //Imprime los datos del viaje
          echo $viaje;
          break;
      case 9: 
          //Imprime los datos de los pasajeros
          print_r($viaje->getPasajeros());
          break;
      case 10:
          echo $responsable;
          break;
      case 11:
          echo "Ingrese el nombre del responsable: ";
          $nombreResponsable = trim(fgets(STDIN));
          $responsable->setNombreResponsable($nombreResponsable);
          echo "Ingrese el apellido del responsable: ";
          $apellidoResponsable = trim(fgets(STDIN));
          $responsable->setApellidoResponsable($apellidoResponsable);
          echo "Ingrese el numero de empleado del responsable: ";
          $numeroEmpleado = trim(fgets(STDIN));
          $responsable->setNumeroEmpleado($numeroEmpleado);
          echo "Ingrese el numero de licencia del responsable: ";
          $numeroLicencia = trim(fgets(STDIN));
          $responsable->setNumeroLicencia($numeroLicencia);
          echo "Los datos fueron cambiados exitosamente.";
          break;
  }
}while ($opcion!=12);
//Mientras no se elija el 12 como opcion se seguira mostrando el menu y pidiendo elegir opcion
?> 