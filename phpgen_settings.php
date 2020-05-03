<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
require_once dirname(__FILE__) . '/' . 'custom_functions.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('America/Sao_Paulo');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => 'mysql',
          'port' => '3306',
          'username' => 'root',
          'password' => 'password',
          'database' => 'epanel',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return true;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => 'GroupResalesAndClient', 'description' => '');
    $result[] = array('caption' => 'GroupServersAndPools', 'description' => '');
    $result[] = array('caption' => 'GroupDomainsAndSettings', 'description' => '');
    $result[] = array('caption' => 'GroupUsers', 'description' => '');
    $result[] = array('caption' => 'GroupZimbra', 'description' => '');
    $result[] = array('caption' => 'GroupMonitor', 'description' => '');
    $result[] = array('caption' => 'GroupSettings', 'description' => '');
    $result[] = array('caption' => 'GroupTrash', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'LabelResale', 'short_caption' => 'TitleResale', 'filename' => 'resale.php', 'name' => 'resale', 'group_name' => 'GroupResalesAndClient', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelClient', 'short_caption' => 'TitleClient', 'filename' => 'client.php', 'name' => 'client', 'group_name' => 'GroupResalesAndClient', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelContact', 'short_caption' => 'TitleContact', 'filename' => 'contact.php', 'name' => 'contact', 'group_name' => 'GroupResalesAndClient', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelServer', 'short_caption' => 'TitleServer', 'filename' => 'server.php', 'name' => 'server01', 'group_name' => 'GroupServersAndPools', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelPool', 'short_caption' => 'TitlePool', 'filename' => 'pool.php', 'name' => 'pool', 'group_name' => 'GroupServersAndPools', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelPoolWeb', 'short_caption' => 'TitlePoolWeb', 'filename' => 'poolweb.php', 'name' => 'poolweb', 'group_name' => 'GroupServersAndPools', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelPoolCache', 'short_caption' => 'TitlePoolCache', 'filename' => 'poolcache.php', 'name' => 'poolcache', 'group_name' => 'GroupServersAndPools', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelDomain', 'short_caption' => 'TitleDomain', 'filename' => 'domain.php', 'name' => 'domain', 'group_name' => 'GroupDomainsAndSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelCertificate', 'short_caption' => 'TitleCertificate', 'filename' => 'certificate.php', 'name' => 'certificate', 'group_name' => 'GroupDomainsAndSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelURL', 'short_caption' => 'TitleURL', 'filename' => 'url.php', 'name' => 'url', 'group_name' => 'GroupDomainsAndSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelUnixUser', 'short_caption' => 'TitleUnixUser', 'filename' => 'unix_user.php', 'name' => 'unix_user', 'group_name' => 'GroupUsers', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelFtpUser', 'short_caption' => 'TitleFtpUser', 'filename' => 'ftp_user.php', 'name' => 'ftp_user', 'group_name' => 'GroupUsers', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelAuthUrlUser', 'short_caption' => 'TitleAuthUrlUser', 'filename' => 'url_user.php', 'name' => 'url_user', 'group_name' => 'GroupUsers', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraAccount', 'short_caption' => 'TitleZimbraAccount', 'filename' => 'zimbra_account.php', 'name' => 'zimbra_account', 'group_name' => 'GroupZimbra', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraAlias', 'short_caption' => 'TitleZimbraAlias', 'filename' => 'zimbra_alias.php', 'name' => 'zimbra_alias', 'group_name' => 'GroupZimbra', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraMail', 'short_caption' => 'TitleZimbraMail', 'filename' => 'zimbra_mail.php', 'name' => 'zimbra_mail', 'group_name' => 'GroupZimbra', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraList', 'short_caption' => 'TitleZimbraList', 'filename' => 'zimbra_list.php', 'name' => 'zimbra_list', 'group_name' => 'GroupZimbra', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraListMail', 'short_caption' => 'TitleZimbraListMail', 'filename' => 'zimbra_list_mail.php', 'name' => 'zimbra_list_mail', 'group_name' => 'GroupZimbra', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraTrustedDomain', 'short_caption' => 'TitleZimbraTrustedDomain', 'filename' => 'zimbra_trusted_domain.php', 'name' => 'zimbra_trusted_domain', 'group_name' => 'GroupZimbra', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraTrustedIpUser', 'short_caption' => 'TitleZimbraTrustedIpUser', 'filename' => 'zimbra_trusted_ip_user.php', 'name' => 'zimbra_trusted_ip_user', 'group_name' => 'GroupZimbra', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraMeeting', 'short_caption' => 'TitleZimbraMeeting', 'filename' => 'zimbra_meeting.php', 'name' => 'zimbra_meeting', 'group_name' => 'GroupZimbra', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelAntispamBlackWhiteList', 'short_caption' => 'TitleAntispamBlackWhiteList', 'filename' => 'spam_blackwhite.php', 'name' => 'spam_blackwhite', 'group_name' => 'GroupZimbra', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelRestrictHost', 'short_caption' => 'TitleRestrictHost', 'filename' => 'restrict_host.php', 'name' => 'restrict_host', 'group_name' => 'GroupZimbra', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelOperationLog', 'short_caption' => 'TitleOperationLog', 'filename' => 'log.php', 'name' => 'log', 'group_name' => 'GroupMonitor', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelEnvironment', 'short_caption' => 'TitleEnvironment', 'filename' => 'environment.php', 'name' => 'environment', 'group_name' => 'GroupSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelConfig', 'short_caption' => 'TitleConfig', 'filename' => 'config.php', 'name' => 'config', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelServerMX', 'short_caption' => 'TitleServerMX', 'filename' => 'mx.php', 'name' => 'mx', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelAccountSize', 'short_caption' => 'TitleAccountSize', 'filename' => 'account_size.php', 'name' => 'account_size', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelParameter', 'short_caption' => 'TitleParameter', 'filename' => 'param.php', 'name' => 'param', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelParameterDetail', 'short_caption' => 'TitleParameterDetail', 'filename' => 'param_detail.php', 'name' => 'param_detail', 'group_name' => 'GroupSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelOpenBaseDir', 'short_caption' => 'TitleOpenBaseDir', 'filename' => 'openbasedir.php', 'name' => 'openbasedir', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelPhpVersion', 'short_caption' => 'TitlePhpVersion', 'filename' => 'php_version.php', 'name' => 'php_version', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelDirectiveApacheAndPHP', 'short_caption' => 'TitleDirectiveApacheAndPHP', 'filename' => 'directive.php', 'name' => 'directive', 'group_name' => 'GroupSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelProtection', 'short_caption' => 'TitleProtection', 'filename' => 'protection.php', 'name' => 'protection', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelPoolWebAndServer', 'short_caption' => 'TitlePoolWebAndServer', 'filename' => 'poolwebserver.php', 'name' => 'poolwebserver', 'group_name' => 'GroupSettings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelPoolCacheAndServer', 'short_caption' => 'TitlePoolCacheAndServer', 'filename' => 'poolcacheserver.php', 'name' => 'poolcacheserver', 'group_name' => 'GroupSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelDomainAndParameter', 'short_caption' => 'TitleDomainAndParameter', 'filename' => 'domain_param.php', 'name' => 'domain_param', 'group_name' => 'GroupSettings', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelDomainTrash', 'short_caption' => 'TitleDomainTrash', 'filename' => 'domain_trash.php', 'name' => 'domain01', 'group_name' => 'GroupTrash', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraAccountTrash', 'short_caption' => 'TitleZimbraAccountTrash', 'filename' => 'zimbra_account_trash.php', 'name' => 'zimbra_account01', 'group_name' => 'GroupTrash', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraAliasTrash', 'short_caption' => 'TitleZimbraAliasTrash', 'filename' => 'zimbra_alias_trash.php', 'name' => 'zimbra_alias01', 'group_name' => 'GroupTrash', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraMailTrash', 'short_caption' => 'TitleZimbraMailTrash', 'filename' => 'zimbra_mail_trash.php', 'name' => 'zimbra_mail01', 'group_name' => 'GroupTrash', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraListTrash', 'short_caption' => 'TitleZimbraListTrash', 'filename' => 'zimbra_list_trash.php', 'name' => 'zimbra_list01', 'group_name' => 'GroupTrash', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'LabelZimbraMeetingTrash', 'short_caption' => 'TitleZimbraMeetingTrash', 'filename' => 'zimbra_meeting_trash.php', 'name' => 'zimbra_meeting01', 'group_name' => 'GroupTrash', 'add_separator' => true, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        '';
}

function GetPagesFooter()
{
    return
        '';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_OnGetCustomPagePermissionsHandler(Page $page, PermissionSet &$permissions, &$handled)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{
    $list_form = array(
    	'default' 		=> 'custom_form_SUFFIX.tpl',
    	'resale' 		=> 'custom_form_resale_SUFFIX.tpl',
    	'client' 		=> 'custom_form_client_SUFFIX.tpl',
    	'server' 		=> 'custom_form_server_SUFFIX.tpl',
    	'pool'			=> 'custom_form_pool_SUFFIX.tpl',
    	'poolweb'		=> 'custom_form_poolweb_SUFFIX.tpl',
    	'poolcache'		=> 'custom_form_poolcache_SUFFIX.tpl',
    	'domain'		=> 'custom_form_domain_SUFFIX.tpl',
    	'url'			=> 'custom_form_url_SUFFIX.tpl',
    	'certificate'		=> 'custom_form_certificate_SUFFIX.tpl',
    	'unix_user'		=> 'custom_form_unix_user_SUFFIX.tpl',
    	'ftp_user'		=> 'custom_form_ftp_user_SUFFIX.tpl',
    	'url_user'		=> 'custom_form_url_user_SUFFIX.tpl',
    	'zimbra_account'	=> 'custom_form_zimbra_account_SUFFIX.tpl',
    	'zimbra_list'		=> 'custom_form_zimbra_list_SUFFIX.tpl',	
    	'zimbra_meeting'	=> 'custom_form_zimbra_meeting_SUFFIX.tpl',
    	'environment' 		=> 'custom_form_environment_SUFFIX.tpl',
    	'protection' 		=> 'custom_form_protection_SUFFIX.tpl'
    );
    
    if ($part == PagePart::RecordCard && $mode == PageMode::View) {
    	$form = $page->GetEnvVar('PAGE_ID');
    	$f = $list_form['default'];
    
    	if (array_key_exists($form, $list_form))
    		$f = $list_form[$form];
    
    	$result = str_replace('_SUFFIX', '_view', $f);
    } elseif ($part == PagePart::VerticalGrid && ($mode == PageMode::Edit || $mode == PageMode::Insert)) {
    	$result = 'custom_page_form.tpl';
    } elseif ($mode == PageMode::FormEdit || $mode == PageMode::FormInsert) {
    	$form = $page->GetEnvVar('PAGE_ID');
    	$f = $list_form['default'];
    
    	if (array_key_exists($form, $list_form))
    		$f = $list_form[$form];
    
    	$result = str_replace('_SUFFIX', '', $f);
    }
}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{
    $table = trim($tableName, '`');
    
    // Resale
    if ($table == 'resale') {
    	if ($fieldName == 'mail_size' || $fieldName == 'http_size' || $fieldName == 'backup_size') {
    		if ($value >= 1073741824) {
    			$value = $value/1024/1024/1024;
    		} elseif ($value >= 1048576) {
    			$value = $value/1024/1024;
    		} elseif ($value >= 1024) {
    			$value = $value/1024;
    		}
    	}
    }
    
    // Client
    elseif ($table == 'client') {
    	if ($fieldName == 'mail_size' || $fieldName == 'http_size' || $fieldName == 'backup_size') {
    		if ($value >= 1073741824) {
    			$value = $value/1024/1024/1024;
    		} elseif ($value >= 1048576) {
    			$value = $value/1024/1024;
    		} elseif ($value >= 1024) {
    			$value = $value/1024;
    		}
    	}
    }
    
    // Domain
    elseif ($table == 'domain') {
    	if ($fieldName == 'mail_size') {
    		if ($value >= 1073741824) {
    			$value = $value/1024/1024/1024;
    		} elseif ($value >= 1048576) {
    			$value = $value/1024/1024;
    		} elseif ($value >= 1024) {
    			$value = $value/1024;
    		}
    	} elseif ($fieldName == 'http_limit_rate') {
    		if ($value >= 1024) {
    			$value = $value/1024;
    		}
    	}
    
    }
}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{
    /*
    $pageList->addGroup('External links');
    
    $pageList->addPage(new PageLink('Home Site', 'http://www.mysite.com', 
        'Vist my site', false, false, 'External links'));
    
    $pageList->addPage(new PageLink('Get Support', 'http://www.mysite.com/support/',
        'Get support for this application', false, false, 'External links'));
    */
}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{
    $form = $page->GetEnvVar('PAGE_ID');
    
    // Resale
    if ($form == 'resale') {
    	if ($rowData['service_dns'] && empty($rowData['mx_id'])) {
    		$cancel = true;
    		$message = 'Informe o serviço MX padrão desta revenda.';
    	} elseif ($rowData['service_web'] && empty($rowData['web_rootdir'])) {
    		$cancel = true;
    		$message = 'Informe o web rootdir padrão desta revenda.';
    	}
    
    	// conversion
    	if (!$cancel) {
    		if (!empty($rowData['mail_size']))
    			$rowData['mail_size'] = $rowData['mail_size'] * 1024 * 1024 * 1024;
    
    		if (!empty($rowData['http_size']))
    			$rowData['http_size'] = $rowData['http_size'] * 1024 * 1024 * 1024;
    
    		if (!empty($rowData['backup_size']))
    			$rowData['backup_size'] = $rowData['backup_size'] * 1024 * 1024 * 1024;
    	}
    }
    
    // Client
    elseif ($form == 'client') {
    	if (($rowData['service_http'] || $rowData['service_ftp']) && empty($rowData['unix_user_id'])) {
    		$cancel = true;
    		$message = 'Para ativar o serviço Web e/ou FTP é necessário definir o usuário Unix.';
    	}
    
    	// conversion
    	if (!$cancel) {
    		if (!empty($rowData['mail_size']))
    			$rowData['mail_size'] = $rowData['mail_size'] * 1024 * 1024 * 1024;
    
    		if (!empty($rowData['http_size']))
    			$rowData['http_size'] = $rowData['http_size'] * 1024 * 1024 * 1024;
    
    		if (!empty($rowData['backup_size']))
    			$rowData['backup_size'] = $rowData['backup_size'] * 1024 * 1024 * 1024;
    	}
    }
    
    // Domain
    elseif ($form == 'domain') {
    	$SQL_DOMAIN = sprintf("SELECT id FROM domain WHERE domain = '%s' LIMIT 1",
    		$rowData['domain']);
    
    	if (getSQLValueID($page, $SQL_DOMAIN) > 0) {
    		$cancel = true;
    		$message = 'Este domínio já existe. Verifique na Lixeira se não está excluído!';
    	}
    
    	// conversion
    	if (!$cancel) {
    		if (!empty($rowData['mail_size']))
    			$rowData['mail_size'] = $rowData['mail_size'] * 1024 * 1024 * 1024;
    
    		if (!empty($rowData['http_limit_rate']))
    			$rowData['http_limit_rate'] = $rowData['http_limit_rate'] * 1024;
    	}
    }
    
    // Unix User
    elseif ($form == 'unix_user') {
    	if (empty($rowData['password'])) {
    		$rowData['password'] = '!*!';
    	} else {
    		$msg = validatePassword($page, 'password', $rowData['password']);
    	
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		}
    	}
    }
    
    // FTP User
    elseif ($form == 'ftp_user') {
    	$msg = validatePassword($page, 'password', $rowData['password']);
    	
    	if (!empty($msg)) {
    		$cancel = true;
    		$message = $msg;
    	} else {
    		$rowData['password'] = md5($rowData['password']);
    	}
    }
    
    // Auth URL User
    elseif ($form == 'auth_url_user') {
    	$msg = validatePassword($page, 'password', $rowData['password']);
    	
    	if (!empty($msg)) {
    		$cancel = true;
    		$message = $msg;
    	}
    
    	if (!$cancel) {
    		$salt = '';
    		$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    
    		for ($i=0; $i < 9; $i++) {
    			$salt .= $salt_chars[array_rand($salt_chars)];
    		}
    
    		$rowData['password'] = crypt($rowData['password'], '$1$' . $salt . '$');
    	}
    }
    
    // Zimbra Account
    elseif ($form == 'zimbra_account') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Esta conta já existe. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Existe um alias com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Existe uma lista com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Existe uma sala de reunião com este usuário!';
    	}
    	
            if ($cancel == false && $rowData['preauth_authentication']) {
    		$msg = validatePassword($page, 'preauth_authentication', $rowData['preauth_password']);
    		
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} elseif ($rowData['preauth_password_expire']) {
    			if (empty($rowData['preauth_password_expire_time'])) {
    				$cancel = true;
    				$message = 'Informe a data de expiração da senha ESWEB ou desmarque a opção.';
    			}
    		}
    		
    		if (!$cancel) {
    			$rowData['preauth_password'] = password_hash($rowData['preauth_password'], PASSWORD_DEFAULT);
    		}
    	}
    
            if ($cancel == false && $rowData['zimbra_authentication']) {
    		$msg = validatePassword($page, 'zimbra_authentication', $rowData['zimbra_password']);
    
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} elseif ($rowData['zimbra_password_expire']) {
    			if (empty($rowData['zimbra_password_expire_time'])) {
    				$cancel = true;
    				$message = 'Informe a data de expiração da senha Zimbra ou desmarque a opção.';
    			}
    		}
    	}
    	
            if (!$cancel && $rowData['zimbra_auto_reply']) {
    		if (empty(trim($rowData['zimbra_auto_reply_message']))) {
    			$cancel = true;
    			$message = 'Preencha o texto da mensagem automática!';
    		} elseif (empty($rowData['zimbra_auto_reply_time_start'])) {
    			$cancel = true;
    			$message = 'Informe a data/hora que irá iniciar a resposta automática.';
    		} elseif (empty($rowData['zimbra_auto_reply_time_stop'])) {
    			$cancel = true;
    			$message = 'Informe a data/hora que irá parar a resposta automática.';
    		} elseif ($rowData['zimbra_auto_reply_time_start'] >= $rowData['zimbra_auto_reply_time_stop']) {
    			$cancel = true;
    			$message = 'A data/hora que irá parar a resposta automática é menor que a data de início.';
    		}
    	}
    }
    
    // Zimbra Alias
    elseif ($form == 'zimbra_alias') {
    	list($user, $domain) = explode('@', $rowData['alias']);
    
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = '%s' LIMIT 1",
    		$rowData['alias']);
    
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    
    	$SQL_DOMAIN = sprintf("SELECT id FROM domain WHERE domain = '%s'",
    		$domain);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Este alias já existe!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Existe uma lista com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Existe uma sala de reunião com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_DOMAIN) == 0) {
    		$cancel = true;
    		$message = 'O domínio informado é inválido. Certifique-se de que esteja cadastrado em Domínios!';
    	}
    }
    
    // Zimbra Mail
    
    // Zimbra List
    elseif ($form == 'zimbra_list') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Existe um alias com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Esta lista já existe!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Existe uma sala de reunião com este usuário!';
    	}
    }
    
    // Zimbra Trusted Domain
    
    // Zimbra Trusted IP User
    elseif ($form == 'zimbra_trusted_ip_user') {
    	$cancel = true;
    	$message = 'ssdasdasdasd'; // REVISAR
    
    	if ($rowData['expire'] < SMDateTime::Now()) {
    		$cancel = true;
    		$message = 'Informe uma data maior que a data atual.';
    	}	
    }
    
    // Zimbra Meeting
    elseif ($form == 'zimbra_meeting') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Existe um alias com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Existe uma lista com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Esta sala de reunião já existe!';
    	}
    }
    
    // Zimbra Antispam
    
    // Zimbra Restrict Host
    
    // Environment
    elseif ($form == 'environment') {
    	$token = md5(uniqid(rand(), true));
    	$p1 = substr($token, 0, 8);
    	$p2 = substr($token, 8, 4);
    	$p3 = substr($token, 12, 4);
    	$p4 = substr($token, 16, 4);
    	$p5 = substr($token, 20, 12);
    	$rowData['uuid'] = "$p1-$p2-$p3-$p4-$p5";
    }
    
    // Action
    if (isset($rowData['action'])) {
    	if ($form == 'domain') {
    		if ($rowData['service_mail'])
    			$rowData['action'] = 'create';
    	} else {
    		$rowData['action'] = 'create';
    	}
    }
}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{
    $form = $page->GetEnvVar('PAGE_ID');
    
    // Resale
    if ($form == 'resale') {
    	if ($rowData['service_dns'] && empty($rowData['mx_id'])) {
    		$cancel = true;
    		$message = 'Informe o serviço MX padrão desta revenda.';
    	} elseif ($rowData['service_http'] && empty($rowData['web_rootdir'])) {
    		$cancel = true;
    		$message = 'Informe o web rootdir padrão desta revenda.';
    	}
    }
    
    // Client
    elseif ($form == 'client') {
    	if (($rowData['service_http'] || $rowData['service_ftp']) && empty($rowData['unix_user_id'])) {
    		$cancel = true;
    		$message = 'Para ativar o serviço Web e/ou FTP é necessário definir o usuário Unix.';
    	}
    }
    
    // Domain
    elseif ($form == 'domain') {
    	$SQL_DOMAIN = sprintf("SELECT id FROM domain WHERE domain = '%s' AND id <> '%d' LIMIT 1",
    		$rowData['domain'], $rowData['id']);
    
    	if (getSQLValueID($page, $SQL_DOMAIN) > 0) {
    		$cancel = true;
    		$message = 'Este domínio já existe. Verifique na Lixeira se não está excluído!';
    	}
    }
    
    // Unix User
    elseif ($form == 'unix_user') {
    	if ($rowData['password'] != $oldRowData['password']) {
    		if (empty($rowData['password'])) {
    			$rowData['password'] = '!*!';
    		} else {
    			$msg = validatePassword($page, 'password', $rowData['password']);
    	
    			if (!empty($msg)) {
    				$cancel = true;
    				$message = $msg;
    			} else {
    				$rowData['password'] = password_hash($rowData['password'], PASSWORD_DEFAULT);
    			}
    		}
    	}
    }
    
    // FTP User
    elseif ($form == 'ftp_user') {
    	if ($rowData['password'] != $oldRowData['password']) {
    		$msg = validatePassword($page, 'password', $rowData['password']);
    
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} else {
    			$rowData['password'] = md5($rowData['password']);
    		}
    	}
    }
    
    // Auth URL User
    elseif ($form == 'auth_url_user') {
    	if ($rowData['password'] != $oldRowData['password']) {
    		$msg = validatePassword($page, 'password', $rowData['password']);
    
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} else {
    			$salt = '';
    			$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    
    			for ($i=0; $i < 9; $i++) {
    				$salt .= $salt_chars[array_rand($salt_chars)];
    			}
    
    			$rowData['password'] = crypt($rowData['password'], '$1$' . $salt . '$');
    		}
    	}
    }
    
    // Zimbra Account
    elseif ($form == 'zimbra_account') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' AND id <> '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id'], $rowData['id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Já existe uma conta com este nome de usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Já existe um alias com este nome de usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Já existe uma lista com este nome de usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Já existe uma sala de reunião com este nome de usuário!';
    	}
    		
    	if (!$cancel && $rowData['preauth_authentication'] && 
    		($rowData['preauth_password'] != $oldRowData['preauth_password'])) {
    		$msg = validatePassword($page, 'preauth_authentication', $rowData['preauth_password']);
    		
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} elseif ($rowData['preauth_password_expire']) {
    			if (empty($rowData['preauth_password_expire_time'])) {
    				$cancel = true;
    				$message = 'Informe a data de expiração da senha ESWEB ou desmarque a opção.';
    			}
    		}
    
    		if (!$cancel) {
    			$rowData['preauth_password'] = password_hash($rowData['preauth_password'], PASSWORD_DEFAULT);
    		}
    	}
    	
    	if (!$cancel && $rowData['zimbra_authentication'] &&
    		($rowData['zimbra_password'] != $oldRowData['zimbra_password'])) {
    		$msg = validatePassword($page, 'zimbra_authentication', $rowData['zimbra_password']);
    		
    		if (!empty($msg)) {
    			$cancel = true;
    			$message = $msg;
    		} elseif ($rowData['zimbra_password_expire']) {
    			if (empty($rowData['zimbra_password_expire_time'])) {
    				$cancel = true;
    				$message = 'Informe a data de expiração da senha Zimbra ou desmarque a opção.';
    			}
    		}
    	}
    	
    	if (!$cancel && $rowData['zimbra_auto_reply']) {
    		if (empty(trim($rowData['zimbra_auto_reply_message']))) {
    			$cancel = true;
    			$message = 'Preencha o texto da mensagem automática!';
    		} elseif (empty($rowData['zimbra_auto_reply_time_start'])) {
    			$cancel = true;
    			$message = 'Informe a data/hora que irá iniciar a resposta automática.';
    		} elseif (empty($rowData['zimbra_auto_reply_time_stop'])) {
    			$cancel = true;
    			$message = 'Informe a data/hora que irá parar a resposta automática.';
    		} elseif ($rowData['zimbra_auto_reply_time_start'] >= $rowData['zimbra_auto_reply_time_stop']) {
    			$cancel = true;
    			$message = 'A data/hora que irá parar a resposta automática é menor que a data de início.';
    		}
    	}
    }
    
    // Zimbra Alias
    elseif ($form == 'zimbra_alias') {
    	list($user, $domain) = explode('@', $rowData['alias']);
    
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = '%s' LIMIT 1",
    		$rowData['alias']);
    
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = (SELECT id FROM domain WHERE domain = '%d') LIMIT 1",
    		$user, $domain);
    
    	$SQL_DOMAIN = sprintf("SELECT id FROM domain WHERE domain = '%s'",
    		$domain);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Este alias já existe!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Existe uma lista com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Existe uma sala de reunião com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_DOMAIN) == 0) {
    		$cancel = true;
    		$message = 'O domínio informado é inválido. Certifique-se de que esteja cadastrado em Domínios!';
    	}
    }
    
    // Zimbra List
    elseif ($form == 'zimbra_list') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' AND id <> '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id'], $rowData['id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Existe um alias com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Esta lista já existe!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Existe uma sala de reunião com este usuário!';
    	}
    }
    
    // Zimbra Trusted IP User
    elseif ($form == 'zimbra_trusted_ip_user') {
    	$cancel = true;
    	$message = 'ssdasdasdasd'; // REVISAR
    
    	if ($rowData['expire'] < SMDateTime::Now()) {
    		$cancel = true;
    		$message = 'Informe uma data maior que a data atual.';
    	}
    }
    
    // Zimbra Meeting
    elseif ($form == 'zimbra_meeting') {
    	$SQL_ACCOUNT = sprintf("SELECT id FROM zimbra_account WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    	
    	$SQL_ALIAS = sprintf("SELECT id FROM zimbra_alias WHERE alias = CONCAT('%s','@',(SELECT domain FROM domain WHERE id = '%d')) LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    		
    	$SQL_LIST = sprintf("SELECT id FROM zimbra_list WHERE username = '%s' AND domain_id = '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id']);
    
    	$SQL_MEETING = sprintf("SELECT id FROM zimbra_meeting WHERE username = '%s' AND domain_id = '%d' AND id <> '%d' LIMIT 1",
    		$rowData['username'], $rowData['domain_id'], $rowData['id']);
    
    	if (getSQLValueID($page, $SQL_ACCOUNT) > 0) {
    		$cancel = true;
    		$message = 'Existe uma conta com este usuário. Verifique na Lixeira se não está excluída!';
    	} elseif (getSQLValueID($page, $SQL_ALIAS) > 0) {
    		$cancel = true;
    		$message = 'Existe um alias com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_LIST) > 0) {
    		$cancel = true;
    		$message = 'Existe uma lista com este usuário!';
    	} elseif (getSQLValueID($page, $SQL_MEETING) > 0) {
    		$cancel = true;
    		$message = 'Esta sala de reunião já existe!';
    	}
    }
    // Action
    if (!in_array($form, array('zimbra_alias', 'zimbra_mail', 'zimbra_list_mail'))) {
    	if (isset($rowData['action']) and empty($oldRowData['action'])) {
    		foreach ($rowData as $key => $value) {
    			if ($key == 'created' or $key == 'updated') continue;
    			if ($rowData[$key] !== $oldRowData[$key]) {
    				if ($form == 'domain') {
    					if ($rowData['service_mail'])
    						$rowData['action'] = 'update';
    				} else {
    					$rowData['action'] = 'update';
    				}
    				break;
    			}
    		}
    	}
    }
}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{
    $form = $page->GetEnvVar('PAGE_ID');
    
    $delete = false;
    $id = $rowData['id'];
    
    // Domain
    if ($form == 'domain') {
    	$delete = true;
    	$SQL = "UPDATE domain SET deleted = 1, deleted_time = now(), action = 'delete', active = 0 WHERE id = '$id'";
    }
    
    // Zimbra Account
    elseif ($form == 'zimbra_account') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_account SET deleted = 1, deleted_time = now(), action = 'delete', active = 0 WHERE id = '$id'";
    }
    
    // Zimbra Alias
    elseif ($form == 'zimbra_alias') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_alias SET deleted = 1, deleted_time = now(), action = 'delete' WHERE id = '$id'";
    }
    
    // Zimbra Mail
    elseif ($form == 'zimbra_mail') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_mail SET deleted = 1, deleted_time = now(), action = 'delete' WHERE id = '$id'";
    }
    
    // Zimbra List
    elseif ($form == 'zimbra_list') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_list SET deleted = 1, deleted_time = now(), action = 'delete', active = 0 WHERE id = '$id'";
    }
    
    // Zimbra List Mail
    elseif ($form == 'zimbra_list_mail') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_list_mail SET deleted = 1, deleted_time = now(), action = 'delete' WHERE id = '$id'";
    }
    
    // Zimbra Meeting
    elseif ($form == 'zimbra_meeting') {
    	$delete = true;
    	$SQL = "UPDATE zimbra_meeting SET deleted = 1, deleted_time = now(), action = 'delete', active = 0 WHERE id = '$id'";
    }
    
    if ($delete) {
    	$cancel = true;
    	$page->GetConnection()->ExecSQL($SQL);
    }
}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{
    $form = $page->GetEnvVar('PAGE_ID');
    
    if ($success) {
    	$id = $page->GetConnection()->GetLastInsertId();
    	
    	if ($form == 'client') {
    		if ($rowData['service_mail'] &&
    			GetApplication()->IsPOSTValueSet('size_edit') &&
    			GetApplication()->IsPOSTValueSet('size_check_edit') &&
    			GetApplication()->IsPOSTValueSet('free_account_edit')) {
    			
    			$sizes = GetApplication()->GetPOSTValue('size_edit');
    			$sizes_check = GetApplication()->GetPOSTValue('size_check_edit');
    			$free_accounts = GetApplication()->GetPOSTValue('free_account_edit');
    			
    			$SQL = "INSERT INTO client_account_size (client_id, account_size_id, price, free_account) VALUES ";
    			$insert = false;
    
    			foreach ($sizes as $key => $value) {
    				if (isset($sizes_check[$key])) {
    					$free_account = $free_accounts[$key];
    					$SQL .= sprintf('(%d, %d, %.2f, %d),', $id, $key, $value, $free_account);
    					$insert = true;
    				}
    			}
    
    			if ($insert) {
    				$SQL = trim($SQL, ',');
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'pool') {
    		$id = $page->GetConnection()->GetLastInsertId();
    		$port = $id + 9300;
    		$SQL = "UPDATE pool SET port='$port' WHERE id='$id'";
    		$page->GetConnection()->ExecSQL($SQL);
    	} elseif ($form == 'poolweb') {
    		if (GetApplication()->IsPOSTValueSet('server_edit')) {
    			$servers = GetApplication()->GetPOSTValue('server_edit');
    			foreach ($servers as $server) {
    				$SQL = "INSERT INTO poolwebserver VALUES ($id, $server)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'poolcache') {
    		if (GetApplication()->IsPOSTValueSet('server_edit')) {
    			$servers = GetApplication()->GetPOSTValue('server_edit');
    			foreach ($servers as $server) {
    				$SQL = "INSERT INTO poolcacheserver VALUES ($id, $server)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'domain') {
    		if (GetApplication()->IsPOSTValueSet('parameter_edit')) {
    			$params = GetApplication()->GetPOSTValue('parameter_edit');
    			foreach ($params as $param) {
    				$SQL = "INSERT INTO domain_param VALUES ($id, $param, 1)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'unix_user') {
    		$u1 = $id + 100000;
    		$u2 = $id + 200000;  
    		$SQL = "UPDATE unix_user " .
    			"SET uid_ftp=%d, gid_ftp=%d, uid_http=%d, gid_http=%d " .
    			"WHERE id='%d'";
    
    		$SQL = sprintf($SQL, $u1, $u1, $u2, $u2, $id);
    		$page->GetConnection()->ExecSQL($SQL);
    	}
    
    	// Log Register
    	$userName = $page->GetEnvVar('CURRENT_USER_NAME');
    	$table = trim($tableName, '`');
    	$action = 'insert';
    	$ipAddress = $page->GetEnvVar('REMOTE_ADDR');
    	$values = '';
    
    	foreach ($rowData as $key => $value) {
    		if ($key == 'created' or $key == 'updated') continue;
    		$values .= "$key: <span class=\"log_value\">$value</span><br /> ";
    	}
    
    	$SQL = "INSERT INTO log (`username`, `table`, `action`, `ip`, `text`) " .
    		"VALUES ('$userName', '$table', '$action', '$ipAddress', '$values')";
    	$page->GetConnection()->ExecSQL($SQL);
    }
}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{
    $form = $page->GetEnvVar('PAGE_ID');
    
    if ($success) {
    	$id = $rowData['id'];
    
    	if ($form == 'resale') {
    		if (($rowData['mail_size']*1024*1024*1024 != $oldRowData['mail_size']) ||
    			($rowData['http_size']*1024*1024*1024 != $oldRowData['http_size']) ||
    			($rowData['backup_size']*1024*1024*1024 != $oldRowData['backup_size'])) {
    			$SQL = "UPDATE resale " .
    				"SET mail_size = mail_size*1024*1024*1024, " .
    				"http_size = http_size*1024*1024*1024, " .
    				"backup_size = backup_size*1024*1024*1024 " .
    				"WHERE id = $id";
    			$page->GetConnection()->ExecSQL($SQL);
    		}
    	} elseif ($form == 'client') {
    		if (($rowData['mail_size']*1024*1024*1024 != $oldRowData['mail_size']) ||
    			($rowData['http_size']*1024*1024*1024 != $oldRowData['http_size']) ||
    			($rowData['backup_size']*1024*1024*1024 != $oldRowData['backup_size'])) {
    			$SQL = "UPDATE client " .
    				"SET mail_size = mail_size*1024*1024*1024, " .
    				"http_size = http_size*1024*1024*1024, " .
    				"backup_size = backup_size*1024*1024*1024 " .
    				"WHERE id = $id";
    
    			$page->GetConnection()->ExecSQL($SQL);
    		}
    
    		if ($rowData['service_mail'] &&
    			GetApplication()->IsPOSTValueSet('size_edit') &&
    			GetApplication()->IsPOSTValueSet('size_check_edit') &&
    			GetApplication()->IsPOSTValueSet('free_account_edit')) {
    			$SQL = "DELETE FROM client_account_size WHERE client_id = $id";
    			$page->GetConnection()->ExecSQL($SQL);
    
    			$sizes = GetApplication()->GetPOSTValue('size_edit');
    			$sizes_check = GetApplication()->GetPOSTValue('size_check_edit');
    			$free_accounts = GetApplication()->GetPOSTValue('free_account_edit');
    			
    			$SQL = "INSERT INTO client_account_size (client_id, account_size_id, price, free_account) VALUES ";
    			$insert = false;
    
    			foreach ($sizes as $key => $value) {
    				if (isset($sizes_check[$key])) {
    					$free_account = $free_accounts[$key];
    					$SQL .= sprintf('(%d, %d, %.2f, %d),', $id, $key, $value, $free_account);
    					$insert = true;
    				}
    			}
    
    			if ($insert) {
    				$SQL = trim($SQL, ',');
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'poolweb') {
    		$SQL = "DELETE FROM poolwebserver WHERE poolweb_id = $id";
    		$page->GetConnection()->ExecSQL($SQL);
    		
    		if (GetApplication()->IsPOSTValueSet('server_edit')) {
    			$servers = GetApplication()->GetPOSTValue('server_edit');
    
    			foreach ($servers as $server) {
    				$SQL = "INSERT INTO poolwebserver VALUES ($id, $server)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'poolcache') {
    		$SQL = "DELETE FROM poolcacheserver WHERE poolcache_id = $id";
    		$page->GetConnection()->ExecSQL($SQL);
    		
    		if (GetApplication()->IsPOSTValueSet('server_edit')) {
    			$servers = GetApplication()->GetPOSTValue('server_edit');
    
    			foreach ($servers as $server) {
    				$SQL = "INSERT INTO poolcacheserver VALUES ($id, $server)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	} elseif ($form == 'domain') {
    		if (($rowData['mail_size']*1024*1024*1024 != $oldRowData['mail_size']) ||
    			($rowData['http_limit_rate']*1024 != $oldRowData['http_limit_rate'])) {
    			$SQL = "UPDATE domain " .
    				"SET mail_size = mail_size*1024*1024*1024, " .
    				"http_limit_rate = http_limit_rate*1024 " .
    				"WHERE id = $id";
    
    			$page->GetConnection()->ExecSQL($SQL);
    		}
    
    		$SQL = "DELETE FROM domain_param WHERE domain_id = $id";
    		$page->GetConnection()->ExecSQL($SQL);
    		
    		if (GetApplication()->IsPOSTValueSet('parameter_edit')) {
    			$params = GetApplication()->GetPOSTValue('parameter_edit');
    			
    			foreach ($params as $param) {
    				$SQL = "INSERT INTO domain_param VALUES ($id, $param, 1)";
    				$page->GetConnection()->ExecSQL($SQL);
    			}
    		}
    	}
    
    	// Log Register
    	$userName = $page->GetEnvVar('CURRENT_USER_NAME');
    	$table = trim($tableName, '`');
    	$action = 'update';
    	$ipAddress = $page->GetEnvVar('REMOTE_ADDR');
            $values = '';
    	$modified = false;
    
    	foreach ($rowData as $key => $value) {
    		if ($key == 'created' or $key == 'updated') continue;
    		if ($key == 'id') $values .= "$key: <span class=\"log_value\">$value</span><br /> ";
    		if ($rowData[$key] !== $oldRowData[$key]) {
    			$modified = true;
    			$values .= "$key: <span class=\"log_value\">$value</span><br /> ";
    		}
    	}
    
    	if ($modified) {
    		$SQL = "INSERT INTO log (`username`, `table`, `action`, `ip`, `text`) " .
    			"VALUES ('$userName', '$table', '$action', '$ipAddress', '$values')";
    		$page->GetConnection()->ExecSQL($SQL);
    	}
    }
}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{
    if ($success) {
    	// Log Register
    	$userName = $page->GetEnvVar('CURRENT_USER_NAME');
    	$table = trim($tableName, '`');
    	$action = 'delete';
    	$ipAddress = $page->GetEnvVar('REMOTE_ADDR');
            $values = '';
    
    	foreach ($rowData as $key => $value) {
    		$values .= "$key: <span class=\"log_value\">$value</span><br /> ";
    	}
    
    	$SQL = "INSERT INTO log (`username`, `table`, `action`, `ip`, `text`) " .
    		"VALUES ('$userName', '$table', '$action', '$ipAddress', '$values')";
    	$page->GetConnection()->ExecSQL($SQL);
    }
}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_MENU;
}

function GetNullLabel()
{
    return '';
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 1800;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, 'hostmaster@esweb.com.br', 'EPANEL');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}
