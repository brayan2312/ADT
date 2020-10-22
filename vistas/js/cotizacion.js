/*=============================================
CARGAR LA TABLA DINÁMICA DE COTIZACIONES
=============================================*/
$('.tablaCotizacion').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
    "deferRender": true,
  "retrieve": true,
  "processing": true,
   "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

  }

} );
$(".tablaCotizacion tbody").on("click", "button.agregarProducto", function(){

  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

  var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            /*=============================================
            EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
            =============================================*/

          //   if(stock == 0){

          //   swal({
          //   title: "No hay stock disponible",
          //   type: "error",
          //   confirmButtonText: "¡Cerrar!"
          // });

          // $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

          // return;

          //   }

            $(".nuevoProducto").append(

            '<div class="row quitarr" style="padding:5px 15px">'+

        '<!-- Descripción del producto -->'+
            
            '<div class="col-xs-6" style="padding-right:0px">'+
            
              '<div class="input-group">'+
                
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

              '</div>'+

            '</div>'+

            '<!-- Cantidad del producto -->'+

            '<div class="col-xs-3">'+
              
               '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

            '</div>' +

            '<!-- Precio del producto -->'+

            '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

              '<div class="input-group">'+

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                   
                '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
   
              '</div>'+
               
            '</div>'+

          '</div>') 

          // SUMAR TOTAL DE PRECIOS

          sumarTotalPrecios()

          // AGREGAR IMPUESTO

          // agregarImpuesto()

          // AGRUPAR PRODUCTOS EN FORMATO JSON

          listarProductos()

          // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

          $(".nuevoPrecioProducto").number(true, 2);

        }

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaCotizacion").on("draw.dt", function(){

  if(localStorage.getItem("quitarProducto") != null){

    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for(var i = 0; i < listaIdProductos.length; i++){

      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

    }


  }


})

// ---------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------
/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarCotizacion", function(){

	var idCotizacion = $(this).attr("idCotizacion");
	
	window.location = "index.php?ruta=editar-cotizacion&idCotizacion="+idCotizacion;

})

/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarCotizacion", function(){

  var cotizacion = $(this).attr("idCotizacion");

  swal({
        title: '¿Está seguro de borrar la cotizacion?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cotizacion!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cotizaciones&idCotizacion="+cotizacion;
        }
  })

})

/*=======================================
=            Imprimir Recibo            =
=======================================*/

$(".tablas").on("click",".btnImprimirC",function(){

	var codigo = $(this).attr("codigoC");
	window.open("extensiones/tcpdf/pdf/cotizacion.php?codigo="+codigo,"_blank");
	console.log(codigo);
})
