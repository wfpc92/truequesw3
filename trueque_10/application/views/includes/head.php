<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="Trueque Intercambios Sin Dinero" />
<meta name="description" content="En esta pagina se podra intercambiar entre usuarios de la pagina diferentes productos"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />
<title>Trueque</title>
<?php echo link_tag('css/style.css') ?>
<title>$title</title>
</head>
<?php echo link_tag('css/stylesheet.css') ?>
    <script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>js/busquedaAvanzada.js"></script>
    <script src="<?php echo base_url(); ?>js/registrarUsuario.js"></script>

  <script language="javascript">
    $(document).ready(function(){ 
        $( "#fechaIngreso" ).datepicker({
              showOn: 'both',
              buttonImage: 'http://localhost/trueque_10/images/calendar.png',
              buttonImageOnly: true,
              changeYear: true,
              dateFormat: 'yy-mm-dd',
              //numberOfMonths: 2,
              onSelect: function(textoFecha, objDatepicker){
                 $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
              }
           });    
    })    
  </script>
    
  
  <script>
      jQuery(function($){
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    });
  </script>    
 <script language="javascript">
    $(document).ready(function(){ 
        $( "#hasta" ).datepicker({
              showOn: 'both',
              buttonImage: 'http://localhost/trueque_10/images/calendar.png',                  
              buttonImageOnly: true,
              changeYear: true,
              dateFormat: 'yy-mm-dd',
              //numberOfMonths: 2,
              onSelect: function(textoFecha, objDatepicker){
                 $("#mensaje").html("<p>Has seleccionado: " + textoFecha + "</p>");
              }
           });    
    })    
  </script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
<body>
<div id="header" style="padding-top: 10px;">
	<div id="logo" >
            <img src="<?php echo base_url(); ?>images/logo.jpg" width=50% height=80% border=0 alt="Logo"></img>
	</div>	
	<div id="sesion" style="margin-top: 50px; margin-right: 50px;">
						<?php 
						$this->load->view('includes/'.$sesion);
						?>
	</div>
	<div id="search" style="padding-top: 130px;">
            <!-- </*?php /*$valor="computador";?*/> -->
            <?php echo form_open('productos/buscarProducto') ?>
            <?php echo form_input('buscar',''); ?>  
            <?php echo form_submit('btnBuscar', 'Buscar'); ?> 
            <?php echo anchor('productos/busquedaAvanzada', 'Busqueda avanzada') ?> 
            <?php echo form_close(); ?>                             
     </div>
</div>
<div id="wrapper">
            <div id="menu">
                <?php $this->load->view('includes/'.$menu);?>
            </div>
            <!-- end #menu -->
        </div>
<div id="page">
	
	<div id="content" style="width: 80%;">