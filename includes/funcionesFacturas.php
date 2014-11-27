<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosFacturas {


function insertarFactura($nrofactura,$fechacreacion,$usuacrea,$refformapago,$refcliente,$cancelada,$reftipoiva,$comentarios,$mes,$retencion,$otros,$percepcion,$refactividad,$exento,$gravado,$importe)
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
						gravado)
					VALUES
						('',
						'".$nrofactura."',
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
						".$importe.")";
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