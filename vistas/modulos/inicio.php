<div class="content-wrapper">

    
    <h1>
      
      Pedidos por entregar
      
     <!--  <small>Panel de Control</small> -->
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Pedidos por entregar</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Title</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
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
          ?>
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

          $item = null;
          $valor = 1;

          $respuesta = ControladorVentas::ctrMostrarVentasPedidos($item, $valor);

          foreach ($respuesta as $key => $value) {
           

           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

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

                      <button class="btn btn-success btnEntrega" idVenta="'.$value["id"].'"><i class="far fa-check-circle"></i></button>
                        
                      <button class="btn btn-info btnImprimir" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>


                      <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>
       <?php
     }

      $CumplirPedido = new ControladorVentas();
      $CumplirPedido -> ctrEntregarPedido();

      ?>

      </div>
    </div>
    <!-- /.box -->
    

      <div class="col-lg-12"> 

        <?php 

          if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial"){

            echo '<div class="box box-success">
            <div class="box-header">
              <h1>Bienvenido' .$_SESSION["nombre"].'</h1>
            </div>

            </div>';


          }

         ?>

      </div>
      

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->