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

    
    
    class zimbra_account_domain_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
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
            $this->dataset->AddLookupField('poolweb_id', 'poolweb', new IntegerField('id'), new IntegerField('environment_id', false, false, false, false, 'poolweb_id_environment_id', 'poolweb_id_environment_id_poolweb'), 'poolweb_id_environment_id_poolweb');
            $this->dataset->AddLookupField('mx_id', 'mx', new IntegerField('id'), new StringField('name', false, false, false, false, 'mx_id_name', 'mx_id_name_mx'), 'mx_id_name_mx');
            $this->dataset->AddLookupField('unix_user_id', 'unix_user', new IntegerField('id'), new StringField('username', false, false, false, false, 'unix_user_id_username', 'unix_user_id_username_unix_user'), 'unix_user_id_username_unix_user');
            $this->dataset->AddLookupField('certificate_id', 'certificate', new IntegerField('id'), new StringField('name', false, false, false, false, 'certificate_id_name', 'certificate_id_name_certificate'), 'certificate_id_name_certificate');
            $this->dataset->AddLookupField('http_php_openbasedir_id', 'openbasedir', new IntegerField('id'), new StringField('name', false, false, false, false, 'http_php_openbasedir_id_name', 'http_php_openbasedir_id_name_openbasedir'), 'http_php_openbasedir_id_name_openbasedir');
            $this->dataset->AddLookupField('protection_id', 'protection', new IntegerField('id'), new StringField('name', false, false, false, false, 'protection_id_name', 'protection_id_name_protection'), 'protection_id_name_protection');
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
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'insert_zimbra_account_domain_idNestedPage_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for domain field
            //
            $editor = new TextEdit('domain_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_domain', 'domain', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
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
    
    
    
    class zimbra_accountPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleZimbraAccount');
            $this->SetMenuLabel('LabelZimbraAccount');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zimbra_account`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('domain_id', true),
                    new StringField('username', true),
                    new StringField('name'),
                    new IntegerField('size', true),
                    new IntegerField('usage', true),
                    new IntegerField('preauth_authentication'),
                    new StringField('preauth_password'),
                    new IntegerField('preauth_password_must_change', true),
                    new IntegerField('preauth_password_locked', true),
                    new IntegerField('preauth_password_expire', true),
                    new DateTimeField('preauth_password_expire_time'),
                    new DateTimeField('preauth_password_modified_time'),
                    new DateTimeField('preauth_last_login_time'),
                    new IntegerField('preauth_restrict_login', true),
                    new IntegerField('preauth_access_other_account', true),
                    new IntegerField('zimbra_authentication'),
                    new StringField('zimbra_password'),
                    new IntegerField('zimbra_password_must_change', true),
                    new IntegerField('zimbra_password_locked', true),
                    new IntegerField('zimbra_password_expire', true),
                    new DateTimeField('zimbra_password_expire_time'),
                    new DateTimeField('zimbra_password_modified_time'),
                    new DateTimeField('zimbra_last_login_time'),
                    new IntegerField('zimbra_pop3', true),
                    new IntegerField('zimbra_imap', true),
                    new IntegerField('zimbra_pop3_include_spam', true),
                    new IntegerField('zimbra_hide_of_contacts', true),
                    new IntegerField('zimbra_auto_reply', true),
                    new StringField('zimbra_auto_reply_message'),
                    new DateTimeField('zimbra_auto_reply_time_start'),
                    new DateTimeField('zimbra_auto_reply_time_stop'),
                    new StringField('zimbra_mail_forwarding_address'),
                    new IntegerField('zimbra_forward_local_copy', true),
                    new StringField('zimbra_id'),
                    new IntegerField('conf_password_min_length', true),
                    new IntegerField('conf_password_max_length', true),
                    new IntegerField('conf_password_min_upper_case_chars', true),
                    new IntegerField('conf_password_min_lower_case_chars', true),
                    new IntegerField('conf_password_min_numeric_chars', true),
                    new IntegerField('conf_password_min_digits_or_puncs', true),
                    new IntegerField('conf_password_min_punctuation_chars', true),
                    new IntegerField('conf_password_min_age', true),
                    new IntegerField('conf_password_max_age', true),
                    new IntegerField('account_system', true),
                    new IntegerField('deleted', true),
                    new DateTimeField('deleted_time'),
                    new StringField('action'),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true),
                    new IntegerField('quota_size', false, false, false, true),
                    new IntegerField('quota_usage', false, false, false, true)
                )
            );
            $this->dataset->AddLookupField('domain_id', 'domain', new IntegerField('id'), new StringField('domain', false, false, false, false, 'domain_id_domain', 'domain_id_domain_domain'), 'domain_id_domain_domain');
            $this->dataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(`zimbra_account`.`deleted` = 0)'));
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
                new FilterColumn($this->dataset, 'username', 'username', 'caption_username'),
                new FilterColumn($this->dataset, 'domain_id', 'domain_id_domain', 'caption_domain_id'),
                new FilterColumn($this->dataset, 'name', 'name', 'caption_name'),
                new FilterColumn($this->dataset, 'size', 'size', 'caption_size'),
                new FilterColumn($this->dataset, 'usage', 'usage', 'caption_usage'),
                new FilterColumn($this->dataset, 'quota_size', 'quota_size', 'caption_quota_size'),
                new FilterColumn($this->dataset, 'quota_usage', 'quota_usage', 'caption_quota_usage'),
                new FilterColumn($this->dataset, 'preauth_authentication', 'preauth_authentication', 'caption_preauth_authentication'),
                new FilterColumn($this->dataset, 'preauth_password', 'preauth_password', 'caption_preauth_password'),
                new FilterColumn($this->dataset, 'preauth_password_must_change', 'preauth_password_must_change', 'caption_preauth_password_must_change'),
                new FilterColumn($this->dataset, 'preauth_password_locked', 'preauth_password_locked', 'caption_preauth_password_locked'),
                new FilterColumn($this->dataset, 'preauth_password_expire', 'preauth_password_expire', 'caption_preauth_password_expire'),
                new FilterColumn($this->dataset, 'preauth_password_expire_time', 'preauth_password_expire_time', 'caption_preauth_password_expire_time'),
                new FilterColumn($this->dataset, 'preauth_password_modified_time', 'preauth_password_modified_time', 'caption_preauth_password_modified_time'),
                new FilterColumn($this->dataset, 'preauth_last_login_time', 'preauth_last_login_time', 'caption_preauth_last_login_time'),
                new FilterColumn($this->dataset, 'preauth_restrict_login', 'preauth_restrict_login', 'caption_preauth_restrict_login'),
                new FilterColumn($this->dataset, 'preauth_access_other_account', 'preauth_access_other_account', 'caption_preauth_access_other_account'),
                new FilterColumn($this->dataset, 'zimbra_authentication', 'zimbra_authentication', 'caption_zimbra_authentication'),
                new FilterColumn($this->dataset, 'zimbra_password', 'zimbra_password', 'caption_zimbra_password'),
                new FilterColumn($this->dataset, 'zimbra_password_must_change', 'zimbra_password_must_change', 'caption_zimbra_password_must_change'),
                new FilterColumn($this->dataset, 'zimbra_password_locked', 'zimbra_password_locked', 'caption_zimbra_password_locked'),
                new FilterColumn($this->dataset, 'zimbra_password_expire', 'zimbra_password_expire', 'caption_zimbra_password_expire'),
                new FilterColumn($this->dataset, 'zimbra_password_expire_time', 'zimbra_password_expire_time', 'caption_zimbra_password_expire_time'),
                new FilterColumn($this->dataset, 'zimbra_password_modified_time', 'zimbra_password_modified_time', 'caption_zimbra_password_modified_time'),
                new FilterColumn($this->dataset, 'zimbra_last_login_time', 'zimbra_last_login_time', 'caption_zimbra_last_login_time'),
                new FilterColumn($this->dataset, 'zimbra_pop3', 'zimbra_pop3', 'caption_zimbra_pop3'),
                new FilterColumn($this->dataset, 'zimbra_imap', 'zimbra_imap', 'caption_zimbra_imap'),
                new FilterColumn($this->dataset, 'zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', 'caption_zimbra_pop3_include_spam'),
                new FilterColumn($this->dataset, 'zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', 'caption_zimbra_hide_of_contacts'),
                new FilterColumn($this->dataset, 'zimbra_auto_reply', 'zimbra_auto_reply', 'caption_zimbra_auto_reply'),
                new FilterColumn($this->dataset, 'zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message'),
                new FilterColumn($this->dataset, 'zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', 'caption_zimbra_auto_reply_time_start'),
                new FilterColumn($this->dataset, 'zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', 'caption_zimbra_auto_reply_time_stop'),
                new FilterColumn($this->dataset, 'zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address'),
                new FilterColumn($this->dataset, 'zimbra_forward_local_copy', 'zimbra_forward_local_copy', 'caption_zimbra_forward_local_copy'),
                new FilterColumn($this->dataset, 'zimbra_id', 'zimbra_id', 'caption_zimbra_id'),
                new FilterColumn($this->dataset, 'conf_password_min_length', 'conf_password_min_length', 'caption_conf_password_min_length'),
                new FilterColumn($this->dataset, 'conf_password_max_length', 'conf_password_max_length', 'caption_conf_password_max_length'),
                new FilterColumn($this->dataset, 'conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', 'caption_conf_password_min_upper_case_chars'),
                new FilterColumn($this->dataset, 'conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', 'caption_conf_password_min_lower_case_chars'),
                new FilterColumn($this->dataset, 'conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', 'caption_conf_password_min_numeric_chars'),
                new FilterColumn($this->dataset, 'conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', 'caption_conf_password_min_digits_or_puncs'),
                new FilterColumn($this->dataset, 'conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', 'caption_conf_password_min_punctuation_chars'),
                new FilterColumn($this->dataset, 'conf_password_min_age', 'conf_password_min_age', 'caption_conf_password_min_age'),
                new FilterColumn($this->dataset, 'conf_password_max_age', 'conf_password_max_age', 'caption_conf_password_max_age'),
                new FilterColumn($this->dataset, 'account_system', 'account_system', 'caption_account_system'),
                new FilterColumn($this->dataset, 'deleted', 'deleted', 'caption_deleted'),
                new FilterColumn($this->dataset, 'deleted_time', 'deleted_time', 'caption_deleted_time'),
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
                ->addColumn($columns['username'])
                ->addColumn($columns['domain_id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['size'])
                ->addColumn($columns['usage'])
                ->addColumn($columns['preauth_authentication'])
                ->addColumn($columns['preauth_password'])
                ->addColumn($columns['preauth_password_must_change'])
                ->addColumn($columns['preauth_password_locked'])
                ->addColumn($columns['preauth_password_expire'])
                ->addColumn($columns['preauth_password_expire_time'])
                ->addColumn($columns['preauth_last_login_time'])
                ->addColumn($columns['preauth_restrict_login'])
                ->addColumn($columns['preauth_access_other_account'])
                ->addColumn($columns['zimbra_authentication'])
                ->addColumn($columns['zimbra_password'])
                ->addColumn($columns['zimbra_password_must_change'])
                ->addColumn($columns['zimbra_password_locked'])
                ->addColumn($columns['zimbra_password_expire'])
                ->addColumn($columns['zimbra_password_expire_time'])
                ->addColumn($columns['zimbra_pop3'])
                ->addColumn($columns['zimbra_imap'])
                ->addColumn($columns['zimbra_pop3_include_spam'])
                ->addColumn($columns['zimbra_hide_of_contacts'])
                ->addColumn($columns['zimbra_auto_reply'])
                ->addColumn($columns['zimbra_auto_reply_message'])
                ->addColumn($columns['zimbra_auto_reply_time_start'])
                ->addColumn($columns['zimbra_auto_reply_time_stop'])
                ->addColumn($columns['zimbra_mail_forwarding_address'])
                ->addColumn($columns['zimbra_forward_local_copy'])
                ->addColumn($columns['zimbra_id'])
                ->addColumn($columns['conf_password_min_length'])
                ->addColumn($columns['conf_password_max_length'])
                ->addColumn($columns['conf_password_min_upper_case_chars'])
                ->addColumn($columns['conf_password_min_lower_case_chars'])
                ->addColumn($columns['conf_password_min_numeric_chars'])
                ->addColumn($columns['conf_password_min_digits_or_puncs'])
                ->addColumn($columns['conf_password_min_punctuation_chars'])
                ->addColumn($columns['conf_password_min_age'])
                ->addColumn($columns['conf_password_max_age'])
                ->addColumn($columns['account_system'])
                ->addColumn($columns['active'])
                ->addColumn($columns['created'])
                ->addColumn($columns['updated']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('username')
                ->setOptionsFor('domain_id')
                ->setOptionsFor('name')
                ->setOptionsFor('updated');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
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
            
            $main_editor = new TextEdit('username_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['username'],
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
            
            $main_editor = new DynamicCombobox('domain_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_zimbra_account_domain_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('domain_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_zimbra_account_domain_id_search');
            
            $filterBuilder->addColumn(
                $columns['domain_id'],
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
            
            $main_editor = new TextEdit('name_edit');
            $main_editor->SetMaxLength(128);
            
            $filterBuilder->addColumn(
                $columns['name'],
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
            
            $main_editor = new TextEdit('size_edit');
            
            $filterBuilder->addColumn(
                $columns['size'],
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
            
            $main_editor = new TextEdit('usage_edit');
            
            $filterBuilder->addColumn(
                $columns['usage'],
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
            
            $main_editor = new ComboBox('preauth_authentication');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_authentication'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('preauth_password_edit');$main_editor->SetPasswordMode(true);
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['preauth_password'],
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
            
            $main_editor = new ComboBox('preauth_password_must_change');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_password_must_change'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('preauth_password_locked');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_password_locked'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('preauth_password_expire');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_password_expire'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('preauth_password_expire_time_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['preauth_password_expire_time'],
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
            
            $main_editor = new DateTimeEdit('preauth_last_login_time_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['preauth_last_login_time'],
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
            
            $main_editor = new ComboBox('preauth_restrict_login');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_restrict_login'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('preauth_access_other_account');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['preauth_access_other_account'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_authentication');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_authentication'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('zimbra_password_edit');$main_editor->SetPasswordMode(true);
            
            $filterBuilder->addColumn(
                $columns['zimbra_password'],
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
            
            $main_editor = new ComboBox('zimbra_password_must_change');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_password_must_change'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_password_locked');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_password_locked'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_password_expire');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_password_expire'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('zimbra_password_expire_time_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['zimbra_password_expire_time'],
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
            
            $main_editor = new ComboBox('zimbra_pop3');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_pop3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_imap');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_imap'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_pop3_include_spam');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_pop3_include_spam'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_hide_of_contacts');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_hide_of_contacts'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('zimbra_auto_reply');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_auto_reply'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('zimbra_auto_reply_message');
            
            $filterBuilder->addColumn(
                $columns['zimbra_auto_reply_message'],
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
            
            $main_editor = new DateTimeEdit('zimbra_auto_reply_time_start_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['zimbra_auto_reply_time_start'],
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
            
            $main_editor = new DateTimeEdit('zimbra_auto_reply_time_stop_edit', false, 'Y-m-d H:i');
            
            $filterBuilder->addColumn(
                $columns['zimbra_auto_reply_time_stop'],
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
            
            $main_editor = new TextEdit('zimbra_mail_forwarding_address_edit');
            
            $filterBuilder->addColumn(
                $columns['zimbra_mail_forwarding_address'],
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
            
            $main_editor = new ComboBox('zimbra_forward_local_copy');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['zimbra_forward_local_copy'],
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
            
            $main_editor = new TextEdit('conf_password_min_length_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_length'],
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
            
            $main_editor = new TextEdit('conf_password_max_length_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_max_length'],
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
            
            $main_editor = new TextEdit('conf_password_min_upper_case_chars_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_upper_case_chars'],
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
            
            $main_editor = new TextEdit('conf_password_min_lower_case_chars_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_lower_case_chars'],
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
            
            $main_editor = new TextEdit('conf_password_min_numeric_chars_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_numeric_chars'],
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
            
            $main_editor = new TextEdit('conf_password_min_digits_or_puncs_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_digits_or_puncs'],
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
            
            $main_editor = new TextEdit('conf_password_min_punctuation_chars_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_punctuation_chars'],
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
            
            $main_editor = new TextEdit('conf_password_min_age_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_min_age'],
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
            
            $main_editor = new TextEdit('conf_password_max_age_edit');
            
            $filterBuilder->addColumn(
                $columns['conf_password_max_age'],
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
            
            $main_editor = new ComboBox('account_system');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['account_system'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('username', 'username', 'caption_username', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_name');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quota_size field
            //
            $column = new StringTransformViewColumn('quota_size', 'quota_size', 'caption_quota_size', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quota_usage field
            //
            $column = new StringTransformViewColumn('quota_usage', 'quota_usage', 'caption_quota_usage', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('username', 'username', 'caption_username', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quota_size field
            //
            $column = new StringTransformViewColumn('quota_size', 'quota_size', 'caption_quota_size', $this->dataset);
            $column->SetOrderable(false);
            $column->setStringTransformFunction('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quota_usage field
            //
            $column = new StringTransformViewColumn('quota_usage', 'quota_usage', 'caption_quota_usage', $this->dataset);
            $column->SetOrderable(false);
            $column->setStringTransformFunction('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_authentication field
            //
            $column = new CheckboxViewColumn('preauth_authentication', 'preauth_authentication', 'caption_preauth_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_password_must_change field
            //
            $column = new CheckboxViewColumn('preauth_password_must_change', 'preauth_password_must_change', 'caption_preauth_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_password_locked field
            //
            $column = new CheckboxViewColumn('preauth_password_locked', 'preauth_password_locked', 'caption_preauth_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_password_expire field
            //
            $column = new CheckboxViewColumn('preauth_password_expire', 'preauth_password_expire', 'caption_preauth_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_password_expire_time field
            //
            $column = new DateTimeViewColumn('preauth_password_expire_time', 'preauth_password_expire_time', 'caption_preauth_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_last_login_time field
            //
            $column = new DateTimeViewColumn('preauth_last_login_time', 'preauth_last_login_time', 'caption_preauth_last_login_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_restrict_login field
            //
            $column = new CheckboxViewColumn('preauth_restrict_login', 'preauth_restrict_login', 'caption_preauth_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for preauth_access_other_account field
            //
            $column = new NumberViewColumn('preauth_access_other_account', 'preauth_access_other_account', 'caption_preauth_access_other_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_authentication field
            //
            $column = new CheckboxViewColumn('zimbra_authentication', 'zimbra_authentication', 'caption_zimbra_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_password_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_password_must_change field
            //
            $column = new CheckboxViewColumn('zimbra_password_must_change', 'zimbra_password_must_change', 'caption_zimbra_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_password_locked field
            //
            $column = new CheckboxViewColumn('zimbra_password_locked', 'zimbra_password_locked', 'caption_zimbra_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_password_expire field
            //
            $column = new CheckboxViewColumn('zimbra_password_expire', 'zimbra_password_expire', 'caption_zimbra_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_password_expire_time field
            //
            $column = new DateTimeViewColumn('zimbra_password_expire_time', 'zimbra_password_expire_time', 'caption_zimbra_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_pop3 field
            //
            $column = new CheckboxViewColumn('zimbra_pop3', 'zimbra_pop3', 'caption_zimbra_pop3', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_imap field
            //
            $column = new CheckboxViewColumn('zimbra_imap', 'zimbra_imap', 'caption_zimbra_imap', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_pop3_include_spam field
            //
            $column = new CheckboxViewColumn('zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', 'caption_zimbra_pop3_include_spam', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_hide_of_contacts field
            //
            $column = new CheckboxViewColumn('zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', 'caption_zimbra_hide_of_contacts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_auto_reply field
            //
            $column = new CheckboxViewColumn('zimbra_auto_reply', 'zimbra_auto_reply', 'caption_zimbra_auto_reply', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_auto_reply_message_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_start field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', 'caption_zimbra_auto_reply_time_start', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_stop field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', 'caption_zimbra_auto_reply_time_stop', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_mail_forwarding_address_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zimbra_forward_local_copy field
            //
            $column = new CheckboxViewColumn('zimbra_forward_local_copy', 'zimbra_forward_local_copy', 'caption_zimbra_forward_local_copy', $this->dataset);
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
            // View column for conf_password_min_length field
            //
            $column = new NumberViewColumn('conf_password_min_length', 'conf_password_min_length', 'caption_conf_password_min_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_max_length field
            //
            $column = new NumberViewColumn('conf_password_max_length', 'conf_password_max_length', 'caption_conf_password_max_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_upper_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', 'caption_conf_password_min_upper_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_lower_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', 'caption_conf_password_min_lower_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_numeric_chars field
            //
            $column = new NumberViewColumn('conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', 'caption_conf_password_min_numeric_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_digits_or_puncs field
            //
            $column = new NumberViewColumn('conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', 'caption_conf_password_min_digits_or_puncs', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_punctuation_chars field
            //
            $column = new NumberViewColumn('conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', 'caption_conf_password_min_punctuation_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_min_age field
            //
            $column = new NumberViewColumn('conf_password_min_age', 'conf_password_min_age', 'caption_conf_password_min_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conf_password_max_age field
            //
            $column = new NumberViewColumn('conf_password_max_age', 'conf_password_max_age', 'caption_conf_password_max_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for account_system field
            //
            $column = new CheckboxViewColumn('account_system', 'account_system', 'caption_account_system', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            // Edit column for username field
            //
            $editor = new TextEdit('username_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_username', 'username', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[a-zA-Z0-9._-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for domain_id field
            //
            $editor = new DynamicCombobox('domain_id_edit', $this->CreateLinkBuilder());
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_id', 'domain_id', 'domain_id_domain', 'edit_zimbra_account_domain_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'domain', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(zimbra_account_domain_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for size field
            //
            $editor = new TextEdit('size_edit');
            $editColumn = new CustomEditColumn('caption_size', 'size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_authentication field
            //
            $editor = new CheckBox('preauth_authentication_edit');
            $editColumn = new CustomEditColumn('caption_preauth_authentication', 'preauth_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_password field
            //
            $editor = new TextEdit('preauth_password_edit');$editor->SetPasswordMode(true);
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_preauth_password', 'preauth_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_must_change field
            //
            $editor = new CheckBox('preauth_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_must_change', 'preauth_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_locked field
            //
            $editor = new CheckBox('preauth_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_locked', 'preauth_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire field
            //
            $editor = new CheckBox('preauth_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire', 'preauth_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire_time field
            //
            $editor = new DateTimeEdit('preauth_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire_time', 'preauth_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_last_login_time field
            //
            $editor = new DateTimeEdit('preauth_last_login_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_last_login_time', 'preauth_last_login_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_restrict_login field
            //
            $editor = new CheckBox('preauth_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_preauth_restrict_login', 'preauth_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for preauth_access_other_account field
            //
            $editor = new CheckBox('preauth_access_other_account_edit');
            $editColumn = new CustomEditColumn('caption_preauth_access_other_account', 'preauth_access_other_account', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_authentication field
            //
            $editor = new CheckBox('zimbra_authentication_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_authentication', 'zimbra_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password field
            //
            $editor = new TextEdit('zimbra_password_edit');$editor->SetPasswordMode(true);
            $editColumn = new CustomEditColumn('caption_zimbra_password', 'zimbra_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_must_change field
            //
            $editor = new CheckBox('zimbra_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_must_change', 'zimbra_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_locked field
            //
            $editor = new CheckBox('zimbra_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_locked', 'zimbra_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire field
            //
            $editor = new CheckBox('zimbra_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire', 'zimbra_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire_time field
            //
            $editor = new DateTimeEdit('zimbra_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire_time', 'zimbra_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3 field
            //
            $editor = new CheckBox('zimbra_pop3_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3', 'zimbra_pop3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_imap field
            //
            $editor = new CheckBox('zimbra_imap_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_imap', 'zimbra_imap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3_include_spam field
            //
            $editor = new CheckBox('zimbra_pop3_include_spam_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_hide_of_contacts field
            //
            $editor = new CheckBox('zimbra_hide_of_contacts_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply field
            //
            $editor = new CheckBox('zimbra_auto_reply_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply', 'zimbra_auto_reply', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_message field
            //
            $editor = new TextAreaEdit('zimbra_auto_reply_message_edit', 50, 8);
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_message', 'zimbra_auto_reply_message', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_start field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_start_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_stop field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_stop_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_mail_forwarding_address field
            //
            $editor = new TextEdit('zimbra_mail_forwarding_address_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zimbra_forward_local_copy field
            //
            $editor = new CheckBox('zimbra_forward_local_copy_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_forward_local_copy', 'zimbra_forward_local_copy', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_length field
            //
            $editor = new TextEdit('conf_password_min_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_length', 'conf_password_min_length', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_max_length field
            //
            $editor = new TextEdit('conf_password_max_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_length', 'conf_password_max_length', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_upper_case_chars field
            //
            $editor = new TextEdit('conf_password_min_upper_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_lower_case_chars field
            //
            $editor = new TextEdit('conf_password_min_lower_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_numeric_chars field
            //
            $editor = new TextEdit('conf_password_min_numeric_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_digits_or_puncs field
            //
            $editor = new TextEdit('conf_password_min_digits_or_puncs_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_punctuation_chars field
            //
            $editor = new TextEdit('conf_password_min_punctuation_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_age field
            //
            $editor = new TextEdit('conf_password_min_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_age', 'conf_password_min_age', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conf_password_max_age field
            //
            $editor = new TextEdit('conf_password_max_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_age', 'conf_password_max_age', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for account_system field
            //
            $editor = new CheckBox('account_system_edit');
            $editColumn = new CustomEditColumn('caption_account_system', 'account_system', $editor, $this->dataset);
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
            // Edit column for username field
            //
            $editor = new TextEdit('username_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_username', 'username', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[a-zA-Z0-9._-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for domain_id field
            //
            $editor = new DynamicCombobox('domain_id_edit', $this->CreateLinkBuilder());
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_id', 'domain_id', 'domain_id_domain', 'multi_edit_zimbra_account_domain_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'domain', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(zimbra_account_domain_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for size field
            //
            $editor = new TextEdit('size_edit');
            $editColumn = new CustomEditColumn('caption_size', 'size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_authentication field
            //
            $editor = new CheckBox('preauth_authentication_edit');
            $editColumn = new CustomEditColumn('caption_preauth_authentication', 'preauth_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_must_change field
            //
            $editor = new CheckBox('preauth_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_must_change', 'preauth_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_locked field
            //
            $editor = new CheckBox('preauth_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_locked', 'preauth_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire field
            //
            $editor = new CheckBox('preauth_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire', 'preauth_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire_time field
            //
            $editor = new DateTimeEdit('preauth_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire_time', 'preauth_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_last_login_time field
            //
            $editor = new DateTimeEdit('preauth_last_login_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_last_login_time', 'preauth_last_login_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_restrict_login field
            //
            $editor = new CheckBox('preauth_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_preauth_restrict_login', 'preauth_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for preauth_access_other_account field
            //
            $editor = new CheckBox('preauth_access_other_account_edit');
            $editColumn = new CustomEditColumn('caption_preauth_access_other_account', 'preauth_access_other_account', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_authentication field
            //
            $editor = new CheckBox('zimbra_authentication_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_authentication', 'zimbra_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password field
            //
            $editor = new TextEdit('zimbra_password_edit');$editor->SetPasswordMode(true);
            $editColumn = new CustomEditColumn('caption_zimbra_password', 'zimbra_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_must_change field
            //
            $editor = new CheckBox('zimbra_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_must_change', 'zimbra_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_locked field
            //
            $editor = new CheckBox('zimbra_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_locked', 'zimbra_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire field
            //
            $editor = new CheckBox('zimbra_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire', 'zimbra_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire_time field
            //
            $editor = new DateTimeEdit('zimbra_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire_time', 'zimbra_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3 field
            //
            $editor = new CheckBox('zimbra_pop3_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3', 'zimbra_pop3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_imap field
            //
            $editor = new CheckBox('zimbra_imap_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_imap', 'zimbra_imap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3_include_spam field
            //
            $editor = new CheckBox('zimbra_pop3_include_spam_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_hide_of_contacts field
            //
            $editor = new CheckBox('zimbra_hide_of_contacts_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply field
            //
            $editor = new CheckBox('zimbra_auto_reply_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply', 'zimbra_auto_reply', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_message field
            //
            $editor = new TextAreaEdit('zimbra_auto_reply_message_edit', 50, 8);
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_message', 'zimbra_auto_reply_message', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_start field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_start_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_stop field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_stop_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_mail_forwarding_address field
            //
            $editor = new TextEdit('zimbra_mail_forwarding_address_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zimbra_forward_local_copy field
            //
            $editor = new CheckBox('zimbra_forward_local_copy_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_forward_local_copy', 'zimbra_forward_local_copy', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_length field
            //
            $editor = new TextEdit('conf_password_min_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_length', 'conf_password_min_length', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_max_length field
            //
            $editor = new TextEdit('conf_password_max_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_length', 'conf_password_max_length', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_upper_case_chars field
            //
            $editor = new TextEdit('conf_password_min_upper_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_lower_case_chars field
            //
            $editor = new TextEdit('conf_password_min_lower_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_numeric_chars field
            //
            $editor = new TextEdit('conf_password_min_numeric_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_digits_or_puncs field
            //
            $editor = new TextEdit('conf_password_min_digits_or_puncs_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_punctuation_chars field
            //
            $editor = new TextEdit('conf_password_min_punctuation_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_min_age field
            //
            $editor = new TextEdit('conf_password_min_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_age', 'conf_password_min_age', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for conf_password_max_age field
            //
            $editor = new TextEdit('conf_password_max_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_age', 'conf_password_max_age', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for account_system field
            //
            $editor = new CheckBox('account_system_edit');
            $editColumn = new CustomEditColumn('caption_account_system', 'account_system', $editor, $this->dataset);
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
            // Edit column for username field
            //
            $editor = new TextEdit('username_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_username', 'username', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[a-zA-Z0-9._-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for domain_id field
            //
            $editor = new DynamicCombobox('domain_id_edit', $this->CreateLinkBuilder());
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_id', 'domain_id', 'domain_id_domain', 'insert_zimbra_account_domain_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'domain', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(zimbra_account_domain_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for size field
            //
            $editor = new TextEdit('size_edit');
            $editColumn = new CustomEditColumn('caption_size', 'size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_authentication field
            //
            $editor = new CheckBox('preauth_authentication_edit');
            $editColumn = new CustomEditColumn('caption_preauth_authentication', 'preauth_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_password field
            //
            $editor = new TextEdit('preauth_password_edit');$editor->SetPasswordMode(true);
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_preauth_password', 'preauth_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_password_must_change field
            //
            $editor = new CheckBox('preauth_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_must_change', 'preauth_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_password_locked field
            //
            $editor = new CheckBox('preauth_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_locked', 'preauth_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire field
            //
            $editor = new CheckBox('preauth_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire', 'preauth_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_password_expire_time field
            //
            $editor = new DateTimeEdit('preauth_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_password_expire_time', 'preauth_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_last_login_time field
            //
            $editor = new DateTimeEdit('preauth_last_login_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_preauth_last_login_time', 'preauth_last_login_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_restrict_login field
            //
            $editor = new CheckBox('preauth_restrict_login_edit');
            $editColumn = new CustomEditColumn('caption_preauth_restrict_login', 'preauth_restrict_login', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for preauth_access_other_account field
            //
            $editor = new CheckBox('preauth_access_other_account_edit');
            $editColumn = new CustomEditColumn('caption_preauth_access_other_account', 'preauth_access_other_account', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_authentication field
            //
            $editor = new CheckBox('zimbra_authentication_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_authentication', 'zimbra_authentication', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_password field
            //
            $editor = new TextEdit('zimbra_password_edit');$editor->SetPasswordMode(true);
            $editColumn = new CustomEditColumn('caption_zimbra_password', 'zimbra_password', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_password_must_change field
            //
            $editor = new CheckBox('zimbra_password_must_change_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_must_change', 'zimbra_password_must_change', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_password_locked field
            //
            $editor = new CheckBox('zimbra_password_locked_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_locked', 'zimbra_password_locked', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire field
            //
            $editor = new CheckBox('zimbra_password_expire_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire', 'zimbra_password_expire', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_password_expire_time field
            //
            $editor = new DateTimeEdit('zimbra_password_expire_time_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_password_expire_time', 'zimbra_password_expire_time', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3 field
            //
            $editor = new CheckBox('zimbra_pop3_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3', 'zimbra_pop3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_imap field
            //
            $editor = new CheckBox('zimbra_imap_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_imap', 'zimbra_imap', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_pop3_include_spam field
            //
            $editor = new CheckBox('zimbra_pop3_include_spam_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_hide_of_contacts field
            //
            $editor = new CheckBox('zimbra_hide_of_contacts_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply field
            //
            $editor = new CheckBox('zimbra_auto_reply_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply', 'zimbra_auto_reply', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_message field
            //
            $editor = new TextAreaEdit('zimbra_auto_reply_message_edit', 50, 8);
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_message', 'zimbra_auto_reply_message', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_start field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_start_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_auto_reply_time_stop field
            //
            $editor = new DateTimeEdit('zimbra_auto_reply_time_stop_edit', false, 'Y-m-d H:i');
            $editColumn = new CustomEditColumn('caption_zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_mail_forwarding_address field
            //
            $editor = new TextEdit('zimbra_mail_forwarding_address_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zimbra_forward_local_copy field
            //
            $editor = new CheckBox('zimbra_forward_local_copy_edit');
            $editColumn = new CustomEditColumn('caption_zimbra_forward_local_copy', 'zimbra_forward_local_copy', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_length field
            //
            $editor = new TextEdit('conf_password_min_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_length', 'conf_password_min_length', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('7');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_max_length field
            //
            $editor = new TextEdit('conf_password_max_length_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_length', 'conf_password_max_length', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('64');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_upper_case_chars field
            //
            $editor = new TextEdit('conf_password_min_upper_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_lower_case_chars field
            //
            $editor = new TextEdit('conf_password_min_lower_case_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_numeric_chars field
            //
            $editor = new TextEdit('conf_password_min_numeric_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_digits_or_puncs field
            //
            $editor = new TextEdit('conf_password_min_digits_or_puncs_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_punctuation_chars field
            //
            $editor = new TextEdit('conf_password_min_punctuation_chars_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_min_age field
            //
            $editor = new TextEdit('conf_password_min_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_min_age', 'conf_password_min_age', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conf_password_max_age field
            //
            $editor = new TextEdit('conf_password_max_age_edit');
            $editColumn = new CustomEditColumn('caption_conf_password_max_age', 'conf_password_max_age', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('999');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MaxValueValidator(9999, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(0, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for account_system field
            //
            $editor = new CheckBox('account_system_edit');
            $editColumn = new CustomEditColumn('caption_account_system', 'account_system', $editor, $this->dataset);
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('username', 'username', 'caption_username', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for size field
            //
            $column = new TextViewColumn('size', 'size', 'caption_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddPrintColumn($column);
            
            //
            // View column for usage field
            //
            $column = new TextViewColumn('usage', 'usage', 'caption_usage', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quota_size field
            //
            $column = new StringTransformViewColumn('quota_size', 'quota_size', 'caption_quota_size', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quota_usage field
            //
            $column = new StringTransformViewColumn('quota_usage', 'quota_usage', 'caption_quota_usage', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_authentication field
            //
            $column = new CheckboxViewColumn('preauth_authentication', 'preauth_authentication', 'caption_preauth_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_password field
            //
            $column = new TextViewColumn('preauth_password', 'preauth_password', 'caption_preauth_password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_password_must_change field
            //
            $column = new CheckboxViewColumn('preauth_password_must_change', 'preauth_password_must_change', 'caption_preauth_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_password_locked field
            //
            $column = new CheckboxViewColumn('preauth_password_locked', 'preauth_password_locked', 'caption_preauth_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_password_expire field
            //
            $column = new CheckboxViewColumn('preauth_password_expire', 'preauth_password_expire', 'caption_preauth_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_password_expire_time field
            //
            $column = new DateTimeViewColumn('preauth_password_expire_time', 'preauth_password_expire_time', 'caption_preauth_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_last_login_time field
            //
            $column = new DateTimeViewColumn('preauth_last_login_time', 'preauth_last_login_time', 'caption_preauth_last_login_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_restrict_login field
            //
            $column = new CheckboxViewColumn('preauth_restrict_login', 'preauth_restrict_login', 'caption_preauth_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for preauth_access_other_account field
            //
            $column = new NumberViewColumn('preauth_access_other_account', 'preauth_access_other_account', 'caption_preauth_access_other_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_authentication field
            //
            $column = new CheckboxViewColumn('zimbra_authentication', 'zimbra_authentication', 'caption_zimbra_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_password_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_password_must_change field
            //
            $column = new CheckboxViewColumn('zimbra_password_must_change', 'zimbra_password_must_change', 'caption_zimbra_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_password_locked field
            //
            $column = new CheckboxViewColumn('zimbra_password_locked', 'zimbra_password_locked', 'caption_zimbra_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_password_expire field
            //
            $column = new CheckboxViewColumn('zimbra_password_expire', 'zimbra_password_expire', 'caption_zimbra_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_password_expire_time field
            //
            $column = new DateTimeViewColumn('zimbra_password_expire_time', 'zimbra_password_expire_time', 'caption_zimbra_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_pop3 field
            //
            $column = new CheckboxViewColumn('zimbra_pop3', 'zimbra_pop3', 'caption_zimbra_pop3', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_imap field
            //
            $column = new CheckboxViewColumn('zimbra_imap', 'zimbra_imap', 'caption_zimbra_imap', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_pop3_include_spam field
            //
            $column = new CheckboxViewColumn('zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', 'caption_zimbra_pop3_include_spam', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_auto_reply field
            //
            $column = new CheckboxViewColumn('zimbra_auto_reply', 'zimbra_auto_reply', 'caption_zimbra_auto_reply', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_auto_reply_message_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_start field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', 'caption_zimbra_auto_reply_time_start', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_stop field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', 'caption_zimbra_auto_reply_time_stop', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_mail_forwarding_address_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for zimbra_forward_local_copy field
            //
            $column = new CheckboxViewColumn('zimbra_forward_local_copy', 'zimbra_forward_local_copy', 'caption_zimbra_forward_local_copy', $this->dataset);
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
            // View column for conf_password_min_length field
            //
            $column = new NumberViewColumn('conf_password_min_length', 'conf_password_min_length', 'caption_conf_password_min_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_max_length field
            //
            $column = new NumberViewColumn('conf_password_max_length', 'conf_password_max_length', 'caption_conf_password_max_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_upper_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', 'caption_conf_password_min_upper_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_lower_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', 'caption_conf_password_min_lower_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_numeric_chars field
            //
            $column = new NumberViewColumn('conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', 'caption_conf_password_min_numeric_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_digits_or_puncs field
            //
            $column = new NumberViewColumn('conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', 'caption_conf_password_min_digits_or_puncs', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_punctuation_chars field
            //
            $column = new NumberViewColumn('conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', 'caption_conf_password_min_punctuation_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_min_age field
            //
            $column = new NumberViewColumn('conf_password_min_age', 'conf_password_min_age', 'caption_conf_password_min_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conf_password_max_age field
            //
            $column = new NumberViewColumn('conf_password_max_age', 'conf_password_max_age', 'caption_conf_password_max_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for account_system field
            //
            $column = new CheckboxViewColumn('account_system', 'account_system', 'caption_account_system', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%id%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for username field
            //
            $column = new TextViewColumn('username', 'username', 'caption_username', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for size field
            //
            $column = new TextViewColumn('size', 'size', 'caption_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddExportColumn($column);
            
            //
            // View column for usage field
            //
            $column = new TextViewColumn('usage', 'usage', 'caption_usage', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddExportColumn($column);
            
            //
            // View column for quota_size field
            //
            $column = new StringTransformViewColumn('quota_size', 'quota_size', 'caption_quota_size', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddExportColumn($column);
            
            //
            // View column for quota_usage field
            //
            $column = new StringTransformViewColumn('quota_usage', 'quota_usage', 'caption_quota_usage', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_authentication field
            //
            $column = new CheckboxViewColumn('preauth_authentication', 'preauth_authentication', 'caption_preauth_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_password field
            //
            $column = new TextViewColumn('preauth_password', 'preauth_password', 'caption_preauth_password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_password_must_change field
            //
            $column = new CheckboxViewColumn('preauth_password_must_change', 'preauth_password_must_change', 'caption_preauth_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_password_locked field
            //
            $column = new CheckboxViewColumn('preauth_password_locked', 'preauth_password_locked', 'caption_preauth_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_password_expire field
            //
            $column = new CheckboxViewColumn('preauth_password_expire', 'preauth_password_expire', 'caption_preauth_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_password_expire_time field
            //
            $column = new DateTimeViewColumn('preauth_password_expire_time', 'preauth_password_expire_time', 'caption_preauth_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_last_login_time field
            //
            $column = new DateTimeViewColumn('preauth_last_login_time', 'preauth_last_login_time', 'caption_preauth_last_login_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_restrict_login field
            //
            $column = new CheckboxViewColumn('preauth_restrict_login', 'preauth_restrict_login', 'caption_preauth_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for preauth_access_other_account field
            //
            $column = new NumberViewColumn('preauth_access_other_account', 'preauth_access_other_account', 'caption_preauth_access_other_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_authentication field
            //
            $column = new CheckboxViewColumn('zimbra_authentication', 'zimbra_authentication', 'caption_zimbra_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_password_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_password_must_change field
            //
            $column = new CheckboxViewColumn('zimbra_password_must_change', 'zimbra_password_must_change', 'caption_zimbra_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_password_locked field
            //
            $column = new CheckboxViewColumn('zimbra_password_locked', 'zimbra_password_locked', 'caption_zimbra_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_password_expire field
            //
            $column = new CheckboxViewColumn('zimbra_password_expire', 'zimbra_password_expire', 'caption_zimbra_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_password_expire_time field
            //
            $column = new DateTimeViewColumn('zimbra_password_expire_time', 'zimbra_password_expire_time', 'caption_zimbra_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_pop3 field
            //
            $column = new CheckboxViewColumn('zimbra_pop3', 'zimbra_pop3', 'caption_zimbra_pop3', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_imap field
            //
            $column = new CheckboxViewColumn('zimbra_imap', 'zimbra_imap', 'caption_zimbra_imap', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_pop3_include_spam field
            //
            $column = new CheckboxViewColumn('zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', 'caption_zimbra_pop3_include_spam', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_hide_of_contacts field
            //
            $column = new CheckboxViewColumn('zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', 'caption_zimbra_hide_of_contacts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_auto_reply field
            //
            $column = new CheckboxViewColumn('zimbra_auto_reply', 'zimbra_auto_reply', 'caption_zimbra_auto_reply', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_auto_reply_message_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_start field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', 'caption_zimbra_auto_reply_time_start', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_stop field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', 'caption_zimbra_auto_reply_time_stop', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_mail_forwarding_address_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for zimbra_forward_local_copy field
            //
            $column = new CheckboxViewColumn('zimbra_forward_local_copy', 'zimbra_forward_local_copy', 'caption_zimbra_forward_local_copy', $this->dataset);
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
            // View column for conf_password_min_length field
            //
            $column = new NumberViewColumn('conf_password_min_length', 'conf_password_min_length', 'caption_conf_password_min_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_max_length field
            //
            $column = new NumberViewColumn('conf_password_max_length', 'conf_password_max_length', 'caption_conf_password_max_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_upper_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', 'caption_conf_password_min_upper_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_lower_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', 'caption_conf_password_min_lower_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_numeric_chars field
            //
            $column = new NumberViewColumn('conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', 'caption_conf_password_min_numeric_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_digits_or_puncs field
            //
            $column = new NumberViewColumn('conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', 'caption_conf_password_min_digits_or_puncs', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_punctuation_chars field
            //
            $column = new NumberViewColumn('conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', 'caption_conf_password_min_punctuation_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_min_age field
            //
            $column = new NumberViewColumn('conf_password_min_age', 'conf_password_min_age', 'caption_conf_password_min_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conf_password_max_age field
            //
            $column = new NumberViewColumn('conf_password_max_age', 'conf_password_max_age', 'caption_conf_password_max_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for account_system field
            //
            $column = new CheckboxViewColumn('account_system', 'account_system', 'caption_account_system', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            // View column for username field
            //
            $column = new TextViewColumn('username', 'username', 'caption_username', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for size field
            //
            $column = new TextViewColumn('size', 'size', 'caption_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddCompareColumn($column);
            
            //
            // View column for usage field
            //
            $column = new TextViewColumn('usage', 'usage', 'caption_usage', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddCompareColumn($column);
            
            //
            // View column for quota_size field
            //
            $column = new StringTransformViewColumn('quota_size', 'quota_size', 'caption_quota_size', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for quota_usage field
            //
            $column = new StringTransformViewColumn('quota_usage', 'quota_usage', 'caption_quota_usage', $this->dataset);
            $column->SetOrderable(false);
            $column->setAlign('right');
            $column->setStringTransformFunction('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_authentication field
            //
            $column = new CheckboxViewColumn('preauth_authentication', 'preauth_authentication', 'caption_preauth_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_password field
            //
            $column = new TextViewColumn('preauth_password', 'preauth_password', 'caption_preauth_password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_password_must_change field
            //
            $column = new CheckboxViewColumn('preauth_password_must_change', 'preauth_password_must_change', 'caption_preauth_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_password_locked field
            //
            $column = new CheckboxViewColumn('preauth_password_locked', 'preauth_password_locked', 'caption_preauth_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_password_expire field
            //
            $column = new CheckboxViewColumn('preauth_password_expire', 'preauth_password_expire', 'caption_preauth_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_password_expire_time field
            //
            $column = new DateTimeViewColumn('preauth_password_expire_time', 'preauth_password_expire_time', 'caption_preauth_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_last_login_time field
            //
            $column = new DateTimeViewColumn('preauth_last_login_time', 'preauth_last_login_time', 'caption_preauth_last_login_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_restrict_login field
            //
            $column = new CheckboxViewColumn('preauth_restrict_login', 'preauth_restrict_login', 'caption_preauth_restrict_login', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for preauth_access_other_account field
            //
            $column = new NumberViewColumn('preauth_access_other_account', 'preauth_access_other_account', 'caption_preauth_access_other_account', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_authentication field
            //
            $column = new CheckboxViewColumn('zimbra_authentication', 'zimbra_authentication', 'caption_zimbra_authentication', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_password_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_password_must_change field
            //
            $column = new CheckboxViewColumn('zimbra_password_must_change', 'zimbra_password_must_change', 'caption_zimbra_password_must_change', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_password_locked field
            //
            $column = new CheckboxViewColumn('zimbra_password_locked', 'zimbra_password_locked', 'caption_zimbra_password_locked', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_password_expire field
            //
            $column = new CheckboxViewColumn('zimbra_password_expire', 'zimbra_password_expire', 'caption_zimbra_password_expire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_password_expire_time field
            //
            $column = new DateTimeViewColumn('zimbra_password_expire_time', 'zimbra_password_expire_time', 'caption_zimbra_password_expire_time', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_pop3 field
            //
            $column = new CheckboxViewColumn('zimbra_pop3', 'zimbra_pop3', 'caption_zimbra_pop3', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_imap field
            //
            $column = new CheckboxViewColumn('zimbra_imap', 'zimbra_imap', 'caption_zimbra_imap', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_pop3_include_spam field
            //
            $column = new CheckboxViewColumn('zimbra_pop3_include_spam', 'zimbra_pop3_include_spam', 'caption_zimbra_pop3_include_spam', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_hide_of_contacts field
            //
            $column = new CheckboxViewColumn('zimbra_hide_of_contacts', 'zimbra_hide_of_contacts', 'caption_zimbra_hide_of_contacts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_auto_reply field
            //
            $column = new CheckboxViewColumn('zimbra_auto_reply', 'zimbra_auto_reply', 'caption_zimbra_auto_reply', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_auto_reply_message_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_start field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_start', 'zimbra_auto_reply_time_start', 'caption_zimbra_auto_reply_time_start', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_auto_reply_time_stop field
            //
            $column = new DateTimeViewColumn('zimbra_auto_reply_time_stop', 'zimbra_auto_reply_time_stop', 'caption_zimbra_auto_reply_time_stop', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('zimbra_account_zimbra_mail_forwarding_address_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for zimbra_forward_local_copy field
            //
            $column = new CheckboxViewColumn('zimbra_forward_local_copy', 'zimbra_forward_local_copy', 'caption_zimbra_forward_local_copy', $this->dataset);
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
            // View column for conf_password_min_length field
            //
            $column = new NumberViewColumn('conf_password_min_length', 'conf_password_min_length', 'caption_conf_password_min_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_max_length field
            //
            $column = new NumberViewColumn('conf_password_max_length', 'conf_password_max_length', 'caption_conf_password_max_length', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_upper_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_upper_case_chars', 'conf_password_min_upper_case_chars', 'caption_conf_password_min_upper_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_lower_case_chars field
            //
            $column = new NumberViewColumn('conf_password_min_lower_case_chars', 'conf_password_min_lower_case_chars', 'caption_conf_password_min_lower_case_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_numeric_chars field
            //
            $column = new NumberViewColumn('conf_password_min_numeric_chars', 'conf_password_min_numeric_chars', 'caption_conf_password_min_numeric_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_digits_or_puncs field
            //
            $column = new NumberViewColumn('conf_password_min_digits_or_puncs', 'conf_password_min_digits_or_puncs', 'caption_conf_password_min_digits_or_puncs', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_punctuation_chars field
            //
            $column = new NumberViewColumn('conf_password_min_punctuation_chars', 'conf_password_min_punctuation_chars', 'caption_conf_password_min_punctuation_chars', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_min_age field
            //
            $column = new NumberViewColumn('conf_password_min_age', 'conf_password_min_age', 'caption_conf_password_min_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conf_password_max_age field
            //
            $column = new NumberViewColumn('conf_password_max_age', 'conf_password_max_age', 'caption_conf_password_max_age', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for account_system field
            //
            $column = new CheckboxViewColumn('account_system', 'account_system', 'caption_account_system', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            $this->SetViewFormTitle('%username%');
            $this->SetEditFormTitle('%username%');
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
            $grid->SetInsertClientEditorValueChangedScript('showFormValueChanged(zimbra_account_services, sender, editors);');
            
            $grid->SetEditClientEditorValueChangedScript('showFormValueChanged(zimbra_account_services, sender, editors);');
            
            $grid->SetInsertClientFormLoadedScript('showFormLoad(zimbra_account_services, editors);');
            
            $grid->SetEditClientFormLoadedScript('showFormLoad(zimbra_account_services, editors);');
            
            $grid->setCalculateControlValuesScript('// OnCalculateControlValues event body
            // editors[\'quota_usage\'].setValue(editors[\'size\'].getValue() + \' \' + editors[\'usage\'].getValue());
            
            /*if (editors[\'birthday\'].getValue())
            {
               require([\'moment\'], function(moment) {
                   editors[\'age\'].setValue(moment().diff(editors[\'birthday\'].getValue(), \'years\'));
               });
            }*/');
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_password_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_auto_reply_message_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_mail_forwarding_address_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_password_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_auto_reply_message_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_mail_forwarding_address_handler_compare', $column);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_zimbra_account_domain_id_search', 'id', 'domain', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_zimbra_account_domain_id_search', 'id', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_password field
            //
            $column = new TextViewColumn('zimbra_password', 'zimbra_password', 'caption_zimbra_password', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_password_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_auto_reply_message field
            //
            $column = new TextViewColumn('zimbra_auto_reply_message', 'zimbra_auto_reply_message', 'caption_zimbra_auto_reply_message', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_auto_reply_message_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for zimbra_mail_forwarding_address field
            //
            $column = new TextViewColumn('zimbra_mail_forwarding_address', 'zimbra_mail_forwarding_address', 'caption_zimbra_mail_forwarding_address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'zimbra_account_zimbra_mail_forwarding_address_handler_view', $column);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_zimbra_account_domain_id_search', 'id', 'domain', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '(service_mail = 1)'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_zimbra_account_domain_id_search', 'id', 'domain', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_zimbra_account_domain_idNestedPage_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            new zimbra_account_domain_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('zimbra_account.domain_id'));
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
            if ($fieldName == 'quota_size') {
            	$v = $rowData['size'];
            	$value = '0';
            
            	if ($v >= 1073741824) {
            		$value = round($v/1024/1024/1024, 0) . ' GB';
            	} elseif ($v >= 1048576) {
            		$value = round($v/1024/1024, 0) . ' MB';
            	} elseif ($v >= 1024) {
            		$value = round($v/1024, 0) . ' KB';
            	}
            }
            elseif ($fieldName == 'quota_usage') {
            	$success = '#18b118';
            	$warning = '#e81500';
            	$danger = '#e81500';
            	$percent = '0 %';
            	$color = 'gray';
            	$v = 0;
            	$usage = 0;
            
            	if ($rowData['size'] > 0 and $rowData['usage'] > 0) {
            		$v = round($rowData['usage'] * 100 / $rowData['size'], 0);
            		$usage = $v;
            		if ($v > 100) {
            			$usage = 100;
            		} elseif ($v >= 90) {
            			$color = $danger;
            		} elseif ($v >= 75) {
            			$color = $warning;
            		} elseif ($v > 0) {
            			$color = $success;
            		}
            		$percent = $v . ' %';
            	}
            
            	$value = '<div class="progress_bar"> ' .
            		'  <div class="progress_bar2">' .
            		'    <div style="width:'.$usage.'%; height:12px; background-color:'.$color.';"></div>' .
            		'  </div>' .
            		'  <div class="progress_bar3" style="color:'.$color.';">'.$percent.'</div>' .
            		'</div>';
            }
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
        $Page = new zimbra_accountPage("zimbra_account", "zimbra_account.php", GetCurrentUserPermissionSetForDataSource("zimbra_account"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("zimbra_account"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
