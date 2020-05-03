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
						<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageServers')}</a></li>
					</ul>

					<div class="tab-content" style="margin-top: 20px; min-height: 350px">
						<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.id Help=NOME_FORM_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.environment_id Help=NOME_FORM_environment_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.name Help=NOME_FORM_name}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.description Help=NOME_FORM_description}

							<div class="form-title-field">{$Captions->GetMessageString('LoadBalanceType')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.hash_type Help=NOME_FORM_hash_type ENUM=yes}

							<div class="form-title-field">{$Captions->GetMessageString('PHPInformation')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.cache_id Help=NOME_FORM_cache_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.php_version_id Help=NOME_FORM_php_version_id}

							<div class="form-title-field">{$Captions->GetMessageString('PortConnection')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.port_http Help=NOME_FORM_port_http}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.port_https Help=NOME_FORM_port_https}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.internal_ssl Help=NOME_FORM_internal_ssl}

							<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.active Help=NOME_FORM_active}
						</div>

						<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
							<div class="form-group col-sm-3 form-group-label">
								<label class="control-label">{$Captions->GetMessageString('caption_server')}:</label>
							</div>
							<div class="form-group col-sm-9">
								<div class="col-input" style="width:100%; max-width:100%" data-Col="server">
									{foreach item=Server from=$Servers}
										{if $Server.id|in_array:$PoolwebServers}<div>{$Server.hostname}</div>{/if}
									{/foreach}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        {include file="forms/actions_view.tpl" top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
    </div>
</div>
