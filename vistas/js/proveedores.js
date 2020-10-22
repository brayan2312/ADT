

$(".tablas").on("click",".btnEditarProveedor",function(){

	var idProveedor = $(this).attr("idProveedor");
	var datos = new FormData();
	datos.append("idProveedor",idProveedor);
	
  console.log(idProveedor);
	$.ajax({

      url:"ajax/proveedores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

      

      $("#idPro").val(idProveedor);
  	   $("#EditarProveedor").val(respuesta["nombre"]);
       $("#EditarEmpresa").val(respuesta["empresa"]);
       $("#EditarTelefono").val(respuesta["telefono"]);
       $("#EditarEmail").val(respuesta["email"]);
	  }

  	})
})

/*=========================================
=            Eliminar Provedor            =
=========================================*/
$(".tablas").on("click",".btnEliminarProveedor", function(){



   var idProveedor = $(this).attr("idProveedor");
   console.log(idProveedor);
  swal({
        title: '¿Está seguro de borrar proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar proveedor!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=provedores&idProveedor="+idProveedor;
        }

  })
})


