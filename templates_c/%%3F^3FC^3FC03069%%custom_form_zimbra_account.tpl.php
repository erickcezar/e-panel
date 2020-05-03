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
				<li role="presentation"><a href="#page02-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page02-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageAuthESWEB'); ?>
</a></li>
				<li role="presentation"><a href="#page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageAuthZimbra'); ?>
</a></li>
				<li role="presentation"><a href="#page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PagePasswordRestriction'); ?>
</a></li>
				<li role="presentation"><a href="#page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageProtocol'); ?>
</a></li>		
				<li role="presentation"><a href="#page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageAutoReply'); ?>
</a></li>
				<li role="presentation"><a href="#page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageForward'); ?>
</a></li>
				<li role="presentation"><a href="#page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageAliases'); ?>
</a></li>
			</ul>
			
			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['id'],'Help' => 'NOME_FORM_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['domain_id'],'Help' => 'NOME_FORM_domain_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['username'],'Help' => 'NOME_FORM_username')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['name'],'Help' => 'NOME_FORM_name')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['size'],'Help' => 'NOME_FORM_size')));
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

				<div role="tabpanel" class="tab-pane" id="page02-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_authentication'],'Help' => 'NOME_FORM_preauth_authentication')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div id="form_preauth_authentication">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_password'],'Help' => 'NOME_FORM_preauth_password','Button' => true,'ButtonIcon' => "icon-password-change")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PagePasswordRestriction'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_password_must_change'],'Help' => 'NOME_FORM_preauth_password_must_change')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_password_locked'],'Help' => 'NOME_FORM_preauth_password_locked')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_password_expire'],'Help' => 'NOME_FORM_preauth_password_expire')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_password_expire_time'],'Help' => 'NOME_FORM_preauth_password_expire_time')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('LoginRestriction'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_restrict_login'],'Help' => 'NOME_FORM_preauth_restrict_login')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('AuditAccount'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['preauth_access_other_account'],'Help' => 'NOME_FORM_preauth_access_other_account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_authentication'],'Help' => 'NOME_FORM_zimbra_authentication')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div id="form_zimbra_authentication">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_password'],'Help' => 'NOME_FORM_zimbra_password','Button' => true,'ButtonIcon' => "icon-password-change")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PagePasswordRestriction'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_password_must_change'],'Help' => 'NOME_FORM_zimbra_password_must_change')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_password_locked'],'Help' => 'NOME_FORM_zimbra_password_locked')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_password_expire'],'Help' => 'NOME_FORM_zimbra_password_expire')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_password_expire_time'],'Help' => 'NOME_FORM_zimbra_password_expire_time')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('OtherOptions'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['account_system'],'Help' => 'NOME_FORM_account_system')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_hide_of_contacts'],'Help' => 'NOME_FORM_zimbra_hide_of_contacts')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page04-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_length'],'Help' => 'NOME_FORM_conf_password_min_length')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_max_length'],'Help' => 'NOME_FORM_conf_password_max_length')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_upper_case_chars'],'Help' => 'NOME_FORM_conf_password_min_upper_case_chars')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_lower_case_chars'],'Help' => 'NOME_FORM_conf_password_min_lower_case_chars')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_numeric_chars'],'Help' => 'NOME_FORM_conf_password_min_numeric_chars')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_digits_or_puncs'],'Help' => 'NOME_FORM_conf_password_min_digits_or_puncs')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_punctuation_chars'],'Help' => 'NOME_FORM_conf_password_min_punctuation_chars')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_min_age'],'Help' => 'NOME_FORM_conf_password_min_age')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['conf_password_max_age'],'Help' => 'NOME_FORM_conf_password_max_age')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>

				<div role="tabpanel" class="tab-pane" id="page05-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_pop3'],'Help' => 'NOME_FORM_zimbra_pop3')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_imap'],'Help' => 'NOME_FORM_zimbra_imap')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_pop3_include_spam'],'Help' => 'NOME_FORM_zimbra_pop3_include_spam')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page06-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_auto_reply'],'Help' => 'NOME_FORM_zimbra_auto_reply')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div id="form_zimbra_auto_reply">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_auto_reply_message'],'Help' => 'NOME_FORM_zimbra_auto_reply_message')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_auto_reply_time_start'],'Help' => 'NOME_FORM_zimbra_auto_reply_time_start')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_auto_reply_time_stop'],'Help' => 'NOME_FORM_zimbra_auto_reply_time_stop')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>
		
				<div role="tabpanel" class="tab-pane" id="page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_mail_forwarding_address'],'Help' => 'NOME_FORM_zimbra_mail_forwarding_address')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['zimbra_forward_local_copy'],'Help' => 'NOME_FORM_zimbra_forward_local_copy')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>

				<div role="tabpanel" class="tab-pane" id="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					Exibir aqui todos os alinhas relacionado a esta conta
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