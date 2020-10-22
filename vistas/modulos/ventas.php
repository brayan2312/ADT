<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">

          <button class="btn btn-primary">
            
            Agregar venta

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
           <th>Descuento</th> 
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
           if(isset($_GET["fechaInicial"])){

            $fechaI = $_GET["fechaInicial"];
            $fechaF = $_GET["fechaFinal"];

          }else{

            $fechaI = null;
            $fechaF = null;

          }

          // $item = null;
          // $valor = null;

          $respuesta = ControladorVentas::controlFechasVentas($fechaI, $fechaF);

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

                  <td>$ '.number_format($value["descuento"],2).'</td>


                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimir" codigoVenta1="'.$value["codigo"].'"><i class="fa fa-print"></i></button>

                      <button class="btn btn-default btnImprimir2" codigoVenta="'.$value["codigo"].'"><i class="glyphicon glyphicon-paste"></i></button>';


                      
                    if($_SESSION["perfil"] == "Administrador"){


                     echo '<button class="btn btn-success btnEditarVenta" idVenta="'.$value["id"].'"><i class="glyphicon glyphicon-cog"></i></button>';

                      echo '<button class="btn btn-warning btnEditarTotal" idVenta="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarVenta"><i class="fa fa-pencil"></i></button>';

               echo' <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                    }

                  echo'  </div>  

                  </td>

                </tr>';
            }

        ?>
        <!-- <button class="btn btn-info btnImprimir" codigoVenta="'.$value["codigo"].'"><i class="fa fa-print"></i></button>'; -->
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();
      $eliminarVenta -> reImprimir();

      ?>
       

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarVenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" class="EditarTotal2">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Abonos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO  fa fa-key-->
            
              <!-- <label for="">TOTAL:</label> -->
            <div class="form-group">
              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarCodigo" id="EditarCodigo" required readonly>

                

              </div>

            </div>
            <!-- ENTRADA PARA EL TOTAL  fa fa-key------------------------------------------------------->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarTotal" id="EditarTotal" required readonly>
                 <input type="hidden"  name="total" id="total" required>
                
                 <input type="hidden"  name="idVenta" id="idVenta" required>

              </div>

            </div><!----------------------------------------------------------------------------------->
            
            <div class="Checks">

              <div class="Checkbox2">

                <label>
                        
                    <input type="checkbox" class="checkEditarPago" id="checkss">
               

                    <input type="hidden" id="Editarpendiente" name="Editarpendiente" value="0">
                    Tipo Pago:
                  
              </label>
                
              </div>
              

            </div>
            
            <div class="contado">

              <div class="cajas1">
                

              </div>

              <div class="cajas2">
                

              </div>
              

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="desactivar">Guardar cambios</button>

        </div>

      <?php

          $editarAbono = new ControladorVentas();
          $editarAbono -> ctrActualizarAbonos();

        ?> 

      </form>

    </div>

  </div>

</div>


