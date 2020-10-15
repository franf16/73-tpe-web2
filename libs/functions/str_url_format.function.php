<?php 

/** Función para formatear un string para usarlo en la url */
function str_url_format(string &$nombre) {
    $nombre_format = str_replace(' ', '-', $nombre);
    $nombre_format = iconv('UTF-8', 'ASCII//TRANSLIT', $nombre_format); // translit : descompone caracteres invalidos (á = a')
    $nombre_format = strtolower($nombre_format); 
    $nombre_format = preg_replace("/[^a-z0-9-]/", '', $nombre_format); // elimina caracteres invalidos
    return $nombre_format;   
}