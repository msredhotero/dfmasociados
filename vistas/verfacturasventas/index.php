<?php


require '../../includes/funcionesFacturas.php';
include ('../../includes/funcionesClientes.php');

$serviciosClientes  = new ServiciosClientes();
$serviciosFacturas = new ServiciosFacturas();

$resFacturas = $serviciosFacturas->traerFacturaVendedoresTodos();

$resCantC = mysql_num_rows($serviciosClientes->traerClientesNoProveedores());

$resCantP = mysql_num_rows($serviciosClientes->traerClientesProveedores());
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

<h3>Facturas</h3>
<h5>Usuario: <strong>Diego</strong></h5>

<button id="verfacturasventas" class="btn btn-success" type="button">Ver Facturas Ventas</button>
<button id="crearfacturav" class="btn btn-success" type="button">Crear Facturas Venta</button>
<button id="crearfacturap" class="btn btn-danger" type="button">Crear Facturas Proveedores</button>
<button id="crearcliente" class="btn btn-success" type="button">Crear Clientes <span class="badge"> <?php echo $resCantC; ?></span></button>
<button id="crearproveedor" class="btn btn-danger" type="button">Crear Proveedor <span class="badge"> <?php echo $resCantP; ?></span></button>
<br>
<br>
    
    <div class="panel panel-success" style="width:1400px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Facturación a Clientes</h3>
		</div>
			<div class="panel-body">
        	<table class="table table-striped">
            	<thead>
                	<tr>
                    	<th colspan="6"></th>
                        <th colspan="2" align="center">I.V.A. 10,5%</th>
                        <th colspan="2" align="center">I.V.A. 21%</th>
                        <th>Percp.</th>
                        <th></th>
                        <th>Base Imp</th>
                        <th></th>
                    </tr>
                	<tr>
                    	<th>NroFactura</th>
                        <th>Fecha</th>
                        <th>Mes</th>
                        <th>Cliente</th>
                        <th>Exento</th>
                        <th>No Gravado</th>
                        <th>Base Imp.</th>
                        <th>Monto</th>
                        <th>Base Imp.</th>
                        <th>Monto</th>
                        <th>Gcias</th>
                        <th>Total Fact.</th>
                        <th>IIBB</th>
                        <th>Actividad</th>
                    </tr>
                </thead>
                <tbody>
<!--idcliente,nombre,nrocliente,email,telefono,nrodocumento-->
                	<?php
						$totalBase21 = 0;
						$totalImp21 = 0;
						$totalBase10 = 0;
						$totalImp10 = 0;
						$totalFac = 0;
						$totalBaseImp = 0;
						if (mysql_num_rows($resFacturas)>0) {
							$cant = 0;
							
							while ($row = mysql_fetch_array($resFacturas)) {
							$totalBase21 = $totalBase21 + $row['Importe21'];
							$totalImp21 = $totalImp21 + $row['Importe21']*0.21;
							$totalBase10 = $totalBase10 + $row['Importe10'];
							$totalImp10 = $totalImp10 + $row['Importe10']*0.105;
							$totalBaseImp = $totalBaseImp + $row['baseimponible'];
							
							$totalFac = $totalFac + $row['importe'];
					?>
                    	<tr>
                        	<td><?php echo utf8_encode($row['nrofactura']); ?></td>
                            <td><?php echo $row['fechacreacion']; ?></td>
                            <td><?php echo $row['mes']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo '$ '.number_format($row['exento'], 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['gravado'], 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['Importe10'], 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['Importe10']*0.105, 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['Importe21'], 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['Importe21']*0.21, 2, ',', ' '); ?></td>
                            <td><?php echo '$ '.number_format($row['percepcion'], 2, ',', ' '); ?></td>
                            <td><?php echo '$'.number_format($row['importe'], 2, ',', ' '); ?></td>
                            <td><?php echo '$'.number_format($row['baseimponible'], 2, ',', ' '); ?></td>
                            <td><?php echo $row['actividad']; ?></td>
                        </tr>
                    <?php } ?>
                    	
                    <?php } else { ?>
                    	<h3>No hay facturas cargadas cargados.</h3>
                    <?php } ?>
                </tbody>
                <tfoot>
                	<tr style="background-color: #999; font-weight:bold;">
                    	<td colspan="6" align="right">Totales</td>
                        <td><?php echo '$ '.number_format($totalBase10, 2, ',', ' '); ?></td>
                        <td><?php echo '$ '.number_format($totalImp10, 2, ',', ' '); ?></td>
                        <td><?php echo '$ '.number_format($totalBase21, 2, ',', ' '); ?></td>
                        <td><?php echo '$ '.number_format($totalImp21, 2, ',', ' '); ?></td>
                        <td></td>
                        <td><?php echo '$ '.number_format($totalFac, 2, ',', ' '); ?></td>
                        <td><?php echo '$ '.number_format($totalBaseImp, 2, ',', ' '); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
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
	
	$('#crearcliente').live("click",function(){

		url = "../crearcliente/";
		$(location).attr('href',url);

	})
	
	$('#crearproveedor').live("click",function(){

		url = "../crearproveedor/";
		$(location).attr('href',url);

	})
	

});//fin del document ready
</script>


</body>
</html>
