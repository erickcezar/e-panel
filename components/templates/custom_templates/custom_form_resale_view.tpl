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
					<li role="presentation"><a href="#page03-{$Grid.FormId}" aria-controls="page03-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvDNS')}</a></li>
					<li role="presentation"><a href="#page04-{$Grid.FormId}" aria-controls="page04-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvMail')}</a></li>
					<li role="presentation"><a href="#page05-{$Grid.FormId}" aria-controls="page05-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvWeb')}</a></li>
					<li role="presentation"><a href="#page06-{$Grid.FormId}" aria-controls="page06-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvFTP')}</a></li>
					<li role="presentation"><a href="#page07-{$Grid.FormId}" aria-controls="page07-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvSMTP')}</a></li>
					<li role="presentation"><a href="#page08-{$Grid.FormId}" aria-controls="page08-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvBackup')}</a></li>
					<li role="presentation"><a href="#page09-{$Grid.FormId}" aria-controls="page09-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvMKmail')}</a></li>
					<li role="presentation"><a href="#page10-{$Grid.FormId}" aria-controls="page10-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvTS')}</a></li>
					<li role="presentation"><a href="#page11-{$Grid.FormId}" aria-controls="page11-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvIPDedicate')}</a></li>
					<li role="presentation"><a href="#page12-{$Grid.FormId}" aria-controls="page12-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageSrvOther')}</a></li>
					<li role="presentation"><a href="#page13-{$Grid.FormId}" aria-controls="page13-{$Grid.FormId}" role="tab" data-toggle="tab">{$Captions->GetMessageString('PageContacts')}</a></li>
				</ul>

				<div class="tab-content" style="margin-top: 20px; min-height: 350px">
					<div role="tabpanel" class="tab-pane active" id="page01-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.id Help=NOME_FORM_id}
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.name Help=NOME_FORM_name}
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.description Help=NOME_FORM_description}
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.site Help=NOME_FORM_site}
						
						<div class="form-title-field">{$Captions->GetMessageString('Limits')}</div>
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.max_domain Help=NOME_FORM_max_domain}

						<div class="form-title-field">{$Captions->GetMessageString('Agreement')}</div>
						alguma coisa

						<div class="form-title-field">{$Captions->GetMessageString('Active')}</div>
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.active Help=NOME_FORM_active}
					</div>

					<div role="tabpanel" class="tab-pane" id="page03-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_dns Help=NOME_FORM_service_dns}
						
						<div id="form_service_dns">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.dns_note Help=NOME_FORM_dns_note}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mx_id Help=NOME_FORM_mx_id}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page04-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_mail Help=NOME_FORM_service_mail}
						
						<div id="form_service_mail">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_note Help=NOME_FORM_mail_note}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.type_plan Help=NOME_FORM_type_plan ENUM=yes}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.server_id Help=NOME_FORM_server_id}
							
							<div class="form-title-field">{$Captions->GetMessageString('Limits')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_max_domain Help=NOME_FORM_mail_max_domain}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_max_account Help=NOME_FORM_mail_max_account}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_max_alias Help=NOME_FORM_mail_max_alias}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_max_forward Help=NOME_FORM_mail_max_forward}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mail_size Help=NOME_FORM_mail_size ButtonLabel=GB}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page05-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_http Help=NOME_FORM_service_http}
						
						<div id="form_service_http">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.http_note Help=NOME_FORM_http_note}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.web_rootdir Help=NOME_FORM_web_rootdir Button=yes ButtonIcon=icon-page-refresh}
							
							<div class="form-title-field">{$Captions->GetMessageString('Limits')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.http_max_hosting Help=NOME_FORM_http_max_hosting}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.http_max_virtualhost Help=NOME_FORM_http_max_virtualhost}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.http_max_db Help=NOME_FORM_http_max_db}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.http_size Help=NOME_FORM_http_size ButtonLabel=GB}
						</div>
					</div>
						
					<div role="tabpanel" class="tab-pane" id="page06-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_ftp Help=NOME_FORM_service_ftp}

						<div id="form_service_ftp">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ftp_note Help=NOME_FORM_ftp_note}
							
							<div class="form-title-field">{$Captions->GetMessageString('Limits')}</div>
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ftp_max_user Help=NOME_FORM_ftp_max_user}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page07-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_smtp Help=NOME_FORM_service_smtp}
						
						<div id="form_service_smtp">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.smtp_note Help=NOME_FORM_smtp_note}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.smtp_max_send Help=NOME_FORM_smtp_max_send}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.smtp_type_limit Help=NOME_FORM_smtp_type_limit ENUM=yes}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page08-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_backup Help=NOME_FORM_service_backup}
						
						<div id="form_service_backup">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.backup_note Help=NOME_FORM_backup_note}
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.backup_size Help=NOME_FORM_backup_size ButtonLabel=GB}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page09-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_mkmail Help=NOME_FORM_service_mkmail}
						
						<div id="form_service_mkmail">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.mkmail_note Help=NOME_FORM_mkmail_note}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page10-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_ts Help=NOME_FORM_service_ts}
						
						<div id="form_service_ts">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ts_note Help=NOME_FORM_ts_note}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page11-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_ip_dedicate Help=NOME_FORM_service_ip_dedicate}
						
						<div id="form_service_ip_dedicate">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.ip_dedicate_note Help=NOME_FORM_ip_dedicate_note}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page12-{$Grid.FormId}">
						{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.service_other Help=NOME_FORM_service_other}
						
						<div id="form_service_other">
							{include file="custom_templates/custom_form_view_column.tpl" Col=$Columns.other_note Help=NOME_FORM_other_note}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="page13-{$Grid.FormId}">
						<table class="table text-center table-striped table-hover table-condensed">
							<thead class="js-column-filter-container">
								<tr>
									<th>{$Captions->GetMessageString('caption_name')}</th>
									<th>{$Captions->GetMessageString('caption_email')}</th>
									<th>{$Captions->GetMessageString('caption_phone')}</th>
								</tr>
							</thead>
							<tbody class="pg-row-list">
							{foreach item=Contact from=$Contacts}
								<tr class="pg-row">
									<td><div style="text-align: left;">{$Contact.name}</div></td>
									<td><div style="text-align: left;">{$Contact.mail}</div></td>
									<td><div style="text-align: left;">{$Contact.phone}</div></td>
								</tr>
							{/foreach}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		{include file="forms/actions_view.tpl" top=false isHorizontal=$Grid.FormLayout->isHorizontal()}
	</div>
</div>
