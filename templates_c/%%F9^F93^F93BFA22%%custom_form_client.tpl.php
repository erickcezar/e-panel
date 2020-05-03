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
				<li role="presentation"><a href="#page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvDNS'); ?>
</a></li>
				<li role="presentation"><a href="#page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvMail'); ?>
</a></li>
				<li role="presentation"><a href="#page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvWeb'); ?>
</a></li>
				<li role="presentation"><a href="#page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvFTP'); ?>
</a></li>
				<li role="presentation"><a href="#page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvSMTP'); ?>
</a></li>
				<li role="presentation"><a href="#page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvBackup'); ?>
</a></li>
				<li role="presentation"><a href="#page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvMKmail'); ?>
</a></li>
				<li role="presentation"><a href="#page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvTS'); ?>
</a></li>
				<li role="presentation"><a href="#page11-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page11-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvIPDedicate'); ?>
</a></li>
				<li role="presentation"><a href="#page12-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page12-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvOther'); ?>
</a></li>
				<li role="presentation"><a href="#page13-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page13-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageContacts'); ?>
</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['resale_id'],'Help' => 'NOME_FORM_resale_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['name'],'Help' => 'NOME_FORM_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['description'],'Help' => 'NOME_FORM_description')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['site'],'Help' => 'NOME_FORM_site')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Limits'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['max_domain'],'Help' => 'NOME_FORM_max_domain')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Agreement'); ?>
</div>
					alguma coisa

					<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Active'); ?>
</div>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['active'],'Help' => 'NOME_FORM_active')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>

				<div role="tabpanel" class="tab-pane" id="page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_dns'],'Help' => 'NOME_FORM_service_dns')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_dns">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['dns_note'],'Help' => 'NOME_FORM_dns_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_mail'],'Help' => 'NOME_FORM_service_mail')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_mail">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_note'],'Help' => 'NOME_FORM_mail_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['type_plan'],'Help' => 'NOME_FORM_type_plan')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Limits'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_domain'],'Help' => 'NOME_FORM_mail_max_domain','ButtonLabel' => "Free: 18")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_account'],'Help' => 'NOME_FORM_mail_max_account','ButtonLabel' => "Free: 47")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_alias'],'Help' => 'NOME_FORM_mail_max_alias','ButtonLabel' => "Free: 20")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_forward'],'Help' => 'NOME_FORM_mail_max_forward','ButtonLabel' => "Free: 50")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_size'],'Help' => 'NOME_FORM_mail_size','ButtonLabel' => "Free: 3 TB")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('AccountSizeList'); ?>
</div>
						<div class="row">
							<div class="form-group col-sm-3 form-group-label">
								<label class="control-label" for="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" data-column="account_size"></label>
							</div>
							<div class="form-group col-sm-9">
								<div class="col-input" style="width: 560px; display: inline-block;" data-column="account_size">
									<div class="input-checkbox">
										<div style="width: 100%; display: inline-block;">
											<label style="width: 216px;text-align: right;"><?php echo $this->_tpl_vars['Captions']->GetMessageString('SizesValues'); ?>
</label> |
											<label style="width: 216px;text-align: left;"><?php echo $this->_tpl_vars['Captions']->GetMessageString('NumberFreeAccount'); ?>
</label>
										</div>
										<?php $_from = $this->_tpl_vars['AccountSizes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Size']):
?>
										<div style="width: 100%; display: inline-block;">
											<input id="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
_size_check_<?php echo $this->_tpl_vars['Size']['id']; ?>
_edit" name="size_check_edit[<?php echo $this->_tpl_vars['Size']['id']; ?>
]" style="margin: 10px 0px 0px 0px;" data-editor="checkbox" data-field-name="size_check_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-legacy-field-name="size_check_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-pgui-legacy-validate="false" type="checkbox" value="<?php echo $this->_tpl_vars['Size']['price']; ?>
" <?php echo $this->_tpl_vars['Size']['checked']; ?>
>
											<label style="width: 60px; text-align: right;"><?php echo $this->_tpl_vars['Size']['name']; ?>
</label>
											<div class="col-input" style="width: 140px; display: inline-block;" data-column="size_<?php echo $this->_tpl_vars['Size']['id']; ?>
">
												<input id="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
_size_<?php echo $this->_tpl_vars['Size']['id']; ?>
_edit" name="size_edit[<?php echo $this->_tpl_vars['Size']['id']; ?>
]" data-editor="text" data-field-name="size_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-number-error-message="Please enter a valid number." data-validation="number" data-legacy-field-name="size_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-pgui-legacy-validate="true" class="form-control" value="<?php echo $this->_tpl_vars['Size']['price']; ?>
" type="text">
											</div>
											<div class="col-input" style="width: 140px; display: inline-block;" data-column="free_account_<?php echo $this->_tpl_vars['Size']['id']; ?>
">
												<input id="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
_free_account_<?php echo $this->_tpl_vars['Size']['id']; ?>
_edit" name="free_account_edit[<?php echo $this->_tpl_vars['Size']['id']; ?>
]" data-editor="text" data-field-name="free_account_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-digits-error-message="Please enter only digits." data-validation="digit" data-legacy-field-name="free_account_<?php echo $this->_tpl_vars['Size']['id']; ?>
" data-pgui-legacy-validate="true" class="form-control" value="<?php echo $this->_tpl_vars['Size']['free_account']; ?>
" type="text">
											</div>
										</div>
										<?php endforeach; endif; unset($_from); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_http'],'Help' => 'NOME_FORM_service_http')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_http">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_note'],'Help' => 'NOME_FORM_http_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Limits'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_max_hosting'],'Help' => 'NOME_FORM_http_max_hosting','ButtonLabel' => "Free: 3")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_max_virtualhost'],'Help' => 'NOME_FORM_http_max_virtualhost','ButtonLabel' => "Free: 3")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_max_db'],'Help' => 'NOME_FORM_http_max_db','ButtonLabel' => "Free: 3")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_size'],'Help' => 'NOME_FORM_http_size','ButtonLabel' => "Free: 3 TB")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_ftp'],'Help' => 'NOME_FORM_service_ftp')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_ftp">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['ftp_note'],'Help' => 'NOME_FORM_ftp_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['unix_user_id'],'Help' => 'NOME_FORM_unix_user_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Limits'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['ftp_max_user'],'Help' => 'NOME_FORM_ftp_max_user')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_smtp'],'Help' => 'NOME_FORM_service_smtp')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_smtp">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['smtp_note'],'Help' => 'NOME_FORM_smtp_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['smtp_max_send'],'Help' => 'NOME_FORM_smtp_max_send')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['smtp_type_limit'],'Help' => 'NOME_FORM_smtp_type_limit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_backup'],'Help' => 'NOME_FORM_service_backup')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_backup">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_note'],'Help' => 'NOME_FORM_backup_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_email'],'Help' => 'NOME_FORM_backup_email')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_size'],'Help' => 'NOME_FORM_backup_size','ButtonLabel' => 'GB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('RemoteServerAccessData'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_type_connect'],'Help' => 'NOME_FORM_backup_server_type_connect')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_host'],'Help' => 'NOME_FORM_backup_server_host')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_port'],'Help' => 'NOME_FORM_backup_server_port')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_os'],'Help' => 'NOME_FORM_backup_server_os')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_user'],'Help' => 'NOME_FORM_backup_server_user')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['backup_server_password'],'Help' => 'NOME_FORM_backup_server_password','Button' => true,'ButtonIcon' => "icon-password-change")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_mkmail'],'Help' => 'NOME_FORM_service_mkmail')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_mkmail">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mkmail_note'],'Help' => 'NOME_FORM_mkmail_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_ts'],'Help' => 'NOME_FORM_service_ts')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_ts">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['ts_note'],'Help' => 'NOME_FORM_ts_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page11-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_ip_dedicate'],'Help' => 'NOME_FORM_service_ip_dedicate')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_ip_dedicate">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['ip_dedicate_note'],'Help' => 'NOME_FORM_ip_dedicate_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page12-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_other'],'Help' => 'NOME_FORM_service_other')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<div id="form_service_other">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['other_note'],'Help' => 'NOME_FORM_other_note')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page13-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<table class="table text-center table-striped table-hover table-condensed">
						<thead class="js-column-filter-container">
							<tr>
								<th><?php echo $this->_tpl_vars['Captions']->GetMessageString('caption_name'); ?>
</th>
								<th><?php echo $this->_tpl_vars['Captions']->GetMessageString('caption_email'); ?>
</th>
								<th><?php echo $this->_tpl_vars['Captions']->GetMessageString('caption_phone'); ?>
</th>
							</tr>
						</thead>
						<tbody class="pg-row-list">
						<?php $_from = $this->_tpl_vars['Contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Contact']):
?>
							<tr class="pg-row">
								<td><div style="text-align: left;"><?php echo $this->_tpl_vars['Contact']['name']; ?>
</div></td>
								<td><div style="text-align: left;"><?php echo $this->_tpl_vars['Contact']['mail']; ?>
</div></td>
								<td><div style="text-align: left;"><?php echo $this->_tpl_vars['Contact']['phone']; ?>
</div></td>
							</tr>
						<?php endforeach; endif; unset($_from); ?>
						</tbody>
					</table>
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