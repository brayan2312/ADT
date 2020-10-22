 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- menu para el usuario tipo vendedor -->

		<a class=" menu-cabezote btn btn-primary"  href="provedores">Provedor</a>
		    	      		
		<a class=" menu-cabezote btn btn-primary" href="productos">Productos</a>
		    	      		
		<a class=" menu-cabezote btn btn-primary" href="crear-venta">Crear-Venta</a>

		<a class=" menu-cabezote btn btn-primary" href="ventas">Ventas</a>



		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						
						<span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						
						<li class="user-body">
							
							<div class="pull-right">
								
								<a href="salir" class="btn btn-default btn-flat">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>

 <!-- stilo de menu para vandedor   -->
  <style>
 	.menu-cabezote{
 	padding: 5px !important;  	
 	margin: 10px 3px 5px 10px ;
 	border: 0px;
 	}
 </style>