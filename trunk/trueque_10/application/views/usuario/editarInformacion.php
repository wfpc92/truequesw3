
<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > 
    <?php echo anchor('miCuenta', 'Mi Cuenta'); ?>
    >
    <?php echo "<strong>" . $title . "</strong>"; ?>
</div>     
<br/>

<td><h1>Editar Informacion de la Cuenta</h1></td>
<br/>
<div style="padding-left: 5%;">
    <table>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <tr><td><h4 id="editar">Tu Avatar: </h4></td></tr>
        <tr><td>
                <?php
                $image_properties = array(
                    'src' => $usuario->avatar,
                    'alt' => $usuario->nombre,
                    'class' => 'resize',
                    'width' => '150',
                    'height' => '150'
                );
                echo img($image_properties);
                ?>
                <?php echo form_open_multipart('miCuenta/guardarInformacion'); 
                echo form_hidden('usuario[avatar]',$usuario->avatar);?>
            </td></tr>
        <tr><td>
                <input type="file" name="userfile" size="20" />
            </td></tr>
        <tr><td>
                <table>
                    <tr>
                        <td>* Nombre: </td>
                        <td> <?php
                $data_form = array(
                    'name' => 'usuario[nombre]',
                    'id' => 'nombre',
                    'size' => '40',
                    'value' => $usuario->nombre,
                );
                echo form_input($data_form);
                ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br/><label for="apellido">* Apellido: </label></td>
                        <td><?php
                            $data_form = array(
                                'name' => 'usuario[apellido]',
                                'id' => 'apellido',
                                'size' => '40',
                                'value' => $usuario->apellido,
                            );
                            echo form_input($data_form);
                ?>
                        </td>
                    </tr>
                    <tr>
                        <td> <?php echo form_label("Ciudad"); ?></td>
                        <td> <?php echo form_dropdown('ciudad', $ciudades, $usuario->id_ciudad); ?></td>
                    </tr>
                </table>
            </td></tr>
        <tr><td>
                <input type="submit" value="Guardar Informacion" />
            </td></tr>
    </table>
</div>
<?php echo form_close() ?>
  
