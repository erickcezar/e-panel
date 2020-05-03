<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'custom_templates/custom_form_domain.tpl', 117, false),)), $this); ?>
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
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageParameter'); ?>
</a></li>
				<li role="presentation"><a href="#page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageSrvURL'); ?>
</a></li>
				<li role="presentation"><a href="#page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageFTPUser'); ?>
</a></li>
				<li role="presentation"><a href="#page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" aria-controls="page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" role="tab" data-toggle="tab"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PageAuthURLUser'); ?>
</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['client_id'],'Help' => 'NOME_FORM_client_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['domain'],'Help' => 'NOME_FORM_domain')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['locked'],'Help' => 'NOME_FORM_locked')));
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
				
				<div role="tabpanel" class="tab-pane" id="page03-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['service_dns'],'Help' => 'NOME_FORM_service_dns')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<div id="form_service_dns">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['dns_transfer'],'Help' => 'NOME_FORM_dns_transfer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mx_id'],'Help' => 'NOME_FORM_mx_id')));
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
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_account'],'Help' => 'NOME_FORM_mail_max_account')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_alias'],'Help' => 'NOME_FORM_mail_max_alias')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_max_forward'],'Help' => 'NOME_FORM_mail_max_forward')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_size'],'Help' => 'NOME_FORM_mail_size','ButtonLabel' => 'GB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('AuthenticationRestriction'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_domain_preauth_esweb'],'Help' => 'NOME_FORM_mail_domain_preauth_esweb')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['mail_domain_restrict_login'],'Help' => 'NOME_FORM_mail_domain_restrict_login')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('DomainRoot'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['domain_root'],'Help' => 'NOME_FORM_domain_root')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('RedirectToAnExistingSite'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['redirect'],'Help' => 'NOME_FORM_redirect')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['server_id'],'Help' => 'NOME_FORM_server_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('HostingConfigurationParameters'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['poolweb_id'],'Help' => 'NOME_FORM_poolweb_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['homedir'],'Help' => 'NOME_FORM_homedir','Button' => true,'ButtonIcon' => "icon-page-refresh")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_exploredir'],'Help' => 'NOME_FORM_http_exploredir')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_showmsgerror'],'Help' => 'NOME_FORM_http_showmsgerror')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_wildcard'],'Help' => 'NOME_FORM_http_wildcard')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_force_www'],'Help' => 'NOME_FORM_http_force_www')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Restriction'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_suspended'],'Help' => 'NOME_FORM_http_suspended')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_authurl'],'Help' => 'NOME_FORM_http_authurl')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_limit_rate'],'Help' => 'NOME_FORM_http_limit_rate','ButtonLabel' => 'KB')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('PHP'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_php_openbasedir_id'],'Help' => 'NOME_FORM_http_php_openbasedir_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_php_cache'],'Help' => 'NOME_FORM_http_php_cache')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_php_suhosin'],'Help' => 'NOME_FORM_http_php_suhosin')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('CertificateSSL'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['certificate_id'],'Help' => 'NOME_FORM_certificate_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_force_ssl'],'Help' => 'NOME_FORM_http_force_ssl')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<div class="form-title-field"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Security'); ?>
</div>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['protection_id'],'Help' => 'NOME_FORM_protection_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['http_waf'],'Help' => 'NOME_FORM_http_waf')));
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
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['dir'],'Help' => 'NOME_FORM_dir')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_templates/custom_form_column.tpl", 'smarty_include_vars' => array('Column' => $this->_tpl_vars['Columns']['unix_user_id'],'Help' => 'NOME_FORM_unix_user_id')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page07-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<div class="form-group form-group-label col-sm-4">
						<label class="control-label"><?php echo $this->_tpl_vars['Captions']->GetMessageString('caption_parameter'); ?>
:</label>
					</div>
					<div class="form-group col-sm-8">
						<div class="col-input" style="width:100%; max-width:100%" data-column="parameter">
							<select class="form-control" name="parameter_edit[]" multiple data-max-selection-size="0" data-editor="multivalue_select">
								<?php $_from = $this->_tpl_vars['Parameters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Parameter']):
?>
									<option value="<?php echo $this->_tpl_vars['Parameter']['id']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['Parameter']['id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['DomainParameters']) : in_array($_tmp, $this->_tpl_vars['DomainParameters']))): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Parameter']['name']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						</div>
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page08-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_from = $this->_tpl_vars['Urls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Url']):
?>
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" data-column="url_user"><a href="">
								<?php echo $this->_tpl_vars['Url']['id']; ?>
 - <?php echo $this->_tpl_vars['Url']['uri']; ?>
 - <?php echo $this->_tpl_vars['Url']['redirect_type']; ?>
 - <?php echo $this->_tpl_vars['Url']['active']; ?>
 - <?php echo $this->_tpl_vars['Url']['created']; ?>
 - <?php echo $this->_tpl_vars['Url']['updated']; ?>

								</a>
								</label>
							</div>
						</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page09-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_from = $this->_tpl_vars['FtpUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['FtpUser']):
?>
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" data-column="ftp_user"><a href="">
								<?php echo $this->_tpl_vars['FtpUser']['id']; ?>
 - <?php echo $this->_tpl_vars['FtpUser']['username']; ?>
 - <?php echo $this->_tpl_vars['FtpUser']['quotasize']; ?>
 - <?php echo $this->_tpl_vars['FtpUser']['active']; ?>
 - <?php echo $this->_tpl_vars['FtpUser']['created']; ?>
 - <?php echo $this->_tpl_vars['FtpUser']['updated']; ?>

								</a>
								</label>
							</div>
						</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page10-<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
">
					<?php $_from = $this->_tpl_vars['UrlUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['UrlUser']):
?>
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="<?php echo $this->_tpl_vars['Grid']['FormId']; ?>
" data-column="url_user"><a href="">
								<?php echo $this->_tpl_vars['UrlUser']['id']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['username']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['description']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['expire']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['active']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['created']; ?>
 - <?php echo $this->_tpl_vars['UrlUser']['updated']; ?>

								</a>
								</label>
							</div>
						</div>
					<?php endforeach; endif; unset($_from); ?>
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