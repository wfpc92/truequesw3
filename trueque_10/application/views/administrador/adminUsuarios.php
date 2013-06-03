<table cellpadding="5" cellspacing="0" border="1">
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
                    <td> <?php
        echo anchor('administrar/updateUsuario/' . $usuario->usuario_id, 'editar', 'class="link-opc"');
        echo " ";
        echo anchor('administrar/deleteUsuario/' . $usuario->usuario_id, 'eliminar');
                ?>
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