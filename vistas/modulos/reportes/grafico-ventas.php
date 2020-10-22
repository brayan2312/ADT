<?php 

	error_reporting(0);

	// if(isset($_GET["fechaInicial"])){

	// $fechaI = $_GET["fechaInicial"];
	// $fechaF = $_GET["fechaFinal"];

	// }else{

	// $fechaI = null;
	// $fechaF = null;

	// }
	 // $fechaI = null;
	 // $fechaF = null;
	


	$respuesta = ControladorVentas::controlFechasVentas($fechaI,$fechaF);
	
	$arrayFechas = array();
	$arrayVentas = array();
	$sumaPagosMes = array();

	foreach ($respuesta as $key => $value) {

		#Capturamos solo el año y el mes
		$fecha = substr($value["fecha"], 0,7);

		#Introducir las fechas en el arrayFechas
		array_push($arrayFechas, $fecha);

		#Capturamos el total de las ventas
		$arrayVentas = array($fecha => $value["total"]);

		#sumamos los pagos que se realizaron el mismo mes

		foreach ($arrayVentas as $key => $value) {
			
			$sumaPagosMes[$key] += $value;
		}
    }

    // var_dump($sumaPagosMes);

    $noRepetirFechas =  array_unique($arrayFechas);

    // var_dump($noRepetirFechas);
		

 ?>

<!--=============================================
=            Section comment block            =
=============================================-->
<div class="box box-solid bg-teal-gradient">

	<div class="box-header">

		<i class="fa fa-th"></i>

		<h3 class="box-title">Gráfico de Ventas</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
		
	</div>
 
</div>

<script>
	var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php 
    	if($noRepetirFechas != null){


	    	foreach ($noRepetirFechas as $key) {

	    		echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";
	    	}

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    	}else{

    		echo "{ y: '0', ventas: 0 }";

    	}

  	 ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['Total'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits		 : '$'	,
    gridTextSize     : 10
  });


</script>


