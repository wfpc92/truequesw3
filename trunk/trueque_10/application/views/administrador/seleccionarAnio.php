<div id="anio">
    <h3>Ingrese el Año del que desea ver el reporte de Trueques:</h3><br></br>
        <?php echo form_open('administrar/estadisticasTrueque');
        echo form_error('anio');
        echo form_input('anio',  set_value('anio'));?>
        <input id = "anio" type="submit" value="Seleccionar" />
       <?php
       echo form_close();
        ?>
</div>