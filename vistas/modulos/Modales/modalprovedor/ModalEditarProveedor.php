<!--=====================================
MODAL Editar USUARIO
======================================-->

<div id="ModalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedor</h4>

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

                <input type="text" class="form-control input-lg" name="EditarProveedor" id="EditarProveedor"  required="">

              </div>

            </div>

            <!-- ENTRADA PARA EL EMPRESA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-building"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarEmpresa" id="EditarEmpresa"   required="">

                <input type="hidden" name="idPro" id="idPro">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarTelefono" id="EditarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>


             <!-- ENTRADA PARA EL CORREO -->
            
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="EditarEmail" id="EditarEmail" required>

              </div>

            </div>

            <!--................... -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Provedor</button>

        </div>

        <?php

          $EditarProvedor = new ProvedoresControlador();
          $EditarProvedor -> ctrEditarProvedor();

        ?>

      </form>

    </div>

  </div>

</div>