$(function(){
    var selectHoras=$('horarios');
    var selectJuegos=$('juegos');
    //Calendario
    $( "#datepicker" ).datepicker();

    //Rellenamos el select de horario
    $.ajax({
        url:"https://localhost:8000/api/juego",
        datatype: "json"
    }).done(function(data){
        debugger
        console.log(data);
        $.each(data,function(i,v){
            $("<option>").val(v[i].id).text(v[i].nombre).appendTo(selectJuegos);
        })
    })

    


    //Creamos el dialog
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
    //Función para crear la mesa con el dialog
    function pintar(){
        var contenedor=$('#contenedorMesas');
        var sala=$('#sala');
        var ancho=$('#ancho').val();
        var alto=$('#alto').val();
        var mesa=new Mesa(ancho,alto);
        creaMesa(mesa, contenedor, sala);
        dialog.dialog( "close" );
    }

    //Acciones para el botón NuevaMesa que abre el dialog
    $( "#nuevaMesa" ).click(function(){
        dialog.dialog('open');
    });
    

} );