var default_values = [];

const resale_services = {
	'service_dns':['dns_note', 'mx_id'],
	'service_mail':['mail_note', 'type_plan', 'server_id', 'mail_max_domain', 
			'mail_max_account', 'mail_max_alias', 'mail_max_forward',
			'mail_size'],
	'service_http':['http_note', 'http_max_hosting', 'http_max_virtualhost',
			'http_max_db', 'http_size', 'web_rootdir'],
	'service_ftp':['ftp_note', 'ftp_max_user'],
	'service_smtp':['smtp_note', 'smtp_max_send', 'smtp_type_limit'],
	'service_backup':['backup_note', 'backup_size'],
	'service_mkmail':['mkmail_note'],
	'service_ts':['ts_note'],
	'service_ip_dedicate':['ip_dedicate_note'],
	'service_other':['other_note']
};

const client_services = {
	'service_dns':['dns_note'],
	'service_mail':['mail_note', 'type_plan', 'mail_max_domain', 'mail_max_account',
			'mail_max_alias', 'mail_max_forward', 'mail_size'],
	'service_http':['http_note', 'http_max_hosting',
			'http_max_virtualhost', 'http_max_db', 'http_size'], 
	'service_ftp':['ftp_note', 'ftp_max_user', 'unix_user_id'],
	'service_smtp':['smtp_note', 'smtp_max_send', 'smtp_type_limit'],
	'service_backup':['backup_note', 'backup_email', 'backup_size',
		'backup_server_type_connect', 'backup_server_host', 'backup_server_port',
		'backup_server_os', 'backup_server_user', 'backup_server_password'],
	'service_mkmail':['mkmail_note'], 
	'service_ts':['ts_note'],
	'service_ip_dedicate':['ip_dedicate_note'],
	'service_other':['other_note'], 
};

const domain_services = {
	'service_dns':['dns_transfer', 'mx_id'],
	'service_mail':['mail_max_account', 'mail_max_alias', 'mail_max_forward', 
		'mail_size', 'mail_domain_preauth_esweb', 'mail_domain_restrict_login'],
	'service_http':['domain_root', 'redirect', 'server_id', 'poolweb_id', 'homedir',
		'http_exploredir', 'http_showmsgerror', 'http_wildcard',
		'http_force_www', 'http_suspended', 'http_authurl',
		'http_limit_rate', 'http_php_openbasedir_id',
		'http_php_cache', 'http_php_suhosin', 'certificate_id',
		'http_force_ssl', 'protection_id', 'http_waf'],
	'service_ftp':['dir', 'unix_user_id']
};

const zimbra_account_services = {
	'preauth_authentication':['preauth_password', 'preauth_password_must_change',
		'preauth_password_locked', 'preauth_password_expire',
		'preauth_password_expire_time', 'preauth_restrict_login',
		'preauth_access_other_account'],
	'zimbra_authentication':['zimbra_password', 'zimbra_password_must_change',
		'zimbra_password_locked', 'zimbra_password_expire', 'zimbra_password_expire_time',
		'zimbra_hide_of_contacts'],
	'zimbra_auto_reply':['zimbra_auto_reply_message', 'zimbra_auto_reply_time_start',
		'zimbra_auto_reply_time_stop']
};

const protection_services = {
	'sts':[ 'sts_max_age', 'sts_includesubdomains', 'sts_preload', 'sts_always'],
	'x_frame':[ 'x_frame_options', 'x_frame_url', 'x_content_nosniff', 'x_xss'],
	'cors':['cors_origin', 'cors_credential', 'cors_always', 'cors_methods', 
			'cors_method_get', 'cors_method_head', 'cors_method_post', 
			'cors_method_put', 'cors_method_delete', 'cors_method_connect',
			'cors_method_options', 'cors_method_trace', 'cors_method_patch', 
			'cors_headers', 'cors_headers_options', 'cors_max_age']
};

// resale, client, domain, zimbra_account, protection
function showFormLoad(services, editors)
{
	var v = '';

	try
        {
		for (i in editors)
		{
			v = editors[i].rootElement.fieldValue()[0];
			if (v == undefined) v = null;
			default_values[i] = v;
		}

		for (i in services)
		{
			if (editors[i].getValue() || editors[i].getValue() === '')
			{
				document.getElementById('form_' + i).style.visibility = '';
			}
			else
			{
				document.getElementById('form_' + i).style.visibility = 'hidden';
			}
		}
	}
        catch (e)
        {
		console.log(e);
	}
}

// resale, client, domain, zimbra_account, protection
function showFormValueChanged(services, sender, editors)
{
	var s = sender.getFieldName();

	try
        {
		for (i in services)
		{
			if (i == s)
			{
				if (editors[i].getValue())
				{
					document.getElementById('form_' + i).style.visibility = '';
				}
				else
				{
					document.getElementById('form_' + i).style.visibility = 'hidden';

					for (f of services[i])
					{
						editors[f].setValue(default_values[f]);
					}
				}
				break;
			}
		}
	}
        catch (e)
        {
		console.log(e);
	}
}