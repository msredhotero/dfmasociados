<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosUsuarios {


function TraerUsuarios()
{
		$sql		= "select * from dbusuarios";
		$resultado	= $this->query($sql,0);
		return $resultado;	
}

function actualizarFechaPago($idcliente) {
		$sql = "update dbclientesfechapago set fechapago = CURDATE() where refcliente =".$idcliente;
		$resultado	= $this->query($sql,0);
		return $resultado;	
}

function enviarPagoPayPal() {
		$sql = "select 
				c.* 
				from dbclientes c
				inner
				join	dbclientesfechapago cf
				on		cf.refcliente = c.idcliente
				 where DATE_SUB(DATE_ADD( cf.fechapago, INTERVAL 1 MONTH ), interval 2 day) < CURDATE()";
		$resultado	= $this->query($sql,0);
		while ($row = mysql_fetch_array($resultado)) {
			mail($row[3], 'Pago de Factura', 'Ya esta su factura de pago');	
			mail('msredhotero@msn.com', 'Pago de Factura', 'Ya esta su factura de pago');	
			$this->actualizarFechaPago($row[0]);
		}
		return 0;
}

function enviarPagoTransferencia() {
		$sql = "select 
				c.* 
				from dbclientes c
				inner
				join	dbclientesfechapago cf
				on		cf.refcliente = c.idcliente
				 where DATE_SUB(DATE_ADD( cf.fechapago, INTERVAL 1 MONTH ), interval 5 day) < CURDATE()";
		$resultado	= $this->query($sql,0);
		while ($row = mysql_fetch_array($resultado)) {
			mail($row[3], 'Pago de Factura', 'Ya esta su factura de pago');	
			mail('msredhotero@msn.com', 'Pago de Factura', 'Ya esta su factura de pago');
			$this->actualizarFechaPago($row[0]);
		}
		return 0;
}


function existe($usuario){
 
           $sql        =   "SELECT idusuario FROM dbusuarios WHERE usuario= '".$usuario. "'";         
           $resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;

        }

function asignado($refCliente){
            $sql        =   "SELECT refusuario FROM dbusuariosclientes WHERE refcliente= ".$refCliente;         
            $resultado  =   $this->query($sql,0);
           
            if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

            }

           return 0;
}

function asignadoDistribuidor($idcliente,$idusuario) {
			$sql        =   "SELECT refusuario FROM dbusuariosclientes WHERE refcliente= ".$idcliente. ", refusuario =".$idusuario;         
            $resultado  =   $this->query($sql,0);
           
            if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

            }

           return 0;
}

function cargarUsuario($usuario,$password,$refrol,$nombrecompleto,$email,$refcliente,$cliente)
{
	$devuelve = "";
	if($this->existe($usuario)!=0){
        $devuelve    =   "Ya existe un usuario con ese nombre ".$usuario;                        
    } 

    if ($this->asignado($refcliente)!=0) {
        $devuelve    =   $devuelve."<br>Ya existe un usuario asignado a ese cliente: ".$cliente;
    }
    
    if ($devuelve == "") {
        $sql = "INSERT INTO dbusuarios
									(idusuario,
									usuario,
									password,
									refroll,
									email,
									nombrecompleto)
									VALUES
									('',
									'".$usuario."',
									'".$password."',
									".$refrol.",
									'".$email."',
									'".$nombrecompleto."');";
	   $resultado = $this->query($sql,1);
       
       $sqlUC = "INSERT INTO dbusuariosclientes
									(idusuariocliente,
									refusuario,
									refcliente)
									VALUES
									('',
									".$resultado.",
									".$refcliente.");";
	   $resultadoUC = $this->query($sqlUC,1);
    }
	
	
	return $devuelve;
	
}

function agregarAsignacion($idusuario,$idcliente) {
		if ($this->asignadoDistribuidor($idcliente,$idusuario) == 0) {
			$sql = "insert into dbusuariosclientes (idusuariocliente,
									refusuario,
									refcliente)
									VALUES
									('',
									".$idusuario.",
									".$idcliente.");";
			$this->query($sql,0);
			return "";
		} else {
			return "El distribuidor ya tiene asignado ha ese cliente.";
			
		}
	
}

function modificarUsuario($id,$usuario,$password,$nombrecompleto,$email) {

	$devuelve = "";
	$idExiste = $this->existe($usuario);
	if($idExiste!=0){
				if($idExiste == $id) {
					$sql		= "update dbusuarios set usuario = '".$usuario."', password ='".$password."', email='".$email."', nombrecompleto= '".$nombrecompleto."' where idusuario =".$id;
					$resultado	= $this->query($sql,0);
				} else {
					$devuelve    =   "Ya existe un usuario con ese nombre ".$usuario;	
				}
                
                            
            } else {

				$sql		= "update dbusuarios set usuario = '".$usuario."', password ='".$password."', email='".$email."', nombrecompleto= '".$nombrecompleto."' where idusuario =".$id;
				$resultado	= $this->query($sql,0);
	}
	return $devuelve;
}

function modificarAsignacion($idUsuario,$idCliente) {
    $devuelve = "";
    if ($this->asignado($idCliente)!=0) {
        $devuelve    =   $devuelve."<br>Ya existe un usuario asignado a ese cliente: ".$cliente;
    }   else    {
        
        $sql        =   "update dbusuariosclientes set refcliente =".$idCliente." where refusuario=".$idCliente;
        $resultado	=    $this->query($sql,0);
    }
    
    return $devuelve;
}

function eliminarAsignacion($id) {
    $sql        =       "delete from dbusuariosclientes where refcliente =".$id;
    $resultado	=       $this->query($sql,0);
    
    return      "";
}

function eliminarUsuario($idUsuario,$idUC) {
    $this->eliminarAsignacion($idUC);
    $sql        =       "delete from dbusuarios where idusuario =".$idUsuario;
    $resultado	=       $this->query($sql,0);
    
    return      "";
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