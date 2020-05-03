<label class="control-label"<?php if (! $this->_tpl_vars['isViewForm']): ?> for="<?php echo $this->_tpl_vars['editorId']; ?>
"<?php endif; ?> data-column="<?php echo $this->_tpl_vars['ColumnViewData']['FieldName']; ?>
">
	<?php echo $this->_tpl_vars['Captions']->GetMessageString($this->_tpl_vars['Col']->getCaption()); ?>
:

    <?php if (! $this->_tpl_vars['isViewForm']): ?>
		<?php if (isset ( $this->_tpl_vars['Help'] )): ?><button type="button" class="btn_whatisthis" data-toggle="modal" data-target="#<?php echo $this->_tpl_vars['Help']; ?>
" title="<?php echo $this->_tpl_vars['Captions']->GetMessageString('WhatIsThis'); ?>
"><i class="icon-question"></i></button><?php endif; ?>
        <span class="required-mark"><?php if (! $this->_tpl_vars['ColumnViewData']['Required']): ?>&nbsp;&nbsp;<?php else: ?> *<?php endif; ?></span>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "edit_field_options.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['ColumnViewData'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
</label>

<div class="modal fade" id="<?php echo $this->_tpl_vars['Help']; ?>
" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<span style="font-size:16pt;"><?php echo $this->_tpl_vars['Captions']->GetMessageString('WhatIsThis'); ?>
</span>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p></p>
				<div class="text_whatisthis">

Porque nós o usamos?
É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página quando estiver examinando sua diagramação. A vantagem de usar Lorem Ipsum é que ele tem uma distribuição normal de letras, ao contrário de "Conteúdo aqui, conteúdo aqui", fazendo com que ele tenha uma aparência similar a de um texto legível. Muitos softwares de publicação e editores de páginas na internet agora usam Lorem Ipsum como texto-modelo padrão, e uma rápida busca por 'lorem ipsum' mostra vários websites ainda em sua fase de construção. Várias versões novas surgiram ao longo dos anos, eventualmente por acidente, e às vezes de propósito (injetando humor, e coisas do gênero).

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-cancel" data-dismiss="modal"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Close'); ?>
</button>
			</div>
		</div>
	</div>
</div>