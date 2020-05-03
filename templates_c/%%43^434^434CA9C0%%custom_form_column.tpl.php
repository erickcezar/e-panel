<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'custom_templates/custom_form_column.tpl', 15, false),)), $this); ?>
<div class="row">
<?php $_from = $this->_tpl_vars['Grid']['FormLayout']->getGroups(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Group']):
?>
    <?php if (count ( $this->_tpl_vars['Group']->getRows() ) > 0): ?>
    <<?php if ($this->_tpl_vars['isViewForm']): ?>div<?php else: ?>fieldset<?php endif; ?> class="col-md-<?php echo $this->_tpl_vars['Group']->getWidth(); ?>
">
        <?php if ($this->_tpl_vars['Group']->getName()): ?><legend><?php echo $this->_tpl_vars['Group']->getName(); ?>
</legend><?php endif; ?>
        <?php $_from = $this->_tpl_vars['Group']->getRows(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Row']):
?>
            <div class="row">
				<?php if (isset ( $this->_tpl_vars['Column'] )): ?>
					<?php $_from = $this->_tpl_vars['Row']->getCols(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Col']):
?>
						<?php if ($this->_tpl_vars['Col']->getName() == $this->_tpl_vars['Column']->getName()): ?>
							<?php $this->assign('ColumnViewData', $this->_tpl_vars['Col']->getViewData()); ?>
							<?php $this->assign('Editor', $this->_tpl_vars['ColumnViewData']['EditorViewData']['Editor']); ?>

							<?php if ($this->_tpl_vars['Editor']): ?>
								<?php $this->assign('editorId', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Grid']['FormId'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['Editor']->getName()) : smarty_modifier_cat($_tmp, $this->_tpl_vars['Editor']->getName()))); ?>
							<?php endif; ?>

							<div class="form-group <?php if ($this->_tpl_vars['Grid']['FormLayout']->isHorizontal()): ?>col-sm-<?php echo $this->_tpl_vars['Col']->getLabelWidth(); ?>
 form-group-label<?php else: ?>col-sm-<?php echo $this->_tpl_vars['Col']->getWidth(); ?>
<?php endif; ?>"<?php if ($this->_tpl_vars['Editor'] && ! $this->_tpl_vars['Editor']->getVisible()): ?> style="display: none"<?php endif; ?>>
								<?php if ($this->_tpl_vars['Grid']['FormLayout']->isHorizontal() || ! $this->_tpl_vars['ColumnViewData']['EditorViewData'] || ! $this->_tpl_vars['Editor']->isInlineLabel()): ?>
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'custom_templates/field_label.tpl', 'smarty_include_vars' => array('editorId' => $this->_tpl_vars['editorId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<?php endif; ?>

								<?php if ($this->_tpl_vars['Grid']['FormLayout']->isHorizontal()): ?>
									</div>
									<div class="form-group col-sm-<?php echo $this->_tpl_vars['Col']->getInputWidth(); ?>
"<?php if ($this->_tpl_vars['Editor'] && ! $this->_tpl_vars['Editor']->getVisible()): ?> style="display: none"<?php endif; ?>>
								<?php endif; ?>

								<?php if (! $this->_tpl_vars['isViewForm']): ?>
									<div class="col-input" style="width:100%; max-width:<?php echo $this->_tpl_vars['Editor']->getMaxWidth(); ?>
" data-column="<?php echo $this->_tpl_vars['ColumnViewData']['FieldName']; ?>
">
									
										<?php if ($this->_tpl_vars['Button'] == 'yes' || isset ( $this->_tpl_vars['ButtonLabel'] ) || isset ( $this->_tpl_vars['ButtonIcon'] )): ?>										
											<div class="input-group">
										<?php endif; ?>

										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp='editors/')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['Editor']->getEditorName()) : smarty_modifier_cat($_tmp, $this->_tpl_vars['Editor']->getEditorName())))) ? $this->_run_mod_handler('cat', true, $_tmp, '.tpl') : smarty_modifier_cat($_tmp, '.tpl')), 'smarty_include_vars' => array('Editor' => $this->_tpl_vars['Editor'],'ViewData' => $this->_tpl_vars['ColumnViewData']['EditorViewData'],'FormId' => $this->_tpl_vars['Grid']['FormId'],'id' => $this->_tpl_vars['editorId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										<?php if (! $this->_tpl_vars['Grid']['FormLayout']->isHorizontal() && $this->_tpl_vars['Editor']->isInlineLabel()): ?>
											<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'custom_templates/field_label.tpl', 'smarty_include_vars' => array('editorId' => $this->_tpl_vars['editorId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										<?php endif; ?>

										<?php if ($this->_tpl_vars['Button'] == 'yes' && isset ( $this->_tpl_vars['ButtonIcon'] )): ?>
											<div class="btn-group input-group-btn">
												<button type="button" class="btn btn-default js-nested-insert" data-content-link="#" data-display-field-name="<?php echo $this->_tpl_vars['ColumnViewData']['FieldName']; ?>
" title="<?php if (isset ( $this->_tpl_vars['ButtonTitle'] )): ?><?php echo $this->_tpl_vars['ButtonTitle']; ?>
<?php endif; ?>">
													<span class="<?php echo $this->_tpl_vars['ButtonIcon']; ?>
"></span>
												</button>
											</div>
											</div>
										<?php elseif (isset ( $this->_tpl_vars['ButtonLabel'] ) || isset ( $this->_tpl_vars['ButtonIcon'] )): ?>
											<span class="input-group-addon">
												<?php if (isset ( $this->_tpl_vars['ButtonIcon'] )): ?><span class="<?php echo $this->_tpl_vars['ButtonIcon']; ?>
"></span><?php else: ?><?php echo $this->_tpl_vars['ButtonLabel']; ?>
<?php endif; ?>
											</span>
											</div>
										<?php endif; ?>
										
									</div>
								<?php else: ?>
									<?php $this->assign('ColumnName', $this->_tpl_vars['Col']->getName()); ?>
									<?php $this->assign('CellEditUrl', $this->_tpl_vars['Grid']['CellEditUrls'][$this->_tpl_vars['ColumnName']]); ?>

									<div class="form-control-static<?php if ($this->_tpl_vars['CellEditUrl']): ?> pgui-cell-edit<?php endif; ?>"<?php if ($this->_tpl_vars['CellEditUrl']): ?> data-column-name="<?php echo $this->_tpl_vars['ColumnName']; ?>
" data-edit-url="<?php echo $this->_tpl_vars['CellEditUrl']; ?>
"<?php endif; ?>>
										<?php if (isset ( $this->_tpl_vars['ENUM'] )): ?>
											<?php $this->assign('fieldvalue', ((is_array($_tmp='value_caption_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['Col']->getDisplayValue($this->_tpl_vars['Renderer'])) : smarty_modifier_cat($_tmp, $this->_tpl_vars['Col']->getDisplayValue($this->_tpl_vars['Renderer'])))); ?>
											<?php echo $this->_tpl_vars['Captions']->GetMessageString($this->_tpl_vars['fieldvalue']); ?>

										<?php else: ?>
											<?php echo $this->_tpl_vars['Col']->getDisplayValue($this->_tpl_vars['Renderer']); ?>

										<?php endif; ?>
									</div>
								<?php endif; ?>
								
							</div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
            </div>
        <?php endforeach; endif; unset($_from); ?>
    </<?php if ($this->_tpl_vars['isViewForm']): ?>div<?php else: ?>fieldset<?php endif; ?>>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>