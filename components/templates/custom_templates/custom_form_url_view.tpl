<div id="pgui-view-grid">
    {include file="page_header.tpl" pageTitle=$Grid.Title}

    <div class="{if $Grid.FormLayout->isHorizontal()}form-horizontal{/if}">

        <div class="row">
            <div class="col-md-12 js-message-container"></div>
            <div class="clearfix"></div>
            <div class="form-static {if $Grid.FormLayout->isHorizontal()}form-horizontal col-lg-8{else}col-md-8 col-md-offset-2{/if}">
				{assign var=Columns value=$Grid.FormLayout->getColumns()}
				<div style="margin: 0px 20px;">

					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#page01-{$Grid.FormId}" aria-controls="page01-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageEssential')}</a></li>
					</ul>

					<div class="tab-content" style="margin-top: 20px; min-height: 350px">
						<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.id Help=NOME_FORM_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.domain_id Help=NOME_FORM_domain_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.uri Help=NOME_FORM_uri}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.complete_uri Help=NOME_FORM_complete_uri}

							<div class="form-title-field">{$Captions->GetMessageString('Action')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.redirect_type Help=NOME_FORM_redirect_type ENUM=yes}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.poolweb_id Help=NOME_FORM_poolweb_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.url Help=NOME_FORM_url}

							<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.active Help=NOME_FORM_active}
						</div>
					</div>
				</div>
			</div>
		</div>

        {include file="forms/actions_view.tpl" top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
    </div>
</div>
