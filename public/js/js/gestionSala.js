$(function(){
    //Calendario
    $( "#datepicker" ).datepicker();
    
    var dialog=$( "#dialog" ).dialog({
        autoOpen:false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
            'Crear': pintar,
            Cancel: function(event, ui) {
                form[ 0 ].reset();
                dialog.dialog( "close" );
            }

        }
    });
    
    function pintar(){
        var contenedor=$('#contenedorMesas');
        var sala=$('#sala');
        var ancho=$('#ancho').val();
        var alto=$('#alto').val();
        var mesa=new Mesa(ancho,alto);
        creaMesa(mesa, contenedor, sala);
        dialog.dialog( "close" );
    }

    //Acciones para el botón NuevaMesa
    $( "#nuevaMesa" ).click(function(){
        dialog.dialog('open');
    });
    

} );