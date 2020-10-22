<?php 

if($_SESSION["perfil"] == "Vendedor"){
  echo '<script>
    window.location = "inicio";
  </script>';

  return;
}

 ?>


<div class="content-wrapper">


  <section class="content-header">
    
    <h1>
      
      Reportes de ventas
    
    </h1>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes de ventas</li>
    
    </ol>

  </section>



  <!-- Main content -->
  <section class="content">
    
    <!-- Default box -->
    <div class="box">

      <!-- ----------------------------------------------------------------------------------------------- -->
         <?php 
            if($_SESSION["perfil"] == "Administrador"){

            date_default_timezone_set("America/Mexico_City");
            $hoy = date("Y-m-d");
            // var_dump($hoy);

            $respuesta = ControladorEntrada::ctrMostrarCajero();

            if($respuesta["fecha"] != $hoy || $respuesta["fecha"] == ""){


         ?>

         <script>
          myFunction();
           function myFunction() {
           var fechaa = moment().format("YYYY-MM-DD");

              var txt;
              var person = prompt("Agrege Dinero a Caja");
              if (person == null || person == "") {
                txt = "User cancelled the prompt.";
              } else {

                    $.post("ajax/caja.php",{
                      numero: person,
                      fecha: fechaa 
                    });

                    window.location = "salida";
                
              }
              document.getElementById("demo").innerHTML = txt;
            }
        // -------------------------------------------------

           
         </script>
         <?php 

          }else{
            
          }
        }
          ?>
<!-- ----------------------------------------------------------------------------------------------- -->

      <div class="box-header with-border">

        <div class="input-group">

           <button type="button" class="btn btn-default" id="daterange-btn2">
         
              
              <span>
                <i class="fa fa-calendar"></i>Rango de Fecha
              </span>
                <i class="fa fa-caret-down"></i>
          </button>

        </div>
       <br>
          <!-- ----------------------------- -->
            <div class="row">
            <?php 

              if($_SESSION["perfil"] == "Administrador"){
              
               include "inicio/cajas-superiores.php";

              }
             ?>

            </div>

          <!-- ----------------------------- -->
        <div class="box-tools pull-right">

          
          <?php 
            if(isset($_GET["fechaInicial"])){

              echo ' <a href="vistas/modulos/descarga-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

            }else{

              echo ' <a href="vistas/modulos/descarga-reporte.php?reporte=reporte">';


            }

           ?>

          
          <button class="btn btn-success" style="margin-top: 5px">Descargar reporte en Excel </button>

        </div>

      </div>

      <div class="box-body">

         <!-- ------------------------- -->
        
            
        <!-- ------------------------ -->


        
       
<!-- --------------------------------------------------------- -->
        <div class="row"> 

          <div class="col-xs-12">

            <?php 

            include "reportes/grafico-ventas.php";

             ?>
            
          </div>

          <div class="col-md-6 col-xs-12">
            <?php 

              include "reportes/productos-mas-vendidos.php"

             ?>

          </div>

          <div class="col-md-6 col-xs-12">
            <?php 

              include "reportes/vendedores.php"

             ?>

          </div>

          <div class="col-md-6 col-xs-12">
            <?php 

              include "reportes/clientes.php"

             ?>

          </div>

        </div>
<!-- --------------------------------------------------------- -->

      </div>

    </div>

  </section>

</div>
