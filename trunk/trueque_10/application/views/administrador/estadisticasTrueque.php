<script type="text/javascript" language="javascript" >
        var chart1;
        $(document).ready(function(){
            chart1=new Highcharts.Chart({
                    chart: {
                        renderTo:'content',
                    type: 'bar',
                    width:600
                },
                title: {
                    text: 'Estadisticas de Trueques'
                },
                xAxis: {
                    categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'
                    , 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre','Diciembre']
                },
                yAxis: {
                    title: {
                        text: 'Numero de Trueques'
                    }
                },
                series: <?php echo $reporte;?>
            });          
        });
    </script>