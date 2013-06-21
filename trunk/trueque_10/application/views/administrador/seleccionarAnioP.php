<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <?php echo anchor('administrar/index', 'Administrar'); ?>
    ><strong>Estadistica Trueques</strong>
</div>
<br/>
<div style="padding-left: 5%;">
<div id="anio">
    <h3>Ingrese el Año del que desea ver el reporte de Publicaciones:</h3><br></br>
        <?php echo form_open('administrar/estadisticasPublicaciones');
        echo form_error('anio');
        echo form_input('anio',  set_value('anio'));
        $opciones = array(0 => 'Barras',1 => 'Torta',);
        echo form_dropdown('tipo_grafica',$opciones,0);?>
        <input id = "anio" type="submit" value="Seleccionar" />
       <?php
       echo form_close();
        ?>
</div>
</div>