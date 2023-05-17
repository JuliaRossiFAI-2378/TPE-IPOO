<?php
include_once 'Pasajero.php';
include_once 'PasajeroEspecial.php';
include_once 'PasajeroVIP.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';

$vip1 = new PasajeroVIP("vip1",9,2,48,301);
$vip2 = new PasajeroVIP("vip2",10,5,32,200);
$esp1 = new PasajeroEspecial("esp1",1,34,true,false,false);
$esp2 = new PasajeroEspecial("esp2", 2,10,true,true,false);
$pas1 = new Pasajero("pas1",40,21);
$pasViaje1 = array($vip1,$esp1,$pas1);
$pasViaje2 = array($vip2,$esp2,$pas1);
$responsable = new ResponsableV(10,12,"resp","viaje");
$viaje1 = new Viaje(30,"Destino1",3,$responsable,$pasViaje1,5000,30000);
$viaje2 = new Viaje(30,"Destino2",30,$responsable,$pasViaje2,5500,35000);

$viaje1->venderPasaje($vip2);
$viaje2->venderPasaje($vip1);


?>