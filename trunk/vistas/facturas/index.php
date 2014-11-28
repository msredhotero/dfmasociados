<?

include ('../../includes/funcionesFacturas.php');

$ServiciosFacturas  = new ServiciosFacturas();

$resActividad = $ServiciosFacturas->traerActividades();


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

<script>

	$( document ).ready(function() {
		// Handler for .ready() called.


	function validarFact() {
		$error	=	"";
		if ($("#nrofactura").val() == "") {
			$error	=	"* No puede estar vacio el campo Nro Factura";
		}
		
		return $error;	
	}

	$( "#importe1" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#importe2" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#importe3" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#importeRetencion" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#percepcion" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#exento" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	$( "#gravado" ).focusout(function() {
		if ($( this ).val() == '') {
			$( this ).val('0');
		}
	});
	
	
	function calcular() {
		importe1Iva = parseFloat($('#importe1').val()) * 0.105;
		importe2Iva = parseFloat($('#importe2').val()) * 0.21;
		importe3Iva = parseFloat($('#importe3').val()) * 0.27;
		
		importe1 = parseFloat($('#importe1').val());
		importe2 = parseFloat($('#importe2').val());
		importe3 = parseFloat($('#importe3').val());
		
		retencion = parseFloat($('#importeRetencion').val());
		percepcion = parseFloat($('#percepcion').val());
		exento = parseFloat($('#exento').val());
		gravado = parseFloat($('#gravado').val());
		
		totalFacturado = importe1 + importe2 + importe3 + importe1Iva + importe2Iva + importe3Iva + retencion + percepcion + exento + gravado;
		
		totalBaseImponible = importe1 + importe2 + importe3 + exento + gravado;
		
		$('#resultadoFinal').html('Total Facturado: $ '+totalFacturado);
		$('#resultadoBase').html('Base Imponible: $ '+totalBaseImponible);
		
		$('#importe').val(totalFacturado);
		$('#baseimponible').val(totalBaseImponible);
		
	}


	$('#calcular').click(function(){
		calcular();
	});


		//al enviar el formulario
    $('#generar').click(function(){
		
		if (validarFact() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
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
		
	});


</script>


</head>



<body style="background-color: #edede4;">


<div class="content" align="center">
<h3>Crear Factura</h3>
<h5>Usuario: <strong>Diego</strong></h5>

<button id="verfacturas" class="btn btn-primary" type="button">Ver Facturas</button>
<button id="crearcliente" class="btn btn-primary" type="button">Crear Clientes</button>

<br>
<br>

		<div class="panel panel-info" style="width:700px;" align="left">
		<div class="panel-heading">
			<h3 class="panel-title">Datos de la Factura.</h3>
		</div>
			<div class="panel-body">
				<form class="formulario" role="form">
				
					<div class="form-group">
						<label for="NroFactura">Nº de Factura</label>
						<input id="nrofactura" class="form-control" style="width:220px;" type="nrofactura" placeholder="Ingrese el Nº de Factura"/>
					</div>
					
					
					<div class="form-group">
						<label for="FechaFactura">Fecha Factura</label>
						<input type="text" class="form-control" name="fechafactura" id="fechafactura" style="width:200px;"> 
					</div>
					
                    <div class="row">
                    	<div class="form-group col-md-6">
							<label for="Exento">Exento</label>
						    <input type="text" class="form-control" name="exento" id="exento" value="0"> 
                        
						</div>
                        
                    	<div class="form-group col-md-6">
							<label for="gravado">No Gravado</label>
						    <input type="text" class="form-control" name="gravado" id="gravado" value="0"> 
                        
						</div>
                    </div>
                    <br>
                    
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="Iva">IVA 10,5%</label>
                            <input type="text" class="form-control" name="importe1" id="importe1" value="0"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Iva">IVA 21%</label>
                            <input type="text" class="form-control" name="importe2" id="importe2" value="0"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Iva">IVA 27%</label>
                            <input type="text" class="form-control" name="importe3" id="importe3" value="0"> 
                        </div>
                    
                    </div>
                    
                    
                    
                    
                    
					<div class="form-group">
						<label for="Retencion">Retención</label>
                        <div class="input-group col-md-4">
						<input type="text" class="form-control" name="importeRetencion" id="importeRetencion" value="0"> 
                        </div>
					</div>
					
                    <div class="form-group">
						<label for="Otros">Percepcion</label>
						<input id="percepcion" name="percepcion" class="form-control" style="width:200px;" type="text" value="0" />
					</div>
                    
					
                    <div class="row">
                    <div class="form-group col-md-6">
						<label for="actividad">Seleccione la Actividad</label>
						<select class="form-control" id="actividad" name="actividad">
                            <?php while ($row = mysql_fetch_array($resActividad)) { ?>
                            	<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php } ?>
						</select>
                       
					</div>
					</div>
					
                    <input type="hidden" id="importe" name="importe" value="0">
                    <input type="hidden" id="baseimponible" name="baseimponible" value="0">
                    
					<div id="resultadoFinal" style="background-color:#66a3d2;border-left:3px solid #0B61A4;padding:10px;color:#FFC373;font-weight:bold;font-size:1.2em;">Total Facturado: $</div>
                    <div id="resultadoBase" style="background-color:#66a3d2;border-left:3px solid #0B61A4;padding:10px;color:#FFC373;font-weight:bold;font-size:1.2em;">Base Imponible: $</div>
                    
					<br />
					<br />
					<div align="center">
						<div id="load"></div>
                        <ul class="list-inline">
                        	<li>
							<button id="generar" class="btn btn-warning" type="button">Generar Factura</button>
                            </li>
                            <li>
                            <button id="calcular" class="btn btn-info" type="button">Calcular Factura</button>
                            </li>
                        </ul>
					</div>
					
					<div id="loading"></div>
					<br>
					<br>
					<div class="alert alert-info" id="errorFact">
					<strong>Importante!</strong>
					Es necesario completar todos los campos y cargar algun concepto para poder generar la factura. Muchas Gracias.
					</div>

				</form>
				<script>
				$(document).ready(function(){
				   $("#cambiames").click(function(){
				      $("#fechafactura").datepicker( "option", "changeMonth", true );
				   });
				});
				
				$('#crearcliente').live("click",function(){

				  	url = "../crearcliente/";
					$(location).attr('href',url);

				})
				
				$('#verfacturas').live("click",function(){

				  	url = "../verfacturas/";
					$(location).attr('href',url);

				})
				
				</script>
			</div>
	</div>
</div>
</body>

</html>
