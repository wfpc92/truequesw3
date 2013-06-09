
<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>" . $title . "</strong>"; ?>
</div>
</br></br>       
<h1>Editar Informacion de la Cuenta</h1></br>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <h4 id="editar">Tu Avatar: </h4>
        <div id ="editar">
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
        <?php echo form_open_multipart('miCuenta/guardarInformacion'); ?>
        </div>
        <div id ="editar">
            <input type="file" name="userfile" size="20" />
        </div>
        <table id="editar">
            <tr>
                <td><br/>* Nombre: </td>
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
        </table>
        <div id ="btnEditar">
            <input type="submit" value="Guardar Informacion" />
        </div>
<?php echo form_close() ?>
  
