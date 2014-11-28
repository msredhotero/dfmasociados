<?php

include ('../includes/funcionesFacturas.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesUsuarios.php');

$ServiciosFacturas  = new ServiciosFacturas();
$serviciosClientes  = new serviciosClientes();
$serviciosUsuarios  = new ServiciosUsuarios();

$accion = $_POST['accion'];


switch ($accion) {
    case 'insertarFactura':
        insertarFactura($ServiciosFacturas);
        break;
   
}

function insertarFactura($ServiciosFacturas) {
	$nrofactura				=	$_POST['nrofactura'];
	$fechafactura			=	$_POST['fechafactura'];
	$exento					=	$_POST['exento'];
	$gravado				=	$_POST['gravado'];
	$importe1				=	$_POST['importe1'];
	$importe2				=	$_POST['importe2'];
	$importe3				=	$_POST['importe3'];
	$importeRetencion		=	$_POST['importeRetencion'];
	$percepcion				=	$_POST['percepcion'];
	$actividad				=	$_POST['actividad'];
	$refcliente				=	$_POST['refcliente'];
	$importe				=	$_POST['importe'];
	$baseimponible			=	$_POST['baseimponible'];
	
	$ServiciosFacturas->insertarDetalle($importe1 == '' ? 0 : $importe1,2,$reffactura);
	$ServiciosFacturas->insertarDetalle($importe2 == '' ? 0 : $importe2,1,$reffactura);
	$ServiciosFacturas->insertarDetalle($importe3 == '' ? 0 : $importe3,4,$reffactura);
	
	$res = $ServiciosFacturas->insertarFactura($nrofactura,$fechafactura,'diego',1,$refcliente,1,1,'',date('M'),$importeRetencion,'',$percepcion,$actividad,$exento,$gravado,$importe,$baseimponible);
	
	
}


?>