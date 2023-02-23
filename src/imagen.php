<?php

function trataImagen($imagen,$juego, $destino){
    
    //Buscamos el nombre del archivo
    $nombreOriginal = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);

    //Capturamos la extensión
    $extension = $imagen->guessExtension();

    //Creamos el nuevo nombre de la imagen con el nombre original junto a la extensión
    $nuevoNombreImg=$nombreOriginal.'.'.$extension;

    //Añadimos el nuevo nombre de la imagen al juego creado con los datos del formulario
    $juego->setImagen($nuevoNombreImg);

    //Movemos la imagen al directorio deseado
    if($imagen->move($destino, $nuevoNombreImg)){
        return true;
    }else{
        return false;
    }
}





?>