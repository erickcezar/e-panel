{include file="page_header.tpl" pageTitle=$Grid.Title pageWithForm=true}

<div class="col-md-12 js-form-container" data-form-url="{$Grid.FormAction}&flash=true">
    {include file='forms/actions_edit.tpl' top=true isHorizontal=$Grid.FormLayout->isHorizontal()}

    <div class="row">
        <div class="js-form-collection {if $Grid.FormLayout->isHorizontal()}col-lg-8{else}col-md-8 col-md-offset-2{/if}">

			<div style="margin: 0px 20px;">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#page01-{$Grid.FormId}" aria-controls="page01-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('Essential')}</a></li>
				</ul>

				<div class="tab-content" style="margin-top: 20px; min-height: 350px">
					<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
					{foreach from=$Forms item=Form name=forms}
						{$Form}
						{if not $smarty.foreach.forms.last}<hr>{/if}
					{/foreach}
					</div>
				</div>
			</div>
        </div>
    </div>

    {if $Grid.AllowAddMultipleRecords}
        <div class="row" style="margin-top: 20px">
            <div class="{if $Grid.FormLayout->isHorizontal()}col-lg-8{else}col-md-8 col-md-offset-2{/if}">
                <a href="#" class="js-form-add{if $Grid.FormLayout->isHorizontal()} col-md-offset-3{/if}"><span class="icon-plus"></span> {$Captions->GetMessageString('FormAdd')}</a>
            </div>
        </div>
    {/if}

    {include file='forms/actions_edit.tpl' top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
</div>
