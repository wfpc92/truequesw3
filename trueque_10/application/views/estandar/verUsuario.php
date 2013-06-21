<br/>
    
<div style="padding-left: 5%;">
<div id="item" >
    <table>
        <tr>
            <td valign="top">
                 <?php
                if (count($usuario) > 0):?>
                
                <h1><?php echo $usuario->nombre." ".$usuario->apellido; ?></h1><br/>
                    <?php
                    $image_properties = array(
                        'src' => $usuario->avatar,
                        'alt' => $usuario->nombre,
                        'class' => 'resize',
                    );
                    echo img($image_properties);
                    ?>               
            </td>
            <td style="padding-left: 10px;">
                <p>
                <b>Correo Electr&oacute;nico: </b><?php echo $usuario->email; ?><br/><br/>
                <b>Ciudad: </b><?php echo $usuario->ciudad; ?><br/><br/>                
            </p>     
            </td>
        </tr>
    </table>
    <?php else: ?>
        <p>No Existe usuario</p>
    <?php endif; ?>
</div>
</div>