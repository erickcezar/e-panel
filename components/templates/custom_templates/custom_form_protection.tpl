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
				<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageProtocolHSTS')}</a></li>
				<li role="presentation"><a href="#page03-{$Grid.FormId}" aria-controls="page03-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageX-Frame')}</a></li>
				<li role="presentation"><a href="#page04-{$Grid.FormId}" aria-controls="page04-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageNosniff')}</a></li>
				<li role="presentation"><a href="#page05-{$Grid.FormId}" aria-controls="page05-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageXSS')}</a></li>
				<li role="presentation"><a href="#page06-{$Grid.FormId}" aria-controls="page06-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageCORS')}</a></li>
				<li role="presentation"><a href="#page07-{$Grid.FormId}" aria-controls="page07-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageDomains')}</a></li>
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.name Help=NOME_FORM_name}
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.active Help=NOME_FORM_active}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.sts Help=NOME_FORM_sts}
					
					<div id="form_sts">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.sts_max_age Help=NOME_FORM_sts_max_age}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.sts_includesubdomains Help=NOME_FORM_sts_includesubdomains}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.sts_preload Help=NOME_FORM_sts_preload}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.sts_always Help=NOME_FORM_sts_always}
					</div>
				</div>
					
				<div role="tabpanel" class="tab-pane" id="page03-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.x_frame Help=NOME_FORM_x_frame}
					
					<div id="form_x_frame">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.x_frame_options Help=NOME_FORM_x_frame_options}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.x_frame_url Help=NOME_FORM_x_frame_url}
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page04-{$Grid.FormId}">					
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.x_content_nosniff Help=NOME_FORM_x_content_nosniff}
				</div>				
				<div role="tabpanel" class="tab-pane" id="page05-{$Grid.FormId}">					
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.x_xss Help=NOME_FORM_x_xss}
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page06-{$Grid.FormId}">
					{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors Help=NOME_FORM_cors}
					
					<div id="form_cors">
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_origin Help=NOME_FORM_cors_origin}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_credential Help=NOME_FORM_cors_credential}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_always Help=NOME_FORM_cors_always}
						
						<div class="form-title-field">{$Captions->GetMessageString('Methods')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_methods Help=NOME_FORM_cors_methods}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_get Help=NOME_FORM_cors_method_get}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_head Help=NOME_FORM_cors_method_head}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_post Help=NOME_FORM_cors_method_post}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_put Help=NOME_FORM_cors_method_put}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_delete Help=NOME_FORM_cors_method_delete}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_connect Help=NOME_FORM_cors_method_connect}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_options Help=NOME_FORM_cors_method_options}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_trace Help=NOME_FORM_cors_method_trace}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_method_patch Help=NOME_FORM_cors_method_patch}
						
						<div class="form-title-field">{$Captions->GetMessageString('HeaderControl')}</div>
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_headers Help=NOME_FORM_cors_headers}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_headers_options Help=NOME_FORM_cors_headers_options}
						{include file="custom_templates/custom_form_column.tpl" Column=$Columns.cors_max_age Help=NOME_FORM_cors_max_age}
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="page07-{$Grid.FormId}">
					sera apresentado todos os domínios relacionado a esta proteção!
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
