$(document).ready(function () {
    $.ajax({
        url: "../view/consultarDatos.php",
        method: "POST",
        data: "&tipo=PadrinoAlumnoLibreOcupado", // Adjuntar los campos del formulario enviado.
        success: function (data1) {

            var playerDato = [];
            var score = [];
            var scoreDato = [];
            var aux = [];
            var content = JSON.parse(data1);
            var n = content.length;
            for (var i = 0; i < n; i++) {
                
                //player.push(content[i].fecha.split(" ")[1]);
                //player.push(new Array('p'+i,content[i].player));
                scoreDato.push(new Array('Player: '+content[i].));
                playerDato.push(new Array('Player',content[i].player));
                
            }
    //*********************************************
    //************  Grafico  **********************
    //*********************************************

Highcharts.setOptions({
    colors: ['rgba(227, 140, 75, 0.85)', '##71397C', '#ED561B', '#DDDF00', '#596C68', '#64E572', '#FF9655', '#FFF263', '#6AF9C4', '#CF4647', 'rgba(140, 195, 52, 0.5)']
});
            
            
            $('#container').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        borderColor: '#333',
                        borderWidth: 2
                    }
                },
                title: {
                    text: 'Comparaciones'
                },
                /*subtitle: {
                    text: '3D donut'
                },*/

                tooltip: {
                    enabled: true,
                    pointFormat: '{series.name}: {point.y}</br>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        innerSize: 80,
                        depth: 85,
                        dataLabels: {
                            enabled: true,
                            //format:'{"score.point"}'
                            
                        },
                        size:150
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Score',
                    className: 'String',
                    data: scoreDato

                }/*,{
                    name: 'Player',
                    className: 'String',
                    data: playerDato

                }*/],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 400
                                    }
                            }]
                }
            });


        }
    });

}); //function