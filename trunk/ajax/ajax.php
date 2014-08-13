<?php

include ('../includes/funcionesHTML.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesUsuarios.php');

$ServiciosFunciones = new ServiciosHTML();
$serviciosClientes  = new serviciosClientes();
$serviciosUsuarios  = new ServiciosUsuarios();

$accion = $_POST['accion'];


switch ($accion) {
    case 'enviarMail':
        enviarMail($ServiciosFunciones);
        break;
    case 'cargarCliente':
    	cargarCliente($serviciosClientes);
    	break;
    case 'modificarCliente':
    	modificarCliente($serviciosClientes);
    	break;
    case 'insertarCompra':
    	insertarCompra($serviciosClientes);
    	break;
    case 'insertarDetalleDeFactura':
    	insertarDetalleDeFactura($serviciosClientes);
    	break;
    case 'cargarUsuario':
        cargarUsuario($serviciosUsuarios);
        break;
    case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
    case 'modificarAsignacion':
        modificarAsignacion($serviciosUsuarios);
        break;
    case 'eliminarAsignacion':
        eliminarAsignacion($serviciosUsuarios);
        break;
    case 'eliminarUsuario':
        eliminarUsuario($serviciosUsuarios);
        break;
	case 'borrarCompraA':
		borrarCompraA($serviciosClientes);
		break;
	case 'eliminarCliente':
		eliminarCliente($serviciosClientes);
		break;
	case 'agregarAsignacion':
		agregarAsignacion($serviciosUsuarios);
		break;
	case 'insertarDatosFacturacion':
		insertarDatosFacturacion($serviciosClientes);
		break;
	case 'modificarDatosFacturacion':
		modificarDatosFacturacion($serviciosClientes);
		break;
	case 'borrarArchivo':
		borrarArchivo($serviciosClientes);
		break;
	case 'TraerArchivo':
		TraerArchivo($serviciosClientes);
		break;
	case 'borrarClienteDefinitivamente':
		borrarClienteDefinitivamente($serviciosClientes);
		break;
}

function borrarClienteDefinitivamente($serviciosClientes) {
	$idCliente	=	$_POST['idcliente'];
	echo	$serviciosClientes->borrarClienteDefinitivamente($idCliente);
}


function TraerArchivo($serviciosClientes) {
	$id			=	$_POST['id'];
	echo	$serviciosClientes->TraerArchivo($id);	
}

function borrarArchivo($serviciosClientes) {
	$id			=	$_POST['id'];
	$archivo	=	$_POST['archivo'];
	echo $serviciosClientes->borrarArchivo($id,$archivo);	
	
}


function insertarDatosFacturacion($serviciosClientes) {
	$refcliente			=	$_POST['refcliente'];
	$nombre				=	utf8_decode(str_replace("'","",$_POST['nombre']));
	$direccion			=	utf8_decode(str_replace("'","",$_POST['direccion']));
	$ciudad				=	utf8_decode(str_replace("'","",$_POST['ciudad']));
	$pais				=	utf8_decode(str_replace("'","",$_POST['pais']));
	$nif				=	str_replace("'","",$_POST['nif']);
	$telefonofijo		=	str_replace("'","",$_POST['telefonofijo']);
	$telefonomovil		=	str_replace("'","",$_POST['telefonomovil']);	
	$serviciosClientes->insertarDatosFacturacion($refcliente,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	echo '';
}


function modificarDatosFacturacion($serviciosClientes) {
	$refcliente			=	$_POST['refcliente'];
	$nombre				=	utf8_decode(str_replace("'","",$_POST['nombre']));
	$direccion			=	utf8_decode(str_replace("'","",$_POST['direccion']));
	$ciudad				=	utf8_decode(str_replace("'","",$_POST['ciudad']));
	$pais				=	utf8_decode(str_replace("'","",$_POST['pais']));
	$nif				=	str_replace("'","",$_POST['nif']);
	$telefonofijo		=	str_replace("'","",$_POST['telefonofijo']);
	$telefonomovil		=	str_replace("'","",$_POST['telefonomovil']);	
	$serviciosClientes->modificarDatosFacturacion($refcliente,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	echo '';
}

function agregarAsignacion($serviciosUsuarios) {
	$idCliente             =   $_POST['idcliente'];
	$idUsuario             =   $_POST['idusuario'];
	echo 		$serviciosUsuarios->agregarAsignacion($idUsuario,$idCliente);
}

function eliminarCliente($serviciosClientes) {
	$id             =   $_POST['id'];
	echo	$serviciosClientes->eliminarCliente($id);
}

function borrarCompraA($serviciosClientes) {
	$id             =   $_POST['id'];
	echo	$serviciosClientes->borrarCompraA($id);	
}

function eliminarUsuario($serviciosUsuarios) {
    $idUsuario      =   $_POST['idusuario'];
    $id             =   $_POST['id'];
    echo    $serviciosUsuarios->eliminarUsuario($idUsuario,$id);
}

function eliminarAsignacion($serviciosUsuarios) {
    $id     =   $_POST['id'];
    echo    $serviciosUsuarios->eliminarAsignacion($id);
}

function modificarAsignacion($serviciosUsuarios) {
    $idUsuario      =   $_POST['idusuario'];
    $idCliente      =   $_POST['idcliente'];
    
    echo $serviciosUsuarios->modificarAsignacion($idUsuario,$idCliente);
}

function modificarUsuario($serviciosUsuarios) {
    $id             =   $_POST['id'];             
    $usuario        =   $_POST['usuario'];
    $password       =   $_POST['password'];
    $nombrecompleto =   $_POST['nombrecompleto'];
    $email          =   $_POST['email'];
    
    echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$nombrecompleto,$email);
}

function cargarUsuario($serviciosUsuarios) {
    
    $usuario        =   $_POST['usuario'];
    $password       =   $_POST['password'];
    $refrol         =   $_POST['refrol'];
    $nombrecompleto =   $_POST['nombrecompleto'];
    $email          =   $_POST['email'];
    $refcliente     =   $_POST['refcliente'];
    $cliente        =   $_POST['cliente'];
    
    echo $serviciosUsuarios->cargarUsuario($usuario,$password,$refrol,$nombrecompleto,$email,$refcliente,$cliente);
}

function enviarMail($ServiciosFunciones)
{
	$nombre = $_POST['nombre'];
	$mensaje = $_POST['mensaje'];
	$email = $_POST['email'];

	echo $ServiciosFunciones->enviarMail($nombre,$mensaje,$email);
}



function cargarCliente($serviciosClientes) {
	$url = $_POST['url'];
	$formapago = $_POST['formapago'];
	$acceso = $_POST['acceso'];
	$nombre				=	utf8_decode(str_replace("'","",$_POST['nombre']));
	$direccion			=	utf8_decode(str_replace("'","",$_POST['direccion']));
	$ciudad				=	utf8_decode(str_replace("'","",$_POST['ciudad']));
	$pais				=	utf8_decode(str_replace("'","",$_POST['pais']));
	$nif				=	str_replace("'","",$_POST['nif']);
	$telefonofijo		=	str_replace("'","",$_POST['telefonofijo']);
	$telefonomovil		=	str_replace("'","",$_POST['telefonomovil']);
	
    echo $refcliente = $serviciosClientes->cargarCliente($url,$formapago,$acceso,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);        	
//	$refcliente			=	$_POST['refcliente'];
	
	//echo $serviciosClientes->insertarDatosFacturacion($refcliente,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
}

function modificarCliente($serviciosClientes) {
	$url			=	$_POST['url'];
	$acceso			=	$_POST['acceso'];
	$refformapago	=	$_POST['formapago'];
	$id				=	$_POST['id'];
	$fechabaja		=	$_POST['fechabaja'];

    $serviciosClientes->modificarCliente($id,$url,$refformapago,$acceso,$fechabaja);        	
	
	$datos = $serviciosClientes->TraerDatosDeFacturacion($id);
	
	$nombre				=	utf8_decode(str_replace("'","",$_POST['nombre']));
	$direccion			=	utf8_decode(str_replace("'","",$_POST['direccion']));
	$ciudad				=	utf8_decode(str_replace("'","",$_POST['ciudad']));
	$pais				=	utf8_decode(str_replace("'","",$_POST['pais']));
	$nif				=	str_replace("'","",$_POST['nif']);
	$telefonofijo		=	str_replace("'","",$_POST['telefonofijo']);
	$telefonomovil		=	str_replace("'","",$_POST['telefonomovil']);
	
	if (mysql_num_rows($datos) > 0) {
		$serviciosClientes->modificarDatosFacturacion($id,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	} else {
		$serviciosClientes->insertarDatosFacturacion($id,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	}
	echo "";
}

function insertarDetalleDeFactura($serviciosClientes) {
	$nrofactura		=	$_POST['nrofactura'];
	$concepto		=	$_POST['concepto'];
	$importe		=	$_POST['importe'];
	$cantidad		=	$_POST['cantidad'];
	$reffactura		=	$_POST['reffactura'];

	echo $serviciosClientes->insertarDetalleDeFactura($nrofactura,$concepto,$importe,$cantidad,$reffactura);

}


function insertarCompra($serviciosClientes)
{
	$factura 			=	$_POST['nrofactura'];
	$fechacreacion		=	date('Y-m-d');
	$usuacrea			=	$_POST['usuacrea'];
	$refcliente			=	$_POST['refcliente'];
	$reftipoiva			=	$_POST['reftipoiva'];
	$refretencion		=	$_POST['refretencion'];
	$palabraclave		=	$_POST['palabraclave'];
    $comentarios        =   $_POST['comentarios'];
    $otros              =   $_POST['otros'];

	echo $serviciosClientes->insertarCompra($factura,$fechacreacion,$usuacrea,$refcliente,$reftipoiva,$palabraclave,$comentarios,$refretencion,$otros);
}
?>