<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-6 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);
                    echo $venta["lugar"];
                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                   


                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente">

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];

                  // if (array_key_exists('descuento', $value)) {
                  //  
                  //  }else{
                  //  
                  //  }


                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-xs-5" style="padding-right:0px">
            
                          <div class="input-group">
                
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                          </div>


                        </div>';

                        if (array_key_exists('descuento', $value)) {
                           if($value["descuento"] == "0"){

                          echo '<div class="col-xs-2 ingresoDescuento">
              
                             <input type="number" class="form-control nuevaDescuentoProducto" name="nuevaDescuentoProducto" id="nuevaDescuentoProducto2" value="0" min="0">
                             <input type="hidden" class="form-control nuevoDes" name="nuevoDes" id="nuevoDes" totalDesc="0" value="0">


                          </div>';


                        }else{

                           echo '<div class="col-xs-2 ingresoDescuento">
              
                             <input type="number" class="form-control nuevaDescuentoProducto" name="nuevaDescuentoProducto" id="nuevaDescuentoProducto2" value="'.$value["descuento"].'" min="0">
                             <input type="hidden" class="form-control nuevoDes" name="nuevoDes" id="nuevoDes" totalDesc="0" value="'.$value["descuento"].'">


                          </div>';
                        }
                   
                        }else{

                           echo '<div class="col-xs-2 ingresoDescuento">
              
                             <input type="number" class="form-control nuevaDescuentoProducto" name="nuevaDescuentoProducto" id="nuevaDescuentoProducto2" value="0" min="0">
                             <input type="hidden" class="form-control nuevoDes" name="nuevoDes" id="nuevoDes" totalDesc="0" value="0">


                          </div>';
                   
                        }

                       

                         
                       echo' <div class="col-xs-2 ingresoCantidad">
              
                          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                        </div>

                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" precioCompra="'.$value["compra"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
   
                          </div>
               
                        </div>

                      </div>';
                }


                ?>

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                
                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <!-- <th>Impuesto</th> -->
                          <th></th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>

                          <td style="width: 50%">

                              
                              

                            </td>
                          
                          <!-- <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td> -->

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>" value="<?php echo $venta["total"]; ?>" readonly required>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                              <input type="hidden" class="totalDes" name="totalDescuento" id="totalDescuento">

                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>
                <!-- ------------------------------------------------------------- -->
                <?php 

                  if($venta["efectivo"] > "0.00"){

                    echo '<label>
                        
                              <input type="checkbox" class="minimal checkPago">

                               <!-- <input type="checkbox" class="minimal checkboxxx" checked> -->
                             

                              <input type="hidden" id="pendiente" name="pendiente" value="0">
                              Tipo Pago:
                  
                         </label>';
                  }else{
                     echo '<label>
                        
                              <input type="checkbox" class="minimal checkPago" checked>

                               <!-- <input type="checkbox" class="minimal checkboxxx" checked> -->
                             

                              <input type="hidden" id="pendiente" name="pendiente" value="0">
                              Tipo Pago:
                  
                         </label>';
                  }


                 ?>
                 
                <!-- ------------------------------------------------------------- -->



                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                <div class="form-group row tipos">
                  



                    <div class="cajasCambio"> 
                       <!--.-------------------------------------- -->
                       <?php 
                          if($venta["recibi"] == "0.00"){
                            $efec = $venta["efectivo"];
                            $cambio = $venta["cambio"];

                       echo '<div class="col-xs-6">

                          <label >Recibi:</label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control efectivo" id="nuevoValorEfectivo" placeholder="000000" required value="'.$efec.'">
                            <input type="hidden" name="efectivoo" id="efectivoo" value="'.$efec.'">
                            
                          </div>

                      </div>

                      <div class="col-xs-6" id="capturarCambioEfectivo" style="padding-left:0px">

                          <label >Cambio:</label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control cambio" id="nuevoCambioEfectivo" readonly min="0" placeholder="000000" required readonly="" value="'.$cambio.'">
                            <input type="hidden" name="cambio" id="cambio" value="'.$cambio.'" required="">
                          </div>

                      </div>';

                          }else{

                            $recib = $venta["recibi"];
                            $rest = $venta["resta"];

                            echo '<div class="col-xs-6">

                              <label >Recibi:</label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                <input type="text" class="form-control" id="NuevoAdelanto" placeholder="000000" required value="'.$recib.'">
                                <input type="hidden" name=Adelanto id=Adelanto value="'.$recib.'">
                                
                              </div>

                             </div>

                             <div class="col-xs-6" id="capturarResta" style="padding-left:0px">

                              <label >Resta:</label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                <input type="text" class="form-control" id="NuevoResta" readonly min="0" placeholder="000000" required value="'.$rest.'">

                                <input type="hidden" name="Resta" id="Resta" value="'.$rest.'" required="">
                              </div>

                           </div>';
                          }



                        ?>
                       
                       <!--.-------------------------------------- -->
                    
                  </div>

                  <div class="cajasDeuda">
                    
                    
                    
                  </div>
                    
                    
                  
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>                
                <!-- ---------------------------------------------------------- -->
                <div class="form-group">
                      
                 <label>
                  <br>
                  
                    <br>
                    <?php 
                     // var_dump($venta["pendiente"]);
                    if($venta["pendiente"] == 1){

                    echo' <label>
                        
                          <input type="checkbox" class="minimal checkEntrega" checked>

                           <!-- <input type="checkbox" class="minimal checkboxxx" checked> -->
                         

                          <input type="hidden" class="Pendi" id="pendiente" name="pendiente" value="0">
                          Entrega Pendiente
                      
                         </label>
                        <br>
                        <div class="Direccion">
                          <textarea class="form-control" name="DireccionEntrega" placeholder="Ingresa Dirección" rows="3" required="" cols="83">';echo $venta["lugar"];echo'</textarea>

                          
                          <input type="hidden" name="DireccionEntrega" value="">

                        </div>';


                    }else if($venta["pendiente"] == 0){

                        echo' <label>
                        
                          <input type="checkbox" class="minimal checkEntrega">

                           <!-- <input type="checkbox" class="minimal checkboxxx" checked> -->
                         

                          <input type="hidden" class="Pendi" id="pendiente" name="pendiente" value="0">
                          Entrega Pendiente
                      
                         </label>
                        <br>
                        <div class="Direccion">
                         

                          
                          <input type="hidden" name="DireccionEntrega" value="">

                        </div>';

                      
                    }

                     ?>
                             
                  </label>

                 <!--   <div class="Direccion">
                    
                    <input type="hidden" name="DireccionEntrega" value="">

                  </div>
 -->
              </div>
                <!-- ---------------------------------------------------------- -->

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <!-- <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button> -->
            <button type="submit" class="btn btn-primary pull-right apagar" id="desactivar">Guardar Cambios</button>


          </div>

        </form>

        <?php

          $editarVenta = new ControladorVentas();
          $editarVenta -> ctrEditarVenta();
          
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Costo</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
