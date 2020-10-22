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
      
      Proveedores
      
      <small>de productos</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Proveedores</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
        <!-- section title -->
      <div class="box-header with-border">
        <!-- <h3 class="box-title">Title</h3> -->

        
      <div class="box-header with-border">
  
  <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregarProveedor">
    
    Agregar Provedor

  </button>

</div>
      </div>
       <!-- section body -->
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
           <th>Nombre</th>
           <th>Empresa</th>
           <th>Teléfono</th>
           <th>Email</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $provedor = ProvedoresControlador::ctrMostrarProvedores($item, $valor);

          foreach ($provedor as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["empresa"].'</td>

                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["email"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#ModalEditarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
          
            }

        ?>
   
        </tbody>

       </table>

      
      

     
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
    
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 

<!-- Modales -->

<?php
// include agregar provedor
include "vistas/modulos/modales/modalprovedor/ModalAgregarProveedor.php";

include "vistas/modulos/modales/modalprovedor/ModalEditarProveedor.php";


$EliminarProvedor = new ProvedoresControlador();
$EliminarProvedor -> ctrEliminarProvedor();
?>
