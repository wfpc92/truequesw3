      <div id="titulo" >
           </br></br></br>
           <h2 >Busqueda Avanzada </h2>
           </br></br></br>
       </div>
       
       <div id="formulario">
            <?php 
                echo form_open('productos/busquedaAvanzadaProducto');
                echo form_label("Categoria " );
                echo form_dropdown('categorias', $categoria);  
            ?>
       </div>
       <br/>
       <div >
            </br></br>
            <font align="center">fecha de publicacion  </font>
            <br/><br/>
       </div>
       <div >
                <td>desde: </td>
                <td><input type="text" id="fechaIngreso" size="20" name= "fechaIngreso" readonly/></td> 
                </br></br>
          
       </div>
        <div >
                <td>hasta : </td>
                <td><input type="text" id="hasta" size="20" name="hasta" readonly/></td>
       </div>
       <br/><br/>
       <font> ubicacion </font>
       <br/><br/>
         <div>
           <?php
                echo form_label("Ciudad");
                echo form_dropdown('ciudades', $ciudades);     
           ?>
       </div>
       <div>
           <br/>
           <div align="center">
               
               <?php
                    echo form_open('productos/index');
                    echo form_button('btnCancelar','Cancelar');
                    echo form_submit('btnBuscar', 'Buscar' ); 
                    echo form_close();
                    echo form_close();
                ?>
           </div>
       </div>
        
        <p><a href="#" class="more"><</a><a href="#" class="more">></a></p>


        <div style="clear: both;">&nbsp;</div>
