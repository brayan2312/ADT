/*=============================================
=            Section comment block            =
=============================================*/
// if(localStorage.getItem("capturarRango2") != null){

// 	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));

// }else{
// 	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de Fecha');
// }

/*=================================
=          Rango de Fechas Caja      =
=================================*/


$(function() {
  $('#daterange-btn3').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    startDate: moment(),
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
  	 $('#daterange-btn3 span').html(start.format('MMMM D, YYYY'));
    var fechaa = start.format('YYYY-MM-DD');
    console.log(fechaa);
    var capturarRango = $("#daterange-btn3 span").html();
   	console.log(capturarRango);

   	localStorage.setItem("capturarRango",capturarRango);

   	window.location = "index.php?ruta=salida&fechaa="+fechaa;


  });
});

/*=================================
=          Rango de Fechas       =
=================================*/
$('#daterange-btn2').daterangepicker(
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
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');
   
   	var capturarRango = $("#daterange-btn2 span").html();
   	console.log(capturarRango);

   	localStorage.setItem("capturarRango2",capturarRango);

   	window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
)

/*===================================================
=            Cancelar el rango de fechas            =
===================================================*/
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
})

/*=============================================
=            Section comment block            =
=============================================*/
$(".daterangepicker.opensright .ranges li").on("click",function(){

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


		localStorage.setItem("capturarRango2","Hoy");
   		
   		window.location = "index.php?ruta=reportes&fechaInicial="+fechaI+"&fechaFinal="+fechaF;


	}

})

