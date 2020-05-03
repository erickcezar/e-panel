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
			</ul>

			<div class="tab-content" style="margin-top: 20px; min-height: 350px">
				<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{include file='custom_templates/form_fields.tpl' isViewForm=false}
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
