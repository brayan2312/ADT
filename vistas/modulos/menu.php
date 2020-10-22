<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
		<?php 

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo  '<li class="active">

					<a href="inicio">

						<i class="fa fa-home"></i>
						<span>Inicio</span>

					</a>

				</li>';
		}
		if($_SESSION["perfil"] == "Administrador"){
			echo    '<li>

					<a href="usuarios">

						<i class="fa fa-user"></i>
						<span>Usuarios</span>

					</a>

				</li>
		

			<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>

			<li>

				<a href="provedores">

					<i class="glyphicon glyphicon-copy"></i>
					<span>Provedores</span>

				</a>

			</li>

			<li>

			<a href="salida">

				<i class="ion-cash"></i>
				<span>Salida</span>

			</a>

		</li>


		<li>

			<a href="prestamo">

				<i class="glyphicon glyphicon-open"></i>
				<span>Prestamos</span>

			</a>

		</li>


			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';
		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
		echo    '<li>


					<a href="clientes">

						<i class="fa fa-users"></i>
						<span>Clientes</span>

					</a>

				</li>';

		}	
		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
			// fas fa-file-invoice-dollar fa fa-list-ul
		echo  '<li class="treeview">

				<a href="#">

					<i class="glyphicon glyphicon-shopping-cart"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-list-ul"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fas fa-cash-register"></i>
							<span>Crear venta</span>

						</a>

					</li>';


		if($_SESSION["perfil"] == "Administrador"){

			// far fa-chart-bar fas fa-poll

		echo        '<li>

						<a href="reportes">
							
							<i class="far fa-chart-bar"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';
		}

		echo    '</ul>

			</li>';
		}

		




		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
			// fas fa-file-invoice-dollar fas fa-dollar-sign
		
			
		echo  '<li class="treeview">

				<a href="#">

					<i class="glyphicon glyphicon-usd"></i>
					
					<span>Cotizaciones</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="crear-cotizacion">
							
							<i class="fas fa-clipboard"></i>
							<span>Crear Cotizacion</span>

						</a>

					</li>

					<li>

						<a href="cotizaciones">
							
							<i class="fa fa-list-ul"></i>
							<span>Cotizaciones</span>

						</a>

					</li>';


		

		echo    '</ul>

			</li>';
		}

			

		
		 ?>
		</ul>

	 </section>

</aside>