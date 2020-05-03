<form id="{$Grid.FormId}" class="{if $Grid.FormLayout->isHorizontal()}form-horizontal{/if}" enctype="multipart/form-data" method="POST" action="{$Grid.FormAction}">

    {include file='common/messages.tpl' type='danger' dismissable=true messages=$Grid.ErrorMessages displayTime=$Grid.MessageDisplayTime}
    {include file='common/messages.tpl' type='success' dismissable=true messages=$Grid.Messages displayTime=$Grid.MessageDisplayTime}

    {if $ShowErrorsOnTop}
    <div class="row">
        <div class="col-md-12 form-error-container form-error-container-top"></div>
    </div>
    {/if}
	
	<div class="row">
        {assign var=Columns value=$Grid.FormLayout->getColumns()}
        <div style="margin: 0px 20px;">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#page01-{$Grid.FormId}" aria-controls="page01-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageEssential')}</a></li>
				<li role="presentation"><a href="#page03-{$Grid.FormId}" aria-controls="page03-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvDNS')}</a></li>
				<li role="presentation"><a href="#page04-{$Grid.FormId}" aria-controls="page04-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvMail')}</a></li>
				<li role="presentation"><a href="#page05-{$Grid.FormId}" aria-controls="page05-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvWeb')}</a></li>
				<li role="presentation"><a href="#page06-{$Grid.FormId}" aria-controls="page06-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvFTP')}</a></li>
				<li role="presentation"><a href="#page07-{$Grid.FormId}" aria-controls="page07-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageParameter')}</a></li>
				<li role="presentation"><a href="#page08-{$Grid.FormId}" aria-controls="page08-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvURL')}</a></li>
				<li role="presentation"><a href="#page09-{$Grid.FormId}" aria-controls="page09-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageFTPUser')}</a></li>
				<li role="presentation"><a href="#page10-{$Grid.FormId}" aria-controls="page10-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAuthURLUser')}</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.client_id Help=NOME_FORM_client_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.domain Help=NOME_FORM_domain}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.locked Help=NOME_FORM_locked}

					<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.active Help=NOME_FORM_active}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page03-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.service_dns Help=NOME_FORM_service_dns}
					
					<div id="form_service_dns">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.dns_transfer Help=NOME_FORM_dns_transfer}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mx_id Help=NOME_FORM_mx_id}
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page04-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.service_mail Help=NOME_FORM_service_mail}
					
					<div id="form_service_mail">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_max_account Help=NOME_FORM_mail_max_account}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_max_alias Help=NOME_FORM_mail_max_alias}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_max_forward Help=NOME_FORM_mail_max_forward}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_size Help=NOME_FORM_mail_size ButtonLabel=GB}
						
						<div class="form-title-field">{$Captions->GetMessageString('AuthenticationRestriction')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_domain_preauth_esweb Help=NOME_FORM_mail_domain_preauth_esweb}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.mail_domain_restrict_login Help=NOME_FORM_mail_domain_restrict_login}
					</div>
				</div>	
	
				<div role="tabpanel" class="tab-pane" id="page05-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.service_http Help=NOME_FORM_service_http}
					
					<div id="form_service_http">						
						<div class="form-title-field">{$Captions->GetMessageString('DomainRoot')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.domain_root Help=NOME_FORM_domain_root}
						
						<div class="form-title-field">{$Captions->GetMessageString('RedirectToAnExistingSite')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.redirect Help=NOME_FORM_redirect}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.server_id Help=NOME_FORM_server_id}

						<div class="form-title-field">{$Captions->GetMessageString('HostingConfigurationParameters')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.poolweb_id Help=NOME_FORM_poolweb_id}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.homedir Help=NOME_FORM_homedir Button=yes ButtonIcon=icon-page-refresh}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_exploredir Help=NOME_FORM_http_exploredir}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_showmsgerror Help=NOME_FORM_http_showmsgerror}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_wildcard Help=NOME_FORM_http_wildcard}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_force_www Help=NOME_FORM_http_force_www}
						
						<div class="form-title-field">{$Captions->GetMessageString('Restriction')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_suspended Help=NOME_FORM_http_suspended}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_authurl Help=NOME_FORM_http_authurl}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_limit_rate Help=NOME_FORM_http_limit_rate ButtonLabel=KB}
						
						<div class="form-title-field">{$Captions->GetMessageString('PHP')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_php_openbasedir_id Help=NOME_FORM_http_php_openbasedir_id}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_php_cache Help=NOME_FORM_http_php_cache}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_php_suhosin Help=NOME_FORM_http_php_suhosin}

						<div class="form-title-field">{$Captions->GetMessageString('CertificateSSL')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.certificate_id Help=NOME_FORM_certificate_id}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_force_ssl Help=NOME_FORM_http_force_ssl}
						
						<div class="form-title-field">{$Captions->GetMessageString('Security')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.protection_id Help=NOME_FORM_protection_id}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.http_waf Help=NOME_FORM_http_waf}
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page06-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.service_ftp Help=NOME_FORM_service_ftp}
					
					<div id="form_service_ftp">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.dir Help=NOME_FORM_dir}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.unix_user_id Help=NOME_FORM_unix_user_id}
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page07-{$Grid.FormId}">
					<div class="form-group form-group-label col-sm-4">
						<label class="control-label">{$Captions->GetMessageString('caption_parameter')}:</label>
					</div>
					<div class="form-group col-sm-8">
						<div class="col-input" style="width:100%; max-width:100%" data-column="parameter">
							<select class="form-control" name="parameter_edit[]" multiple data-max-selection-size="0" data-editor="multivalue_select">
								{foreach item=Parameter from=$Parameters}
									<option value="{$Parameter.id}" {if $Parameter.id|in_array:$DomainParameters} selected{/if}>{$Parameter.name}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page08-{$Grid.FormId}">
					{foreach item=Url from=$Urls}
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="{$Grid.FormId}" data-column="url_user"><a href="">
								{$Url.id} - {$Url.uri} - {$Url.redirect_type} - {$Url.active} - {$Url.created} - {$Url.updated}
								</a>
								</label>
							</div>
						</div>
					{/foreach}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page09-{$Grid.FormId}">
					{foreach item=FtpUser from=$FtpUsers}
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="{$Grid.FormId}" data-column="ftp_user"><a href="">
								{$FtpUser.id} - {$FtpUser.username} - {$FtpUser.quotasize} - {$FtpUser.active} - {$FtpUser.created} - {$FtpUser.updated}
								</a>
								</label>
							</div>
						</div>
					{/foreach}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page10-{$Grid.FormId}">
					{foreach item=UrlUser from=$UrlUsers}
						<div class="row">
							<div>
								<label style="font-weight: normal;" for="{$Grid.FormId}" data-column="url_user"><a href="">
								{$UrlUser.id} - {$UrlUser.username} - {$UrlUser.description} - {$UrlUser.expire} - {$UrlUser.active} - {$UrlUser.created} - {$UrlUser.updated}
								</a>
								</label>
							</div>
						</div>
					{/foreach}
				</div>
			</div> 
        </div>
    </div>

    {foreach key=HiddenValueName item=HiddenValue from=$HiddenValues}
        <input type="hidden" name="{$HiddenValueName}" value="{$HiddenValue}" />
    {/foreach}

    {if $flashMessages}
        <input type="hidden" name="flash_messages" value="1" />
    {/if}

    {if $ShowErrorsAtBottom}
    <div class="row">
        <div class="col-md-12 form-error-container form-error-container-bottom"></div>
    </div>
    {/if}

    {include file='forms/form_scripts.tpl'}

</form>

{if not $isViewForm and not $isMultiUploadOperation}
    <div class="row">
        <div class="{if $Grid.FormLayout->isHorizontal()}col-sm-9 col-sm-offset-3{else}col-md-12{/if}">
            <span class="required-mark">*</span> - {$Captions->GetMessageString('RequiredField')}
        </div>
    </div>

    {if $isMultiEditOperation}
        {foreach key=HiddenValueName item=HiddenArray from=$HiddenValues}
            {foreach item=HiddenValue from=$HiddenArray}
                <input type="hidden" name="{$HiddenValueName}[]" value="{$HiddenValue}" />
            {/foreach}
        {/foreach}
    {else}
        {foreach key=HiddenValueName item=HiddenValue from=$HiddenValues}
        <input type="hidden" name="{$HiddenValueName}" value="{$HiddenValue}" />
        {/foreach}
    {/if}
{/if}
