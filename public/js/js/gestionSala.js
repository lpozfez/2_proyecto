$(function(){
    //Calendario
    $( "#datepicker" ).datepicker();
    
    var dialog=$( "#dialog" ).dialog({
        autoOpen:false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            Cancel: function(event, ui) {
              dialog.dialog( "close" );
            }
        }
    });
    
    $("#pintar").click(function(){
        var contenedor=$('#contenedorMesas');
        var sala=$('#sala');
        var ancho=$('#ancho').val();
        var alto=$('#alto').val();
        var mesa=new Mesa(ancho,alto);
        creaMesa(mesa, contenedor, sala);
    });

    //Acciones para el botón NuevaMesa
    $( "#nuevaMesa" ).click(function(){
        dialog.dialog('open');
    });
    

} );