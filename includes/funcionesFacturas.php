<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosFacturas {


function traerActividades() {
	$sql		=	"select idactividad,actividad from tbactividad";
	$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function insertarFactura($nrofactura,$fechacreacion,$usuacrea,$refformapago,$refcliente,$cancelada,$reftipoiva,$comentarios,$mes,$retencion,$otros,$percepcion,$refactividad,$exento,$gravado,$importe,$baseimponible)
{
$sql		=	"INSERT INTO dfmasociados.dbfacturas
						(idfactura,
						nrofactura,
						fechacreacion,
						usuacrea,
						refformapago,
						refcliente,
						cancelada,
						reftipoiva,
						comentarios,
						mes,
						retencion,
						otros,
						percepcion,
						refactividad,
						exento,
						gravado,
						importe,
						baseimponible)
					VALUES
						('',
						'".utf8_decode($nrofactura)."',
						'".$fechacreacion."',
						'".$usuacrea."',
						".$refformapago.",
						".$refcliente.",
						".$cancelada.",
						".$reftipoiva.",
						'".$comentarios."',
						'".$mes."',
						".$retencion.",
						'".$otros."',
						".$percepcion.",
						".$refactividad.",
						".$exento.",
						".$gravado.",
						".$importe.",
						".$baseimponible.")";
			//return $sql;
$res = $this->query($sql,1);

if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
		
}

function insertarDetalle($importe,$refiva,$reffactura) {
	$sql	=		"INSERT INTO dfmasociados.dbdetallefactura
						(iddetallefactura,
						importe,
						refiva,
						reffactura)
					VALUES
						('',
						".$importe.",
						".$refiva.",
						".$reffactura.")";
	$res = $this->query($sql,1);

if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}			
						
}

function traerFacturasBasico() {
	$sql = "select * from dbfacturas";
	$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerFacturaProveedor($anio) {
	$sql	=	"SELECT 
					v.idfactura,
					v.nrofactura,
					v.fechacreacion,
					v.mes,
					v.refcliente,
					v.actividad,
					v.retencion,
					v.percepcion,
					v.exento,
					v.gravado,
					v.nombre,
					v.tipocliente,
					v.importe,
					v.baseimponible,
					max(case
						when v.monto = 0.105 then v.importebase
						else 0
					end) as Importe10,
					max(case
						when v.monto = 0.210 then v.importebase
						else 0
					end) as Importe21,
					max(case
						when v.monto = 0.270 then v.importebase
						else 0
					end) as Importe27
				FROM
					dfmasociados.viewfacturas v
						inner join
					dfmasociados.tbmeses m ON v.mes = m.meses
				where
					v.proveedor = 1
					and year(v.fechacreacion) = '".$anio."'
				group by v.idfactura , v.nrofactura , v.fechacreacion , v.mes , v.baseimponible, v.refcliente , v.actividad , v.retencion , v.percepcion , v.exento , v.gravado , v.nombre , v.tipocliente , v.importe
				order by m.valor";
				
				$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerFacturaVendedor($anio) {
	$sql	=	"SELECT 
					v.idfactura,
					v.nrofactura,
					v.fechacreacion,
					v.mes,
					v.refcliente,
					v.actividad,
					v.retencion,
					v.percepcion,
					v.exento,
					v.gravado,
					v.nombre,
					v.tipocliente,
					v.importe,
					v.baseimponible,
					max(case
						when v.monto = 0.105 then v.importebase
						else 0
					end) as Importe10,
					max(case
						when v.monto = 0.210 then v.importebase
						else 0
					end) as Importe21,
					max(case
						when v.monto = 0.270 then v.importebase
						else 0
					end) as Importe27
				FROM
					dfmasociados.viewfacturas v
						inner join
					dfmasociados.tbmeses m ON v.mes = m.meses
				where
					v.proveedor = 0
					and year(v.fechacreacion) = '".$anio."'
				group by v.idfactura , v.nrofactura , v.fechacreacion , v.baseimponible, v.mes , v.refcliente , v.actividad , v.retencion , v.percepcion , v.exento , v.gravado , v.nombre , v.tipocliente , v.importe
				order by m.valor";
				
				$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerFacturaProveedorTodos() {
	$sql	=	"SELECT 
					v.idfactura,
					v.nrofactura,
					v.fechacreacion,
					v.mes,
					v.refcliente,
					v.actividad,
					v.retencion,
					v.percepcion,
					v.exento,
					v.gravado,
					v.nombre,
					v.tipocliente,
					v.importe,
					v.baseimponible,
					max(case
						when v.monto = 0.105 then v.importebase
						else 0
					end) as Importe10,
					max(case
						when v.monto = 0.210 then v.importebase
						else 0
					end) as Importe21,
					max(case
						when v.monto = 0.270 then v.importebase
						else 0
					end) as Importe27
				FROM
					dfmasociados.viewfacturas v
						inner join
					dfmasociados.tbmeses m ON v.mes = m.meses
				where
					v.proveedor = 1
				group by v.idfactura , v.nrofactura , v.fechacreacion , v.baseimponible, v.mes , v.refcliente , v.actividad , v.retencion , v.percepcion , v.exento , v.gravado , v.nombre , v.tipocliente , v.importe
				order by year(v.fechacreacion),m.valor";
				
				$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerFacturaVendedoresTodos() {
	$sql	=	"SELECT 
					v.idfactura,
					v.nrofactura,
					v.fechacreacion,
					v.mes,
					v.refcliente,
					v.actividad,
					v.retencion,
					v.percepcion,
					v.exento,
					v.gravado,
					v.nombre,
					v.tipocliente,
					v.importe,
					v.baseimponible,
					max(case
						when v.monto = 0.105 then v.importebase
						else 0
					end) as Importe10,
					max(case
						when v.monto = 0.210 then v.importebase
						else 0
					end) as Importe21,
					max(case
						when v.monto = 0.270 then v.importebase
						else 0
					end) as Importe27
				FROM
					dfmasociados.viewfacturas v
						inner join
					dfmasociados.tbmeses m ON v.mes = m.meses
				where
					v.proveedor = 0
				group by v.idfactura , v.nrofactura , v.fechacreacion , v.baseimponible, v.mes , v.refcliente , v.actividad , v.retencion , v.percepcion , v.exento , v.gravado , v.nombre , v.tipocliente , v.importe
				order by year(v.fechacreacion),m.valor";
				
				$res = $this->query($sql,0);

if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

Function query($sql,$accion) {
		
		
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