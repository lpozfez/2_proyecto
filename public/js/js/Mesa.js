function Mesa(ancho, alto, x=null, y=null){
    this.ancho=ancho;
    this.alto=alto;
    this.x=x;
    this.y=y;
    this.posicion=[this.x,(this.x+this.ancho),this.y,(this.y+this.alto)];
    
    //[x,(x+ancho),y,(y+alto)];
}


Mesa.prototype.solapado=function(mesa2){
    debugger
    var choque=false;
    
    this.posicion=[this.x,(this.x+this.ancho),this.y,(this.y+this.alto)];
    mesa2.posicion=[mesa2.x,(mesa2.x+mesa2.ancho),mesa2.y,(mesa2.y+mesa2.alto)];

    console.log(this.posicion);
    console.log(mesa2.posicion);

    if((this.posicion[0]>mesa2.posicion[0] && this.posicion[0]<mesa2.posicion[1] || 
        this.posicion[1]>mesa2.posicion[0] && this.posicion[1]<mesa2.posicion[1] || 
        this.posicion[0]<=mesa2.posicion[0] && this.posicion[1]>=mesa2.posicion[1]) 
        &&
        (this.posicion[2]>mesa2.posicion[2] && this.posicion[2]<mesa2.posicion[3] || 
        this.posicion[3]>mesa2.posicion[2] && this.posicion[3]<mesa2.posicion[3] || 
        this.posicion[2]<=mesa2.posicion[2] && this.posicion[3]>=mesa2.posicion[3])
        )
        {
            choque=true;
            return choque;
           
        };
        
    return choque;
}



/*
MesaObjeto.prototype.pinta=function(){

    var divMesa = $("<div>");
    console.log(this.width);
    console.log(this.height);
    divMesa.width(this.width);
    divMesa.height(this.height);
    divMesa.css('backgroundColor','brown');
    divMesa.attr('class','mesa');
    $(".almacen").append(divMesa); 
    divMesa.draggable({
     revert: true,
       helper: 'clone',
       revertDuration:0,
       start:function(ev,ui){
         $(this).attr("data-y",ui.offset.top)
         $(this).attr("data-x",ui.offset.left)
    }})
 }*/


/**
 * Mesa.prototype.creaMesa=function(ancho,alto){
    var nuevaMesa=new Mesa(ancho,alto,null,null);
    //console.log(mesa);
    var contenedorMesas=$("#contenedorMesas");
    var mesa=$("<div>");
    mesa.width(nuevaMesa.ancho);
    mesa.height(nuevaMesa.alto);
    mesa.addClass("mesa").draggable({
        stop:function(ev,ui){
            $(this)[0].x=ui.posicionition.top;
            $(this)[0].y=ui.posicionition.left;
        }
    }).appendTo(contenedorMesas);
}
 */