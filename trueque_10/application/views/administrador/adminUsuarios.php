<table cellpadding="5" cellspacing="0" border="1" style="width: 100%;">
    <caption><h2>Usuarios</h2></caption>
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Nivel</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($usuarios) > 0): //se verifica hayan libros cargados
            //recorremos el arreglo enviado por data['books'] y mostramos los resultados
            foreach ($usuarios->result() as $usuario):
                ?>
                <tr>
                    <td><?php echo $usuario->usuario_id; ?></td>
                    <td><?php echo $usuario->nombre; ?></td>
                    <td><?php echo $usuario->apellido; ?></td>
                    <td><?php echo $usuario->email; ?></td>
                    <td> <?php echo $usuario->nivel; ?></td>
                    <td> 
                        <table><tr><td><?php
                      echo form_open('administrar/updateUsuario')?>
                <?php echo form_hidden('usuario_id', $usuario->usuario_id, 'size ="20" id =""'); ?>
                    <input type="submit" value=" Editar " />
            <?php echo form_close();?>
                                </td><td>
            <?php echo form_open('administrar/deleteUsuario')?>
                <?php echo form_hidden('usuario_id', $usuario->usuario_id, 'size ="20" id =""'); ?>
                    <input type="submit" value="Eliminar" />
            <?php echo form_close();
                ?></td></tr>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" align="center"> No hay libros</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<br/>
<div colspan="6" align="center"><p><?php echo $paginacion; ?></p></div>