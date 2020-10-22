/*=============================================
EDITAR EN EFECTIVO 
=============================================*/


$(".EditarTotal2").on("change", "input#EditarValorEfectivo", function(){
	
	var efectivo = Number($(this).val());
	var total = Number($("#EditarTotal").val());

	

	$("#Editarefectivoo").val(efectivo);
	$("#EditarValorEfectivo").number(true, 2);

	var nuevo = $("#Editarefectivoo").val();

	if(total > 0){

		if(nuevo >= total){
			
			var cambio =  efectivo - total;
			console.log("cambio es: ",cambio);
			// var nuevoCambioEfectivo = $(this).parent().parent().parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

			// nuevoCambioEfectivo.val(cambio);
			$("#EditarCambioEfectivo").val(cambio);
			$("#EditarCambioEfectivo").number(true, 2);

			$("#Editarcambio").val(cambio);
			var b = document.querySelector("#desactivar"); 
			b.removeAttribute("disabled","");

		}else{

			// $("#nuevoCambioEfectivo").removeItem("value");
			// $("#nuevoValorEfectivo").removeItem("value");
			
			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

			nuevoCambioEfectivo.val("");
			$("#Editarcambio").val("");
			$("#Editarefectivoo").val("");
			var b = document.querySelector("#desactivar"); 
			b.setAttribute("disabled", 0);
		}
	}	

 })
// Cuento Abonara
// -------------------Paso 3------------------------
$(".EditarTotal2").on("change", "input#EditarAbono", function(){

$("#EditarAbono").number(true, 2);
var abono = Number($("#EditarAbono").val());
var abonado = Number($("#AdelantoFijo").val());
var subTotal = Number($("#RestaFijo").val());
 var Total = Number($("#EditarTotal").val());



console.log(subTotal);
if(abono <= subTotal){
	var nuevoAbono = abono + abonado;
	$("#EditarCAdelanto").val(nuevoAbono);
	$("#EditarAdelanto").val(nuevoAbono);
	$("#EditarCAdelanto").number(true, 2);

	var resta = Number(Total) - Number(nuevoAbono);
	$("#EditarResta").val(resta);
	$("#EditarResta").number(true, 2);
	$("#Editaresta").val(resta);


	var b = document.querySelector("#desactivar"); 
	b.removeAttribute("disabled","");

}else{
 	var b = document.querySelector("#desactivar"); 

	b.setAttribute("disabled", 0);
	console.log("ño");
}

})

// ------------------------------------------------------------

$(".EditarTotal2").on("change", "input#EditarCAdelanto", function(){

 var Recibi = Number($("#EditarCAdelanto").val());
 var Total = Number($("#EditarTotal").val());
 $("#EditarAdelanto").val(Recibi);
$("#EditarCAdelanto").number(true, 2);

	 if(Recibi <= Total){

	 	var resta = Number(Total) - Number(Recibi);
	 	$("#EditarResta").val(resta);
		$("#EditarResta").number(true, 2);
	 	$("#Editaresta").val(resta);
	 	var b = document.querySelector("#desactivar"); 
		b.removeAttribute("disabled","");
	 		

	 }else{
        $("#EditarCAdelanto").val("");
        $("#EditarAdelanto").val("");
	 	$("#EditarResta").val("");
 	    $("#Editaresta").val("");
 	    var b = document.querySelector("#desactivar"); 
		b.setAttribute("disabled", 0);

	 }

})

$('#checkss').click(function(){

    if($(this).is(':checked')){
		$(".contado").children(".cajas1").html('');
    	$(".contado").children(".cajas2").html(

				'<div class="form-group">'+

					'<div class="col-xs-6">'+

				      '<label >Recibi:</label>'+

				      '<div class="input-group">'+

				        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

				        '<input type="text" class="form-control" id="EditarCAdelanto" placeholder="000000" required>'+
				        '<input type="hidden" name=EditarAdelanto id=EditarAdelanto>'+
				        
				      '</div>'+

				     '</div>'+

				     '<div class="col-xs-6" id="capturarResta" style="padding-left:0px">'+

				      '<label >Resta:</label>'+

				      '<div class="input-group">'+

				        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

				        '<input type="text" class="form-control" id="EditarResta" readonly min="0" placeholder="000000" required>'+

				        '<input type="hidden" name="Editaresta" id="Editaresta" value="" required="">'+
				      '</div>'+
				      '</div>'+


				    '</div>');



    } else {
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
        
    }
});


// <label>
                        
//                 <input type="checkbox" class="minimal checkEditarPago">

//                  <!-- <input type="checkbox" class="minimal checkboxxx" checked> -->
               

//                 <input type="hidden" id="Editarpendiente" name="Editarpendiente" value="0">
//                 Tipo Pago:
                  
//             </label>