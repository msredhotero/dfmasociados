<?php

session_start();

require "includes/funcionesClientes.php";


?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DFM & Asociados</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="css/estilo1.css" rel="stylesheet" type="text/css">
    
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        
        
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<style>
		.boxgridMenu {
			float: left;
			height: 40px;
			padding-top:5px;
			padding-bottom:7px;
			margin: 10px;
			overflow: hidden;
			position: relative;
			width: 170px;
			background-color:#CCC;
			/*para Firefox*/
			-moz-border-radius: 6px 6px 6px 6px;
			/*para Safari y Chrome*/
			-webkit-border-radius: 6px 6px 6px 6px;
			/* para Opera */
			border-radius: 6px;
			background-color: #C9EEFC;
		}
		
		.boxgridMenu > a {
			text-align:center;
			color:#FFF;
		}
		
		.boxgridMenu .menuItem3 {
			/*para Firefox*/
			-moz-border-radius: 5px 5px 5px 5px;
			/*para Safari y Chrome*/
			-webkit-border-radius: 5px 5px 5px 5px;
			/* para Opera */
			border-radius: 3px;
			width:100%;
		}
		
		.boxgridSubInfo {
			float: left;
			height: 360px;
			margin: 10px;
			margin-left:25px;
			overflow: hidden;
			position: relative;
			width: 270px;
			background:url(imagenes/subInfo.png) repeat;
			border:1px solid #E6E6E6;
			box-shadow: 1px 1px 4px rgba(0,0,0,0.6);
			text-align:left;
		}
		
		.boxgridSubInfo p {
			padding:10px;
			text-align:justify;
		}
		
		.boxgridSubInfo a {
			padding-left:10px;
		}
		
		.boxgridSubInfo h4 {
			padding-left:10px;
		}
		.active {
			color:#FFF;
			background-color:#900;
		}
		
	
	</style>

	<!-- galeria -->
    <script src="js/responsiveslides.min.js"></script>
    <link rel="stylesheet" href="css/responsiveslides.css">
    <link rel="stylesheet" href="css/demo.css">
    
    <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: false,
        pager: true,
        speed: 300,
        maxwidth: 540
      });

      // Slideshow 3
      $("#slider3").responsiveSlides({
        manualControls: '#slider3-pager',
        maxwidth: 540
      });

      // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: false,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });
  </script>
    
    <!-- fin galeria -->

	<script type="text/javascript">
		
		$(document).ready(function(){
			
			$("#menuItem2").mouseenter(function(evento){
				$("#menu2").show(600);
				$("#menu1").hide();
				$("#menu3").hide();
				$("#menu4").hide();
			});
			
			$("#menuItem1").mouseenter(function(evento){
				$("#menu1").show(600);
				$("#menu2").hide();
				$("#menu3").hide();
				$("#menu4").hide();
			});
			
			$("#menuItem3").mouseenter(function(evento){
				$("#menu3").show(600);
				$("#menu1").hide();
				$("#menu2").hide();
				$("#menu4").hide();
			});
			
			$("#menuItem4").mouseenter(function(evento){
				$("#menu4").show(600);
				$("#menu1").hide();
				$("#menu2").hide();
				$("#menu3").hide();
			});
		});
	
	</script>

</head>

<body>
<div style="background: url(imagenes/crossword.png) repeat;">


<!--<div align="center" style="height:160px; width:100%;">
<img src="imagenes/logo.png">
<div style=" position:absolute;">
<h2>DM & Asociados</h2>
<h4>Consultora Integral</h4>
</div>
</div>-->

<div style="text-align:center;margin:0 auto;width:100%;">

    <div style="width: 45%; float: left;margin:0px 15px 0px 15px;text-align: right;">
    	<img src="imagenes/logo.png">
    </div>
    
    <div style="width: 45%; float: left;margin:30px 5px 0px 0px;text-align:justify;">
    	<h3 style="margin-left:-25px;"><strong>DM</strong> & Asociados</h3>
    	<h4 style="margin-left:-25px; color: #096; font-family:Tahoma, Geneva, sans-serif;">Consultora Integral</h4>
        <div style="margin-left:70%; margin-top:-60px;"><img src="imagenes/face.png"></div>
    </div>
    
<div style="clear: both;"/>
</div>

<div class="content">
<div style="height:1px; background-color:#B22222;">

</div>
<div style="height:1px; background-color: #F0D2D3;">

</div>



<div>

	<div class="boxgridMenu active" style="margin-left:17%;">
<!--    	<div style="width:100%; height:33%; border-bottom:1px solid #000; font-family:Verdana, Geneva, sans-serif; font-size:10px; font-weight:bold; text-align:left; color: #AAA; text-shadow:1px 1px 1px white;">1</div>-->
        <div style=" font-family: Bebas; font-size:1.5em;" id="menuItem1" class="menuItem3"><a href="" class="active" style="text-align:left;">Home</a></div>
    </div>
    <div class="boxgridMenu">
<!--    	<div style="width:100%; height:33%; border-bottom:1px solid #000;font-family:Verdana, Geneva, sans-serif; font-size:10px; font-weight:bold;text-align:left; color:#AAA; text-shadow:1px 1px 1px white;">2</div>-->
    	<div style=" font-family: Bebas; font-size:1.5em;" id="menuItem2" class="menuItem3"><a href="vistas/servicios/" style="text-align:left;">Servicios</a></div>
    </div>
    <div class="boxgridMenu">
<!--    	<div style="width:100%; height:33%; border-bottom:1px solid #000;font-family:Verdana, Geneva, sans-serif; font-size:10px; font-weight:bold;text-align:left; color:#AAA; text-shadow:1px 1px 1px white;">3</div>-->
    	<div style="font-family: Bebas; font-size:1.5em;" id="menuItem3" class="menuItem3"><a href="">Herramientas</a></div>
    </div>
    <div class="boxgridMenu">
<!--    	<div style="width:100%; height:33%; border-bottom:1px solid #000;font-family:Verdana, Geneva, sans-serif; font-size:10px; font-weight:bold;text-align:left; color:#AAA; text-shadow:1px 1px 1px white;">4</div>-->
    	<div style="font-family: Bebas; font-size:1.5em;" id="menuItem4" class="menuItem3"><a href="" style="text-align:left;">Contacto</a></div>
    </div>

</div>


<div style="height:59px;">

</div>

<div style="height:1px; background-color:#B22222;">

</div>
<div style="height:1px; background-color: #F0D2D3;">

</div>


<div id="descripcionMenu">

	<div id="menu1">
    	<h3>DM & Asociados. Estud se encuentra en el inicio de la Web.</h3>
    </div>

	<div id="menu2">
    	<h3>La totalidad de los servicios ofrecidos, fueron <strong>cuidadosamente diseñados</strong> para atender las necesidades de las PyMEs y microemprendimientos.</h3>
        <div align="center" style="padding-left:2%;">
            <!--<div id="menu3int" align="center">
                <a href="">Gestión Empresarial</a>
                <a href="">Outsourcing</a>
                <a href="">Impuestos</a>
                <a href="">Auditoria</a>
                <a href="">Gestión Documental</a>
                <a href="">Imagen Corporativa</a>
                <a href="" class="ultimo">Desarrollo Tecnológico</a>
            </div>-->
            <!--<div id="menu3int" align="center">
                <a href="">Gestión Documental</a>
                <a href="">Imagen Corporativa</a>
                <a href="">Desarrollo Tecnológico</a>
            </div>-->
            <ul id="nav">
					<li><a href="#">Gestión Empresarial</a></li>
	                <li><a href="#">Outsourcing</a></li>
	                <li><a href="#">Impuestos</a></li>
	                <li><a href="#">Auditoria</a></li>
	                <li><a href="#">Gestión Documental</a></li>
                    <li><a href="#">Imagen Corporativa</a></li>
	                <li><a href="#">Desarrollo Tecnológico</a></li>
	            </ul>
        </div>
    </div>
    
    <div id="menu3">
    	<h3>Plantillas y Formularios administrativos.</h3>
    </div>
    
    <div id="menu4">
    	<h3>Encontra donde poder comunicarse con nosotros.</h3>
    </div>
</div>


<!-- Slideshow 4 -->
<div style="width:700px;">
    <div class="callbacks_container">
      <ul class="rslides" id="slider4">
        <li>
          <img src="images/1.jpg" alt="">
          <p class="caption">This is a caption</p>
        </li>
        <li>
          <img src="images/2.jpg" alt="">
          <p class="caption">This is another caption</p>
        </li>
        <li>
          <img src="images/3.jpg" alt="">
          <p class="caption">The third caption</p>
        </li>
      </ul>
    </div>
</div>
<div style="width:350px; float:right; border:1px solid #333; height:350px;">
<h4>Aca va otro contenedor</h4>
<h5>Con alguna otra informacion</h5>
</div>

</div><!-- FIN del CONTENT -->

<div style="height:410px;"></div>

<div style="background-color:#d01d1d; height:160px; border-bottom:1px solid #e4e4e4; text-align:left; padding-top:20px; text-align:center; border-bottom:2px solid #fff; border-top:1px solid #fff;">

	<!--<img src="imagenes/bg-vist.jpg" style="float:left; margin-top:-20px; height:157px;">-->
	<h2 style="color:#FFF; font-style:italic;text-shadow: 3px 4px 4px #222;">"… la PyME del siglo XXI carece de capacidad de adaptación …"</h2>
    <h4 style="color: #FFF;">POR ESO PENSAMOS SERVICIOS PARA ACOMPAÑAR SU DESARROLLO.</h4>

</div>
    
<div style="background: url(imagenes/notebook.png) repeat; height:440px; padding-top:20px;">

    <div style="margin-left:13%; height:320px; width:2px; float:left;"></div>
    
	<div class="boxgridSubInfo">
    	<img src="imagenes/launcher_sobre_bemvasid.jpg">
        <h4>Titulo</h4>
        <p>Informacion adicional del contenedor, esta se mostrara acomode lugar</p>
        <a href="">+ Ver Más</a>
    </div>
    
    <div class="boxgridSubInfo">
    	<img src="imagenes/launcher_servicios.jpg">
        <h4>Titulo</h4>
        <p>Informacion adicional del contenedor, esta se mostrara acomode lugar</p>
        <a href="">+ Ver Más</a>
    </div>
    
    <div class="boxgridSubInfo">
    	<img src="imagenes/launcher_informes.jpg">
        <h4>Titulo</h4>
        <p>Informacion adicional del contenedor, esta se mostrara acomode lugar</p>
        <a href="">+ Ver Más</a>
    </div>
    

</div>

<!--<div id="sobreDiv">
</div>-->
<div style="background-color:#8B0000; height:500px;">
<div align="center">
<br>
<br>
<div style="background-color:#4c0101; height:1px; width:900px;"></div>
<div style="background-color:#f7d5d5; height:1px; width:900px;"></div>

<table width="900" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="60">
<img src="imagenes/icon-email.png">
</td>
<td width="450" valign="middle" align="left">
<h3 style="color:#FFF;">Reciba nuestras ofertas de servicios</h3>
</td>
<td align="center" width="350" valign="middle">
<input type="text" name="email" class="style-4" placeholder="Ingrese su e-mail">
</td>
<td align="center" width="50">
<input type="button" name="enviarnoticia" id="enviarnoticia" style="background:url(imagenes/Logo_Telegram.png) no-repeat; height:43px; width:43px; border:none;">
</td>
</tr>
</table>
<div style="background-color:#f7d5d5; height:1px; width:900px;"></div>
<div style="background-color:#4c0101; height:1px; width:900px;"></div>
<br>
<br>


</div>

<div class="container" style="width:900px; color:#FFF;">
<form role="form">
	<div class="row" align="left">
    	<h3 style="padding-left:15px;">Contacto</h3>
    </div>
	<div class="row">
		<div class="col-md-6">
            <div class="form-group">
            	<input type="text" class="form-control" id="nombreapellido" placeholder="Nombre y Apellido">
            </div>
  		</div>

	</div>
	<div class="row">
		<div class="col-md-3">
            <div class="form-group">
            	<input type="text" class="form-control" id="telefono" placeholder="Teléfono">
            </div>
  		</div>
        <div class="col-md-3">
        	<div class="form-group">
            	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-Mail">
            </div>
        </div>

	</div>
    
    <div class="row">
    	<textarea class="col-md-6" rows="3" style="padding:10px; width:420px; margin-left:15px;"></textarea>
    </div>
</form>


<table width="300" border="0" cellpadding="0" cellspacing="0" style="float:right; margin-top:-250px;" height="300">
    <tr>
    	<td align="left">
        	<h3>Teléfonos</h3>
            <h5>15-6184415</h5>
        </td>
    </tr>
    <tr>
    	<td align="left">
        	<h3>Seguinos en Twitter</h3>
            <h5>diegomenna@superstar</h5>
        </td>
    </tr>
    <tr>
    	<td align="left">
        	<h3>Mira las noticias nuevas</h3>
            <h5>facebookdiegomenna</h5>
        </td>
    </tr>
</table>


</div>


</div>

</div>
</body>
</html>
