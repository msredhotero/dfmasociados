<?




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

		$("#concepto,#cantidad,#importe").click(function(event) {
			$("#errorItem").html('<strong>Importante!</strong>Es necesario completar todos los campos para poder cargar.');
		});

		function validarFact() {
			$error	=	"";
			if ($("#nrofactura").val() == "") {
				$error	=	"* No puede estar vacio el campo Nro Factura";
			}

			if ($("#palabraclave").val() == "") {
				$error	=	$error+"<br>* No puede estar vacio el campo Palabra Clave";
			}

			if ($("#iva").val() == "") {
				$error	=	$error+"<br>* No puede estar vacio el campo IVA";
			}
			
			if ($("#retencion").val() == "") {
				$error	=	$error+"<br>* No puede estar vacio el campo Retención";
			}
			
			if (parseFloat(SumarTabla()) <= 0) {
				$error	=	$error+"<br>* Debe cargar algun concepto";
			}
			
			return $error;	
		}

		function validador() {
			$error	=	"";
			if ($("#concepto").val() == "") {
				$error	=	"* No puede estar vacio el campo Conceptos";
			}

			if ($("#cantidad").val() == "") {
				$error	=	$error+"<br>* No puede estar vacio el campo Cantidad";
			}

			if ($("#importe").val() == "") {
				$error	=	$error+"<br>* No puede estar vacio el campo Importe";
			}
			
			return $error;	
		}
		

		function SumarTabla() {
		var suma = 0;
		//borrarDetalleFacturaAux();
			$('#conceptoscargados tr#row').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
				suma += parseFloat($(this).find('td').eq(3).text()||0,10); //numero de la celda 3

			})
			return suma;

	  	}
	  	
	  	$('#iva').change(function(event) {
	  		if (parseFloat(SumarTabla()) > 0) {
	  			$('#resultadoFinal').html('Total con descuento: <span class="glyphicon glyphicon-euro"></span>'+SumarTablaDescuentos().toFixed(2));
		  	}
	  	});
	  	
	  	function SumarTablaDescuentos() {
		var suma = 0;
		//borrarDetalleFacturaAux();
			//$('#conceptoscargados tr#row').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
			//	suma += parseFloat($(this).find('td').eq(3).text()||0,10).toFixed(2); //numero de la celda 3

			//});
			//alert($('#iva option:selected').text());
			
			suma = SumarTabla();
			
			resta = (suma*parseFloat($('#iva option:selected').text().replace('% ','').replace(',','.'))/100).toFixed(2);
			retencion = (suma*parseFloat($('#retencion option:selected').text().replace('% ','').replace(',','.'))/100).toFixed(2);
			//alert((suma*parseFloat($('#iva option:selected').text().replace('% ','').replace(',','.'))/100).toFixed(2));

			return suma + parseFloat(resta) + parseFloat(retencion);

	  	}

	  	//elimina una fila
	  	$(document).on("click",".eliminarfila",function(){
			var padre = $(this).parents().get(2);
			//var resta = parseInt($(this).find('td').eq(4).text()||0,10);
			//alert(parseInt($(this).parents().get(1).find('td').eq(4).text()||0,10));
			//var id = $(this).parents().find('td').attr('id');
			//alert(id);
			//var borrar = id.replace('fcodprod', '' );
			//borrarDetalleFacturaAuxPorCod(borrar);
			//$(padre).animate({'opacity':0} ,800,function() { $(this).remove() });
			$(padre).remove();
		
		
			$('#sumaTabla').html("<span class='glyphicon glyphicon-euro'></span>" + SumarTabla());
			$('#resultadoFinal').html('Total con descuento: <span class="glyphicon glyphicon-euro"></span>'+SumarTablaDescuentos());
	  	});

		$("#cargar").click(function(event) {
			if (validador()== "") {
				if (isNaN(parseFloat($("#importe").val().trim()))== false) {
					$("#conceptoscargados").prepend("<tr id='row'><td>"+
					$("#concepto").val()+"</td><td>"+
					$("#cantidad").val().trim()+"</td><td>"+
					parseFloat($("#importe").val().trim())+"</td><td>"+
					($("#cantidad").val().trim()*parseFloat($("#importe").val().trim()))+"</td><td><span class='glyphicon glyphicon-remove'> <input type='button' class='eliminarfila' value='Eliminar' /></span></td></tr>");	
					$('#sumaTabla').html("<span class='glyphicon glyphicon-euro'></span>" + SumarTabla());
					$('#resultadoFinal').html('Total con descuento: <span class="glyphicon glyphicon-euro"></span>'+SumarTablaDescuentos().toFixed(2));
				} else {
					alert("No es un numero");
				}
			} else {
				
				$("#errorItem").html(validador());
			}
			
			
		});



		function grabarDetalle(refFactura) {
			$('#conceptoscargados tr#row').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
				concepto = $(this).find('td').eq(0).text();
				cantidad = parseInt($(this).find('td').eq(1).text()||0,10);
				importe = parseFloat($(this).find('td').eq(2).text()||0,10); //numero de la celda 3
				
					$.ajax({
                                data:  {concepto: concepto,cantidad: cantidad,importe: importe,nrofactura: $("#nrofactura").val(),reffactura: refFactura, accion: 'insertarDetalleDeFactura'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
                                    
                                            $("#load").html('');
       
                                }
					});						
			});
		}


		$('#generar').click(function(event) {
				if (validarFact() != "") {
					
					$("#errorFact").html(validarFact());
				} else {
					//agrego los conceptos
					/*
					$('#conceptoscargados tr#row').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
						concepto = $(this).find('td').eq(0).text();
						cantidad = parseInt($(this).find('td').eq(2).text()||0,10);
						importe = parseFloat($(this).find('td').eq(2).text()||0,10); //numero de la celda 3
						});
					*/
					$.ajax({
                                data:  {refcliente: $("#refC").val(),usuacrea: 'Marcos',reftipoiva: $("#iva").val(),refretencion: $("#retencion").val(),palabraclave: $("#palabraclave").val(),otros: $("#otros").val(),comentarios: $("#comentarios").val(),nrofactura: $("#nrofactura").val(), accion: 'insertarCompra'},
                                url:   '../../ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
                                    
                                        if (response != '') {

                                        	grabarDetalle(response);

                                            $("#errorFact").removeClass("alert-info");
                                            $("#errorFact").addClass("alert-success");
                                            $("#errorFact").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Cliente</strong>. ');
                                            $("#load").html('');

                                        } else {
                                        	$("#errorFact").removeClass("alert-info");
                                            $("#errorFact").addClass("alert-danger");
                                            $("#errorFact").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');

                                        }
                                        
                                }
					});
					//agrego el pdf
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
				<form role="form">
				
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
						<label for="Iva">Seleccione el IVA</label>
						<select class="form-control" id="iva" style="width:100px;">
						    <option value="2">10,5 %</option>
						</select>
                        <input type="text" class="form-control" name="importe1" id="importe1" value="0"> 
					</div>
                    <div class="form-group col-md-4">
						<label for="Iva">Seleccione el IVA</label>
						<select class="form-control" id="iva" style="width:100px;">
						    <option value="1">21 %</option>
						</select>
                        <input type="text" class="form-control" name="importe2" id="importe2" value="0"> 
					</div>
                    <div class="form-group col-md-4">
						<label for="Iva">Seleccione el IVA</label>
						<select class="form-control" id="iva" style="width:100px;">
                            <option value="4">27 %</option>
						</select>
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
						<select class="form-control" id="actividad">
                            
						</select>
                       
					</div>
					</div>
					
					<div id="resultadoFinal" style="background-color:#66a3d2;border-left:3px solid #0B61A4;padding:10px;color:#FFC373;font-weight:bold;font-size:1.2em;">Total con Descuentos: $</div>
					<br />
					<br />
					<div align="center">
						<div id="load"></div>
						<button id="generar" class="btn btn-warning" type="button">Generar Factura</button>
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
