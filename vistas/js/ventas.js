/*=============================================
EDITAR VENTAS
=============================================*/
$(".tablas").on("click", ".btnEditarTotal", function(){
document.getElementById("checkss").checked = false;


	var idVenta = $(this).attr("idVenta");
	var datos = new FormData();
	datos.append("idVenta", idVenta);

	$.ajax({

		url:"ajax/total.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#EditarCodigo").val(respuesta["codigo"]);
			$("#EditarTotal").val(respuesta["total"]);
			$("#EditarTotal").number(true, 2);
			$("#total").val(respuesta["total"]);
			$("#idVenta").val(respuesta["id"]);




			var recibi = respuesta["recibi"];
			var resta = respuesta["resta"];
			var efectivo = respuesta["efectivo"];
			console.log(recibi);
			console.log(resta);

			if(recibi == "0.00" && resta == "0.00"){
     			

				$(".contado").children(".cajas2").html('');
				$(".contado").children(".cajas1").html(

				'<div class="form-group">'+			     
        
					'<div class="col-xs-6">'+

                          '<label >Recibi:</label>'+

                          '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                            '<input type="text" class="form-control Editarefectivo" id="EditarValorEfectivo" placeholder="000000" required>'+
                            '<input type="hidden" name="Editarefectivoo" id="Editarefectivoo">'+
                            
                          '</div>'+

                      '</div>'+

                      '<div class="col-xs-6" id="capturarCambioEfectivo" style="padding-left:0px">'+

                          '<label >Cambio:</label>'+

                          '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                            '<input type="text" class="form-control Editarcambio" id="EditarCambioEfectivo" readonly min="0" placeholder="000000" required readonly="">'+
                            '<input type="hidden" name="Editarcambio" id="Editarcambio" value="" required="">'+
                          '</div>'+

                      '</div>'+

       			'</div>');

				$("#EditarValorEfectivo").val(respuesta["efectivo"]);
				$("#Editarefectivoo").val(respuesta["efectivo"]);		
				$("#EditarCambioEfectivo").val(respuesta["cambio"]);
				$("#Editarcambio").val(respuesta["cambio"]);


			}else{

// ---------------------Paso 1--------------------------
				document.getElementById("checkss").checked = true;
				
				$(".contado").children(".cajas1").html('');
				$(".contado").children(".cajas2").html(
				'<br>'+
				'<div class="form-group">'+

					'<div class="col-xs-6">'+
						'<label >Abono:</label>'+
            			'<div class="form-group">'+

					      '<div class="input-group">'+

					        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					        '<input type="text" class="form-control" id="EditarAbono" placeholder="000000" required>'+

					        '<input type="hidden" name="EditarAbono2" id="EditarAbono2">'+

					      '</div>'+
					    '</div>'+  			
				    '</div>'+  

				'</div'+	

				'<div class="form-group">'+

					'<div class="col-xs-6">'+
					    
					    '<input type="hidden" name="AdelantoFijo" id="AdelantoFijo">'+
					    '<input type="hidden" name="RestaFijo" id="RestaFijo">'+


				      '<label >Recibi:</label>'+
            			'<div class="form-group">'+

					     			

					      '<div class="input-group">'+

					        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					        '<input type="text" class="form-control" id="EditarCAdelanto" readonly placeholder="000000" required>'+
					        '<input type="hidden" name="EditarAdelanto" id="EditarAdelanto">'+
					        
					      '</div>'+
					    '</div>'+   	
				     '</div>'+

				     '<div class="col-xs-6" id="capturarResta" style="padding-left:0px">'+

				      '<label >Resta:</label>'+
            			'<div class="form-group">'+

					      '<div class="input-group">'+

					        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					        '<input type="text" class="form-control" id="EditarResta" readonly min="0" placeholder="000000" required>'+
				     '</div>'+

					        '<input type="hidden" name="Editaresta" id="Editaresta" value="" required="">'+
					      '</div>'+
				      '</div>'+


				    '</div>');
						$("#EditarCAdelanto").val(respuesta["recibi"]);
						$("#EditarAdelanto").val(respuesta["recibi"]);		
						$("#EditarResta").val(respuesta["resta"]);
						$("#EditarResta").number(true, 2);
						$("#Editaresta").val(respuesta["resta"]);

						$("#AdelantoFijo").val(respuesta["recibi"]);		
						$("#RestaFijo").val(respuesta["resta"]);

// ------------------------------------------------------------
			    }

			


		}

	});

})

$(".formularioVenta").on("change", "input#NuevoAdelanto", function(){

 var Recibi = Number($("#NuevoAdelanto").val());
 var Total = Number($("#nuevoTotalVenta").val());
 $("#Adelanto").val(Recibi);

 if(Recibi < Total){

 	var resta = Number(Total) - Number(Recibi);
 	$("#Resta").val(resta);
 	$("#NuevoResta").val(resta);

 	console.log(resta);

 }else{

 	console.log("ÑO");
 }

})


/*=============================================
CAMBIO EN EFECTIVO efectivo
=============================================*/
$(".formularioVenta").on("change", "input#NuevoAdelanto", function(){

	

	var Recibi = Number($("#NuevoAdelanto").val());
 	var Total = Number($("#nuevoTotalVenta").val());



	if(Recibi < Total){

 		var resta = Number(Total) - Number(Recibi);
		

		var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#NuevoResta').children().children('#nuevoCambioEfectivo');

		nuevoCambioEfectivo.val(resta);
		// $("#cambio").val(cambio);
		var b = document.querySelector("#desactivar"); 
		b.removeAttribute("disabled","");

	}else{

		// $("#nuevoCambioEfectivo").removeItem("value");
		// $("#nuevoValorEfectivo").removeItem("value");
		
		var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#NuevoResta').children().children('#nuevoCambioEfectivo');

		nuevoCambioEfectivo.val("");
		// $("#cambio").val("");
		// $("#efectivo").val("");
		var b = document.querySelector("#desactivar"); 
		b.setAttribute("disabled", 0);
	}

 })


$(".checkPago").on("ifChecked",function(){
	// $("#pendiente").val("1");

	$(this).parent().parent().parent().children(".tipos").children(".cajasDeuda").html(

 		'<div class="col-xs-6">'+

	      '<label >Recibi:</label>'+

	      '<div class="input-group">'+

	        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

	        '<input type="text" class="form-control" id="NuevoAdelanto" placeholder="000000" required>'+
	        '<input type="hidden" name=Adelanto id=Adelanto>'+
	        
	      '</div>'+

	     '</div>'+

	     '<div class="col-xs-6" id="capturarResta" style="padding-left:0px">'+

	      '<label >Resta:</label>'+

	      '<div class="input-group">'+

	        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

	        '<input type="text" class="form-control" id="NuevoResta" readonly min="0" placeholder="000000" required>'+

	        '<input type="hidden" name="Resta" id="Resta" value="" required="">'+
	      '</div>'+

		 '</div>');
	// cajasCambio

	$(this).parent().parent().parent().children(".tipos").children(".cajasCambio").html(

 		'<div class="form-group">'+
        

        '</div>');

	$("#NuevoAdelanto").number(true, 2);
    $("#NuevoResta").number(true, 2);

})

// *************************************************************************
$(".checkPago").on("ifUnchecked",function(){
	// $("#pendiente").val("1");

	$(this).parent().parent().parent().children(".tipos").children(".cajasCambio").html(

 	'<div class="col-xs-6">'+

		  '<label >Recibi:</label>'+

		  '<div class="input-group">'+

		    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

		    '<input type="text" class="form-control efectivo" id="nuevoValorEfectivo" placeholder="000000" required>'+
		    '<input type="hidden" name="efectivoo" id="efectivoo">'+
		    
		  '</div>'+

		 '</div>'+

		 '<div class="col-xs-6" id="capturarCambioEfectivo" style="padding-left:0px">'+

		  '<label >Cambio:</label>'+

		  '<div class="input-group">'+

		    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

		    '<input type="text" class="form-control cambio" id="nuevoCambioEfectivo" readonly min="0" placeholder="000000" required readonly="">'+
		    '<input type="hidden" name="cambio" id="cambio" value="" required="">'+
		  '</div>'+

	 '</div>');
	// cajasCambio

	$(this).parent().parent().parent().children(".tipos").children(".cajasDeuda").html(

 		'<div class="form-group">'+
        

        '</div>');
	$("#nuevoCambioEfectivo").number(true, 2);
	$("#nuevoValorEfectivo").number(true, 2);

})

// ------------------------------------------------------------------------

$(".checkEntrega").on("ifUnchecked",function(){
	$(".Pendi").val("0");
	$(this).parent().parent().parent().children(".Direccion").html(

 		'<div class="form-group Campo_Text">'+
              
             '<input type="hidden" name="DireccionEntrega" value="">'+
   		

        '</div>');
})

$(".checkEntrega").on("ifChecked",function(){
	$(".Pendi").val("1");

	$(this).parent().parent().parent().children(".Direccion").html(

 		'<div class="form-group Campo_Text">'+
              
        '<div class="input-group">'+
              
        '<span class="input-group-addon"><i class="fa fa-th"></i></span>'+ 
        '<textarea class="form-control" name="DireccionEntrega" placeholder="Ingresa Dirección" rows="3" required="" cols="83"></textarea>'+

        '</div>'+

        '</div>');

})
/*=============================================
=            Section comment block            =
=============================================*/
// if(localStorage.getItem("capturarRango") != null){

// 	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

// }else{
// 	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de Fecha');
// }


/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$('.tablaVentas').DataTable( {
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

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

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
          	var precio_compra = respuesta["precio_compra"];
          	var id_pro = respuesta["id_proveedor"];


          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      	// 		swal({
			    //   title: "No hay stock disponible",
			    //   type: "error",
			    //   confirmButtonText: "¡Cerrar!"
			    // });
			  // --------------------------------------------------
			 //  swal({
				//   title: 'Ingresa cantidad',
				//   input: 'text',
				//   inputAttributes: {
				//     autocapitalize: 'off'
				//   },
				//   showCancelButton: true,
				//   confirmButtonText: 'Aceptar',
    //               cancelButtonText: 'Cancelar',
				//   showLoaderOnConfirm: true,
				//   preConfirm: (login) => {
				//     return fetch(`//api.github.com/users/${login}`)
				//       .then(response => {
				//         if (!response.ok) {
				//           throw new Error(response.statusText)
				//         }
				//         return response.json()
				//       })
				//       .catch(error => {
				//         Swal.showValidationMessage(
				//           `Request failed: ${error}`
				//         )
				//       })
				//   },
				//   allowOutsideClick: () => !Swal.isLoading()
				// }).then((result) => {
				//   if (result.value) {
				//   	console.log(result.value.login);
				//   	console.log(idProducto);


				//   	$.post("ajax/actualizar.stock.php",{
				//   		numero: result.value.login,
				//   		id: idProducto 
				//   	});

    //                 window.location = "crear-venta";
				   
				//   }
				// })
			  // -------------------------------------------------

				var txt;
	            var person = prompt("Ingrese Cantidad");
	            if (person == null || person == "") {
	              txt = "User cancelled the prompt.";
	            } else {

	                  $.post("ajax/actualizar.stock.php",{
	                    numero: person,
				  		id: idProducto 
	                  });

	                  window.location = "crear-venta";
	              
	            }
	            document.getElementById("demo").innerHTML = txt;

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

			    // ------------------------------------------------------------------------------





			    // ------------------------------------------------------------------------------

			    

          	}
          	reset();
          	$(".nuevoProducto").append(

          	'<div class="row quitarr" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-5" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
	              '<input type="hidden" class="form-control idprovedorO"  name="pro" value="'+id_pro+'" readonly required>'+

	            '</div>'+

	          '</div>'+


	          '<!-- Descuento del producto -->'+

	          '<div class="col-xs-2 ingresoDescuento">'+
	            
	             '<input type="number" class="form-control nuevaDescuentoProducto" name="nuevaDescuentoProducto" id="nuevaDescuentoProducto2" value="0">'+
	             '<input type="hidden" class="form-control nuevoDes" name="nuevoDes" id="nuevoDes" totalDesc="0" value="0">'+


	          '</div>' +




	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-2 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" precioCompra="'+precio_compra+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios();
	        sumarTotalDescuento();

	        // AGREGAR IMPUESTO

	        // agregarImpuesto()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
	        

	        $(".nuevoPrecioProducto").number(true, 2);
			localStorage.removeItem("quitarProducto");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})
/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		// $("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		// $("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()
    	sumarTotalDescuento()

    	// AGREGAR IMPUESTO
	        
        // agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>');


	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.stock != 0){

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)

		         }

	         }

	         // SUMAR TOTAL DE PRECIOS

    		sumarTotalPrecios()
    		sumarTotalDescuento()

    		// AGREGAR IMPUESTO
	        
	        // agregarImpuesto()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	     $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})
function reset(){
	$(".efectivo").val("");
	$("#efectivoo").val("");

	$(".cambio").val("");
	$("#cambio").val("");

	
	$("#NuevoAdelanto").val("");
	$("#NuevoResta").val("");

	$("#Adelanto").val("");

	$("#Resta").val("");



	var b = document.querySelector("#desactivar"); 
			b.setAttribute("disabled", 0);

}
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/
$(".formularioVenta").on("change", "input.nuevaDescuentoProducto", function(){
reset();
var desc = $(this).val();
if(desc == ""){
$(this).val("0");
}

// nuevaCantidadProducto nuevoPrecioProducto
var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
var SubTotal = precio.attr("precioreal");

var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
var Cantidad = cantidad.val();
// console.log("Cantidad es: ",Cantidad);-------------------------------

var des = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDes");

// var Cantidad = $(".nuevaCantidadProducto").val();
// var SubTotal = $(".nuevoPrecioProducto").attr("precioreal");
var Descuento = $(this).val();
var NuevoTotal = Cantidad * SubTotal;
var TotalDescuento = Cantidad * Descuento;

des.val(TotalDescuento);
$(this).attr("totalDesc",TotalDescuento);
// console.log("Total descuento",TotalDescuento);--------------------------

if(TotalDescuento >= NuevoTotal){

var Descuento = $(this).val("0");
$(this).attr("totalDesc",0);

des.val(0);
var NuevoTotal2 = Cantidad * SubTotal;

// var SubTotal = $(".nuevoPrecioProducto").val(NuevoTotal);
precio.val(NuevoTotal2);


}else{
Total = NuevoTotal - TotalDescuento;
var SubTotal = precio.val(Total);


}
// var NuevoTotal = SubTotal - DescuentoReal;

// console.log(NuevoTotal);

// $(".nuevoPrecioProducto").val(NuevoTotal);
sumarTotalPrecios()
sumarTotalDescuento()

	// AGREGAR IMPUESTO
	        
    // agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()


})




$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){
reset();
	

	var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevaDescuentoProducto");
	var Descuento = descuento.val();

	var descuento2 = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDes");
	var Descuento2 = descuento2.val();

	// console.log("jejje es: ", Descuento);

	var Cantidad = $(this).val();
	var SubTotal = Cantidad * Descuento;
	// descuento.attr("totalDesc",SubTotal);
	descuento2.val(SubTotal);
	// console.log("Descuento es: ", SubTotal);
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal - SubTotal);
	
	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/


		console.log("es: ",Descuento);
		$(this).val(1);
		descuento2.val(Descuento);



		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

	    descuento.attr("totalDesc",Descuento);
		sumarTotalPrecios();
		sumarTotalDescuento();

		// swal({
	 //      title: "La cantidad supera el Stock",
	 //      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	 //      type: "error",
	 //      confirmButtonText: "¡Cerrar!"
	 //    });
	 // ------------------------------------------------------------



	 // ------------------------------------------------------------

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()
	sumarTotalDescuento()


	// AGREGAR IMPUESTO
	        
    // agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	 $("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

	if(sumaTotalPrecio > 0){

		 // $("#nuevoValorEfectivo").attr("readonly", false);
		 // $("#NuevoAdelanto").attr("readonly", false);


	}

}

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalDescuento(){
	// console.log("chi");
	var precioItem = $(".nuevoDes");
	// var precioItem = $("#nuevaDescuentoProducto2").attr("totaldesc");
	

// // console.log("otroo: ",typeof(precioItem));
// console.log("otroo: ",typeof(precioItem));
// console.log("otroo: ",precioItem);


	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$(".totalDes").val(sumaTotalPrecio);
	//  $("#totalVenta").val(sumaTotalPrecio);
	// $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

	
}


/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);
$("#nuevoCambioEfectivo").number(true, 2);
$("#nuevoValorEfectivo").number(true, 2);





$(".formularioVenta").on("click", "button.quitarProducto", function(){
	var nuevo = $("#nuevoTotalVenta").attr("total");
	reset();
		if(nuevo == 0){
		 // $(".efectivo").attr("readonly", "readonly");
		   $(".efectivo").val("");
		   $("#nuevoCambioEfectivo").val("");
		   $valor = "no";
		   listarProductos($valor);
		   $("#NuevoAdelanto").val("");
		   $("#NuevoResta").val("");
		   
		   
		   var b = document.querySelector("#desactivar"); 
			b.setAttribute("disabled", 0);
		  
		}


	})

/*=============================================
CAMBIO EN EFECTIVO efectivo
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = Number($(this).val());
	var total = Number($("#nuevoTotalVenta").val());

	

	$("#efectivoo").val(efectivo);
	var nuevo = $("#efectivoo").val();

	if(total > 0){

		if(nuevo >= total){
			console.log(nuevo);
			var cambio =  efectivo - total;

			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

			nuevoCambioEfectivo.val(cambio);
			$("#cambio").val(cambio);
			var b = document.querySelector("#desactivar"); 
			b.removeAttribute("disabled","");

		}else{

			// $("#nuevoCambioEfectivo").removeItem("value");
			// $("#nuevoValorEfectivo").removeItem("value");
			
			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

			nuevoCambioEfectivo.val("");
			$("#cambio").val("");
			$("#efectivo").val("");
			var b = document.querySelector("#desactivar"); 
			b.setAttribute("disabled", 0);
		}
	}	

 })


/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos($valor){

	if($valor == "no"){

		var listaProductos = [];
		$("#listaProductos").val(JSON.stringify(listaProductos)); 


	}else{


		var listaProductos = [];

		var descripcion = $(".nuevaDescripcionProducto");

		var idprovedor = $(".idprovedorO");

		var cantidad = $(".nuevaCantidadProducto");

		var precio = $(".nuevoPrecioProducto");

		var descuento = $(".nuevaDescuentoProducto");


		for(var i = 0; i < descripcion.length; i++){

			listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
								  "id_p" : $(idprovedor[i]).val(), 
								  "descripcion" : $(descripcion[i]).val(),
								  "cantidad" : $(cantidad[i]).val(),
								  "descuento" : $(descuento[i]).val(),
								  "stock" : $(cantidad[i]).attr("nuevoStock"),
								  "compra" : $(precio[i]).attr("precioCompra"),
								  "precio" : $(precio[i]).attr("precioReal"),
								  "total" : $(precio[i]).val()})
// 								  "descuento" : $(precio[i]).attr("precioCompra"),

		}

		$("#listaProductos").val(JSON.stringify(listaProductos)); 
	}

}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

// function quitarAgregarProducto(){

// 	//Capturamos todos los id de productos que fueron elegidos en la venta
// 	var idProductos = $(".quitarProducto");

	
// 	//Capturamos todos los botones de agregar que aparecen en la tabla
// 	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

// 	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
// 	for(var i = 0; i < idProductos.length; i++){

		
// 		//Capturamos los Id de los productos agregados a la venta
// 		var boton = $(idProductos[i]).attr("idProducto");
		
// 		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
// 		for(var j = 0; j < botonesTabla.length; j ++){

// 			if($(botonesTabla[j]).attr("idProducto") == boton){

// 				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
// 				$(botonesTabla[j]).addClass("btn-default");

// 			}
// 		}

// 	}
	
// }
function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");
	console.log("chiii ",idProductos);
	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}



/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on('draw.dt', function(){
	// quitarAgregarProducto();
   var idProductos = $(".quitarProducto");
	console.log(idProductos);

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}

})

/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }
  })

})

// /*=======================================
// =            Imprimir Recibo            =
// =======================================*/

// $(".tablas").on("click",".btnImprimir",function(){

// 	var codigo = $(this).attr("codigoVenta");
// 	window.open("controladores/ticket.php?codigo="+codigo,"_blank");
// 	console.log(codigo);
// })

// $(".tablas").on("click",".btnImprimir",function(){
	
// 	var codigo = $(this).attr("codigoVenta");
// 	window.open("controladores/ticket.php?codigo="+codigo,"_blank");
// 	console.log(codigo);
// })

$(".tablas").on("click",".btnImprimir2",function(){

	var codigo = $(this).attr("codigoVenta");
	window.open("extensiones/tcpdf/pdf/recibo.php?codigo="+codigo,"_blank");
	console.log(codigo);
})

/*=================================
=          Rango de Fechas       =
=================================*/
$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Seleccione': [moment(), moment()],
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)


/*===================================================
=            Cancelar el rango de fechas            =
===================================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
=            Section comment block            =
=============================================*/
$(".daterangepicker.opensleft .ranges li").on("click",function(){

	var textHoy = $(this).attr("data-range-key");

	if(textHoy ==  "Hoy"){

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();


		if( mes < 10 && dia < 10){
			var	fechaI = año+"-0"+mes+"-0"+dia;
			var	fechaF = año+"-0"+mes+"-0"+dia;
			

		}else if(dia < 10){

			var	fechaI = año+"-"+mes+"-0"+dia;
			var	fechaF = año+"-"+mes+"-0"+dia;

		}else if( mes < 10){

			

			var fechaI = año+"-0"+mes+"-"+dia;
			var fechaF = año+"-0"+mes+"-"+dia;

		}else{

			var fechaI = año+"-"+mes+"-"+dia;
	    	var fechaF = año+"-"+mes+"-"+dia;
		}


		localStorage.setItem("capturarRango","Hoy");
   		
   		window.location = "index.php?ruta=ventas&fechaInicial="+fechaI+"&fechaFinal="+fechaF;


	}

})
// -----------------------------------------------------
/*========================================
=            Checkbox-Pedidos            =
========================================*/
$(".checkboxxx").on("ifUnchecked",function(){
	$("#pendiente").val("0");
})

$(".checkboxxx").on("ifChecked",function(){
	$("#pendiente").val("1");
})

// ----------------------------------------
if($(".checkbox_2").prop("checked")){


		$("#pendienteEditar").val("1");

}

$(".checkbox_2").on("ifUnchecked",function(){
	$("#pendienteEditar").val("0");
})

$(".checkbox_2").on("ifChecked",function(){
	$("#pendienteEditar").val("1");
})
// -------------------------------------------
$(".checkbox_3").on("ifUnchecked",function(){
	$("#pendienteEditar").val("0");
})

$(".checkbox_3").on("ifChecked",function(){
	$("#pendienteEditar").val("1");
})


/*=====  End of Checkbox-Pedidos  ======*/

$(".tablas").on("click", ".btnEntrega", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿El pedido se ha engregado exitosamente?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, pedido entregado!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=inicio&idVenta="+idVenta;
        }

  })

})

// $(document).ready(function(){
// 	setInterval(
// 		function(){

// 			$("#actualizar_tabla").load("crear-venta.php");
// 		},2000

// 		);
// });

 // $(document).ready(function(){
 //      refreshTable();
 //    });

 //    function refreshTable(){
 //        $('#actualizar_tabla').load('', function(){
 //           setTimeout(refreshTable, 5000);
 //        });
 //    }

 /*=============================================
imprimir
=============================================*/
$(".tablas").on("click", ".btnImprimir", function(){

  var codigo = $(this).attr("codigoVenta1");

          
            window.location = "index.php?ruta=ventas&codig="+codigo;


})