<?php 
$ventas = ControladorVentas::ctrSumaTotalVentas();

$Total = number_format($ventas["Total"],2);


$item = null;
$valor = null;
$orden = "id";

$categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
$totalClientes =  count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);
$totalProductos = count($productos);


$valor= null;
$item = null;

$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);


// ------------------------------------------------------------------
  $Ganancia = 0;
  $Total_Ganancias = 0;
  foreach ($respuesta as $key => $value) {
   $listaProducto = json_decode($value["productos"], true);
   // var_dump($value["recibi"]);

   if($value["recibi"] == "0.00"){


        foreach ($listaProducto as $key => $value2) {

          // var_dump($value2["descripcion"]);
          $cantidad = $value2["cantidad"];

          $TotalInicial = $cantidad * $value2["compra"];
          $TotalFinal = $cantidad * $value2["precio"];
          $TotalDescuento = $cantidad * $value2["descuento"];

          // echo $TotalInicial."<br>";
          // echo $TotalFinal."<br>";
          // echo $TotalDescuento."<br>";

          $Ganancia = $TotalFinal - $TotalInicial - $TotalDescuento;
          $Total_Ganancias = $Total_Ganancias + $Ganancia;

        }
    } 


  }
    

              // ------------------------------------------------------------------

 ?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3><?php echo $Total; ?></h3>
        <p>Ventas</p>
    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<!-- ./col -->
<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo $Total_Ganancias; ?></h3>

      <p>Ganancias</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="#" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<!-- ./col -->
<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">

      <div class="inner">

        <h3><?php echo $totalCategorias; ?><sup style="font-size: 20px"></sup></h3>

        <p>Categorias</p>

      </div>

      <div class="icon">

        <i class="ion ion-clipboard"></i>

      </div>

      <a href="categorias" class="small-box-footer">

        Más info <i class="fa fa-arrow-circle-right"></i>

      </a>

    </div>

</div>




<!-- ./col -->
<div class="col-lg-3 col-xs-6">
<!-- small box -->
  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo $totalProductos; ?></h3>

      <p>Productos</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>
  </div>

</div>  