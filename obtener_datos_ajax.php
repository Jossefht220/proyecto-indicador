<?php

$apiUrl = 'https://mindicador.cl/api';

if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}

$dailyIndicators = json_decode($json);
$etiquetas = ["El valor actual de la UF es $", "El valor actual del Dólar observado es $", 'El valor actual del Dólar acuerdo es $', 'El valor actual del Euro es $', 'El valor actual del IPC es ', 'El valor actual de la UTM es $', 'El valor actual del IVP es $', 'El valor actual del Imacec es '];
$datosVentas = [$dailyIndicators->uf->valor,$dailyIndicators->dolar->valor,$dailyIndicators->dolar_intercambio->valor,$dailyIndicators->euro->valor, $dailyIndicators->ipc->valor, $dailyIndicators->utm->valor,  $dailyIndicators->ivp->valor,  $dailyIndicators->imacec->valor];

$respuesta = [
    "etiquetas" => $etiquetas,
    "datos" => $datosVentas,
];
echo json_encode($respuesta);
