<div id="pestañas" style="width:100%"> <br /><br />
                <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
      				<tbody>
        				<tr>
         				 <td>
           				 <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
             				 <tr>
                                <td width="348" class="texto_adm" ><div align="left">Codigo de la actividad</div></td>
                                <td width="38" class="texto_adm"><div align="left">:</div></td>
                                <td width="277" ><div align="left"><?php echo $codigoActividad;?></div></td>
                                <td width="357" class="texto_adm" ><div align="left">Nombre del Curso</div></td>
                                <td width="11" class="texto_adm"><div align="left">:</div></td>
                                <td width="304" ><div align="left"><?php echo $nomCurso;?></div></td>
							</tr>
                   		 </table>
                     	</td>
                     </tr>
                    </tbody>
                  </table>
                   <fieldset><legend class="texto_adm_negrita">Ejecución</legend>
                  
    

                    <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                             <td>
                             <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                                 <tr>
                                    <td width="348" class="texto_adm" ><div align="left">Fecha de Inicio</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left">
                      <label for="from">From</label>
<input type="text" id="from" name="from"/>

                                    </div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Fecha de Termino</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input type="text" id="to" name="to"/>


<label for="to">to</label> </div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Nº de horas</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $NumeroHoras;?></div></td>
                                 </tr>
                             </table>
                             <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                              <tr>
                                    <td ><div align="center">Lunes</div></td>
                                    <td ><div align="center">Martes</div></td>
                                    <td ><div align="center">Miercoles</div></td>
                                    <td ><div align="center">Jueves</div></td>
                                    <td ><div align="center">Viernes</div></td>
                                    <td ><div align="center">Sabado</div></td>
                                    <td ><div align="center">Domingo</div></td>
                           	   </tr>
                                <tr>
                                    <td ><div align="left"><input name="hora_lunes_inicio" 		id="hora_lunes_inicio" 		value="<?php echo $horaLunesInicio;?>" 		style="width:70px"> - 
                                  						   <input name="hora_lunes_termino" 	id="hora_lunes_termino" 	value="<?php echo $horaLunesTermino;?>" 	style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_Martes_inicio" 	id="hora_Martes_inicio" 	value="<?php echo $horaMartesInicio;?>" 	style="width:70px"> - 
                                    					   <input name="hora_Mates_termino" 	id="hora_Martes_termino" 	value="<?php echo $horaMartesTermino;?>" 	style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_Miercoles_inicio" 	id="hora_Miercoles_inicio" 	value="<?php echo $horaMiercolesInicio;?>" 	style="width:70px"> - 
                                  						   <input name="hora_Miercoles_termino"	id="hora_Miercoles_termino" value="<?php echo $horaMiercolesTermino;?>" style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_Jueves_inicio" 	id="hora_Jueves_inicio" 	value="<?php echo $horaJuevesInicio;?>" 	style="width:70px"> - 
                                    					   <input name="hora_lunes" 			id="hora_lunes" 			value="<?php echo $horaJuevesTermino;?>" 	style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_Viernes_inicio" 	id="hora_Viernes_inicio" 	value="<?php echo $horaViernesInicio;?>" 	style="width:70px"> - 
                                    					   <input name="hora_lunes" 			id="hora_lunes" 			value="<?php echo $horaViernesTermino;?>" 	style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_Sabado_inicio" 	id="hora_Sabado_inicio" 	value="<?php echo $horaSabadoInicio;?>" 	style="width:70px"> - 
                                    					   <input name="hora_lunes" 			id="hora_lunes" 			value="<?php echo $horaSabadoTermino;?>" 	style="width:70px"></div></td>
                                    <td ><div align="left"><input name="hora_domingo_inicio" 	id="hora_domingo_inicio" 	value="<?php echo $horaDomingoInicio;?>" 	style="width:70px"> - 
                                    					   <input name="hora_lunes" 			id="hora_lunes" 			value="<?php echo $horaDomingoTermino;?>" 	style="width:70px"></div></td>
                           	   </tr>
                             </table>
                             <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                             	<tr>
                                    <td width="348" class="texto_adm" ><div align="left">Direccion</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="dir_act" id="dir_act" value="<?php echo $direrccionActividad;?>" style="width:200px"></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Tipo Calle</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="tip_calle_act" id="tip_calle_act" value="<?php echo $tipoCalleActividad;?>" style="width:200px"></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Número</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="N_calle_act" id="N_calle_act" value="<?php echo $nCalleAct;?>" style="width:200px"></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Nº de oficina</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="N_de_ofi_act" id="N_de_ofi_act" value="<?php echo $numeroOficinaAct;?>" style="width:200px"></div></td>
                                 </tr>
                                 <tr>
                                     <td width="348" class="texto_adm" ><div align="left">Villa o Poblacion</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="villa_pobl_act" id="villa_pobl_act" value="<?php echo $villaPoblAct;?>" style="width:200px"></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Comuna</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="Comuna_act" id="Comuna_act" value="<?php echo $comunaAct;?>" style="width:200px"></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Ciudad</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $ciudadct;?></div></td>
                                 </tr>
                             </table>
                             </td>
                            </tr>
                        </tbody>
                     </table>
                   </fieldset>
                   <fieldset><legend class="texto_adm_negrita">Institucion capacitadora</legend>
                   		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                             <td>
                             <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                                 <tr>
                                 	<td width="348" class="texto_adm" ><div align="left">Nombre o Razon Social</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $NomRazonInstitucion;?></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Tipo de institucion</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $tipoInstitucion;?></div></td>
                                 </tr>
                                 <tr>
                                 	<td width="348" class="texto_adm" ><div align="left">Dirección</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $direccionInstitucion;?></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Comuna</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $ComunaTipoInstitucion;?></div></td>
                                 </tr>
                                 <tr>
                                 	<td width="348" class="texto_adm" ><div align="left">Ciudad</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $CiudadInstitucion;?></div></td>
                                 <tr>
                                 	<td width="348" class="texto_adm" ><div align="left">Contacto</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $NomRazonInstitucionContacto;?></div></td>
                                    <td width="348" class="texto_adm" ><div align="left">Telefono</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $telInstitucion;?></div></td>
                                 </tr>
                             </table>
                            </td>
                       	  </tr>
                        </tbody>
                       </table>
                   </fieldset>
                  </div>