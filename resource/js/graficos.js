var sinDatosAlu = 0;
var sinDatosPadri = 0;
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
            if (content[0].totalAlumno != 0 || content[0].alumnoLib != 0) {
                alumnosVinculados.push(new Array('Vinculados', content[0].totalAlumno));
                alumnosVinculados.push(new Array('No Vinculados', content[0].alumnoLib));
            } else {
                sinDatosAlu = 1;
            }
             if (content[0].totalPadrino != 0 || content[0].padrinoLib != 0 ) {
                padrinosVinculados.push(new Array('Vinculados', content[0].totalPadrino));
                padrinosVinculados.push(new Array('No Vinculados', content[0].padrinoLib));
            } else {
                sinDatosPadri = 1;
            }
            //   scoreDato.push(new Array('Player: '+content[0].total));
            //     playerDato.push(new Array('Player',content[0].padrinoLib));
            //*********************************************
            //************  Grafico  **********************
            //*********************************************

            Highcharts.setOptions({
                colors: ['#23912f', 'rgb(227, 140, 75)']
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
                },
                function (chart) { // on complete
                    if (sinDatosPadri == 1) {
                        chart.renderer.text('No hay información', 100, 100)
                            .css({
                                color: '#4572A7',
                                fontSize: '16px'
                            })
                            .add();
                    }
                });
            Highcharts.setOptions({
                colors: ['#23912f', 'rgb(227, 140, 75)']
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
                },
                function (chart) { // on complete
                    if (sinDatosAlu == 1) {
                        chart.renderer.text('No hay información', 100, 100)
                            .css({
                                color: '#4572A7',
                                fontSize: '16px'
                            })
                            .add();
                    }
                });

        }
    });

}); //function
