 

 function init() {
    $("#formulario-contacto").on("submit",function(e){
       enviarcorreo(e);
     });     
   
    }
   
   function enviarcorreo(e) {
   
   // body...
     e.preventDefault(); // No se activará la acción predeterminada del evento
     $("#btnSend").prop("disable",true);
     var formData = new FormData($("#formulario-contacto")[0]);
   
     $.ajax({
       url:"enviar.php",
       type: "POST",
       data: formData,
       contentType:false,
       processData: false,
       success:function(data,status){
        //data = JSON.parse(data);
        $("#btnSend").prop("disable",false);
         bootbox.alert('Correo enviado.');  
         $("#name").val("");
         $("#email").val("");
         $("#subject").val("");         
         $("#message").val("");
       }
     });
   
   }
 
   
    init();