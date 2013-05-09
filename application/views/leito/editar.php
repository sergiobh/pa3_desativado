<div class='titulo_page'>Edição de Leito</div>
<div class="leito_editar">
	<?php if($Leito) { ?>
		<form class='formulario'>
			<input type="hidden" value="<?php echo $Leito->LeitoId;?>" id='LeitoId' />
			<table cellspacing = "10" border = '0'>
				<tr>
					<td class='col_titulo'>Quarto:</td>
					<td>
						<input type="text" id="Quarto" value="<?php echo $Leito->Quarto;?>">
					</td>
				</tr>
				<tr>
					<td>Identificação:</td>
					<td>
						<input type = 'text' maxlength = '10' id='Identificacao' name = 'identificacao' descricao = 'Identificação'  obrigatorio = 'sim' value="<?php echo $Leito->Identificacao;?>" />
					</td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>
						<select id='Status' descricao = 'Status' obrigatorio = 'sim'>
							<?php if($Leito->Status != '3') { ?>
								<?php foreach($Status as $Registro){ ?>
									<option value="<?php echo $Registro->Status;?>" <?php echo ($Leito->Status == $Registro->Status) ? 'selected="selected"' : '';?>><?php echo $Registro->Nome;?></option>
								<?php } ?>
							<?php }else { ?>
								<option value="1" selected="selected">Ocupado</option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class='retorno_ajax'></div>
						<input class='botao_submit' type = 'button' value = 'Enviar' />
						<input class='botao_reset' type = 'reset' value = 'Cancelar' />
					</td>
				</tr>
			</table>
		</form>
	<?php } else{ ?>
		<div class=''>Leito inválido!</div>
	<?php } ?>
</div>