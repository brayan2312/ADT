$(".tablas_dos").on("click", ".btnEditarSalida", function(){
  console.log("le atinaste");
	var idSalida = $(this).attr("idSalida");

	var datos = new FormData();
    datos.append("idSalida", idSalida);

    $.ajax({

      url:"ajax/salida.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("uuh ",respuesta["id"]);

        

      	 $("#idS").val(respuesta["id"]);
	       $("#EditarSalida").val(respuesta["monto"]);
	       $("#EditarRazonSalida").val(respuesta["razon"]);
	       $("#EditarProvedorSalida").val(respuesta["entregado_por"]);
	       
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas_dos").on("click", ".btnEliminarASalida", function(){

	var idSalida = $(this).attr("idSalida");
	
	swal({
        title: '¿Está seguro de borrar la salida?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar salida!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=salida&idSalida="+idSalida;
        }

  })

})

$(".tablas").on("click", ".btnEditarEntrada", function(){
  console.log("le atinaste");
  var idEntrada = $(this).attr("idEntrada");

  var datos = new FormData();
    datos.append("idEntrada", idEntrada);

    $.ajax({

      url:"ajax/entrada.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("uuh ",respuesta["id"]);

        

         $("#idE").val(respuesta["id"]);
         $("#EditarEntrada").val(respuesta["monto"]);
         $("#EditarRazon").val(respuesta["razon"]);
        
    }

    })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarEntrada", function(){

  var idEntrada = $(this).attr("idEntrada");
  
  swal({
        title: '¿Está seguro de borrar la entrada?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar salida!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=salida&idEntrada="+idEntrada;
        }

  })

})