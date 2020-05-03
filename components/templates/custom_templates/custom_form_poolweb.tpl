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
				<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageServers')}</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.environment_id Help=NOME_FORM_environment_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.name Help=NOME_FORM_name}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.description Help=NOME_FORM_description}

					<div class="form-title-field">{$Captions->GetMessageString('LoadBalanceType')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.hash_type Help=NOME_FORM_hash_type}

					<div class="form-title-field">{$Captions->GetMessageString('PHPInformation')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cache_id Help=NOME_FORM_cache_id}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.php_version_id Help=NOME_FORM_php_version_id}

					<div class="form-title-field">{$Captions->GetMessageString('PortConnection')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.port_http Help=NOME_FORM_port_http}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.port_https Help=NOME_FORM_port_https}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.internal_ssl Help=NOME_FORM_internal_ssl}

					<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.active Help=NOME_FORM_active}
				</div>

				<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
					<div class="form-group col-sm-3 form-group-label">
						<label class="control-label">{$Captions->GetMessageString('caption_server')}:</label>
					</div>
					<div class="form-group col-sm-9">
						<div class="col-input" style="width:100%; max-width:100%" data-column="server">
							<select class="form-control" name="server_edit[]" multiple data-max-selection-size="0" data-editor="multivalue_select">
								{foreach item=Server from=$Servers}
									<option value="{$Server.id}" {if $Server.id|in_array:$PoolwebServers} selected{/if}>{$Server.hostname}</option>
								{/foreach}
							</select>
						</div>
					</div>
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
