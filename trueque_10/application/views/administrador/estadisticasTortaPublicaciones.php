<script type="text/javascript" language="javascript" >
        var chart1;
        $(document).ready(function(){
            chart1=new Highcharts.Chart({
                    chart: {
                        renderTo:'content',
                    type: 'pie',
                    width:600
                },
                title: {
                    text: 'Estadisticas de Publicaciones'
                },
                xAxis: {
                    categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'
                    , 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre','Diciembre']
                },
                 tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    },
                    showInLegend: true
                }
            },
                yAxis: {
                    title: {
                        text: 'Numero de Publicaciones'
                    }
                },
                series: <?php echo $reporte;?>
            });          
        });
    </script>