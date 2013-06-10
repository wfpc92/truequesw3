<?php if (isset($mensajeAprobacion)):?>
    <?php
    $image_properties = array(
        'id' => 'imagenProducto',
        'src' => base_url().'images/ok.jpg',
        'alt' => 'Error',
        'class' => 'resize',
        'height'=> '5%',
        'width'=>'10%',
        'align'=>'left'
    );
    echo img($image_properties);
    ?>
    <br/>
     <?php echo "<h2 align=\"right\" style=\"color: green;\";>".$mensajeAprobacion."</h2>"?>
<?php else: redirect(base_url());
 endif;
?>