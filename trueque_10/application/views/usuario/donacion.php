<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > 
    <?php echo anchor('miCuenta', 'Mi Cuenta'); ?>
    >
    <?php echo "<strong> Realizar Donacion</strong>"; ?>
</div> 
<br/>
<div style="padding-left: 5%;">
<form id="datos_tc" name="datos_tc" action="/trueque_10/miCuenta/donacionExitosa" method="POST" onsubmit="return procesando();"> 


    <br/>
    Esta transacción se está realizando a través de un medio seguro.
    <br/>
    <br/><br/>
    <br/>

    <table width="95%" border="0" cellpadding="2" cellspacing="2">
        <tbody><tr> 


                <td width="35%" align="right" bgcolor="#EAEAEA">Apellidos del titular: <span >(*)</span></td>
                <td width="65%" bgcolor="#EAEAEA" > <input name="nombre" type="text"  id="nombre" value="" size="30">
                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#F4F4F4">Número de la Tarjeta <span >(*)</span></td>
                <td bgcolor="#F4F4F4" > <input autocomplete="off" name="numero" type="text"  id="numero" value="" size="30">
                </td>
            </tr>

            <tr>            
                <td align="right" bgcolor="#EAEAEA">Código de Seguridad <span >(*)</span></td>
                <td  bgcolor="#EAEAEA">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody><tr> 
                                <td width="22%" ><input name="codigoSeguridad" autocomplete="off" type="text"  id="codigoSeguridad" value="" size="5" maxlength="3"></td>
                                <td width="10%"> 
                                    
                                </td>
                                <td width="68%" ></td>
                            </tr>
                            <tr> 
                                <td colspan="3" >El código de 3 o 4 dígitos situado junto a tu número de cuenta, en la parte posterior de la tarjeta</td>
                            </tr>
                        </tbody></table></td>
            </tr>

            <tr>
                <td align="right" bgcolor="#F4F4F4">Fecha de Expiración<span > 
                        (*)</span></td>
                <td  bgcolor="#F4F4F4"> 
                    <table width="75%" border="0" cellspacing="2" cellpadding="2">
                        <tbody><tr>
                                <td>Mes: </td>
                                <td width="70%" ><select name="fechaExpiracionMes" >
                                        <option>01</option> 													
                                        <option>02</option> 													
                                        <option>03</option> 													
                                        <option>04</option> 													
                                        <option>05</option> 													
                                        <option>06</option> 													
                                        <option>07</option> 													
                                        <option>08</option> 													
                                        <option>09</option> 													
                                        <option>10</option> 													
                                        <option>11</option> 													
                                        <option>12</option> 													
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Año:</td>
                                <td><select name="fechaExpiracionAnio" >
                                        <option>2013</option>
                                        <option selected="selected">2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                        <option>2028</option>
                                        <option>2029</option>
                                        <option>2030</option>
                                        <option>2031</option>
                                        <option>2032</option>
                                        <option>2033</option>
                                        <option>2034</option>
                                        <option>2035</option>
                                        <option>2036</option>
                                        <option>2037</option>
                                    </select></td>
                            </tr>
                        </tbody></table>

                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#EAEAEA">Cuotas <span >(*)</span></td>
                <td  bgcolor="#EAEAEA"> <select name="numero_cuotas" >
                        <option>12</option>	  				
                        <option>1</option>	
                        <option>2</option>	
                        <option>3</option>	
                        <option>4</option>	
                        <option>5</option>	
                        <option>6</option>	
                        <option>7</option>	
                        <option>8</option>	
                        <option>9</option>	
                        <option>10</option>	
                        <option>11</option>	
                        <option>12</option>	
                        <option>13</option>	
                        <option>14</option>	
                        <option>15</option>	
                        <option>16</option>	
                        <option>17</option>	
                        <option>18</option>	
                        <option>19</option>	
                        <option>20</option>	
                        <option>21</option>	
                        <option>22</option>	
                        <option>23</option>	
                        <option>24</option>	
                        <option>25</option>	
                        <option>26</option>	
                        <option>27</option>	
                        <option>28</option>	
                        <option>29</option>	
                        <option>30</option>	
                        <option>31</option>	
                        <option>32</option>	
                        <option>33</option>	
                        <option>34</option>	
                        <option>35</option>	
                        <option>36</option>	
                    </select>
                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#F4F4F4">Cantidad
                    <span >(*)</span></td>
                <td  bgcolor="#F4F4F4"> <div >
                        <input type="radio" name="collaboration_quantity_radio" checked="checked" id="input_10" value="10">
                        <label for="input_10">$5.000</label>
                        <input type="radio" name="collaboration_quantity_radio"  value="30">
                        <label for="input_30">$10.000</label>
                        <input type="radio" name="collaboration_quantity_radio" id="input_60" value="60">
                        <label for="input_60">$20.000</label>
                        <input type="radio" name="collaboration_quantity_radio" id="input_Otro" value="other_amount">
                        <label for="input_Otro">Otro: </label>
                        <input type="text" name="collaboration_quantity_radio" id="input_Otro" value="">
                    </div>
                    
                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#F4F4F4">Dirección Correspondencia 
                    <span >(*)</span></td>
                <td  bgcolor="#F4F4F4">
                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#EAEAEA">Teléfono  <span class="campo-requerido">(*)</span></td>
                <td class="Rojo10Pt" bgcolor="#EAEAEA"> <input name="telefonoOficina" type="text" class="Boxes" id="telefonoOficina" value="" size="30">
                </td>
            </tr>
            <tr> 
                <td align="right" bgcolor="#EAEAEA">Ciudad <span >(*)</span></td>
                <td  bgcolor="#EAEAEA"><input name="ciudadCobro" type="text"  id="ciudadCobro" value="" size="30">
                </td>
            </tr>
            
            <tr> 
                <td colspan="2" bgcolor="#F4F4F4"> 
                    <p><span >(*)</span> Campos requeridos.</p>
                </td>
            </tr>
        </tbody></table>
    <br>
    <div >
        <table width="95%" border="0" cellpadding="2" cellspacing="2" bordercolor="#000000">
            <tbody><tr> 
                    <td width="83%" align="center" ><table width="150" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
                            <tbody><tr> 
                                    <td height="17" align="center">
                                        <input name="enviar" type="submit" value="Donar"  >
                                    </td>
                                </tr>
                            </tbody></table></td>
                </tr>

            </tbody></table>
    </div>

    <div  > 
    </div>

    
</form>
</div>