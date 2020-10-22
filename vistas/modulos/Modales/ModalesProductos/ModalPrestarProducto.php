<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalPrestarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" class="formularioPrestarProducto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Prestar Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <label>Categoria</label>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                 <input type="text" class="form-control input-lg" id="pretarCategoria" name="pretarCategoria" required readonly="">
                  <input type="hidden" name="idCategoria" id="idCategoria">



              </div>

            </div>
            <!-- ENTRADA PARA SELECCIONAR PROVEEDOR -->
            <label>Proveedor</label>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                 <input type="text" class="form-control input-lg" id="pretarProveedor" name="pretarProveedor" required readonly="">
                  <input type="hidden" name="idProveedor" id="idProveedor">


               

              </div>

            </div>

            <!--  -->

            <!-- ENTRADA PARA EL CÓDIGO -->
            <label>Código</label>
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="prestarCodigo" name="prestarCodigo" readonly required>
                  <input type="hidden" name="idProducto1" id="idProducto1">


              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <label>Producto</label>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="prestarProducto" name="prestarProducto" required readonly>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group row">
              
              <div class="col-xs-12 col-sm-6"> 

               <label for="">Precio</label>
             
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                  <input type="number" class="form-control input-lg" id="prestarPrecio" name="prestarPrecio" min="0" value="0" required readonly>
                
                </div>
              </div>
              <!-- ------------------------------------------- -->

              <div class="col-xs-12 col-sm-6">              
                 <label for="">Cantidad</label>

                <div class="input-group">

              
                  <span class="input-group-addon"><i class="fa fa-check"></i></span> 
                  <input type="number" class="form-control input-lg" id="prestarCantidad" name="prestarCantida" min="0" required>
                    <input type="hidden" name="cantidadActual" id="cantidadActual">
                    <input type="hidden" name="nuevoStock" id="nuevoStock">

                </div>
              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <!-- ENTRADA PARA LA RAZON -->
            <label>Razón</label>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon glyphicon glyphicon-pencil"></span> 

                 <textarea class="form-control" name="prestarRazon" id="prestarRazon" placeholder="Ingresa la Razón" rows="3" required="" cols="83"></textarea>
               

              </div>

            </div>

            
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrCrearPrestamo();

        ?>      

    </div>

  </div>

</div>
