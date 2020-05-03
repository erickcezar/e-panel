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
				<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAuthESWEB')}</a></li>
				<li role="presentation"><a href="#page03-{$Grid.FormId}" aria-controls="page03-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAuthZimbra')}</a></li>
				<li role="presentation"><a href="#page04-{$Grid.FormId}" aria-controls="page04-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PagePasswordRestriction')}</a></li>
				<li role="presentation"><a href="#page05-{$Grid.FormId}" aria-controls="page05-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageProtocol')}</a></li>		
				<li role="presentation"><a href="#page06-{$Grid.FormId}" aria-controls="page06-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAutoReply')}</a></li>
				<li role="presentation"><a href="#page07-{$Grid.FormId}" aria-controls="page07-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageForward')}</a></li>
				<li role="presentation"><a href="#page08-{$Grid.FormId}" aria-controls="page08-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAliases')}</a></li>
			</ul>
			
			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.id Help=NOME_FORM_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.domain_id Help=NOME_FORM_domain_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.username Help=NOME_FORM_username}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.name Help=NOME_FORM_name}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.size Help=NOME_FORM_size}

					<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.active Help=NOME_FORM_active}
				</div>

				<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_authentication Help=NOME_FORM_preauth_authentication}
					
					<div id="form_preauth_authentication">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_password Help=NOME_FORM_preauth_password Button=yes ButtonIcon=icon-password-change}

						<div class="form-title-field">{$Captions->GetMessageString('PagePasswordRestriction')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_password_must_change Help=NOME_FORM_preauth_password_must_change}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_password_locked Help=NOME_FORM_preauth_password_locked}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_password_expire Help=NOME_FORM_preauth_password_expire}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_password_expire_time Help=NOME_FORM_preauth_password_expire_time}
						
						<div class="form-title-field">{$Captions->GetMessageString('LoginRestriction')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_restrict_login Help=NOME_FORM_preauth_restrict_login}
						
						<div class="form-title-field">{$Captions->GetMessageString('AuditAccount')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.preauth_access_other_account Help=NOME_FORM_preauth_access_other_account}
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page03-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_authentication Help=NOME_FORM_zimbra_authentication}
					
					<div id="form_zimbra_authentication">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_password Help=NOME_FORM_zimbra_password Button=yes ButtonIcon=icon-password-change}
						
						<div class="form-title-field">{$Captions->GetMessageString('PagePasswordRestriction')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_password_must_change Help=NOME_FORM_zimbra_password_must_change}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_password_locked Help=NOME_FORM_zimbra_password_locked}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_password_expire Help=NOME_FORM_zimbra_password_expire}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_password_expire_time Help=NOME_FORM_zimbra_password_expire_time}
						
						<div class="form-title-field">{$Captions->GetMessageString('OtherOptions')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.account_system Help=NOME_FORM_account_system}

						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_hide_of_contacts Help=NOME_FORM_zimbra_hide_of_contacts}
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="page04-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_length Help=NOME_FORM_conf_password_min_length}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_max_length Help=NOME_FORM_conf_password_max_length}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_upper_case_chars Help=NOME_FORM_conf_password_min_upper_case_chars}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_lower_case_chars Help=NOME_FORM_conf_password_min_lower_case_chars}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_numeric_chars Help=NOME_FORM_conf_password_min_numeric_chars}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_digits_or_puncs Help=NOME_FORM_conf_password_min_digits_or_puncs}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_punctuation_chars Help=NOME_FORM_conf_password_min_punctuation_chars}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_min_age Help=NOME_FORM_conf_password_min_age}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.conf_password_max_age Help=NOME_FORM_conf_password_max_age}
				</div>

				<div role="tabpanel" class="tab-pane" id="page05-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_pop3 Help=NOME_FORM_zimbra_pop3}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_imap Help=NOME_FORM_zimbra_imap}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_pop3_include_spam Help=NOME_FORM_zimbra_pop3_include_spam}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page06-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_auto_reply Help=NOME_FORM_zimbra_auto_reply}
					
					<div id="form_zimbra_auto_reply">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_auto_reply_message Help=NOME_FORM_zimbra_auto_reply_message}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_auto_reply_time_start Help=NOME_FORM_zimbra_auto_reply_time_start}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_auto_reply_time_stop Help=NOME_FORM_zimbra_auto_reply_time_stop}
					</div>
				</div>
		
				<div role="tabpanel" class="tab-pane" id="page07-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_mail_forwarding_address Help=NOME_FORM_zimbra_mail_forwarding_address}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.zimbra_forward_local_copy Help=NOME_FORM_zimbra_forward_local_copy}
				</div>

				<div role="tabpanel" class="tab-pane" id="page08-{$Grid.FormId}">
					Exibir aqui todos os alinhas relacionado a esta conta
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
