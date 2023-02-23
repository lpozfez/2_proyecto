$(function(){
    var contenedor=$("#contenedorMesas");
    var sala=$("#sala");

    //Botón de crear mesa
    $("button").click(function(){
        var mesa=new Mesa(60,40);
        creaMesa(mesa, contenedor, sala);
    })

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
                        debugger
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
            

            /*
            debugger
            if(todasMesas.length>0){
                $.each(todasMesas,function(key,elemento){
                    if(mesaUi.solapado(elemento)==true){
                        alert('no');
                    }
                })
            }else{
                //Añadimos la mesa a la sala con la posición actualizada
                mesaUi.appendTo($("#sala")).css({position:"absolute",  
                                                left: xx+'px', 
                                                top: yy+'px'}).appendTo(sala);
                //Guardamos los datos en el objeto DOM
                mesaUi[0].objeto.x=xx;
                mesaUi[0].objeto.y=yy;
            }*/
        }
    });

    //Método que crea una mesa con unas medidas dadas, le añade la clase mesa y la añade al contenedor de mesas
    function creaMesa(mesa, contenedor, sala){
        debugger
        var mesaDiv=$("<div>"); //Div que será la mesa

        //Añadimos al div la clase y el método DRAG
        mesaDiv.width(mesa.ancho).height(mesa.alto).addClass("mesa").draggable({
            helper:"clone",
            revert:true,
            revertDuration:0,
            /*
            create:function(ev,ui){
                //Asignamos las medidas de la mesa al Div
                $(this).width(mesa.ancho);
                $(this).height(mesa.alto);
            },*/
            
        })
        mesaDiv[0].objeto=mesa;
        if(mesa.x!=null && mesa.y!=null){
            mesaDiv.css({position:"absolute",  
                         left: mesa.x+'px', 
                         top:mesa.y+'px'}).appendTo(sala);

            //mesaDiv.offset().left;
            //mesaDiv.offset().top;
        }else{
            mesaDiv.appendTo(contenedor);
        }
        
    }

})

//TODO: HACER QUE NO SE PUEDA SACAR LA MESA DE LA SALA

/**
 * $(".sala").droppable({
      drop : function(event,ui){
        var mesa= ui.draggable;

        var x= parseInt(ui.offset.left)
          var y= parseInt(ui.offset.top)
           var width= parseInt(mesa.width())
           var height= parseInt(mesa.height())
        var pos1= [x,x+width,y,y+height]

        var mesaObjeto = new MesaObjeto(x,y,width,height,pos1);
        
        let valido=true;
        var mesaYa=$(".sala .mesa");
        $.each(mesaYa,function(key,value){

            posX=parseInt(value.offsetLeft);
            posY=parseInt(value.offsetTop);
            var anchura=(value.offsetWidth);
            var altura=(value.offsetTop);
           
            var pos2=[posX,posX+anchura,posY,posY+altura];
            
            var mesaNueva= new MesaObjeto(posX,posY,anchura,altura,pos2);
            console.log(mesaObjeto)
            console.log(mesaNueva)
            if(mesaObjeto.choque(mesaNueva)==true){
              valido=false;
                
            }
            
          
        })
 */


/**
 * $("document").ready(function () {
    $(".mesa").draggable({
      start: function (ev, ui) {
        //lo guardo en obj mesa
        $(this).attr("data-y", ui.offset.top);
        $(this).attr("data-x", ui.offset.left);
      },
      revert:true,
      revertDuration:0,
      helper:'clone',
      accept: '#almacen, #sala',
    });
    $('#almacen').droppable({
        drop:function (ev, ui) {
            let mesa = ui.draggable;
            mesa.attr('style','');
            $(this).append(mesa);
        }
    })
    $("#sala").droppable({
      drop: function (ev, ui) {
        var mesa = ui.draggable;
        var left = parseInt(ui.offset.left);
        var top = parseInt(ui.offset.top);
        let width = mesa.width();
        let height = mesa.height();

        let pos1=[left,left+width,top,top+height];
        
        let mesaYa = $('#sala .mesa').eq(0);
        if (mesaYa.length>0) {
            let posX = parseInt(mesaYa.offset().left);
            let posY = parseInt(mesaYa.offset().top);
            let anchura = mesaYa.width();
            let longitud = mesaYa.height();
            let pos2=[posX,posX+anchura,posY,posY+longitud];
            
            if ( (pos1[0] > pos2[0] && pos1[0] < pos2[1] ||
                  pos1[1] > pos2[0] && pos1[1] < pos2[1] ||
                  pos1[0] <= pos2[0] && pos1[1] >= pos2[1])
                  
                  &&
                
                  (pos1[2] > pos2[2] && pos1[2] < pos2[3] ||
                  pos1[3] > pos2[2] && pos1[3] < pos2[3] ||
                  pos1[2] <= pos2[2] && pos1[3] >= pos2[3]))
            {
                console.log('choca')
            }else {
                $(this).append(mesa);
                mesa.css({ position: 'absolute', top: top + "px", left: left + "px" });
            }
        }else{
            $(this).append(mesa);
            mesa.css({ position: 'absolute', top: top + "px", left: left + "px" });
        }
        //mesa.attr("style", "");
      },
    });
})
 */