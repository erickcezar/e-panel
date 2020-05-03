<form id="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" class="<?php if ($this->_tpl_vars['Grid']['FormLayout']->isHorizontal()): ?>form-horizontal<?php endif; ?>" enctype="multipart/form-data" method="POST" action="<?php echo $this->_tpl_vars['Grid']['FormAction']; ?>
">

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'common/messages.tpl', 'smarty_include_vars' => array('type' => 'danger','dismissable' => true,'messages' => $this->_tpl_vars['Grid']['ErrorMessages'],'displayTime' => $this->_tpl_vars['Grid']['MessageDisplayTime'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'common/messages.tpl', 'smarty_include_vars' => array('type' => 'success','dismissable' => true,'messages' => $this->_tpl_vars['Grid']['Messages'],'displayTime' => $this->_tpl_vars['Grid']['MessageDisplayTime'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if ($this->_tpl_vars['ShowErrorsOnTop']): ?>
    <div class="row">
        <div class="col-md-12 form-error-container form-error-container-top"></div>
    </div>
    <?php endif; ?>

	<div class="row">
		<?php $this->assign('Columns', $this->_tpl_vars['Grid']['FormLayout']->getColumns()); ?>
        <div style="margin: 0px 20px;">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageEssential'); ?>
</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['client_id'],'Help' => 'client_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['domain_id'],'Help' => 'domain_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['unix_user_id'],'Help' => 'unix_user_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['username'],'Help' => 'username')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['password'],'Help' => 'password','Button' => true,'ButtonIcon' => "icon-password-change")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('DirectoryPath'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['dir'],'Help' => 'dir','Button' => true,'ButtonIcon' => "icon-page-refresh")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('QuotaLimit'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['quotasize'],'Help' => 'quotasize','ButtonLabel' => 'MB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['quotafiles'],'Help' => 'quotafiles')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('UploadDownloadLimit'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['ulbandwidth'],'Help' => 'ulbandwidth','ButtonLabel' => 'KB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['dlbandwidth'],'Help' => 'dlbandwidth','ButtonLabel' => 'KB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Active'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['active'],'Help' => 'NOME_FORM_active')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>		  
        </div>
    </div>

    <?php $_from = $this->_tpl_vars['HiddenValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValueName'] => $this->_tpl_vars['HiddenValue']):
?>
        <input type="hidden" name="<?php echo $this->_tpl_vars['HiddenValueName']; ?>
" value="<?php echo $this->_tpl_vars['HiddenValue']; ?>
" />
    <?php endforeach; endif; unset($_from); ?>

    <?php if ($this->_tpl_vars['flashMessages']): ?>
        <input type="hidden" name="flash_messages" value="1" />
    <?php endif; ?>

    <?php if ($this->_tpl_vars['ShowErrorsAtBottom']): ?>
    <div class="row">
        <div class="col-md-12 form-error-container form-error-container-bottom"></div>
    </div>
    <?php endif; ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'forms/form_scripts.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php if (! $this->_tpl_vars['isViewForm'] && ! $this->_tpl_vars['isMultiUploadOperation']): ?>
    <div class="row">
        <div class="<?php if ($this->_tpl_vars['Grid']['FormLayout']->isHorizontal()): ?>col-sm-9 col-sm-offset-3<?php else: ?>col-md-12<?php endif; ?>">
            <span class="required-mark">*</span> - <?php echo $this->_tpl_vars['Captions']->GetMessageString('RequiredField'); ?>

        </div>
    </div>

    <?php if ($this->_tpl_vars['isMultiEditOperation']): ?>
        <?php $_from = $this->_tpl_vars['HiddenValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValueName'] => $this->_tpl_vars['HiddenArray']):
?>
            <?php $_from = $this->_tpl_vars['HiddenArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValue']):
?>
                <input type="hidden" name="<?php echo $this->_tpl_vars['HiddenValueName']; ?>
[]" value="<?php echo $this->_tpl_vars['HiddenValue']; ?>
" />
            <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $_from = $this->_tpl_vars['HiddenValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HiddenValueName'] => $this->_tpl_vars['HiddenValue']):
?>
        <input type="hidden" name="<?php echo $this->_tpl_vars['HiddenValueName']; ?>
" value="<?php echo $this->_tpl_vars['HiddenValue']; ?>
" />
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
<?php endif; ?>