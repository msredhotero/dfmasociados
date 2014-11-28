<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosClientes {

/* logica de negocios para los clientes */

function traerTipoClienteProveedor() {
	$sql = "select idtipocliente, tipocliente from tbtipocliente where proveedor = 1 order by tipocliente";	
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerTipoClienteNoProveedor() {
	$sql = "select idtipocliente, tipocliente from tbtipocliente where proveedor = 0 order by tipocliente";	
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function generarNroCliente($nombre) {
	$primerasLetras = substr(trim($nombre),0,2);
	$sql = "select idcliente from dbclientes order by idcliente desc";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		$num = mysql_result($res,0,0) + 1;	
	} else {
		$num = 1;
	}
	$nroCliente = $primerasLetras.str_pad($num,4,'0',STR_PAD_LEFT);
	return $nroCliente;
}


//el utf8_decode($cadena) este va en todos los campos que sean tipo string o cadena o varchar

function insertarCliente($nombre,$nrocliente,$email,$nrodocumento,$telefono,$cuit,$reftipocliente) {
	$sql	=	"insert into dbclientes(idcliente,nombre,nrocliente,email,nrodocumento,telefono,reftipocliente,cuit)
					values
						('',
						 '".utf8_decode($nombre)."',
						 '".utf8_decode($this->generarNroCliente($nombre))."',
						 '".utf8_decode($email)."',
						 ".($nrodocumento == '' ? 'null' : $nrodocumento).",
						 '".$telefono."',
						 ".$reftipocliente.",
						 '".$cuit."')";
	//return $sql;
	$res	=	$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}
}

	

	function eliminarCliente($id) {
		$sqlTurnoDesactivar = "update lcdd_turnos set activo = 0 where refcliente =".$id;
		$this->query($sqlTurnoDesactivar,0);
		
		$sql = "delete from dbclientes where idcliente =".$id;
		$res = $this->query($sql,0);
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
}


function modificarCliente($id,$nombre,$nrocliente,$email,$nrodocumento,$telefono) {
	$sql = "update dbclientes 			
			SET
			nombre = '".utf8_decode($nombre)."',
			email = '".utf8_decode($email)."',
			nrodocumento = ".($nrodocumento == '' ? 'null' : $nrodocumento).",
			telefono	= '".$telefono."'
			WHERE idcliente = ".$id;
	//return $sql;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}

}

function traerCantidadClientes() {
	$sql = "select count(idcliente) from dbclientes";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerClientes() {
	$sql	=	"select idcliente,nombre,nrocliente,email,nrodocumento,telefono from dbclientes ";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerClientesProveedores() {
	$sql	=	"select idcliente,nombre,nrocliente,email,nrodocumento,telefono ,cuit, tc.tipocliente
				 from dbclientes c
				 inner join tbtipocliente tc
				 on c.reftipocliente = tc.idtipocliente
				 where tc.proveedor = 1";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerClientesNoProveedores() {
	$sql	=	"select idcliente,nombre,nrocliente,email,nrodocumento,telefono ,cuit, tc.tipocliente
				 from dbclientes c
				 inner join tbtipocliente tc
				 on c.reftipocliente = tc.idtipocliente
				 where tc.proveedor = 0";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerClientePorId($id) {
	$sql	=	"select c.idcliente,c.nombre,c.nrocliente,c.email,c.nrodocumento,c.telefono,cc.saldo
				 from dbclientes c
				 join	lcdd_cuentas cc
				 on c.idcliente = cc.refcliente
				 where idcliente =".$id;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerClienteMovimientos($id) {
	$sql	=	"select c.idcliente,c.nombre,c.nrocliente,c.email,c.nrodocumento,c.telefono,cc.saldo
				 from dbclientes c
				 inner join	lcdd_cuentas cc
				 on c.idcliente = cc.refcliente
				 inner join lcdd_movimientos m
				 on cc.idcuenta = m.refcuenta
				 where c.idcliente =".$id;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerClientePorNroCliente($nrocliente) {
	$sql	=	"select idcliente,nombre,nrocliente,email,nrodocumento,telefono from dbclientes where nrocliente ='".$nrocliente."'";
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerClientePorNroDocumento($nrodocumento) {
	$sql	=	"select idcliente,nombre,nrocliente,email,nrodocumento,telefono from dbclientes where nrodocumento =".$nrodocumento;
	$res	=	$this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}



/* fin */

function query($sql,$accion) {
		
		
		
		$hostname = "localhost";
		$database = "dfmasociados";
		$username = "root";
		$password = "";
		
/*		$hostname = "db494455387.db.1and1.com";
		$database = "db494455387";
		$username = "dbo494455387";
		$password = "Admin1234";*/
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		*/
                $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>