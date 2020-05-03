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
						<li role="presentation"><a href="#page02-{$Grid.FormId}" aria-controls="page02-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageAddress')}</a></li>
					</ul>

					<div class="tab-content" style="margin-top: 20px; min-height: 350px">
						<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.domain_id Help=NOME_FORM_domain_id}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.username Help=NOME_FORM_username}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.name Help=NOME_FORM_name}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.local Help=NOME_FORM_local}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.description Help=NOME_FORM_description}

							<div class="form-title-field">{$Captions->GetMessageString('MeetingContact')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.contact Help=NOME_FORM_contact}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.email Help=NOME_FORM_email}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.phone Help=NOME_FORM_phone}
					
							<div class="form-title-field">{$Captions->GetMessageString('MeetingCapacity')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.capacity Help=NOME_FORM_capacity}

							<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.active Help=NOME_FORM_active}
						</div>

						<div role="tabpanel" class="tab-pane" id="page02-{$Grid.FormId}">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.street Help=NOME_FORM_street}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.floor Help=NOME_FORM_floor}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.building Help=NOME_FORM_building}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.city Help=NOME_FORM_city}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.state Help=NOME_FORM_state}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.postal_code Help=NOME_FORM_postal_code}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.country Help=NOME_FORM_country}
						</div>
					</div>
				</div>
			</div>
		</div>

		{include file="forms/actions_view.tpl" top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
	</div>
</div>
