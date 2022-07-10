/*
Encierro todo en una función asíncrona para poder usar async y await cómodamente
https://parzibyte.me/blog
*/
(async () => {
    // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
    const respuestaRaw = await fetch("./obtener_datos_ajax.php");
    // Decodificar como JSON
    const respuesta = await respuestaRaw.json();
    
    const $grafica = document.querySelector("#grafica");
    const etiquetas = respuesta.etiquetas; 
    
    const datosVentas2020 = {
        

        data: respuesta.datos, 
        backgroundColor: 'rgba(54, 162, 235, 0.2)', 
        borderColor: 'rgba(54, 162, 235, 1)', 
        borderWidth: 1, 
    };
    new Chart($grafica, {
        type: 'line', 
        data: {
            labels: etiquetas,
            datasets: [
                datosVentas2020,
              
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
})();
