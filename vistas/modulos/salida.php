<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Movimientos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Salida </li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">


        <div class="row">
            <?php 

              if($_SESSION["perfil"] == "Administrador"){
              
               include "inicio/cajas-superiores2.php";

              }
             ?>

        </div>


      
      <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarSalida">
          
          Agregar salida

        </button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEntrada">
          
          Agregar Entrada

        </button>
        
      </div>

      <div class="box-body">
          <!-- ----------------------------------------------------------------------------------------------- -->
         <?php 
            if($_SESSION["perfil"] == "Administrador"){

            date_default_timezone_set("America/Mexico_City");
            $hoy = date("Y-m-d");

            $hoy2 = date("Y-m-d H:i:s");

             // var_dump($hoy2);

            $respuesta = ControladorEntrada::ctrMostrarCajero();

            if($respuesta["fecha"] != $hoy || $respuesta["fecha"] == ""){


         ?>

         <!-- <script>
           var fechaa = moment().format("YYYY-MM-DD");
           
          // --------------------------------------------------
                swal({
                  title: 'Agregar Dinero en Caja',
                  input: 'text',
                  inputAttributes: {
                    autocapitalize: 'off'
                  },
                  showCancelButton: true,
                  confirmButtonText: 'Agregar',
                  showLoaderOnConfirm: true,
                  cancelButtonText: 'Cancelar',
                  preConfirm: (login) => {
                    return fetch(`//api.github.com/users/${login}`)
                      .then(response => {
                        if (!response.ok) {
                          throw new Error(response.statusText)
                        }
                        return response.json()
                      })
                      .catch(error => {
                        Swal.showValidationMessage(
                          `Request failed: ${error}`
                        )
                      })
                  },
                  allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                  if (result.value) {
                    console.log(result.value.login);
                    console.log(fechaa);


                    $.post("ajax/caja.php",{
                      numero: result.value.login,
                      fecha: fechaa 
                    });

                    window.location = "salida";

                  }
                })
        // -------------------------------------------------

           
         </script> -->
         <?php 

          }else{
           
          }
        }
          ?>
<!-- ----------------------------------------------------------------------------------------------- -->

         <div class="input-group">

           <button type="button" class="btn btn-default" id="daterange-btn3">

              
              <span>
            <!-- <input type="text" id="daterange-btn3"> -->
                <i class="fa fa-calendar"></i>Rango de Fecha
              </span>
                <i class="fa fa-caret-down"></i>
          </button>

            <br>

        </div>
            <a class="btn btn-primary" href="salida">Restaurar</a>
        <?php 
            if($_SESSION["perfil"] == "Administrador"){


         ?>
         <hr size="2px" color="black" />
      <h3>Caja</h3>
      <table class="table table-bordered table-striped dt-responsive tablas_dos" width="100%">

        <?php 
                $Total_Ganancias_Hoy = 0;
            if(isset($_GET["fechaa"])){
                
                $fecha_actual = $_GET["fechaa"];  

                $TotalCaja = ControladorEntrada::ctrMostrarDinero($fecha_actual);

                $item = null;
                $valor= null;

                $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

                 // ------------------------------------------------------------------
                $Ganancia = 0;
                foreach ($respuesta as $key => $value) {
                $Nuevafecha = substr($value["fecha"], 0,10);
               
                 $listaProducto = json_decode($value["productos"], true);
                 // var_dump($value["recibi"]);

                 if($value["recibi"] == "0.00" && $Nuevafecha == $fecha_actual){
              

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
                        $Total_Ganancias_Hoy = $Total_Ganancias_Hoy + $Ganancia;

                      }
                  } 


                }
                  
             
              // ------------------------------------------------------------------


                $total_pgos = 0;
                $total_abonos = 0;

                foreach ($respuesta as $key => $value) {

                    #Capturamos solo el año y el mes
                    $fecha = substr($value["fecha"], 0,10);

                  
                    if($fecha == $fecha_actual && $value["recibi"] == 0){

                      $total_pgos += $value["total"];

                    }

                    if($fecha == $fecha_actual && $value["recibi"] != 0){            

                      $total_abonos += $value["recibi"];

                    }
                }

                $respuestaEntrada = ControladorEntrada::ctrMostrarEntrada($item, $valor);

                $Total_entrada = 0;

                foreach ($respuestaEntrada as $key => $value) {

                    #Capturamos solo el año y el mes
                    $fecha_E = substr($value["fecha"], 0,10);

                  
                    if($fecha_E == $fecha_actual){

                      $Total_entrada += $value["monto"];

                    }

                   
                }

                $respuestaSalidad = ControladorSalida::ctrMostrarSalida($item, $valor);

                 $TotalSalidad = 0;

                foreach ($respuestaSalidad as $key => $value) {

                    #Capturamos solo el año y el mes
                    $fecha_S = substr($value["fecha"], 0,10);

                  
                    if($fecha_S == $fecha_actual){

                      $TotalSalidad += $value["monto"];

                    }

                   
                }
              
                

                $Total_En_Caja = 0;

                $Total_En_Caja = $TotalCaja["dinero"] + $total_pgos + $total_abonos + $Total_entrada - $TotalSalidad;
                // echo $Total_En_Caja;

            }else if(isset($_GET["fechaa"]) == ""){

              date_default_timezone_set("America/Mexico_City");
              $fecha_actual = date("Y-m-d"); 
              $fecha_hora = date("Y-m-d H:i:s"); 

              $TotalCaja = ControladorEntrada::ctrMostrarDinero($fecha_actual);
              $valor= null;
              $item = null;

              $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

          
              // ------------------------------------------------------------------
                $Ganancia = 0;
               
                foreach ($respuesta as $key => $value) {
                $Nuevafecha = substr($value["fecha"], 0,10);
                

                $listaProducto = json_decode($value["productos"], true);
                 // var_dump($value["recibi"]);

                 if($value["recibi"] == "0.00" && $fecha_actual == $Nuevafecha){
              

                      foreach ($listaProducto as $key => $value2) {

                        
                        $cantidad = $value2["cantidad"];

                        $TotalInicial = $cantidad * $value2["compra"];
                        $TotalFinal = $cantidad * $value2["precio"];
                        $TotalDescuento = $cantidad * $value2["descuento"];

                        // echo $TotalInicial."<br>";
                        // echo $TotalFinal."<br>";
                        // echo $TotalDescuento."<br>";

                        $Ganancia = $TotalFinal - $TotalInicial - $TotalDescuento;
                        $Total_Ganancias_Hoy = $Total_Ganancias_Hoy + $Ganancia;

                      }
                  } 


                }
                   // echo $Total_Ganancias_Hoy;
             
              // ------------------------------------------------------------------


              $total_pgos = 0;
              $total_abonos = 0;

              foreach ($respuesta as $key => $value) {

                  #Capturamos solo el año y el mes
                  $fecha = substr($value["fecha"], 0,10);

                
                  if($fecha == $fecha_actual && $value["recibi"] == 0){

                    $total_pgos += $value["total"];

                  }

                  if($fecha == $fecha_actual && $value["recibi"] != 0){            

                    $total_abonos += $value["recibi"];

                  }
              }

              $respuestaEntrada = ControladorEntrada::ctrMostrarEntrada($item, $valor);

              $Total_entrada = 0;

              foreach ($respuestaEntrada as $key => $value) {

                  #Capturamos solo el año y el mes
                  $fecha_E = substr($value["fecha"], 0,10);

                
                  if($fecha_E == $fecha_actual){

                    $Total_entrada += $value["monto"];

                  }

                 
              }

              $respuestaSalidad = ControladorSalida::ctrMostrarSalida($item, $valor);

               $TotalSalidad = 0;

              foreach ($respuestaSalidad as $key => $value) {

                  #Capturamos solo el año y el mes
                  $fecha_S = substr($value["fecha"], 0,10);

                
                  if($fecha_S == $fecha_actual){

                    $TotalSalidad += $value["monto"];

                  }

                 
              }
            
              

              $Total_En_Caja = 0;

              $Total_En_Caja = $TotalCaja["dinero"] + $total_pgos + $total_abonos + $Total_entrada - $TotalSalidad;
              // echo $Total_En_Caja;

            }

              
            


         ?>
         
        <thead>
         
         <tr>
           
           
           <th><h4>Dinero en Caja</h4></th>
           <th><h4>Total</h4></th>
           
           
         </tr> 

        </thead>
        <!-- ------------------------------------------------------- -->
        


        <!-- -------------------------------------------------- -->

       <tr>

          <td><h4>Fondo de Caja</h4></td>
          <td><h4 class="heading2"><?php echo "$".number_format($TotalCaja["dinero"],2); ?></h4></td>
                 
        </tr>

        <tr>

          <td><h4>Dinero Ventas</h4></td>
          <td><h4 class="heading2"><?php echo "+ $".number_format($total_pgos,2); ?></h4></td>
                 
        </tr>

        <tr>

          <td><h4>Abonos</h4></td>
          T<td><h4 class="heading2"><?php echo "+ $".number_format($total_abonos,2); ?></h4></td>
          
                 
        </tr>
        
         <tr>

          <td><h4>Entradas</h4></td>
          <td><h4 class="heading2"><?php echo "+ $".number_format($Total_entrada,2); ?></h4></td>
                           
        </tr>

         <tr>

          <td><h4>Salidas</h4></td>
          <td><h4 class="heading"><?php echo "- $".number_format($TotalSalidad,2); ?></h4></td>
          
                 
        </tr>
        <!-- -------------------------------------------------------------- -->
        
          

       

        <!-- -------------------------------------------------------------- -->

       
         <tr>

          <td><h3 class="heading2">Ganancias</h3></td>
          <td><h3 class="heading2"><?php echo "$".number_format($Total_Ganancias_Hoy,2); ?></h3></td>
      
        
                 
        </tr>   
            
        <tr>

          <td><h2 class="heading2">Total en Caja</h2></td>
          <td><h2 class="heading2"><?php echo "$".number_format($Total_En_Caja,2); ?></h2></td>
        
                 
        </tr> 

      
                

        
               
        </tbody>

       </table>
      <hr style="border-color:blue;">
       <!-- ==================================================================================== -->

       <!--**************************************************************** -->
      <h3>Ventas Por Proveedor</h3>
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           
           <th>Proveedor</th>
           <th>Monto</th>
           

           
         </tr> 

        </thead>

        <tbody>

        <?php 
          if(isset($_GET["fechaa"])){
                
                $fecha_actual2 = $_GET["fechaa"];  
          }else{
            date_default_timezone_set("America/Mexico_City");
              $fecha_actual2 = date("Y-m-d");
          }
          $to = 0;
          $prove = ProvedoresControlador::ctrMostrarProvedores(null,null);

          foreach ($prove as $key => $valuep) {
           echo '<tr>'; 

            $respuesta = ControladorVentas::ctrMostrarVentas(null, null);
            foreach ($respuesta as $key => $value0) {

              $Nuevafecha = substr($value0["fecha"], 0,10);
              $listaProducto2 = json_decode($value0["productos"], true);

                  
              if($value0["recibi"] == "0.00" && $fecha_actual2 == $Nuevafecha){
               


                foreach ($listaProducto2 as $key => $value2) {
                // // $produc = ControladorProductos::MostrarProductos("id", $value2["id"]);
                  
          

                 if($value2["id_p"] == $valuep["id"] ){
                 
                    // $cantidad = $value2["cantidad"];
                    // $TotalFinal = $cantidad * $value2["precio"];
                    // $TotalDescuento = $cantidad * $value2["descuento"];
                    // $total = $TotalFinal - $TotalDescuento / 2;
                  $total = $value2["total"];
                    $to = $to + $total;
                  
                  }

                }//////////                
              }      
              
            } 
             echo' <td><h1>'.$valuep["nombre"].'</h1></td>
             <td><h2 class="heading2">$'.number_format($to,2).'</h2></td>';

             echo '</tr>'; 
             $to = 0;
          }//foreach prove





         ?>

               
        </tbody>

       </table>


       <!--**************************************************************** -->

      <h3>Entradas</h3>
      
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Monto</th>
           <th>Razón</th>
           <th>fecha</th>

           
         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = 1;

          $respuesta = ControladorEntrada::ctrMostrarEntrada($item, $valor);



          foreach ($respuesta as $key => $value) {
           
            $fecha = substr($value["fecha"], 0,10);

             if(isset($_GET["fechaa"])){
              $fecha_bus = $_GET["fechaa"];
             }else{

              date_default_timezone_set("America/Mexico_City");
              $fecha_bus = date("Y-m-d");      
             }

            if($fecha_bus == $fecha ){
               echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>$'.$value["monto"].'</td>';

                      // $itemCliente = "id";
                      // $valorCliente = $value["id_cliente"];

                      // $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);


                      // $itemUsuario = "id";
                      // $valorUsuario = $value["id_vendedor"];

                      // $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                      echo '<td>'.$value["razon"].'</td>

                    
                       
                      <td>'.$value["fecha"].'</td>

                      <td>

                        <div class="btn-group">

                     

                          

                          <button class="btn btn-warning btnEditarEntrada" data-toggle="modal" data-target="#ModalEditarEntrada" idEntrada="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          
                         
                          <button class="btn btn-danger btnEliminarEntrada" idEntrada="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                    </tr>';
              }
            }

        ?>
               
        </tbody>

       </table>
   
      <!-- <hr style="border-color:blue;"> -->
       
       

        <h3>Salidas</h3>
     
        <table class="table table-bordered table-striped dt-responsive tablas_dos tables" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Monto</th>
           <th>Razón</th>
           <th>fecha</th>

           
         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = 1;

          $respuesta = ControladorSalida::ctrMostrarSalida($item, $valor);

          foreach ($respuesta as $key => $value) {

             $fecha = substr($value["fecha"], 0,10);

             if(isset($_GET["fechaa"])){
              $fecha_bus = $_GET["fechaa"];
             }else{

              date_default_timezone_set("America/Mexico_City");
              $fecha_bus = date("Y-m-d");      
             }
           
              if($fecha_bus == $fecha){
               echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>$'.$value["monto"].'</td>';

                      // $itemCliente = "id";
                      // $valorCliente = $value["id_cliente"];

                      // $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);


                      // $itemUsuario = "id";
                      // $valorUsuario = $value["id_vendedor"];

                      // $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                      echo '<td>'.$value["razon"].'</td>

                    

                       
                      <td>'.$value["fecha"].'</td>

                      <td>

                        <div class="btn-group">

                     

                          

                          <button class="btn btn-warning btnEditarSalida" data-toggle="modal" data-target="#ModalEditarSalida" idSalida="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          
                         
                          <button class="btn btn-danger btnEliminarASalida" idSalida="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                    </tr>';
              }    
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
    

            

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

      </form>

    </div>

  </div>

</div>


<?php
include "vistas/modulos/Modales/modalSDE/entradaEFV.php";
include "vistas/modulos/Modales/modalSDE/editarsalidaEFV.php";
include "vistas/modulos/Modales/modalSDE/salidaEFV.php";
include "vistas/modulos/Modales/modalSDE/editarentradaEFV.php";

$eliminarEntrada = new ControladorEntrada();
$eliminarEntrada -> ctrEliminarEntrada();

$eliminarSalida = new ControladorSalida();
$eliminarSalida -> ctrEliminarSalida();
?>

