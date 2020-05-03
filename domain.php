<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    class domain_mx_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[a-zA-Z0-9._-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zone field
            //
            $editor = new TextAreaEdit('zone_edit', 50, 20);
            $editColumn = new CustomEditColumn('caption_zone', 'zone', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    class domain_server_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $this->dataset->AddLookupField('environment_id', 'environment', new IntegerField('id'), new StringField('name', false, false, false, false, 'environment_id_name', 'environment_id_name_environment'), 'environment_id_name_environment');
            $this->dataset->AddLookupField('php_version_id', 'php_version', new IntegerField('id'), new StringField('version', false, false, false, false, 'php_version_id_version', 'php_version_id_version_php_version'), 'php_version_id_version_php_version');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for environment_id field
            //
            $editor = new DynamicCombobox('environment_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`environment`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('uuid', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_environment_id', 'environment_id', 'environment_id_name', 'insert_domain_server_idNestedPage_environment_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for hostname field
            //
            $editor = new TextEdit('hostname_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_hostname', 'hostname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for uuid field
            //
            $editor = new TextEdit('uuid_edit');
            $editor->SetMaxLength(36);
            $editColumn = new CustomEditColumn('caption_uuid', 'uuid', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    class domain_certificate_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $this->dataset->AddLookupField('client_id', '`client`', new IntegerField('id'), new StringField('name', false, false, false, false, 'client_id_name', 'client_id_name_client'), 'client_id_name_client');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for client_id field
            //
            $editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'insert_domain_certificate_idNestedPage_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class domainPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleDomain');
            $this->SetMenuLabel('LabelDomain');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $this->dataset->AddLookupField('client_id', '`client`', new IntegerField('id'), new StringField('name', false, false, false, false, 'client_id_name', 'client_id_name_client'), 'client_id_name_client');
            $this->dataset->AddLookupField('mx_id', 'mx', new IntegerField('id'), new StringField('name', false, false, false, false, 'mx_id_name', 'mx_id_name_mx'), 'mx_id_name_mx');
            $this->dataset->AddLookupField('domain_root', 'domain', new StringField('domain'), new StringField('domain', false, false, false, false, 'domain_root_domain', 'domain_root_domain_domain'), 'domain_root_domain_domain');
            $this->dataset->AddLookupField('server_id', '`server`', new IntegerField('id'), new StringField('hostname', false, false, false, false, 'server_id_hostname', 'server_id_hostname_server'), 'server_id_hostname_server');
            $this->dataset->AddLookupField('poolweb_id', 'poolweb', new IntegerField('id'), new StringField('name', false, false, false, false, 'poolweb_id_name', 'poolweb_id_name_poolweb'), 'poolweb_id_name_poolweb');
            $this->dataset->AddLookupField('http_php_openbasedir_id', 'openbasedir', new IntegerField('id'), new StringField('name', false, false, false, false, 'http_php_openbasedir_id_name', 'http_php_openbasedir_id_name_openbasedir'), 'http_php_openbasedir_id_name_openbasedir');
            $this->dataset->AddLookupField('certificate_id', 'certificate', new IntegerField('id'), new StringField('name', false, false, false, false, 'certificate_id_name', 'certificate_id_name_certificate'), 'certificate_id_name_certificate');
            $this->dataset->AddLookupField('protection_id', 'protection', new IntegerField('id'), new StringField('name', false, false, false, false, 'protection_id_name', 'protection_id_name_protection'), 'protection_id_name_protection');
            $this->dataset->AddLookupField('unix_user_id', 'unix_user', new IntegerField('id'), new StringField('username', false, false, false, false, 'unix_user_id_username', 'unix_user_id_username_unix_user'), 'unix_user_id_username_unix_user');
            $this->dataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`domain`.`deleted` = 0)'));
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'caption_id'),
                new FilterColumn($this->dataset, 'client_id', 'client_id_name', 'caption_client_id'),
                new FilterColumn($this->dataset, 'domain', 'domain', 'caption_domain'),
                new FilterColumn($this->dataset, 'service_dns', 'service_dns', 'caption_service_dns'),
                new FilterColumn($this->dataset, 'dns_transfer', 'dns_transfer', 'caption_dns_transfer'),
                new FilterColumn($this->dataset, 'mx_id', 'mx_id_name', 'caption_mx_id'),
                new FilterColumn($this->dataset, 'service_mail', 'service_mail', 'caption_service_mail'),
                new FilterColumn($this->dataset, 'mail_max_account', 'mail_max_account', 'caption_mail_max_account'),
                new FilterColumn($this->dataset, 'mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias'),
                new FilterColumn($this->dataset, 'mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward'),
                new FilterColumn($this->dataset, 'mail_size', 'mail_size', 'caption_mail_size'),
                new FilterColumn($this->dataset, 'mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', 'caption_mail_domain_preauth_esweb'),
                new FilterColumn($this->dataset, 'mail_domain_restrict_login', 'mail_domain_restrict_login', 'caption_mail_domain_restrict_login'),
                new FilterColumn($this->dataset, 'mail_zimbra_key', 'mail_zimbra_key', 'caption_mail_zimbra_key'),
                new FilterColumn($this->dataset, 'service_http', 'service_http', 'caption_service_http'),
                new FilterColumn($this->dataset, 'domain_root', 'domain_root_domain', 'caption_domain_root'),
                new FilterColumn($this->dataset, 'redirect', 'redirect', 'caption_redirect'),
                new FilterColumn($this->dataset, 'server_id', 'server_id_hostname', 'caption_server_id'),
                new FilterColumn($this->dataset, 'poolweb_id', 'poolweb_id_name', 'caption_poolweb_id'),
                new FilterColumn($this->dataset, 'homedir', 'homedir', 'caption_homedir'),
                new FilterColumn($this->dataset, 'http_exploredir', 'http_exploredir', 'caption_http_exploredir'),
                new FilterColumn($this->dataset, 'http_showmsgerror', 'http_showmsgerror', 'caption_http_showmsgerror'),
                new FilterColumn($this->dataset, 'http_wildcard', 'http_wildcard', 'caption_http_wildcard'),
                new FilterColumn($this->dataset, 'http_force_www', 'http_force_www', 'caption_http_force_www'),
                new FilterColumn($this->dataset, 'http_suspended', 'http_suspended', 'caption_http_suspended'),
                new FilterColumn($this->dataset, 'http_authurl', 'http_authurl', 'caption_http_authurl'),
                new FilterColumn($this->dataset, 'http_limit_rate', 'http_limit_rate', 'caption_http_limit_rate'),
                new FilterColumn($this->dataset, 'http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'caption_http_php_openbasedir_id'),
                new FilterColumn($this->dataset, 'http_php_cache', 'http_php_cache', 'caption_http_php_cache'),
                new FilterColumn($this->dataset, 'http_php_suhosin', 'http_php_suhosin', 'caption_http_php_suhosin'),
                new FilterColumn($this->dataset, 'certificate_id', 'certificate_id_name', 'caption_certificate_id'),
                new FilterColumn($this->dataset, 'http_force_ssl', 'http_force_ssl', 'caption_http_force_ssl'),
                new FilterColumn($this->dataset, 'protection_id', 'protection_id_name', 'caption_protection_id'),
                new FilterColumn($this->dataset, 'http_waf', 'http_waf', 'caption_http_waf'),
                new FilterColumn($this->dataset, 'service_ftp', 'service_ftp', 'caption_service_ftp'),
                new FilterColumn($this->dataset, 'dir', 'dir', 'caption_dir'),
                new FilterColumn($this->dataset, 'unix_user_id', 'unix_user_id_username', 'caption_unix_user_id'),
                new FilterColumn($this->dataset, 'locked', 'locked', 'caption_locked'),
                new FilterColumn($this->dataset, 'deleted', 'deleted', 'caption_deleted'),
                new FilterColumn($this->dataset, 'deleted_time', 'deleted_time', 'caption_deleted_time'),
                new FilterColumn($this->dataset, 'zimbra_id', 'zimbra_id', 'caption_zimbra_id'),
                new FilterColumn($this->dataset, 'action', 'action', 'caption_action'),
                new FilterColumn($this->dataset, 'active', 'active', 'caption_active'),
                new FilterColumn($this->dataset, 'created', 'created', 'caption_created'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'caption_updated')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['client_id'])
                ->addColumn($columns['domain'])
                ->addColumn($columns['service_dns'])
                ->addColumn($columns['dns_transfer'])
                ->addColumn($columns['mx_id'])
                ->addColumn($columns['service_mail'])
                ->addColumn($columns['mail_max_account'])
                ->addColumn($columns['mail_max_alias'])
                ->addColumn($columns['mail_max_forward'])
                ->addColumn($columns['mail_size'])
                ->addColumn($columns['mail_domain_preauth_esweb'])
                ->addColumn($columns['mail_domain_restrict_login'])
                ->addColumn($columns['service_http'])
                ->addColumn($columns['domain_root'])
                ->addColumn($columns['redirect'])
                ->addColumn($columns['server_id'])
                ->addColumn($columns['poolweb_id'])
                ->addColumn($columns['homedir'])
                ->addColumn($columns['http_exploredir'])
                ->addColumn($columns['http_showmsgerror'])
                ->addColumn($columns['http_wildcard'])
                ->addColumn($columns['http_force_www'])
                ->addColumn($columns['http_suspended'])
                ->addColumn($columns['http_authurl'])
                ->addColumn($columns['http_limit_rate'])
                ->addColumn($columns['http_php_openbasedir_id'])
                ->addColumn($columns['http_php_cache'])
                ->addColumn($columns['http_php_suhosin'])
                ->addColumn($columns['certificate_id'])
                ->addColumn($columns['http_force_ssl'])
                ->addColumn($columns['protection_id'])
                ->addColumn($columns['http_waf'])
                ->addColumn($columns['service_ftp'])
                ->addColumn($columns['dir'])
                ->addColumn($columns['unix_user_id'])
                ->addColumn($columns['locked'])
                ->addColumn($columns['zimbra_id'])
                ->addColumn($columns['active'])
                ->addColumn($columns['created'])
                ->addColumn($columns['updated']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('client_id')
                ->setOptionsFor('domain')
                ->setOptionsFor('updated');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            $main_editor->setCustomAttributes('page01');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $main_editor->setCustomAttributes('page01');
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_client_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('client_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_client_id_search');
            
            $filterBuilder->addColumn(
                $columns['client_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('domain_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['domain'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('service_dns');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_dns'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('dns_transfer');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['dns_transfer'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('mx_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_mx_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('mx_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_mx_id_search');
            
            $text_editor = new TextEdit('mx_id');
            
            $filterBuilder->addColumn(
                $columns['mx_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('service_mail');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_mail'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mail_max_account_edit');
            
            $filterBuilder->addColumn(
                $columns['mail_max_account'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mail_max_alias_edit');
            
            $filterBuilder->addColumn(
                $columns['mail_max_alias'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mail_max_forward_edit');
            
            $filterBuilder->addColumn(
                $columns['mail_max_forward'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mail_size_edit');
            
            $filterBuilder->addColumn(
                $columns['mail_size'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('mail_domain_preauth_esweb');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['mail_domain_preauth_esweb'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('mail_domain_restrict_login');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['mail_domain_restrict_login'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('service_http');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_http'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('domain_root_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_domain_root_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('domain_root', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_domain_root_search');
            
            $text_editor = new TextEdit('domain_root');
            
            $filterBuilder->addColumn(
                $columns['domain_root'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('redirect_edit');
            
            $filterBuilder->addColumn(
                $columns['redirect'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('server_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_server_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('server_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_server_id_search');
            
            $filterBuilder->addColumn(
                $columns['server_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('poolweb_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_poolweb_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('poolweb_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_poolweb_id_search');
            
            $text_editor = new TextEdit('poolweb_id');
            
            $filterBuilder->addColumn(
                $columns['poolweb_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('homedir_edit');
            
            $filterBuilder->addColumn(
                $columns['homedir'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_exploredir');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_exploredir'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_showmsgerror');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_showmsgerror'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_wildcard');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_wildcard'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_force_www');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_force_www'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_suspended');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_suspended'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_authurl');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_authurl'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('http_limit_rate_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['http_limit_rate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('http_php_openbasedir_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_http_php_openbasedir_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('http_php_openbasedir_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_http_php_openbasedir_id_search');
            
            $text_editor = new TextEdit('http_php_openbasedir_id');
            
            $filterBuilder->addColumn(
                $columns['http_php_openbasedir_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_php_cache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('opcache', 'value_caption_opcache');
            $main_editor->addChoice('xcache', 'value_caption_xcache');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('http_php_cache');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('http_php_cache');
            
            $filterBuilder->addColumn(
                $columns['http_php_cache'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_php_suhosin');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_php_suhosin'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('certificate_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_certificate_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('certificate_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_certificate_id_search');
            
            $text_editor = new TextEdit('certificate_id');
            
            $filterBuilder->addColumn(
                $columns['certificate_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_force_ssl');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_force_ssl'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('protection_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_protection_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('protection_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_protection_id_search');
            
            $text_editor = new TextEdit('protection_id');
            
            $filterBuilder->addColumn(
                $columns['protection_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('http_waf');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['http_waf'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('service_ftp');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_ftp'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('dir');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['dir'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('unix_user_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_unix_user_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('unix_user_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_unix_user_id_search');
            
            $text_editor = new TextEdit('unix_user_id');
            
            $filterBuilder->addColumn(
                $columns['unix_user_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('locked');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['locked'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('zimbra_id_edit');
            $main_editor->SetMaxLength(36);
            
            $filterBuilder->addColumn(
                $columns['zimbra_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('active');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['active'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['created'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['updated'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_RIGHT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_client_id');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain', 'domain', 'caption_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_domain');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_dns');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_mail field
            //
            $column = new CheckboxViewColumn('service_mail', 'service_mail', 'caption_service_mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_mail');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mail_max_account field
            //
            $column = new NumberViewColumn('mail_max_account', 'mail_max_account', 'caption_mail_max_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_mail_max_account');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mail_max_alias field
            //
            $column = new NumberViewColumn('mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_mail_max_alias');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mail_max_forward field
            //
            $column = new NumberViewColumn('mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_mail_max_forward');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mail_size field
            //
            $column = new NumberViewColumn('mail_size', 'mail_size', 'caption_mail_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_domain_mail_size');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_http');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_ftp');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for locked field
            //
            $column = new CheckboxViewColumn('locked', 'locked', 'caption_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_locked');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_active');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'caption_updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain', 'domain', 'caption_domain', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for dns_transfer field
            //
            $column = new CheckboxViewColumn('dns_transfer', 'dns_transfer', 'caption_dns_transfer', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('mx_id', 'mx_id_name', 'caption_mx_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_mail field
            //
            $column = new CheckboxViewColumn('service_mail', 'service_mail', 'caption_service_mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_max_account field
            //
            $column = new NumberViewColumn('mail_max_account', 'mail_max_account', 'caption_mail_max_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_max_alias field
            //
            $column = new NumberViewColumn('mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_max_forward field
            //
            $column = new NumberViewColumn('mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_size field
            //
            $column = new NumberViewColumn('mail_size', 'mail_size', 'caption_mail_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_domain_preauth_esweb field
            //
            $column = new CheckboxViewColumn('mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', 'caption_mail_domain_preauth_esweb', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_domain_restrict_login field
            //
            $column = new CheckboxViewColumn('mail_domain_restrict_login', 'mail_domain_restrict_login', 'caption_mail_domain_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_root', 'domain_root_domain', 'caption_domain_root', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_redirect_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('poolweb_id', 'poolweb_id_name', 'caption_poolweb_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_homedir_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_exploredir field
            //
            $column = new CheckboxViewColumn('http_exploredir', 'http_exploredir', 'caption_http_exploredir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_showmsgerror field
            //
            $column = new CheckboxViewColumn('http_showmsgerror', 'http_showmsgerror', 'caption_http_showmsgerror', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_wildcard field
            //
            $column = new CheckboxViewColumn('http_wildcard', 'http_wildcard', 'caption_http_wildcard', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_force_www field
            //
            $column = new CheckboxViewColumn('http_force_www', 'http_force_www', 'caption_http_force_www', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_suspended field
            //
            $column = new CheckboxViewColumn('http_suspended', 'http_suspended', 'caption_http_suspended', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_authurl field
            //
            $column = new CheckboxViewColumn('http_authurl', 'http_authurl', 'caption_http_authurl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_limit_rate field
            //
            $column = new TextViewColumn('http_limit_rate', 'http_limit_rate', 'caption_http_limit_rate', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'caption_http_php_openbasedir_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_php_cache field
            //
            $column = new TextViewColumn('http_php_cache', 'http_php_cache', 'caption_http_php_cache', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_php_suhosin field
            //
            $column = new CheckboxViewColumn('http_php_suhosin', 'http_php_suhosin', 'caption_http_php_suhosin', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('certificate_id', 'certificate_id_name', 'caption_certificate_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_force_ssl field
            //
            $column = new CheckboxViewColumn('http_force_ssl', 'http_force_ssl', 'caption_http_force_ssl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('protection_id', 'protection_id_name', 'caption_protection_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_waf field
            //
            $column = new CheckboxViewColumn('http_waf', 'http_waf', 'caption_http_waf', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for dir field
            //
            $column = new CheckboxViewColumn('dir', 'dir', 'caption_dir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('unix_user_id', 'unix_user_id_username', 'caption_unix_user_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for locked field
            //
            $column = new CheckboxViewColumn('locked', 'locked', 'caption_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_id field
            //
            $column = new TextViewColumn('zimbra_id', 'zimbra_id', 'caption_zimbra_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created field
            //
            $column = new DateTimeViewColumn('created', 'created', 'caption_created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'caption_updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for client_id field
            //
            $editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $editor->setCustomAttributes('page01');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'edit_domain_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for domain field
            //
            $editor = new TextEdit('domain_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_domain', 'domain', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_dns field
            //
            $editor = new CheckBox('service_dns_edit');
            $editColumn = new CustomEditColumn('caption_service_dns', 'service_dns', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for dns_transfer field
            //
            $editor = new CheckBox('dns_transfer_edit');
            $editColumn = new CustomEditColumn('caption_dns_transfer', 'dns_transfer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mx_id field
            //
            $editor = new DynamicCombobox('mx_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'edit_domain_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_max_account field
            //
            $editor = new TextEdit('mail_max_account_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_account', 'mail_max_account', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_max_alias field
            //
            $editor = new TextEdit('mail_max_alias_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_alias', 'mail_max_alias', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_max_forward field
            //
            $editor = new TextEdit('mail_max_forward_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_forward', 'mail_max_forward', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_size field
            //
            $editor = new TextEdit('mail_size_edit');
            $editColumn = new CustomEditColumn('caption_mail_size', 'mail_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_domain_preauth_esweb field
            //
            $editor = new CheckBox('mail_domain_preauth_esweb_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_domain_restrict_login field
            //
            $editor = new CheckBox('mail_domain_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_restrict_login', 'mail_domain_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_http field
            //
            $editor = new CheckBox('service_http_edit');
            $editColumn = new CustomEditColumn('caption_service_http', 'service_http', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for domain_root field
            //
            $editor = new DynamicCombobox('domain_root_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_root', 'domain_root', 'domain_root_domain', '_domain_domain_root_search', $editor, $this->dataset, $lookupDataset, 'domain', 'domain', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for redirect field
            //
            $editor = new TextEdit('redirect_edit');
            $editColumn = new CustomEditColumn('caption_redirect', 'redirect', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}|([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6})(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for server_id field
            //
            $editor = new DynamicCombobox('server_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', '_domain_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for poolweb_id field
            //
            $editor = new DynamicCombobox('poolweb_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $editColumn = new DynamicLookupEditColumn('caption_poolweb_id', 'poolweb_id', 'poolweb_id_name', '_domain_poolweb_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for homedir field
            //
            $editor = new TextEdit('homedir_edit');
            $editColumn = new CustomEditColumn('caption_homedir', 'homedir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^/([a-zA-Z0-9@._-]+/?)+$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_exploredir field
            //
            $editor = new CheckBox('http_exploredir_edit');
            $editColumn = new CustomEditColumn('caption_http_exploredir', 'http_exploredir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_showmsgerror field
            //
            $editor = new CheckBox('http_showmsgerror_edit');
            $editColumn = new CustomEditColumn('caption_http_showmsgerror', 'http_showmsgerror', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_wildcard field
            //
            $editor = new CheckBox('http_wildcard_edit');
            $editColumn = new CustomEditColumn('caption_http_wildcard', 'http_wildcard', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_force_www field
            //
            $editor = new CheckBox('http_force_www_edit');
            $editColumn = new CustomEditColumn('caption_http_force_www', 'http_force_www', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_suspended field
            //
            $editor = new CheckBox('http_suspended_edit');
            $editColumn = new CustomEditColumn('caption_http_suspended', 'http_suspended', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_authurl field
            //
            $editor = new CheckBox('http_authurl_edit');
            $editColumn = new CustomEditColumn('caption_http_authurl', 'http_authurl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_limit_rate field
            //
            $editor = new TextEdit('http_limit_rate_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_http_limit_rate', 'http_limit_rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_php_openbasedir_id field
            //
            $editor = new DynamicCombobox('http_php_openbasedir_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_http_php_openbasedir_id', 'http_php_openbasedir_id', 'http_php_openbasedir_id_name', '_domain_http_php_openbasedir_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_php_cache field
            //
            $editor = new ComboBox('http_php_cache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('opcache', 'value_caption_opcache');
            $editor->addChoice('xcache', 'value_caption_xcache');
            $editColumn = new CustomEditColumn('caption_http_php_cache', 'http_php_cache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_php_suhosin field
            //
            $editor = new CheckBox('http_php_suhosin_edit');
            $editColumn = new CustomEditColumn('caption_http_php_suhosin', 'http_php_suhosin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for certificate_id field
            //
            $editor = new DynamicCombobox('certificate_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_certificate_id', 'certificate_id', 'certificate_id_name', '_domain_certificate_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_certificate_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_force_ssl field
            //
            $editor = new CheckBox('http_force_ssl_edit');
            $editColumn = new CustomEditColumn('caption_http_force_ssl', 'http_force_ssl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for protection_id field
            //
            $editor = new DynamicCombobox('protection_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_protection_id', 'protection_id', 'protection_id_name', '_domain_protection_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_waf field
            //
            $editor = new CheckBox('http_waf_edit');
            $editColumn = new CustomEditColumn('caption_http_waf', 'http_waf', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_ftp field
            //
            $editor = new CheckBox('service_ftp_edit');
            $editColumn = new CustomEditColumn('caption_service_ftp', 'service_ftp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for dir field
            //
            $editor = new CheckBox('dir_edit');
            $editColumn = new CustomEditColumn('caption_dir', 'dir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for unix_user_id field
            //
            $editor = new DynamicCombobox('unix_user_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_unix_user_id', 'unix_user_id', 'unix_user_id_username', '_domain_unix_user_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'username', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for locked field
            //
            $editor = new CheckBox('locked_edit');
            $editColumn = new CustomEditColumn('caption_locked', 'locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for client_id field
            //
            $editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $editor->setCustomAttributes('page01');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'multi_edit_domain_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_dns field
            //
            $editor = new CheckBox('service_dns_edit');
            $editColumn = new CustomEditColumn('caption_service_dns', 'service_dns', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for dns_transfer field
            //
            $editor = new CheckBox('dns_transfer_edit');
            $editColumn = new CustomEditColumn('caption_dns_transfer', 'dns_transfer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mx_id field
            //
            $editor = new DynamicCombobox('mx_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'multi_edit_domain_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_max_account field
            //
            $editor = new TextEdit('mail_max_account_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_account', 'mail_max_account', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_max_alias field
            //
            $editor = new TextEdit('mail_max_alias_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_alias', 'mail_max_alias', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_max_forward field
            //
            $editor = new TextEdit('mail_max_forward_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_forward', 'mail_max_forward', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_size field
            //
            $editor = new TextEdit('mail_size_edit');
            $editColumn = new CustomEditColumn('caption_mail_size', 'mail_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_domain_preauth_esweb field
            //
            $editor = new CheckBox('mail_domain_preauth_esweb_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_domain_restrict_login field
            //
            $editor = new CheckBox('mail_domain_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_restrict_login', 'mail_domain_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_http field
            //
            $editor = new CheckBox('service_http_edit');
            $editColumn = new CustomEditColumn('caption_service_http', 'service_http', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for domain_root field
            //
            $editor = new DynamicCombobox('domain_root_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_root', 'domain_root', 'domain_root_domain', 'multi_edit_domain_domain_root_search', $editor, $this->dataset, $lookupDataset, 'domain', 'domain', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for redirect field
            //
            $editor = new TextEdit('redirect_edit');
            $editColumn = new CustomEditColumn('caption_redirect', 'redirect', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}|([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6})(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for server_id field
            //
            $editor = new DynamicCombobox('server_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', 'multi_edit_domain_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for poolweb_id field
            //
            $editor = new DynamicCombobox('poolweb_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $editColumn = new DynamicLookupEditColumn('caption_poolweb_id', 'poolweb_id', 'poolweb_id_name', 'multi_edit_domain_poolweb_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for homedir field
            //
            $editor = new TextEdit('homedir_edit');
            $editColumn = new CustomEditColumn('caption_homedir', 'homedir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^/([a-zA-Z0-9@._-]+/?)+$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_exploredir field
            //
            $editor = new CheckBox('http_exploredir_edit');
            $editColumn = new CustomEditColumn('caption_http_exploredir', 'http_exploredir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_showmsgerror field
            //
            $editor = new CheckBox('http_showmsgerror_edit');
            $editColumn = new CustomEditColumn('caption_http_showmsgerror', 'http_showmsgerror', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_wildcard field
            //
            $editor = new CheckBox('http_wildcard_edit');
            $editColumn = new CustomEditColumn('caption_http_wildcard', 'http_wildcard', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_force_www field
            //
            $editor = new CheckBox('http_force_www_edit');
            $editColumn = new CustomEditColumn('caption_http_force_www', 'http_force_www', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_suspended field
            //
            $editor = new CheckBox('http_suspended_edit');
            $editColumn = new CustomEditColumn('caption_http_suspended', 'http_suspended', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_authurl field
            //
            $editor = new CheckBox('http_authurl_edit');
            $editColumn = new CustomEditColumn('caption_http_authurl', 'http_authurl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_limit_rate field
            //
            $editor = new TextEdit('http_limit_rate_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_http_limit_rate', 'http_limit_rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_php_openbasedir_id field
            //
            $editor = new DynamicCombobox('http_php_openbasedir_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_http_php_openbasedir_id', 'http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'multi_edit_domain_http_php_openbasedir_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_php_cache field
            //
            $editor = new ComboBox('http_php_cache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('opcache', 'value_caption_opcache');
            $editor->addChoice('xcache', 'value_caption_xcache');
            $editColumn = new CustomEditColumn('caption_http_php_cache', 'http_php_cache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_php_suhosin field
            //
            $editor = new CheckBox('http_php_suhosin_edit');
            $editColumn = new CustomEditColumn('caption_http_php_suhosin', 'http_php_suhosin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for certificate_id field
            //
            $editor = new DynamicCombobox('certificate_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_certificate_id', 'certificate_id', 'certificate_id_name', 'multi_edit_domain_certificate_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_certificate_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_force_ssl field
            //
            $editor = new CheckBox('http_force_ssl_edit');
            $editColumn = new CustomEditColumn('caption_http_force_ssl', 'http_force_ssl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for protection_id field
            //
            $editor = new DynamicCombobox('protection_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_protection_id', 'protection_id', 'protection_id_name', 'multi_edit_domain_protection_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_waf field
            //
            $editor = new CheckBox('http_waf_edit');
            $editColumn = new CustomEditColumn('caption_http_waf', 'http_waf', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_ftp field
            //
            $editor = new CheckBox('service_ftp_edit');
            $editColumn = new CustomEditColumn('caption_service_ftp', 'service_ftp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for dir field
            //
            $editor = new CheckBox('dir_edit');
            $editColumn = new CustomEditColumn('caption_dir', 'dir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for unix_user_id field
            //
            $editor = new DynamicCombobox('unix_user_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_unix_user_id', 'unix_user_id', 'unix_user_id_username', 'multi_edit_domain_unix_user_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'username', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for locked field
            //
            $editor = new CheckBox('locked_edit');
            $editColumn = new CustomEditColumn('caption_locked', 'locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for client_id field
            //
            $editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $editor->setCustomAttributes('page01');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'insert_domain_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for domain field
            //
            $editor = new TextEdit('domain_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_domain', 'domain', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_dns field
            //
            $editor = new CheckBox('service_dns_edit');
            $editColumn = new CustomEditColumn('caption_service_dns', 'service_dns', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for dns_transfer field
            //
            $editor = new CheckBox('dns_transfer_edit');
            $editColumn = new CustomEditColumn('caption_dns_transfer', 'dns_transfer', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mx_id field
            //
            $editor = new DynamicCombobox('mx_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'insert_domain_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_max_account field
            //
            $editor = new TextEdit('mail_max_account_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_account', 'mail_max_account', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_max_alias field
            //
            $editor = new TextEdit('mail_max_alias_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_alias', 'mail_max_alias', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_max_forward field
            //
            $editor = new TextEdit('mail_max_forward_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_forward', 'mail_max_forward', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_size field
            //
            $editor = new TextEdit('mail_size_edit');
            $editColumn = new CustomEditColumn('caption_mail_size', 'mail_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_domain_preauth_esweb field
            //
            $editor = new CheckBox('mail_domain_preauth_esweb_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_domain_restrict_login field
            //
            $editor = new CheckBox('mail_domain_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_mail_domain_restrict_login', 'mail_domain_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_http field
            //
            $editor = new CheckBox('service_http_edit');
            $editColumn = new CustomEditColumn('caption_service_http', 'service_http', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for domain_root field
            //
            $editor = new DynamicCombobox('domain_root_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_root', 'domain_root', 'domain_root_domain', 'insert_domain_domain_root_search', $editor, $this->dataset, $lookupDataset, 'domain', 'domain', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for redirect field
            //
            $editor = new TextEdit('redirect_edit');
            $editColumn = new CustomEditColumn('caption_redirect', 'redirect', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}|([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6})(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for server_id field
            //
            $editor = new DynamicCombobox('server_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', 'insert_domain_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for poolweb_id field
            //
            $editor = new DynamicCombobox('poolweb_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $editColumn = new DynamicLookupEditColumn('caption_poolweb_id', 'poolweb_id', 'poolweb_id_name', 'insert_domain_poolweb_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for homedir field
            //
            $editor = new TextEdit('homedir_edit');
            $editColumn = new CustomEditColumn('caption_homedir', 'homedir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^/([a-zA-Z0-9@._-]+/?)+$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_exploredir field
            //
            $editor = new CheckBox('http_exploredir_edit');
            $editColumn = new CustomEditColumn('caption_http_exploredir', 'http_exploredir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_showmsgerror field
            //
            $editor = new CheckBox('http_showmsgerror_edit');
            $editColumn = new CustomEditColumn('caption_http_showmsgerror', 'http_showmsgerror', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_wildcard field
            //
            $editor = new CheckBox('http_wildcard_edit');
            $editColumn = new CustomEditColumn('caption_http_wildcard', 'http_wildcard', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_force_www field
            //
            $editor = new CheckBox('http_force_www_edit');
            $editColumn = new CustomEditColumn('caption_http_force_www', 'http_force_www', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_suspended field
            //
            $editor = new CheckBox('http_suspended_edit');
            $editColumn = new CustomEditColumn('caption_http_suspended', 'http_suspended', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_authurl field
            //
            $editor = new CheckBox('http_authurl_edit');
            $editColumn = new CustomEditColumn('caption_http_authurl', 'http_authurl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_limit_rate field
            //
            $editor = new TextEdit('http_limit_rate_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_http_limit_rate', 'http_limit_rate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_php_openbasedir_id field
            //
            $editor = new DynamicCombobox('http_php_openbasedir_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_http_php_openbasedir_id', 'http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'insert_domain_http_php_openbasedir_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_php_cache field
            //
            $editor = new ComboBox('http_php_cache_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('opcache', 'value_caption_opcache');
            $editor->addChoice('xcache', 'value_caption_xcache');
            $editColumn = new CustomEditColumn('caption_http_php_cache', 'http_php_cache', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_php_suhosin field
            //
            $editor = new CheckBox('http_php_suhosin_edit');
            $editColumn = new CustomEditColumn('caption_http_php_suhosin', 'http_php_suhosin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for certificate_id field
            //
            $editor = new DynamicCombobox('certificate_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_certificate_id', 'certificate_id', 'certificate_id_name', 'insert_domain_certificate_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(domain_certificate_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_force_ssl field
            //
            $editor = new CheckBox('http_force_ssl_edit');
            $editColumn = new CustomEditColumn('caption_http_force_ssl', 'http_force_ssl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for protection_id field
            //
            $editor = new DynamicCombobox('protection_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_protection_id', 'protection_id', 'protection_id_name', 'insert_domain_protection_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_waf field
            //
            $editor = new CheckBox('http_waf_edit');
            $editColumn = new CustomEditColumn('caption_http_waf', 'http_waf', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_ftp field
            //
            $editor = new CheckBox('service_ftp_edit');
            $editColumn = new CustomEditColumn('caption_service_ftp', 'service_ftp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for dir field
            //
            $editor = new CheckBox('dir_edit');
            $editColumn = new CustomEditColumn('caption_dir', 'dir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for unix_user_id field
            //
            $editor = new DynamicCombobox('unix_user_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_unix_user_id', 'unix_user_id', 'unix_user_id_username', 'insert_domain_unix_user_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'username', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for locked field
            //
            $editor = new CheckBox('locked_edit');
            $editColumn = new CustomEditColumn('caption_locked', 'locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('1');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain', 'domain', 'caption_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for dns_transfer field
            //
            $column = new CheckboxViewColumn('dns_transfer', 'dns_transfer', 'caption_dns_transfer', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('mx_id', 'mx_id_name', 'caption_mx_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_mail field
            //
            $column = new CheckboxViewColumn('service_mail', 'service_mail', 'caption_service_mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_max_account field
            //
            $column = new NumberViewColumn('mail_max_account', 'mail_max_account', 'caption_mail_max_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_max_alias field
            //
            $column = new NumberViewColumn('mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_max_forward field
            //
            $column = new NumberViewColumn('mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_size field
            //
            $column = new NumberViewColumn('mail_size', 'mail_size', 'caption_mail_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_domain_preauth_esweb field
            //
            $column = new CheckboxViewColumn('mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', 'caption_mail_domain_preauth_esweb', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_domain_restrict_login field
            //
            $column = new CheckboxViewColumn('mail_domain_restrict_login', 'mail_domain_restrict_login', 'caption_mail_domain_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_root', 'domain_root_domain', 'caption_domain_root', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_redirect_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('poolweb_id', 'poolweb_id_name', 'caption_poolweb_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_homedir_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_exploredir field
            //
            $column = new CheckboxViewColumn('http_exploredir', 'http_exploredir', 'caption_http_exploredir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_showmsgerror field
            //
            $column = new CheckboxViewColumn('http_showmsgerror', 'http_showmsgerror', 'caption_http_showmsgerror', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_wildcard field
            //
            $column = new CheckboxViewColumn('http_wildcard', 'http_wildcard', 'caption_http_wildcard', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_force_www field
            //
            $column = new CheckboxViewColumn('http_force_www', 'http_force_www', 'caption_http_force_www', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_suspended field
            //
            $column = new CheckboxViewColumn('http_suspended', 'http_suspended', 'caption_http_suspended', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_authurl field
            //
            $column = new CheckboxViewColumn('http_authurl', 'http_authurl', 'caption_http_authurl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_limit_rate field
            //
            $column = new TextViewColumn('http_limit_rate', 'http_limit_rate', 'caption_http_limit_rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'caption_http_php_openbasedir_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_php_cache field
            //
            $column = new TextViewColumn('http_php_cache', 'http_php_cache', 'caption_http_php_cache', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_php_suhosin field
            //
            $column = new CheckboxViewColumn('http_php_suhosin', 'http_php_suhosin', 'caption_http_php_suhosin', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('certificate_id', 'certificate_id_name', 'caption_certificate_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_force_ssl field
            //
            $column = new CheckboxViewColumn('http_force_ssl', 'http_force_ssl', 'caption_http_force_ssl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('protection_id', 'protection_id_name', 'caption_protection_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_waf field
            //
            $column = new CheckboxViewColumn('http_waf', 'http_waf', 'caption_http_waf', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for dir field
            //
            $column = new CheckboxViewColumn('dir', 'dir', 'caption_dir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('unix_user_id', 'unix_user_id_username', 'caption_unix_user_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for locked field
            //
            $column = new CheckboxViewColumn('locked', 'locked', 'caption_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_id field
            //
            $column = new TextViewColumn('zimbra_id', 'zimbra_id', 'caption_zimbra_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created field
            //
            $column = new DateTimeViewColumn('created', 'created', 'caption_created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'caption_updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain', 'domain', 'caption_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for dns_transfer field
            //
            $column = new CheckboxViewColumn('dns_transfer', 'dns_transfer', 'caption_dns_transfer', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('mx_id', 'mx_id_name', 'caption_mx_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_mail field
            //
            $column = new CheckboxViewColumn('service_mail', 'service_mail', 'caption_service_mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_max_account field
            //
            $column = new NumberViewColumn('mail_max_account', 'mail_max_account', 'caption_mail_max_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_max_alias field
            //
            $column = new NumberViewColumn('mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_max_forward field
            //
            $column = new NumberViewColumn('mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_size field
            //
            $column = new NumberViewColumn('mail_size', 'mail_size', 'caption_mail_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_domain_preauth_esweb field
            //
            $column = new CheckboxViewColumn('mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', 'caption_mail_domain_preauth_esweb', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_domain_restrict_login field
            //
            $column = new CheckboxViewColumn('mail_domain_restrict_login', 'mail_domain_restrict_login', 'caption_mail_domain_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_root', 'domain_root_domain', 'caption_domain_root', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_redirect_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('poolweb_id', 'poolweb_id_name', 'caption_poolweb_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_homedir_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_exploredir field
            //
            $column = new CheckboxViewColumn('http_exploredir', 'http_exploredir', 'caption_http_exploredir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_showmsgerror field
            //
            $column = new CheckboxViewColumn('http_showmsgerror', 'http_showmsgerror', 'caption_http_showmsgerror', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_wildcard field
            //
            $column = new CheckboxViewColumn('http_wildcard', 'http_wildcard', 'caption_http_wildcard', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_force_www field
            //
            $column = new CheckboxViewColumn('http_force_www', 'http_force_www', 'caption_http_force_www', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_suspended field
            //
            $column = new CheckboxViewColumn('http_suspended', 'http_suspended', 'caption_http_suspended', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_authurl field
            //
            $column = new CheckboxViewColumn('http_authurl', 'http_authurl', 'caption_http_authurl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_limit_rate field
            //
            $column = new TextViewColumn('http_limit_rate', 'http_limit_rate', 'caption_http_limit_rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'caption_http_php_openbasedir_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_php_cache field
            //
            $column = new TextViewColumn('http_php_cache', 'http_php_cache', 'caption_http_php_cache', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_php_suhosin field
            //
            $column = new CheckboxViewColumn('http_php_suhosin', 'http_php_suhosin', 'caption_http_php_suhosin', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('certificate_id', 'certificate_id_name', 'caption_certificate_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_force_ssl field
            //
            $column = new CheckboxViewColumn('http_force_ssl', 'http_force_ssl', 'caption_http_force_ssl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('protection_id', 'protection_id_name', 'caption_protection_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_waf field
            //
            $column = new CheckboxViewColumn('http_waf', 'http_waf', 'caption_http_waf', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for dir field
            //
            $column = new CheckboxViewColumn('dir', 'dir', 'caption_dir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('unix_user_id', 'unix_user_id_username', 'caption_unix_user_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for locked field
            //
            $column = new CheckboxViewColumn('locked', 'locked', 'caption_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_id field
            //
            $column = new TextViewColumn('zimbra_id', 'zimbra_id', 'caption_zimbra_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for created field
            //
            $column = new DateTimeViewColumn('created', 'created', 'caption_created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'caption_updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain', 'domain', 'caption_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for dns_transfer field
            //
            $column = new CheckboxViewColumn('dns_transfer', 'dns_transfer', 'caption_dns_transfer', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('mx_id', 'mx_id_name', 'caption_mx_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_mail field
            //
            $column = new CheckboxViewColumn('service_mail', 'service_mail', 'caption_service_mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_max_account field
            //
            $column = new NumberViewColumn('mail_max_account', 'mail_max_account', 'caption_mail_max_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_max_alias field
            //
            $column = new NumberViewColumn('mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_max_forward field
            //
            $column = new NumberViewColumn('mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_size field
            //
            $column = new NumberViewColumn('mail_size', 'mail_size', 'caption_mail_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_domain_preauth_esweb field
            //
            $column = new CheckboxViewColumn('mail_domain_preauth_esweb', 'mail_domain_preauth_esweb', 'caption_mail_domain_preauth_esweb', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_domain_restrict_login field
            //
            $column = new CheckboxViewColumn('mail_domain_restrict_login', 'mail_domain_restrict_login', 'caption_mail_domain_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_root', 'domain_root_domain', 'caption_domain_root', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_redirect_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('poolweb_id', 'poolweb_id_name', 'caption_poolweb_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('domain_homedir_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_exploredir field
            //
            $column = new CheckboxViewColumn('http_exploredir', 'http_exploredir', 'caption_http_exploredir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_showmsgerror field
            //
            $column = new CheckboxViewColumn('http_showmsgerror', 'http_showmsgerror', 'caption_http_showmsgerror', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_wildcard field
            //
            $column = new CheckboxViewColumn('http_wildcard', 'http_wildcard', 'caption_http_wildcard', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_force_www field
            //
            $column = new CheckboxViewColumn('http_force_www', 'http_force_www', 'caption_http_force_www', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_suspended field
            //
            $column = new CheckboxViewColumn('http_suspended', 'http_suspended', 'caption_http_suspended', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_authurl field
            //
            $column = new CheckboxViewColumn('http_authurl', 'http_authurl', 'caption_http_authurl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_limit_rate field
            //
            $column = new TextViewColumn('http_limit_rate', 'http_limit_rate', 'caption_http_limit_rate', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('http_php_openbasedir_id', 'http_php_openbasedir_id_name', 'caption_http_php_openbasedir_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_php_cache field
            //
            $column = new TextViewColumn('http_php_cache', 'http_php_cache', 'caption_http_php_cache', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_php_suhosin field
            //
            $column = new CheckboxViewColumn('http_php_suhosin', 'http_php_suhosin', 'caption_http_php_suhosin', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('certificate_id', 'certificate_id_name', 'caption_certificate_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_force_ssl field
            //
            $column = new CheckboxViewColumn('http_force_ssl', 'http_force_ssl', 'caption_http_force_ssl', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('protection_id', 'protection_id_name', 'caption_protection_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_waf field
            //
            $column = new CheckboxViewColumn('http_waf', 'http_waf', 'caption_http_waf', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for dir field
            //
            $column = new CheckboxViewColumn('dir', 'dir', 'caption_dir', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('unix_user_id', 'unix_user_id_username', 'caption_unix_user_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for locked field
            //
            $column = new CheckboxViewColumn('locked', 'locked', 'caption_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_id field
            //
            $column = new TextViewColumn('zimbra_id', 'zimbra_id', 'caption_zimbra_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created field
            //
            $column = new DateTimeViewColumn('created', 'created', 'caption_created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated field
            //
            $column = new DateTimeViewColumn('updated', 'updated', 'caption_updated', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowAddMultipleRecords(false);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
    
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
            $this->AddOperationsColumns($result);
            $this->SetViewFormTitle('%domain%');
            $this->SetEditFormTitle('%domain%');
            $this->SetInsertFormTitle('InsertFormCaption');
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
            $grid->SetInsertClientEditorValueChangedScript('showFormValueChanged(domain_services, sender, editors);
            
            var f = sender.getFieldName();
            var e = sender.getValue() == \'\';
            
            if (f == \'domain_root\')
            {
            	if (e)
            	{
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(editors[\'redirect\'].getValue() != \'\');
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'redirect\'].setValue(null);
            		editors[\'server_id\'].setValue(null);
            		editors[\'poolweb_id\'].setValue(null);
            		editors[\'http_php_openbasedir_id\'].setValue(null);
            		editors[\'certificate_id\'].setValue(null);
            		editors[\'protection_id\'].setValue(null);
            		
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(false);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(false);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            }
            else if (f == \'redirect\')
            {
            	if (e)
            	{
            		editors[\'server_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'domain_root\'].setValue(null);
            		editors[\'poolweb_id\'].setValue(null);
            		editors[\'http_php_openbasedir_id\'].setValue(null);
            		editors[\'protection_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(false);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(true);
            		editors[\'poolweb_id\'].enabled(false);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(true);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(true);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);		
            	}
            }
            else if (f == \'poolweb_id\')
            {
            	if (e)
            	{
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(editors[\'redirect\'].getValue() != \'\');
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'domain_root\'].setValue(null);
            		editors[\'redirect\'].setValue(null);
            		editors[\'server_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(false);
            		editors[\'redirect\'].enabled(false);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(true);
            		editors[\'http_exploredir\'].enabled(true);
            		editors[\'http_showmsgerror\'].enabled(true);
            		editors[\'http_wildcard\'].enabled(true);
            		editors[\'http_force_www\'].enabled(true);
            		editors[\'http_suspended\'].enabled(true);
            		editors[\'http_authurl\'].enabled(true);
            		editors[\'http_limit_rate\'].enabled(true);
            		editors[\'http_php_openbasedir_id\'].enabled(true);
            		editors[\'http_php_cache\'].enabled(true);
            		editors[\'http_php_suhosin\'].enabled(true);
            		editors[\'certificate_id\'].enabled(true);
            		editors[\'http_force_ssl\'].enabled(true);
            		editors[\'protection_id\'].enabled(true);
            		editors[\'http_waf\'].enabled(true);		
            	}
            }');
            
            $grid->SetEditClientEditorValueChangedScript('showFormValueChanged(domain_services, sender, editors);
            
            var f = sender.getFieldName();
            var e = sender.getValue() == \'\';
            
            if (f == \'domain_root\')
            {
            	if (e)
            	{
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(editors[\'redirect\'].getValue() != \'\');
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'redirect\'].setValue(null);
            		editors[\'server_id\'].setValue(null);
            		editors[\'poolweb_id\'].setValue(null);
            		editors[\'http_php_openbasedir_id\'].setValue(null);
            		editors[\'certificate_id\'].setValue(null);
            		editors[\'protection_id\'].setValue(null);
            		
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(false);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(false);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            }
            else if (f == \'redirect\')
            {
            	if (e)
            	{
            		editors[\'server_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'domain_root\'].setValue(null);
            		editors[\'poolweb_id\'].setValue(null);
            		editors[\'http_php_openbasedir_id\'].setValue(null);
            		editors[\'protection_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(false);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(true);
            		editors[\'poolweb_id\'].enabled(false);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(true);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(true);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);		
            	}
            }
            else if (f == \'poolweb_id\')
            {
            	if (e)
            	{
            		editors[\'domain_root\'].enabled(true);
            		editors[\'redirect\'].enabled(true);
            		editors[\'server_id\'].enabled(editors[\'redirect\'].getValue() != \'\');
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(false);
            		editors[\'http_exploredir\'].enabled(false);
            		editors[\'http_showmsgerror\'].enabled(false);
            		editors[\'http_wildcard\'].enabled(false);
            		editors[\'http_force_www\'].enabled(false);
            		editors[\'http_suspended\'].enabled(false);
            		editors[\'http_authurl\'].enabled(false);
            		editors[\'http_limit_rate\'].enabled(false);
            		editors[\'http_php_openbasedir_id\'].enabled(false);
            		editors[\'http_php_cache\'].enabled(false);
            		editors[\'http_php_suhosin\'].enabled(false);
            		editors[\'certificate_id\'].enabled(false);
            		editors[\'http_force_ssl\'].enabled(false);
            		editors[\'protection_id\'].enabled(false);
            		editors[\'http_waf\'].enabled(false);
            	}
            	else
            	{
            		editors[\'domain_root\'].setValue(null);
            		editors[\'redirect\'].setValue(null);
            		editors[\'server_id\'].setValue(null);
            		editors[\'domain_root\'].enabled(false);
            		editors[\'redirect\'].enabled(false);
            		editors[\'server_id\'].enabled(false);
            		editors[\'poolweb_id\'].enabled(true);
            		editors[\'homedir\'].enabled(true);
            		editors[\'http_exploredir\'].enabled(true);
            		editors[\'http_showmsgerror\'].enabled(true);
            		editors[\'http_wildcard\'].enabled(true);
            		editors[\'http_force_www\'].enabled(true);
            		editors[\'http_suspended\'].enabled(true);
            		editors[\'http_authurl\'].enabled(true);
            		editors[\'http_limit_rate\'].enabled(true);
            		editors[\'http_php_openbasedir_id\'].enabled(true);
            		editors[\'http_php_cache\'].enabled(true);
            		editors[\'http_php_suhosin\'].enabled(true);
            		editors[\'certificate_id\'].enabled(true);
            		editors[\'http_force_ssl\'].enabled(true);
            		editors[\'protection_id\'].enabled(true);
            		editors[\'http_waf\'].enabled(true);		
            	}
            }');
            
            $grid->SetInsertClientFormLoadedScript('showFormLoad(domain_services, editors);
            
            if (editors[\'poolweb_id\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(false);
            	editors[\'redirect\'].enabled(false);
            	editors[\'server_id\'].enabled(false);
            	editors[\'poolweb_id\'].enabled(true);
            	editors[\'homedir\'].enabled(true);
            	editors[\'http_exploredir\'].enabled(true);
            	editors[\'http_showmsgerror\'].enabled(true);
            	editors[\'http_wildcard\'].enabled(true);
            	editors[\'http_force_www\'].enabled(true);
            	editors[\'http_suspended\'].enabled(true);
            	editors[\'http_authurl\'].enabled(true);
            	editors[\'http_limit_rate\'].enabled(true);
            	editors[\'http_php_openbasedir_id\'].enabled(true);
            	editors[\'http_php_cache\'].enabled(true);
            	editors[\'http_php_suhosin\'].enabled(true);
            	editors[\'certificate_id\'].enabled(true);
            	editors[\'http_force_ssl\'].enabled(true);
            	editors[\'protection_id\'].enabled(true);
            	editors[\'http_waf\'].enabled(true);
            }
            else if (editors[\'redirect\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(false);
            	editors[\'redirect\'].enabled(true);
            	editors[\'server_id\'].enabled(true);
            	editors[\'poolweb_id\'].enabled(false);
            	editors[\'homedir\'].enabled(false);
            	editors[\'http_exploredir\'].enabled(false);
            	editors[\'http_showmsgerror\'].enabled(false);
            	editors[\'http_wildcard\'].enabled(false);
            	editors[\'http_force_www\'].enabled(false);
            	editors[\'http_suspended\'].enabled(true);
            	editors[\'http_authurl\'].enabled(false);
            	editors[\'http_limit_rate\'].enabled(false);
            	editors[\'http_php_openbasedir_id\'].enabled(false);
            	editors[\'http_php_cache\'].enabled(false);
            	editors[\'http_php_suhosin\'].enabled(false);
            	editors[\'certificate_id\'].enabled(true);
            	editors[\'http_force_ssl\'].enabled(false);
            	editors[\'protection_id\'].enabled(false);
            	editors[\'http_waf\'].enabled(false);
            }
            else if (editors[\'domain_root\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(true);
            	editors[\'redirect\'].enabled(false);
            	editors[\'server_id\'].enabled(false);
            	editors[\'poolweb_id\'].enabled(false);
            	editors[\'homedir\'].enabled(false);
            	editors[\'http_exploredir\'].enabled(false);
            	editors[\'http_showmsgerror\'].enabled(false);
            	editors[\'http_wildcard\'].enabled(false);
            	editors[\'http_force_www\'].enabled(false);
            	editors[\'http_suspended\'].enabled(false);
            	editors[\'http_authurl\'].enabled(false);
            	editors[\'http_limit_rate\'].enabled(false);
            	editors[\'http_php_openbasedir_id\'].enabled(false);
            	editors[\'http_php_cache\'].enabled(false);
            	editors[\'http_php_suhosin\'].enabled(false);
            	editors[\'certificate_id\'].enabled(false);
            	editors[\'http_force_ssl\'].enabled(false);
            	editors[\'protection_id\'].enabled(false);
            	editors[\'http_waf\'].enabled(false);
            }');
            
            $grid->SetEditClientFormLoadedScript('showFormLoad(domain_services, editors);
            
            if (editors[\'poolweb_id\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(false);
            	editors[\'redirect\'].enabled(false);
            	editors[\'server_id\'].enabled(false);
            	editors[\'poolweb_id\'].enabled(true);
            	editors[\'homedir\'].enabled(true);
            	editors[\'http_exploredir\'].enabled(true);
            	editors[\'http_showmsgerror\'].enabled(true);
            	editors[\'http_wildcard\'].enabled(true);
            	editors[\'http_force_www\'].enabled(true);
            	editors[\'http_suspended\'].enabled(true);
            	editors[\'http_authurl\'].enabled(true);
            	editors[\'http_limit_rate\'].enabled(true);
            	editors[\'http_php_openbasedir_id\'].enabled(true);
            	editors[\'http_php_cache\'].enabled(true);
            	editors[\'http_php_suhosin\'].enabled(true);
            	editors[\'certificate_id\'].enabled(true);
            	editors[\'http_force_ssl\'].enabled(true);
            	editors[\'protection_id\'].enabled(true);
            	editors[\'http_waf\'].enabled(true);
            }
            else if (editors[\'redirect\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(false);
            	editors[\'redirect\'].enabled(true);
            	editors[\'server_id\'].enabled(true);
            	editors[\'poolweb_id\'].enabled(false);
            	editors[\'homedir\'].enabled(false);
            	editors[\'http_exploredir\'].enabled(false);
            	editors[\'http_showmsgerror\'].enabled(false);
            	editors[\'http_wildcard\'].enabled(false);
            	editors[\'http_force_www\'].enabled(false);
            	editors[\'http_suspended\'].enabled(true);
            	editors[\'http_authurl\'].enabled(false);
            	editors[\'http_limit_rate\'].enabled(false);
            	editors[\'http_php_openbasedir_id\'].enabled(false);
            	editors[\'http_php_cache\'].enabled(false);
            	editors[\'http_php_suhosin\'].enabled(false);
            	editors[\'certificate_id\'].enabled(true);
            	editors[\'http_force_ssl\'].enabled(false);
            	editors[\'protection_id\'].enabled(false);
            	editors[\'http_waf\'].enabled(false);
            }
            else if (editors[\'domain_root\'].getValue() !== \'\')
            {
            	editors[\'domain_root\'].enabled(true);
            	editors[\'redirect\'].enabled(false);
            	editors[\'server_id\'].enabled(false);
            	editors[\'poolweb_id\'].enabled(false);
            	editors[\'homedir\'].enabled(false);
            	editors[\'http_exploredir\'].enabled(false);
            	editors[\'http_showmsgerror\'].enabled(false);
            	editors[\'http_wildcard\'].enabled(false);
            	editors[\'http_force_www\'].enabled(false);
            	editors[\'http_suspended\'].enabled(false);
            	editors[\'http_authurl\'].enabled(false);
            	editors[\'http_limit_rate\'].enabled(false);
            	editors[\'http_php_openbasedir_id\'].enabled(false);
            	editors[\'http_php_cache\'].enabled(false);
            	editors[\'http_php_suhosin\'].enabled(false);
            	editors[\'certificate_id\'].enabled(false);
            	editors[\'http_force_ssl\'].enabled(false);
            	editors[\'protection_id\'].enabled(false);
            	editors[\'http_waf\'].enabled(false);
            }');
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_redirect_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_homedir_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_redirect_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_homedir_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_mx_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_domain_root_search', 'domain', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_server_id_search', 'id', 'hostname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_poolweb_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_http_php_openbasedir_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_certificate_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_unix_user_id_search', 'id', 'username', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_mx_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_mx_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_domain_root_search', 'domain', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_server_id_search', 'id', 'hostname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_poolweb_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_http_php_openbasedir_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_certificate_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_certificate_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_unix_user_id_search', 'id', 'username', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_unix_user_id_search', 'id', 'username', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for redirect field
            //
            $column = new TextViewColumn('redirect', 'redirect', 'caption_redirect', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_redirect_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for homedir field
            //
            $column = new TextViewColumn('homedir', 'homedir', 'caption_homedir', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'domain_homedir_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_domain_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_domain_mx_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_domain_root_search', 'domain', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_server_id_search', 'id', 'hostname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_poolweb_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_http_php_openbasedir_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_certificate_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_domain_unix_user_id_search', 'id', 'username', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mx`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('zone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_mx_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new StringField('domain', true),
                    new IntegerField('service_dns', true),
                    new IntegerField('dns_transfer', true),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail'),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('mail_domain_preauth_esweb'),
                    new IntegerField('mail_domain_restrict_login'),
                    new StringField('mail_zimbra_key'),
                    new IntegerField('service_http', true),
                    new StringField('domain_root'),
                    new StringField('redirect'),
                    new IntegerField('server_id'),
                    new IntegerField('poolweb_id'),
                    new StringField('homedir'),
                    new IntegerField('http_exploredir', true),
                    new IntegerField('http_showmsgerror', true),
                    new IntegerField('http_wildcard', true),
                    new IntegerField('http_force_www', true),
                    new IntegerField('http_suspended', true),
                    new IntegerField('http_authurl', true),
                    new IntegerField('http_limit_rate', true),
                    new IntegerField('http_php_openbasedir_id'),
                    new StringField('http_php_cache'),
                    new IntegerField('http_php_suhosin', true),
                    new IntegerField('certificate_id'),
                    new IntegerField('http_force_ssl', true),
                    new IntegerField('protection_id'),
                    new IntegerField('http_waf', true),
                    new IntegerField('service_ftp', true),
                    new IntegerField('dir', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('locked', true),
                    new StringField('zimbra_id'),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('domain', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_domain_root_search', 'domain', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`server`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('hostname', true),
                    new StringField('description'),
                    new StringField('uuid'),
                    new StringField('type', true),
                    new IntegerField('php_version_id'),
                    new IntegerField('cache_port'),
                    new StringField('cache_auth'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('hostname', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`server` .`type` = \'poolweb\')'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_server_id_search', 'id', 'hostname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`poolweb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('environment_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('hash_type', true),
                    new IntegerField('cache_id'),
                    new IntegerField('php_version_id'),
                    new IntegerField('port_http', true),
                    new IntegerField('port_https', true),
                    new IntegerField('internal_ssl', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_poolweb_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`openbasedir`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('path'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_http_php_openbasedir_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`certificate`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new DateField('actived', true),
                    new StringField('key'),
                    new StringField('crt'),
                    new StringField('ca'),
                    new IntegerField('letsencrypt', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_certificate_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`protection`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('sts', true),
                    new IntegerField('sts_max_age', true),
                    new IntegerField('sts_includesubdomains', true),
                    new IntegerField('sts_preload', true),
                    new IntegerField('sts_always', true),
                    new IntegerField('x_frame', true),
                    new StringField('x_frame_options', true),
                    new StringField('x_frame_url'),
                    new IntegerField('x_content_nosniff', true),
                    new IntegerField('x_xss', true),
                    new IntegerField('cors', true),
                    new StringField('cors_origin'),
                    new IntegerField('cors_credential', true),
                    new IntegerField('cors_always', true),
                    new IntegerField('cors_methods', true),
                    new IntegerField('cors_method_get', true),
                    new IntegerField('cors_method_head', true),
                    new IntegerField('cors_method_post', true),
                    new IntegerField('cors_method_put', true),
                    new IntegerField('cors_method_delete', true),
                    new IntegerField('cors_method_connect', true),
                    new IntegerField('cors_method_options', true),
                    new IntegerField('cors_method_trace', true),
                    new IntegerField('cors_method_patch', true),
                    new IntegerField('cors_headers', true),
                    new StringField('cors_headers_options'),
                    new IntegerField('cors_max_age', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_protection_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`unix_user`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('client_id', true),
                    new IntegerField('domain_id'),
                    new StringField('username', true),
                    new IntegerField('uid_ftp'),
                    new IntegerField('gid_ftp'),
                    new IntegerField('uid_http'),
                    new IntegerField('gid_http'),
                    new StringField('gecos', true),
                    new StringField('homedir', true),
                    new StringField('shell', true),
                    new StringField('password', true),
                    new IntegerField('lstchg', true),
                    new IntegerField('min', true),
                    new IntegerField('max', true),
                    new IntegerField('warn', true),
                    new IntegerField('inact', true),
                    new IntegerField('expire', true),
                    new IntegerField('flag', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('username', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_domain_unix_user_id_search', 'id', 'username', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`environment`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('uuid', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_server_idNestedPage_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`client`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id', true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('mail_max_domain', true),
                    new IntegerField('mail_max_account', true),
                    new IntegerField('mail_max_alias', true),
                    new IntegerField('mail_max_forward', true),
                    new IntegerField('mail_size', true),
                    new IntegerField('service_http', true),
                    new StringField('http_note'),
                    new IntegerField('http_max_hosting', true),
                    new IntegerField('http_max_virtualhost', true),
                    new IntegerField('http_max_db', true),
                    new IntegerField('http_size', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('unix_user_id'),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new StringField('backup_email'),
                    new IntegerField('backup_size', true),
                    new StringField('backup_server_type_connect'),
                    new StringField('backup_server_host'),
                    new IntegerField('backup_server_port'),
                    new StringField('backup_server_os'),
                    new StringField('backup_server_user'),
                    new StringField('backup_server_password'),
                    new IntegerField('service_mkmail', true),
                    new StringField('mkmail_note'),
                    new IntegerField('service_ts', true),
                    new StringField('ts_note'),
                    new IntegerField('service_ip_dedicate', true),
                    new StringField('ip_dedicate_note'),
                    new IntegerField('service_other', true),
                    new StringField('other_note'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_certificate_idNestedPage_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            new domain_mx_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('domain.mx_id'));
            new domain_server_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('domain.server_id'));
            new domain_certificate_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('domain.certificate_id'));
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
            if ($mode == PageMode::FormEdit || $mode == PageMode::FormInsert)
            {
            	$id = 0;
            
            	// Get ID Domain
            	if ($mode == PageMode::FormEdit)
            	{
            		$id = $this->dataset->GetFieldValueByName('id');
            	}
            
            	// parameters	
            	$SQL = "SELECT p.`id`, p.`name` " . 
            		"FROM `param` p " .
            		"ORDER BY p.`name`";
            
            	$params['Parameters'] = $this->GetConnection()->fetchAll($SQL);
            
            	// selected parameters
            	$SQL = "SELECT `param_id` " . 
            		"FROM `domain_param` " .
                            "WHERE `domain_id` = '$id'";
            
            	$res = $this->GetConnection()->fetchAll($SQL);
            	$DomainParameters = array();
            
            	foreach ($res as $item)
                    {
            		$DomainParameters[] = $item['param_id'];
            	}
            
            	$params['DomainParameters'] = $DomainParameters;
            
            	// url
            	$SQL = "SELECT `id`, `uri`, `redirect_type`, `active`, `created`, `updated` " .
            		"FROM url " . 
            		"WHERE domain_id = '$id'"; 
            
            	$params['Urls'] = $this->GetConnection()->fetchAll($SQL);
            
            	// ftp
            	$SQL = "SELECT `id`, `username`, `quotasize`, `active`, `created`, `updated` " .
            		"FROM ftp_user " . 
            		"WHERE domain_id = '$id'"; 
            
            	$params['FtpUsers'] = $this->GetConnection()->fetchAll($SQL);
            
            	// url auth user
            	$SQL = "SELECT `id`, `username`, `description`, `expire`, `active`, `created`, `updated` " .
            		"FROM url_user " . 
            		"WHERE domain_id = '$id'";
            
            	$params['UrlUsers'] = $this->GetConnection()->fetchAll($SQL);
            }
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new domainPage("domain", "domain.php", GetCurrentUserPermissionSetForDataSource("domain"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("domain"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
