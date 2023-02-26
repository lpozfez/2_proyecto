function Mesa(ancho, alto, x=null, y=null){
    this.ancho=ancho;
    this.alto=alto;
    this.x=x;
    this.y=y;
    this.posicion=[this.x,(parseInt(this.x)+parseInt(this.ancho)),this.y,(parseInt(this.y)+parseInt(this.alto))];
    
    //[x,(x+ancho),y,(y+alto)];
}


Mesa.prototype.solapado=function(mesa2){
    debugger
    var choque=false;
    
    this.posicion=[this.x,(parseInt(this.x)+parseInt(this.ancho)),this.y,(parseInt(this.y)+parseInt(this.alto))];
    mesa2.posicion=[mesa2.x,(parseInt(mesa2.x)+parseInt(mesa2.ancho)),mesa2.y,(parseInt(mesa2.y)+parseInt(mesa2.alto))];

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

function creaMesa(mesa, contenedor, sala){
    debugger
    var mesaDiv=$('<div>');
    mesaDiv.width(mesa.ancho).height(mesa.alto).addClass("mesa");
    console.log(mesaDiv);
    mesaDiv.draggable({
        helper:"clone",
        revert:true,
        revertDuration:0,
    });
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

