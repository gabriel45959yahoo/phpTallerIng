$(document).ready(function () {
    $.ajax({
        url: "../view/consultarDatos.php",
        method: "POST",
        data: "&tipo=PadrinoAlumnoLibreOcupado", // Adjuntar los campos del formulario enviado.
        success: function (data1) {

            var playerDato = [];
            var score = [];
            var padrinosVinculados = [];
            var alumnosVinculados = [];
            var aux = [];
            var content = JSON.parse(data1);
            var n = content.length;

            padrinosVinculados.push(new Array('Vinculados', content[0].totalPadrino));
            padrinosVinculados.push(new Array('No Vinculados', content[0].padrinoLib));
            alumnosVinculados.push(new Array('Vinculados', content[0].totalAlumno));
            alumnosVinculados.push(new Array('No Vinculados', content[0].alumnoLib));
            //   scoreDato.push(new Array('Player: '+content[0].total));
            //     playerDato.push(new Array('Player',content[0].padrinoLib));
            //*********************************************
            //************  Grafico  **********************
            //*********************************************

            Highcharts.setOptions({
                colors: ['rgb(227, 140, 75)', '#0F4392']
            });


            $('#PadrinoGrafico').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }
                },

                title: {
                    text: 'Padrinos vinculados VS. no vinculados'
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
                        innerSize: 40,
                        depth: 25,
                        dataLabels: {
                            enabled: true,
                            //format:'{"score.point"}'

                        },
                        size: 150
                    },
                    /*para cambiar el tamaño del grafico*/
                     /*pie: {
            size: 50
        }*/
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Cantidad',
                    className: 'String',
                    data: padrinosVinculados

                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 400
                        }
                            }]
                }
            });
            Highcharts.setOptions({
                colors: ['#64E572', '#0F4392']
            });
            $('#AlumnoGrafico').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }
                },
                title: {
                    text: 'Alumnos vinculados VS. no vinculados'
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
                        innerSize: 40,
                        depth: 25,
                        dataLabels: {
                            enabled: true,
                            //format:'{"score.point"}'

                        },
                        size: 150
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Cantidad',
                    className: 'String',
                    data: alumnosVinculados

                }],
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
