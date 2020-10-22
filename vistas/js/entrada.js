
 function myFunction(){
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