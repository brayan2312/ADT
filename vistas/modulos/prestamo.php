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
      
      Administrar Prestamos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Prestamos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

     <!--  <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar prestam

        </button>

      </div> -->

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
           <th>Código</th>
           <th>Producto</th>
           <th>Categoria</th>
           <th>Precio</th>
           <th>Cantidad</th>
           <th>Razón</th>
           <th>Fecha</th>


           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $prestamo = ControladorProductos::ctrMostrarPrestamo($item, $valor);
     

          foreach ($prestamo as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["codigo"].'</td>
                    <td class="text-uppercase">'.$value["producto"].'</td>
                    <td class="text-uppercase">'.$value["categoria"].'</td>
                    <td class="text-uppercase">'.$value["precio"].'</td>
                    <td class="text-uppercase">'.$value["cantidad"].'</td>
                    <td class="text-uppercase">'.$value["razon"].'</td>
                    <td class="text-uppercase">'.$value["fecha"].'</td>
                    <td>

                      <div class="btn-group">
                          
                      

                        <button class="btn btn-danger btnEliminarPrestamo" id="'.$value["id"].'" idProducto="'.$value["id_producto"].'" Cantidad="'.$value["cantidad"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        <!--   <button class="btn btn-warning btnEditarCategoria" idProducto="'.$value["id_producto"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button> -->

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

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

      <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarPrestamo = new ControladorProductos();
  $borrarPrestamo -> ctrEliminarPrestamo();

?>


