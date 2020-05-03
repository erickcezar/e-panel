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
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.environment_id Help=NOME_FORM_environment_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.name Help=NOME_FORM_name}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.description Help=NOME_FORM_description}
							
							<div class="form-title-field">{$Captions->GetMessageString('ConnectionInformation')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ip Help=NOME_FORM_ip}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.port Help=NOME_FORM_port}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.protocol Help=NOME_FORM_protocol ENUM=yes}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.timeout_client Help=NOME_FORM_timeout_client}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.timeout_server Help=NOME_FORM_timeout_server}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.option Help=NOME_FORM_option}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.balance Help=NOME_FORM_balance ENUM=yes}

							<div class="form-title-field">{$Captions->GetMessageString('LocalServerInformation')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.server_id Help=NOME_FORM_server_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.server_port Help=NOME_FORM_server_port}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.maxconn Help=NOME_FORM_maxconn}

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
