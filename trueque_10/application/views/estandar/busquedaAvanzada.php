<div id ="miga">
       <?php echo anchor('productos/index','Inicio') ?> > <strong>Buqueda Avanzada</strong>
</div>
       <br/><br/>
       <h1 align ="center">Busqueda Avanzada </h1>
       <br/><br/>
       <div id="formulario">
            <?php 
                echo form_open('productos/busquedaAvanzadaProducto');
                
            ?>
       </div>

<table id="registrar" width="500"  align="center">
    <tr >
		<td width="200" align="right">  Categoria: </td>
		<td> <?php echo form_dropdown('categorias', $categoria);?></td>
   </tr>
 
   <tr>
       <td width="200" align="left"><font align="center">Fecha de publicaci&oacute;n  </font></td>
   </tr>
   <tr>
       <td width="200" align="right">Desde: </td>
       <td><input type="text" id="fechaIngreso" size="15" name= "fechaIngreso" readonly/></td> 
   </tr>   
   <tr>
       <td width="200" align="right">Hasta : </td>
       <td><input type="text" id="hasta" size="15" name="hasta" readonly/></td>
   </tr>
   <tr>
       <td width="200" align="left"><font> Ubicaci&oacute;n </font></td>
   </tr>   
   <tr>
       <td width="200" align="right">Ciudad: </td>
       <td><?php echo form_dropdown('ciudades', $ciudades);    ?></td>
   </tr> 
   
    
</table>

<table align="center" width="250" border="0">
    <tr>
        <td align="right">
         <br/>
         <?php
                    //echo form_open('productos/index');
                    //echo form_button('btnCancelar','Cancelar');
                   
                    echo form_submit('btnBuscar', 'Buscar' ); 
                    echo form_close();
                    echo form_close();
                ?>  
              <a href="productos/index"><button> cancelar</button></a>
         
              
            </td>
    </tr>
</table>
       

        <div style="clear: both;">&nbsp;</div>
