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
    $conex=mysqli_connect("127.0.0.1","root","","indicator","3306");

    if(!mysqli_connect_errno()){
        echo "Conexion exitosa<";
        $valor1 = $dailyIndicators->uf->valor;
        $valor2 = $dailyIndicators->dolar->valor;
        $sql ="INSERT INTO indicadores(UF,Dolar_Observado) VALUES('$valor1','$valor2')";
        $exito=mysqli_query($conex, $sql);

        if($exito){
            echo "Guardado exitoso";
        }else{
            echo "Error";
        }
    } else{
        echo "Error de conexion... Codigo:  " . mysqli_connect_errno() . "<br";
    }

?>