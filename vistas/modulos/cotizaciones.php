<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cotizaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-cotizacion">

          <button class="btn btn-primary">
            
            Agregar cotización

          </button>

        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            
            <span>
              <i class="fa fa-calendar"></i>Rango de Fecha
            </span>
              <i class="fa fa-caret-down"></i>
          </button>

      </div>

      <div class="box-body">

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
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código factura</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
          //  if(isset($_GET["fechaInicial"])){

          //   $fechaI = $_GET["fechaInicial"];
          //   $fechaF = $_GET["fechaFinal"];

          // }else{

          //   $fechaI = null;
          //   $fechaF = null;

          // }

          $item = null;
          $valor = null;

          // $respuesta = ControladorVentas::controlFechasVentas($fechaI, $fechaF);
          $respuesta = ControladorCotizacion::ctrMostrarCotizacion($item, $valor);


          foreach ($respuesta as $key => $value) {
           

           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_client"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirC" codigoC="'.$value["codigo"].'"><i class="fa fa-print"></i></button>';
                    if($_SESSION["perfil"] == "Administrador"){


                    echo '<button class="btn btn-warning btnEditarCotizacion" idCotizacion="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarCotizacion" idCotizacion="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                    }

                  echo'  </div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarCotizacion = new ControladorCotizacion();
      $eliminarCotizacion -> ctrEliminarCotizacion();

      ?>
       

      </div>

    </div>

  </section>

</div>




