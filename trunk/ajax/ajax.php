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
	$proveedor				=	$_POST['proveedor'];
	
	if ($proveedor == 1) {
		$BuscarMes = date('m');	
	} else {
		$BuscarMes = substr($fechafactura,5,2);	
	}
	
	switch ($BuscarMes) {
    case '01':
        $mes= 'Enero';
        break;
   	case '02':
        $mes= 'Febrero';
        break;
	case '03':
        $mes= 'Marzo';
        break;
	case '04':
        $mes= 'Abril';
        break;
	case '05':
        $mes= 'Mayo';
        break;
	case '06':
        $mes= 'Junio';
        break;
	case '07':
        $mes= 'Julio';
        break;
	case '08':
        $mes= 'Agosto';
        break;
	case '09':
        $mes= 'Septiembre';
        break;
	case '10':
        $mes= 'Octubre';
        break;
	case '11':
        $mes= 'Noviembre';
        break;
	case '12':
        $mes= 'Diciembre';
        break;
	}
	
	
	
	$res = $ServiciosFacturas->insertarFactura($nrofactura,$fechafactura,'diego',1,$refcliente,1,1,'',$mes,$importeRetencion,'',$percepcion,$actividad,$exento,$gravado,$importe,$baseimponible);
	
	$ServiciosFacturas->insertarDetalle($importe1 == '' ? 0 : $importe1,2,$res);
	$ServiciosFacturas->insertarDetalle($importe2 == '' ? 0 : $importe2,1,$res);
	$ServiciosFacturas->insertarDetalle($importe3 == '' ? 0 : $importe3,4,$res);
	
	echo $res;
	
	//echo $fechafactura;
}


?>