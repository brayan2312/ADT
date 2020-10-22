<!--=====================================
MODAL AGREGAR SALIDA de Efectivo
======================================-->
<div id="ModalEditarSalida" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Salida</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MONTO DE SALIDA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion-cash &#xf316;"></i></span> 
                

                <input type="number" min="1" class="form-control input-lg" name="EditarSalida" id="EditarSalida" required="">
                <input type="hidden" name="idS" id="idS">
              </div>

            </div>

            <!-- rAZON DE LA SALIDADA DEL MONTO ENTREGADO  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion-cash"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarRazonSalida" id="EditarRazonSalida" required="">

              </div>

            </div>

              <!-- proveedor aquiuen se le entrego -->
            
              <!-- <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion-cash"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarProvedorSalida" id="EditarProvedorSalida" required="">

              </div>

            </div> -->
            <!--................... -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>
      <?php 
        $editarSalida = new ControladorSalida();
        $editarSalida -> ctrEditarSalida();


       ?>
    
      </form>

    </div>

  </div>

</div>