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
				<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAdvanced')}</a></li>
			</ul>
			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.client_id Help=NOME_FORM_client_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.domain_id Help=NOME_FORM_domain_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.username Help=NOME_FORM_username}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.gecos Help=NOME_FORM_gecos}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.password Help=NOME_FORM_password Button=yes ButtonIcon=icon-password-change}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.homedir Help=NOME_FORM_homedir Button=yes ButtonIcon=icon-page-refresh}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.shell Help=NOME_FORM_shell}

					{*include file="custom_templates/custom_form_column.tpl" Column=$Columns.uid_ftp Help=NOME_FORM_uid_ftp*}
					{*include file="custom_templates/custom_form_column.tpl" Column=$Columns.gid_ftp Help=NOME_FORM_gid_ftp*}
					{*include file="custom_templates/custom_form_column.tpl" Column=$Columns.uid_http Help=NOME_FORM_uid_http*}
					{*include file="custom_templates/custom_form_column.tpl" Column=$Columns.gid_http Help=NOME_FORM_gid_http*}
					
					<div class="form-title-field">{$Captions->GetMessageString('PagePasswordRestriction')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.lstchg Help=NOME_FORM_lstchg}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.min Help=NOME_FORM_min}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.max Help=NOME_FORM_max}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.warn Help=NOME_FORM_warn}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.inact Help=NOME_FORM_inact}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.expire Help=NOME_FORM_expire}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.flag Help=NOME_FORM_flag}
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
