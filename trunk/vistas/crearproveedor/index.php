<?php


require '../../includes/funcionesClientes.php';


$serviciosClientes = new ServiciosClientes();

$resClientes = $serviciosClientes->traerClientesProveedores();

$resTC = $serviciosClientes->traerTipoClienteProveedor();

?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DFM & Asociados</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="../../css/jquery-ui.css">

		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script type="text/javascript" src="../../js/jquery.jparallax.min.js" ></script>

        <script type="text/javascript" src="../../js/jquery.event.frame.js" ></script>

        

        <link rel="stylesheet" href="../../js/source/jquery.fancybox.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../../js/source/jquery.fancybox.pack.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>

		<script src="../../js/jquery.ui.datepicker-es.js"></script>
        <link rel="stylesheet" href="../../css/datepicker.css">
        
		<script>
			$(document).ready(function(){
				$("#fechafactura").datepicker({
		      showOn: 'both',
		      buttonImage: 'calendar.png',
		      buttonImageOnly: true,
		      changeYear: true,
		      numberOfMonths: 2,
		      onSelect: function(textoFecha, objDatepicker){
		         $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
		      }
		   });
			});
		
		</script>
		
		<style>
			
			$("#fechafactura").datepicker({
		   showOn: 'both',
		   buttonImage: 'calendar.png',
		   buttonImageOnly: true,
		   changeYear: true,
		   numberOfMonths: 2,
		   onSelect: function(textoFecha, objDatepicker){
		      $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
		   }
		}); 
		</style>

	<style type="text/css">
		.form-group {
			padding:10px;
		}
		
	</style>
    


</head>

<body style="background-color: #edede4;">



 


<div class="content" align="center">

<h3>Clientes</h3>
<h5>Usuario: <strong>Diego</strong></h5>

<button id="verfacturasventas" class="btn btn-success" type="button">Ver Facturas Ventas</button>
<button id="verfacturasproveedores" class="btn btn-danger" type="button">Ver Facturas Proveedores</button>
<button id="crearfacturav" class="btn btn-success" type="button">Crear Facturas Venta</button>
<button id="crearfacturap" class="btn btn-danger" type="button">Crear Facturas Proveedores</button>
<button id="crearcliente" class="btn btn-success" type="button">Crear Cliente</button>
<br>
<br>

    <div class="panel panel-danger" style="width:900px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Crear Proveedor.</h3>
		</div>
			<div class="panel-body">
        
        <div class="row"> 
        <div class="col-sm-12 col-md-12">
        <form class="form-inline formulario" role="form">
                	
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	
				              	
                    <div class="form-group col-md-6">
                    	<label for="nombre" class="control-label" style="text-align:left">Nombre Completo</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el Nombre Completo..." >
                        </div>
                    </div>
                    

                    
                    <div class="form-group col-md-6">
                    	<label for="nrocliente" class="control-label" style="text-align:left">NroCliente</label>
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" id="nrocliente" name="nrocliente" placeholder="Ingrese el Nro Cliente..." >
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="email" class="control-label" style="text-align:left">E-Mail</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="email" name="email" placeholder="Ingrese el E-Mail..." >
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                    	<label for="telefono" class="control-label" style="text-align:left">Telefono</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el Precio Telefono..." >
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                    	<label for="nrodocumento" class="control-label" style="text-align:left">NroDocumento</label>
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" id="nrodocumento" name="nrodocumento" placeholder="Ingrese el NroDocumento..." >
                        </div>
                    </div>

					<div class="form-group col-md-6">
                    	<label for="cuit" class="control-label" style="text-align:left">Cuit</label>
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" id="cuit" name="cuit" placeholder="Ingrese el Cuit..." >
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                    	<label for="reftipocliente" class="control-label" style="text-align:left">Tipo Cliente</label>
                        <div class="input-group col-md-12">
                            <select name="reftipocliente" id="reftipocliente" class="form-control">
                            	<?php while ($row = mysql_fetch_array($resTC)) { ?>
                                	<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    

                    </div>
                    </div>
                    <ul class="list-inline" style="padding-top:15px;">
                    	<li>
                    		<button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Crear</button>
                        </li>
                        
   
                    </ul>
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> El campo nombre es obligatorios</p>
                	</div>
                    <input type="hidden" id="accion" name="accion" value="insertarCliente"/>
                </form>
                
                <br>
                
                
        </div>
    </div>

    
    <div class="panel panel-default" style="width:900px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Ultimos clientes cargados</h3>
		</div>
			<div class="panel-body">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th>Nombre</th>
                        <th>NroCliente</th>
                        <th>E-Mail</th>
                        <th>NroDocumento</th>
                        <th>Telefono</th>
                        <th>Cuit</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	<?php
						if (mysql_num_rows($resClientes)>0) {
							$cant = 0;
							while ($row = mysql_fetch_array($resClientes)) {

					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['nombre']); ?></td>
                            <td><?php echo $row['nrocliente']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['nrodocumento']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['cuit']; ?></td>
                            <td>
                            		<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
											<li>
											<a href="javascript:void(0)" class="varmodificar" id="<?php echo $row['idcliente']; ?>">Modificar</a>
											</li>

											<li>
											<a href="javascript:void(0)" class="varborrar" id="<?php echo $row['idcliente']; ?>">Borrar</a>
											</li>

										</ul>
									</div>
                             </td>
                        </tr>
                    <?php } ?>
                    <?php } else { ?>
                    	<h3>No hay clientes cargados.</h3>
                    <?php } ?>
                </tbody>
            </table>
            <div style="height:50px;">
            
            </div>
   
        </div>
    </div>

</div>

<div id="dialog2" title="Eliminar Cliente">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar al Cliente?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>También se borrara la relación con las canchas y cuentas asociadas</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.ver').click(function(event){
			url = "ver.php";
			$(location).attr('href',url);
	});//fin del boton eliminar
	
	$('.varborrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$('.varmodificar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar

	$( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarCliente'},
									url:   '../../ajax/ajax_clientes.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar

	$("#nombre").click(function(event) {
		if ($("#nombre").val() == "") {
			$("#nombre").removeClass("alert-danger");
			$("#nombre").attr('value','');
			$("#nombre").attr('placeholder','Ingrese el Nombre...');
		}
    });

	$("#nombre").change(function(event) {
		if ($("#nombre").val() == "") {
			$("#nombre").removeClass("alert-danger");
			$("#nombre").attr('placeholder','Ingrese el Nombre');
		}
	});
	
	$("#codigo").click(function(event) {
		if ($("#codigo").val() == "") {
			$("#codigo").removeClass("alert-danger");
			$("#codigo").attr('value','');
			$("#codigo").attr('placeholder','Ingrese el Codigo...');
		}
    });

	$("#codigo").change(function(event) {
		if ($("#codigo").val() == "") {
			$("#codigo").removeClass("alert-danger");
			$("#codigo").attr('placeholder','Ingrese el Codigo');
		}
	});
	
	$("#precio_unit").click(function(event) {
		if ($("#precio_unit").val() == "") {
			$("#precio_unit").removeClass("alert-danger");
			$("#precio_unit").attr('value','');
			$("#precio_unit").attr('placeholder','Ingrese el Precio Unit...');
		}
    });

	$("#precio_unit").change(function(event) {
		if ($("#precio_unit").val() == "") {
			$("#precio_unit").removeClass("alert-danger");
			$("#precio_unit").attr('placeholder','Ingrese el Precio Unit');
		}
	});
	
	$("#stock").click(function(event) {
		if ($("#stock").val() == "") {
			$("#stock").removeClass("alert-danger");
			$("#stock").attr('value','');
			$("#stock").attr('placeholder','Ingrese el Stock...');
		}
    });

	$("#stock").change(function(event) {
		if ($("#stock").val() == "") {
			$("#stock").removeClass("alert-danger");
			$("#stock").attr('placeholder','Ingrese el Stock');
		}
	});
	
	$("#stock_min").click(function(event) {
		if ($("#stock_min").val() == "") {
			$("#stock_min").removeClass("alert-danger");
			$("#stock_min").attr('value','');
			$("#stock_min").attr('placeholder','Ingrese el Stock Minimo...');
		}
    });

	$("#stock_min").change(function(event) {
		if ($("#stock_min").val() == "") {
			$("#stock_min").removeClass("alert-danger");
			$("#stock_min").attr('placeholder','Ingrese el Stock Minimo');
		}
	});
	
	function validador(){

			$error = "";
//idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas
			
			if ($("#nombre").val() == "") {
				$error = "Es obligatorio el campo nombre.";
				$("#nombre").addClass("alert-danger");
				$("#nombre").attr('placeholder',$error);
			}
			
			if ($("#codigo").val() == "") {
				$error = "Es obligatorio el campo codigo.";
				$("#codigo").addClass("alert-danger");
				$("#codigo").attr('placeholder',$error);
			}
			
			if ($("#precio_unit").val() == "") {
				$error = "Es obligatorio el campo Precio Unit.";
				$("#precio_unit").addClass("alert-danger");
				$("#precio_unit").attr('placeholder',$error);
			}
			
			if ($("#stock").val() == "") {
				$error = "Es obligatorio el campo stock.";
				$("#stock").addClass("alert-danger");
				$("#stock").attr('placeholder',$error);
			}
			
			if ($("#stock_min").val() == "") {
				$error = "Es obligatorio el campo stock min.";
				$("#stock_min").addClass("alert-danger");
				$("#stock_min").attr('placeholder',$error);
			}


			return $error;
    }
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax_clientes.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data != '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Cliente</strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "index.php";
											$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		}
    });
	
	$('#crearfacturav').live("click",function(){

		url = "../facturas/";
		$(location).attr('href',url);

	})
	
	$('#crearfacturap').live("click",function(){

		url = "../facturasProveedores/";
		$(location).attr('href',url);

	})

	$('#verfacturasventas').live("click",function(){

		url = "../verfacturasventas/";
		$(location).attr('href',url);

	})
	
	$('#verfacturasproveedores').live("click",function(){

		url = "../verfacturasproveedores/";
		$(location).attr('href',url);

	})
	
	$('#crearcliente').live("click",function(){

		url = "../crearcliente/";
		$(location).attr('href',url);

	})

});//fin del document ready
</script>


</body>
</html>
