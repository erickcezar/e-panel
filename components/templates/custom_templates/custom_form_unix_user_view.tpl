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
						<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAdvanced')}</a></li>
					</ul>
					<div class="tab-content" style="margin-top: 20px; min-height: 350px">
						<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.id Help=NOME_FORM_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.client_id Help=NOME_FORM_client_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.domain_id Help=NOME_FORM_domain_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.username Help=NOME_FORM_username}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.gecos Help=NOME_FORM_gecos}
						</div>
						
						<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.homedir Help=NOME_FORM_homedir Button=yes ButtonIcon=icon-page-refresh}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.shell Help=NOME_FORM_shell}

							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.uid_ftp Help=NOME_FORM_uid_ftp}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.gid_ftp Help=NOME_FORM_gid_ftp}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.uid_http Help=NOME_FORM_uid_http}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.gid_http Help=NOME_FORM_gid_http}
							
							<div class="form-title-field">Password Restriction</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.lstchg Help=NOME_FORM_lstchg}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.min Help=NOME_FORM_min}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.max Help=NOME_FORM_max}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.warn Help=NOME_FORM_warn}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.inact Help=NOME_FORM_inact}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.expire Help=NOME_FORM_expire}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.flag Help=NOME_FORM_flag}
						</div>
					</div>
				</div>
			</div>
		</div>

        {include file="forms/actions_view.tpl" top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
    </div>
</div>
