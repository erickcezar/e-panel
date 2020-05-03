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
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.id Help=id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.client_id Help=client_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.domain_id Help=domain_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.unix_user_id Help=unix_user_id}
							
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.username Help=username}

							<div class="form-title-field">{$Captions->GetMessageString('DirectoryPath')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.dir Help=dir Button=yes ButtonIcon=icon-page-refresh}

							<div class="form-title-field">{$Captions->GetMessageString('QuotaLimit')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.quotasize Help=quotasize ButtonLabel=MB}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.quotafiles Help=quotafiles}
							
							<div class="form-title-field">{$Captions->GetMessageString('UploadDownloadLimit')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ulbandwidth Help=ulbandwidth ButtonLabel=KB}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.dlbandwidth Help=dlbandwidth ButtonLabel=KB}
							
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
