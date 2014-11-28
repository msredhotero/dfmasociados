<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosFacturas {


function traerActividades() {
	$sql		=	"select idactividad,actividad from tbactividad";
	$res = $this->query($sql,0);

return $res;
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
$res = $this->query($sql,1);

return $res;
		
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

return $res;				
						
}

function traerFacturas($idFactura) {
	
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
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}




?>