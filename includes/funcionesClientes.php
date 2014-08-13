<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosClientes {

function borrarClienteDefinitivamente($idcliente)
{
		
	/* Borro los detalles de las facturas */	
	$sqlDetalleFacturas = "delete from		dbdetallefacturas where		reffactura in (select idfactura from dbfacturas where refcliente = ".$idcliente.")";
	$this->query($sqlDetalleFacturas,0);
	
	/* Borro las facturas */	
	$sqlFacturas = "delete from	dbfacturas where refcliente = ".$idcliente;
	$this->query($sqlFacturas,0);
	
	
	/* Borro los archivos */	
	$sqlArchivos = "select idarchivos from dbarchivosclientes where refcliente =".$idcliente;
	$resAr = $this->query($sqlArchivos,0);
	
	if (mysql_num_rows($resAr)>0) {
		while ($row = mysql_fetch_array($resAr))
		{
			$this->borrarArchivo($row[0],'');	
		}
	}
	
	/* Borro datos de Facturacion */	
	$sqlDatosFacturacion = "delete from tbdatosfacturacioncliente where refcliente =".$idcliente;
	$this->query($sqlDatosFacturacion,0);
	
	/* Borro vinculacion usuario - cliente */	
	$sqlUsuariosClientes = "delete from dbusuariosclientes where refcliente =".$idcliente;
	$this->query($sqlUsuariosClientes,0);
	
	/* Borro fechaPago del cliente */	
	$sqlFechaPago = "delete from dbclientesfechapago where refcliente =".$idcliente;
	$this->query($sqlFechaPago,0);
	
	
	/* borro al cliente */
	$sqlCliente = "delete from dbclientes where idcliente =".$idcliente;
	$this->query($sqlCliente,0);
	
	return '';
	
}



function borrarDirecctorio($dir) {
	array_map('unlink', glob($dir."/*.*"));	
	
}


function TraerArchivo($id) {
	$sql	=	"select carpeta,archivo,concat(carpeta,'/',archivo) as nombrecompleto from dbarchivosclientes where idarchivos =".$id;
	return	mysql_result($this->query($sql,0),0,2);
}

function borrarArchivo($id,$archivo) {
	$sql	=	"delete from dbarchivosclientes where idarchivos =".$id;
	$archivo = $this->TraerArchivo($id);
	$res =  unlink("../archivos/".$archivo);
	if ($res)
	{
		$this->query($sql,0);	
	}
	return $res;
}


function TraerDatosDeFacturacion($idcliente) {
	$sql	=	"select * from tbdatosfacturacioncliente where refcliente =".$idcliente;
	return	$this->query($sql,0);	
}

function insertarDatosFacturacion($refcliente,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil) {
	$sql	=	"INSERT INTO tbdatosfacturacioncliente
														(iddatosfacturacion,
														refcliente,
														nombre,
														direccion,
														ciudad,
														pais,
														nif,
														telefonofijo,
														telefonomovil)
														
														VALUES
														
														('' ,
														".$refcliente.",
														'".$nombre."' ,
														'".$direccion."' ,
														'".$ciudad."' ,
														'".$pais."' ,
														'".$nif."' ,
														'".$telefonofijo."' ,
														'".$telefonomovil."' );";	
	return $this->query($sql,1);
	//return $sql;
}

function modificarDatosFacturacion($refcliente,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil) {
	$sql	=	"update tbdatosfacturacioncliente		set
														refcliente			= ".$refcliente.",
														nombre				= '".$nombre."' ,
														direccion			= '".$direccion."' ,
														ciudad				= '".$ciudad."' ,
														pais				= '".$pais."' ,
														nif					= '".$nif."' ,
														telefonofijo		= '".$telefonofijo."' ,
														telefonomovil		= '".$telefonomovil."'
														where refcliente = ".$refcliente;
														
	return $this->query($sql,0);
	//return $sql;
}

function eliminarDatosFacturacion($id) {
	$sql	=	"delete from tbdatosfacturacioncliente where iddatosfacturacion = ".$id;	
	return $this->query($sql,0);
}


function cargarArchivo($idcliente,$carpeta,$archivo,$tipoarchivo) {
	$sql	=	"insert into dbarchivosclientes values ('',".$idcliente.",'".$archivo."','".$tipoarchivo."','".$carpeta."')";
	return $this->query($sql,1);
		
}

function TraerArchivosClientes($idUsuario) {
	$sql	=	"select c.url, a.archivo, a.tipoarchivo,c. acceso, a.idarchivos, a.carpeta
				 from	dbclientes c
				 inner
				 join	dbarchivosclientes a
				 on		c.idcliente = a.refcliente
				 inner
				 join	dbusuariosclientes uc
				 on		uc.refcliente = c.idcliente
				 where	uc.refusuario =".$idUsuario;
	return $this->query($sql,0);
	
}

function TraerArchivosClientesAdministrador($idCliente) {
	$sql	=	"select c.url, a.archivo, a.tipoarchivo,c. acceso, a.idarchivos, a.carpeta
				 from	dbclientes c
				 inner
				 join	dbarchivosclientes a
				 on		c.idcliente = a.refcliente
				 where	c.idcliente =".$idCliente;
	return $this->query($sql,0);
	
}


function TraerClientes()
{
		$sql		= "select * from dbclientes";
		$resultado	= $this->query($sql,0);
		return $resultado;	
}


function TraerClientesNoAsignados()
{
		$sql		= "select
						c.idcliente,
						c.url
						from 		dbclientes c
						left
						join		dbusuariosclientes uc
						on			c.idcliente = uc.refcliente
						where		uc.refcliente is null";
		$resultado	= $this->query($sql,0);
		return $resultado;	
}


function existe($url){
 
           $sql        =   "SELECT idcliente FROM dbclientes WHERE replace(replace(url,'http://',''),'www.','')= '".$url. "'";         
           $resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;

        }


function cargarCliente($url,$formapago,$acceso,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil)
{
	$devuelve = "";
	$urlAux = $url;
	$url = str_replace("http://","",$url);
	$url = str_replace("www.","",$url);
	if($this->existe($url)>0){

                $devuelve    =   "Ya existe un cliente con esa url ".$urlAux;
                            
            } else {


	$sql = "INSERT INTO dbclientes
									(idcliente,
									url,
									fechaingreso,
									estado,
									refformapago,
									acceso,
									fechabaja)
									VALUES
									('',
									'".$urlAux."',
									'".date('Y-m-d')."',
									1,
									".$formapago.",
									".$acceso.",
									null);";
	$resultado = $this->query($sql,1);
	//return $sql;
	$this->insertarDatosFacturacion($resultado,$nombre,$direccion,$ciudad,$pais,$nif,$telefonofijo,$telefonomovil);
	}
	return $devuelve;
	
}

function modificarCliente($id,$url,$idformapago,$acceso,$fechabaja) {
	
	$activo = 0;
	$devuelve = "";
	if ($fechabaja == "") {
		$fechabaja = null;
		$activo = 1;
	}
	$urlAux = $url;
	$url = str_replace("http://","",$url);
	$url = str_replace("www.","",$url);
	$idExiste = $this->existe($url);
	if($idExiste>0){
				if($idExiste == $id) {
					$sql		= "update dbclientes set url = '".$urlAux."',estado = ".$activo.", refformapago =".$idformapago.", acceso=".$acceso.", fechabaja='".$fechabaja."' where idcliente =".$id;
					$resultado	= $this->query($sql,0);
				} else {
					$devuelve    =   "Ya existe un cliente con esa url ".$urlAux;	
				}
                
                            
            } else {

				$sql		= "update dbclientes set url = '".$urlAux."',estado = ".$activo.", refformapago =".$idformapago.", acceso=".$acceso.", fechabaja='".$fechabaja."' where idcliente =".$id;
				$resultado	= $this->query($sql,0);
	}
	return $devuelve;
}


function insertarDetalleDeFactura($nrofactura,$concepto,$importe,$cantidad,$reffactura) {
	$sqlDBF = "INSERT INTO dbdetallefacturas
				(iddetallefactura,
				nrofactura,
				concepto,
				importe,
				cantidad,
				reffactura)
				VALUES
				('',
				'".$nrofactura."',
				'".str_replace("'","",$concepto)."',
				".$importe.",
				".$cantidad.",
				".$reffactura.")";
		return $resDBF = $this-> query($sqlDBF,1);


}

function insertarCompra($factura,$fechacreacion,$usuacrea,$refcliente,$reftipoiva,$palabraclave,$comentarios,$refretencion,$otros)
	{
		
		
		$sqlF = "INSERT INTO dbfacturas
				(idfactura,
				nrofactura,
				fechacreacion,
				usuacrea,
				refcliente,
				cancelada,
				reftipoiva,
                comentarios,
				refretencion,
                otros,
                palabraclave,
                refformapago)                          
				VALUES                                   
				('',
				'".$factura."',                        
				'".$fechacreacion."',                     
				'".$usuacrea."',                                               
				".$refcliente.",
				0,
				".$reftipoiva.",
                '".str_replace("'","",$comentarios)."',
				".$refretencion.",
                ".$otros.",
                '".$palabraclave."',1)";
		$resF = $this-> query($sqlF,1);	
		
		
		return $resF;
	}

function TraerDetalleCompraA($id) {
	$sql         =   "SELECT 
                        f.idfactura,
                        f.nrofactura,
                        df.concepto,
                        df.importe,
                        df.cantidad,
                        i.descripcion,
                        i.monto,
                        f.palabraclave,
                        c.url,
                        c.fechaingreso,
                        c.fechabaja,
                        r.monto as retencionValor,
                        r.retencion
                    FROM
                        dbfacturas f
                            inner join
                        dbdetallefacturas df ON f.idfactura = df.reffactura
                            inner join
                        tbtipoiva i ON i.idtipoiva = f.reftipoiva
                            inner join
                        tbformaspago fp ON fp.idformapago = f.refformapago
                            inner join
                        dbclientes c ON c.idcliente = f.refcliente
                            inner join
                        tbretenciones r on f.refretencion = r.idretencion
                    where    f.idfactura = ".$id.";";
	return $this->query($sql,0);
}

function TraerCompraA($id) {
    $sql = "SELECT 
                f.idfactura,
                f.nrofactura,
                sum(df.importe) + (sum(df.importe) * i.monto) + (sum(df.importe) * r.monto) + f.otros as montototal,
                sum(df.cantidad) as cantidad,
                sum(df.importe) as importe,
                i.monto,
                i.descripcion,
                f.palabraclave,
                c.url,
                c.fechaingreso,
                c.fechabaja,
                fp.descripcion as formapago,
                r.monto as retencionValor,
                r.retencion,
                f.otros,
				f.comentarios
            FROM
                dbfacturas f
                    inner join
                dbdetallefacturas df ON f.idfactura = df.reffactura
                    inner join
                tbtipoiva i ON i.idtipoiva = f.reftipoiva
                    inner join
                tbformaspago fp ON fp.idformapago = f.refformapago
                    inner join
                dbclientes c ON c.idcliente = f.refcliente
                    inner join
                tbretenciones r on f.refretencion = r.idretencion
            where    f.idfactura = ".$id."
            group by f.idfactura,
                f.nrofactura,
                i.descripcion,
                f.palabraclave,
                c.url,
                c.fechaingreso,
                c.fechabaja,
                fp.descripcion,
                r.monto,
                r.retencion,
                f.otros,
				f.comentarios;";
                return $this->query($sql,0);
    }
	
	
function borrarCompraA($id) {
    $sql = "delete 
            FROM
                dbfacturas
            where    idfactura = ".$id;
    $res = $this->query($sql,0);
	
	$sqlD = "delete 
            FROM
                dbdetallefacturas
            where    reffactura = ".$id;
    return $this->query($sqlD,0);
}

function eliminarCliente($id) {
	$sql = "update dbclientes set estado = 0, acceso = 0, fechabaja='".date('Y-m-d')."'  where idcliente =".$id;
	return $this->query($sql,0);
}

function TraerDistribuidorClientes($idUsuario)
{
	$sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 inner
								 join dbusuariosclientes uc
								 on	  uc.refcliente = c.idcliente
								 inner
								 join dbusuarios u
								 on   u.idusuario = uc.refusuario and u.refroll = 3
								 where u.idusuario =".$idUsuario;
    $resultado   =   $this->query($sql,0);	
	return $resultado;
}

function TraerFacturasClientesDistribuidorAdmin($id) {
    $sql = "select 
				f.idfactura,
							f.nrofactura,
							sum(df.importe) + (sum(df.importe) * i.monto) - (sum(df.importe) * r.monto) + f.otros as montototal,
							sum(df.cantidad) as cantidad,
							i.descripcion,
							f.palabraclave,
							r.retencion,
							f.otros,
							f.fechacreacion
			from
				
				dbclientes c
					inner join
				dbfacturas f ON c.idcliente = f.refcliente
					inner join
				dbdetallefacturas df ON df.reffactura = f.idfactura
					inner join
				tbtipoiva i ON i.idtipoiva = f.reftipoiva
					inner join
				tbretenciones r ON r.idretencion = f.refretencion
					inner join
				tbformaspago fp ON fp.idformapago = f.refformapago
				where			c.idcliente = ".$id."
			group by f.idfactura,
							f.nrofactura,
							i.descripcion,
							f.palabraclave,
							r.retencion,
							f.otros,
							f.fechacreacion;";
    return $this->query($sql,0);
}

function TraerPanelClientes($idusuario) {
	$sql = "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 inner
								 join dbusuariosclientes uc
								 on	  uc.refcliente = c.idcliente
								 inner
								 join dbusuarios u
								 on   u.idusuario = uc.refusuario
                                 WHERE u.idusuario=".$idusuario;
	return $this->query($sql,0);	
}

function TraerPanelClientesAdmin($idcliente) {
	$sql = "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 left
								 join dbusuariosclientes uc
								 on	  uc.refcliente = c.idcliente
								 left
								 join dbusuarios u
								 on   u.idusuario = uc.refusuario
                                 WHERE c.idcliente=".$idcliente;
	return $this->query($sql,0);	
}

function TraerFacturasClientes($idcliente) {
    $sql = "SELECT 
                f.idfactura,
                f.nrofactura,
                sum(df.importe) + (sum(df.importe) * i.monto) + (sum(df.importe) * r.monto) + f.otros as montototal,
                sum(df.cantidad) as cantidad,
                i.descripcion,
                f.palabraclave,
                r.retencion,
                f.otros,
	            f.fechacreacion
                
            FROM
                dbfacturas f
                    inner join
                dbdetallefacturas df ON f.idfactura = df.reffactura
                    inner join
                tbtipoiva i ON i.idtipoiva = f.reftipoiva
                inner join
               tbretenciones r ON r.idretencion = f.refretencion
                    inner join
                tbformaspago fp ON fp.idformapago = f.refformapago
                    inner join
                dbclientes c ON c.idcliente = f.refcliente
            where    c.idcliente = ".$idcliente."
            group by f.idfactura,
                f.nrofactura,
                i.descripcion,
                f.palabraclave,
                r.retencion,
                f.otros,
	            f.fechacreacion;";
    return $this->query($sql,0);
}

function TraerFacturasClientesDistribuidor($id) {
    $sql = "select 
				f.idfactura,
							f.nrofactura,
							sum(df.importe) + (sum(df.importe) * i.monto) + (sum(df.importe) * r.monto) + f.otros as montototal,
							sum(df.cantidad) as cantidad,
							i.descripcion,
							f.palabraclave,
							r.retencion,
							f.otros,
							f.fechacreacion
			from
				dbusuarios u
					inner join
				dbusuariosclientes uc ON u.idusuario = uc.refusuario
					inner join
				dbclientes c ON uc.refcliente = c.idcliente
					left join
				dbfacturas f ON c.idcliente = f.refcliente
					left join
				dbdetallefacturas df ON df.reffactura = f.idfactura
					inner join
				tbtipoiva i ON i.idtipoiva = f.reftipoiva
					inner join
				tbretenciones r ON r.idretencion = f.refretencion
					inner join
				tbformaspago fp ON fp.idformapago = f.refformapago
				where			u.idusuario = ".$id."
			group by f.idfactura,
							f.nrofactura,
							i.descripcion,
							f.palabraclave,
							r.retencion,
							f.otros,
							f.fechacreacion;";
    return $this->query($sql,0);
}

function TraerClientesUsuario($idUsuario) {
	$sql         =   "SELECT 
                                        c.url,
                                    	c.fechaingreso,
                                    	c.fechabaja,
                                    	tb.descripcion,
	                                    c.acceso,
										c.idcliente,
										u.idusuario
                                    FROM
                                        dbusuarios u
                                            inner join
                                        tbroles tr ON u.refroll = tr.idrol
                                    		left join
                                    	dbusuariosclientes uc on uc.refusuario = u.idusuario
                                    		left join
                                    	dbclientes c on c.idcliente = uc.refcliente
                                    		inner join
										tbformaspago tb on c.refformapago = tb.idformapago
										where u.idusuario=".$idUsuario;
 	$resultado   =   $this->query($sql,0);
 	
 	return $resultado;
}


function LoginP($usuario,$pass) {
	$sqlusu = "select * from DbUsuarios where usuario = '".$nombre."'";

	$respusu = mysql_query($sqlusu,$conn);
	
	if (isset($respusu)) {
		$error = false;
		$sqlpass = "select * from DbUsuarios where password = '".$nombre."' and IdUsuario = ".mysql_result($respusu,0,0);
	
		$resppass = mysql_query($sqlusu,$conn);
		
		if (isset($resppass)) {
			$error = false;
			} else {
				$error = true;
			}
		
		}
		else
		
		{
			$error = true;	
		}
		
	
	if ($error == true)
		{
			echo "<scrip>alert('Usuario o Password Incorrecto')</script>";
		} else {
			echo "<scrip>alert('Bienvenido')</script>";
			echo "<script>windows.location = 'adminshowgol.php'</script>";
		}
	
	
}


Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "dbadministracionclientes";
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