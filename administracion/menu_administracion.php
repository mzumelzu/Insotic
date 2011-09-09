<style type="text/css"> 
		a{
		display: block;
		text-decoration: none;
		color: #004a80;
		padding: 5px;
		}
		
		ul{
		width: 1000px;
		height: 20px;
		}
		
		ul,li{
		list-style: none;
		margin:0;
		padding:0;
		}
		
		#nav{
		font-family: 'Century Gothic', sans-serif;
		}
		
		#nav li{
		float:left;
		position: relative;
		width: 200px;
		font-size: 12px;
		font-variant: small-caps;
		border-top:1px solid #004a80;
		border-bottom:1px solid #004A80;
		}
		
		.submenu{
		display: none;
		position: absolute;
		left: -1px;
		border:none;
		height: auto;
		background: none;
		}
		
		#nav .submenu li{
		float: none;
		position: static;
		margin: 0;
		font-size: 12px;
		font-variant: normal;
		border: 1px solid #004a80;
		border-top: none;
		width: 180px;
		}
		
		#nav .submenu li a{
		color: #FFFFFF;
		background: #036 url('fondo_menu_desplegable.png') repeat-x 0 0;
		width: 180px;
		height: 12px;
		
		}
		
		#nav .submenu li a:hover{
		color: #FFFFFF;
		background: #004a80 url('fondo_menu_desplegable.png') repeat-x 0 0;
		width: 180px;
		height: 12px;
		}
		
		div.volver{
			margin-top:300px;
			width: 500px;
			text-align: center;
		}
		
		div.volver a{
			text-decoration: underline;
		}
		
		div.volver a:hover{
			color: #FFFFFF;
			background: #004a80 url('fondo_menu_desplegable.png') repeat-x 0 0;
		}
		</style> 
		<script src="_jquery/jquery.js" type="text/javascript"></script> 
		<script type="text/javascript" src="_jquery/jsbackground.js"></script> 
		<script type="text/javascript"> 
		$(function(){
			$('#nav>li').hover(
				function(){
					$('.submenu',this).stop(true,true).slideDown('fast');
				},
				function(){
					$('.submenu',this).slideUp('fast');
				}
			);
		
			
			$('.submenu li a').css( {backgroundPosition: "0px 0px"} ).hover(
				function(){
					$(this).stop().animate({backgroundPosition: "(0px -95px)"}, 250);
				},
				function(){
					$(this).stop().animate({backgroundPosition: "(0px 0px)"}, 250);
				}
			);			
		});
		</script> 
	
 	<?php
		include_once("properties/propiedades.php");
		echo $LOGO_APP;
	?>
	<ul id="nav"> 
		<li><a href="#">Administración</a> 
			<ul class="submenu"> 
				<li><a href="empresas.php">Empresas</a></li> 
				<li><a href="paises.php">Paises</a></li> 
				<li><a href="regiones.php">Regiones</a></li> 
				<li><a href="comunas.php">Comunas</a></li> 
				<li><a href="ciudades.php">Ciudades</a></li> 
                <li><a href="tipo_calle.php">Tipo de Calles</a></li> 
				<li><a href="actividades_economicas.php">Actividades Económicas</a></li> 
				<li><a href="tipo_documento.php">Documentos</a></li> 
				<li><a href="escolaridad.php">Escolaridad</a></li> 
				<li><a href="grupo_ocupacional.php">Grupo Ocupacional</a></li> 
				<li><a href="franquicia.php">Tipo de Franquicias</a></li> 
				<li><a href="porcentaje_franquicia.php">Porcentajes de Franquicias</a></li> 
				<li><a href="#">Instituciones</a></li>
				<li><a href="#">Usuarios</a></li> 
                <li><a href="aporte_empresa.php">Aporte Empresa</a></li> 
			</ul> 
		</li> 
		<li><a href="#">Generación de Formularios</a> 
			<ul class="submenu"> 
				<li><a href="#">Cursos</a></li> 
				<li><a href="#">Formulario</a></li> 
				<li><a href="#">Horarios</a></li> 
				<li><a href="#">Participantes</a></li> 
			</ul> 
		</li> 
		<li><a href="#">Informes</a> 
			<ul class="submenu"> 
				<li><a href="#">Informe 1</a></li> 
				<li><a href="#">Informe 2</a></li> 
				<li><a href="#">Informe 3</a></li> 
			</ul> 
		</li> 
		<li><a href="#">Sistema</a> 
			<ul class="submenu"> 
				<li><a href="cerrar_sesion.php">Cerrar Sesión</a></li> 
				<li><a href="#">Acerca</a></li> 
	
			</ul> 
		</li> 
	</ul> 