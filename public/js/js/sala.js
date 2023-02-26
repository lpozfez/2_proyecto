$(function(){
    var contenedor=$("#contenedorMesas");
    var sala=$("#sala");

    //Añadirmos a la sala el método DROP
    $("#sala").droppable({
        drop: function(event, ui){
            $(this).addClass("dentro");
            //alert("left: "+$(".mesa").offset().left+" top: "+ $(".mesa").offset().top);
            var mesaUi=ui.draggable;
            var mesaUiHelper=ui.helper;
            //console.log(mesaUiHelper);
            //Ajustamos la posición de la mesa dentro de la sala
            var xx=parseInt(mesaUiHelper.offset().left)-parseInt(sala.offset().left);
            var yy=parseInt(mesaUiHelper.offset().top)-parseInt(sala.offset().top);
            //Despues de comprobar que no se solape
            
            //Guardamos los datos en el objeto DOM
            mesaUi[0].objeto.x=xx;
            mesaUi[0].objeto.y=yy;
            
            const todasMesas=$("#sala .mesa");//Capturamos todas las mesas dentro de sala
            
            if(todasMesas.length>0){
                $.each(todasMesas,function(key,value){
                    if(mesaUi[0].objeto!=value.objeto){
                        if(mesaUi[0].objeto.solapado(value.objeto)==true){
                            alert('no');
                        }else{
                            //Añadimos la mesa a la sala con la posición actualizada
                            mesaUi.appendTo($("#sala")).css({position:"absolute",  
                            left: xx+'px', 
                            top: yy+'px'});
                        }
                    }
                })
            }else{
                //Añadimos la mesa a la sala con la posición actualizada
                mesaUi.appendTo($("#sala")).css({position:"absolute",  
                left: xx+'px', 
                top: yy+'px'});

            }
            
    }});


})