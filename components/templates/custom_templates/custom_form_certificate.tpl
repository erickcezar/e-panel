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
				<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageKey')}</a></li>
			</ul>
			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.client_id Help=NOME_FORM_client_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.name Help=NOME_FORM_name}

					<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.active Help=NOME_FORM_active}
				</div>

				<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.actived Help=NOME_FORM_actived}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.key Help=NOME_FORM_key}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.crt Help=NOME_FORM_crt}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.ca Help=NOME_FORM_ca}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.letsencrypt Help=NOME_FORM_letsencrypt}
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
