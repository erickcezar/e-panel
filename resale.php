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

    
    
    class resale_mx_idNestedPage extends NestedFormPage
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
    
    class resale_server_idNestedPage extends NestedFormPage
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
            $editColumn = new DynamicLookupEditColumn('caption_environment_id', 'environment_id', 'environment_id_name', 'insert_resale_server_idNestedPage_environment_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
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
    
    // OnBeforePageExecute event handler
    
    
    
    class resalePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleResale');
            $this->SetMenuLabel('LabelResale');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('description'),
                    new StringField('site'),
                    new IntegerField('max_domain', true),
                    new IntegerField('service_dns', true),
                    new StringField('dns_note'),
                    new IntegerField('mx_id'),
                    new IntegerField('service_mail', true),
                    new StringField('mail_note'),
                    new StringField('type_plan'),
                    new IntegerField('server_id'),
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
                    new StringField('web_rootdir', true),
                    new IntegerField('service_ftp', true),
                    new StringField('ftp_note'),
                    new IntegerField('ftp_max_user', true),
                    new IntegerField('service_smtp', true),
                    new StringField('smtp_note'),
                    new IntegerField('smtp_max_send', true),
                    new StringField('smtp_type_limit', true),
                    new IntegerField('service_backup', true),
                    new StringField('backup_note'),
                    new IntegerField('backup_size', true),
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
            $this->dataset->AddLookupField('mx_id', 'mx', new IntegerField('id'), new StringField('name', false, false, false, false, 'mx_id_name', 'mx_id_name_mx'), 'mx_id_name_mx');
            $this->dataset->AddLookupField('server_id', '`server`', new IntegerField('id'), new StringField('hostname', false, false, false, false, 'server_id_hostname', 'server_id_hostname_server'), 'server_id_hostname_server');
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
                new FilterColumn($this->dataset, 'name', 'name', 'caption_name'),
                new FilterColumn($this->dataset, 'description', 'description', 'caption_description'),
                new FilterColumn($this->dataset, 'site', 'site', 'caption_site'),
                new FilterColumn($this->dataset, 'max_domain', 'max_domain', 'caption_max_domain'),
                new FilterColumn($this->dataset, 'service_dns', 'service_dns', 'caption_service_dns'),
                new FilterColumn($this->dataset, 'dns_note', 'dns_note', 'caption_dns_note'),
                new FilterColumn($this->dataset, 'mx_id', 'mx_id_name', 'caption_mx_id'),
                new FilterColumn($this->dataset, 'service_mail', 'service_mail', 'caption_service_mail'),
                new FilterColumn($this->dataset, 'mail_note', 'mail_note', 'caption_mail_note'),
                new FilterColumn($this->dataset, 'type_plan', 'type_plan', 'caption_type_plan'),
                new FilterColumn($this->dataset, 'server_id', 'server_id_hostname', 'caption_server_id'),
                new FilterColumn($this->dataset, 'mail_max_domain', 'mail_max_domain', 'caption_mail_max_domain'),
                new FilterColumn($this->dataset, 'mail_max_account', 'mail_max_account', 'caption_mail_max_account'),
                new FilterColumn($this->dataset, 'mail_max_alias', 'mail_max_alias', 'caption_mail_max_alias'),
                new FilterColumn($this->dataset, 'mail_max_forward', 'mail_max_forward', 'caption_mail_max_forward'),
                new FilterColumn($this->dataset, 'mail_size', 'mail_size', 'caption_mail_size'),
                new FilterColumn($this->dataset, 'service_http', 'service_http', 'caption_service_http'),
                new FilterColumn($this->dataset, 'http_note', 'http_note', 'caption_http_note'),
                new FilterColumn($this->dataset, 'http_max_hosting', 'http_max_hosting', 'caption_http_max_hosting'),
                new FilterColumn($this->dataset, 'http_max_virtualhost', 'http_max_virtualhost', 'caption_http_max_virtualhost'),
                new FilterColumn($this->dataset, 'http_max_db', 'http_max_db', 'caption_http_max_db'),
                new FilterColumn($this->dataset, 'http_size', 'http_size', 'caption_http_size'),
                new FilterColumn($this->dataset, 'web_rootdir', 'web_rootdir', 'caption_web_rootdir'),
                new FilterColumn($this->dataset, 'service_ftp', 'service_ftp', 'caption_service_ftp'),
                new FilterColumn($this->dataset, 'ftp_note', 'ftp_note', 'caption_ftp_note'),
                new FilterColumn($this->dataset, 'ftp_max_user', 'ftp_max_user', 'caption_ftp_max_user'),
                new FilterColumn($this->dataset, 'service_smtp', 'service_smtp', 'caption_service_smtp'),
                new FilterColumn($this->dataset, 'smtp_note', 'smtp_note', 'caption_smtp_note'),
                new FilterColumn($this->dataset, 'smtp_max_send', 'smtp_max_send', 'caption_smtp_max_send'),
                new FilterColumn($this->dataset, 'smtp_type_limit', 'smtp_type_limit', 'caption_smtp_type_limit'),
                new FilterColumn($this->dataset, 'service_backup', 'service_backup', 'caption_service_backup'),
                new FilterColumn($this->dataset, 'backup_note', 'backup_note', 'caption_backup_note'),
                new FilterColumn($this->dataset, 'backup_size', 'backup_size', 'caption_backup_size'),
                new FilterColumn($this->dataset, 'service_mkmail', 'service_mkmail', 'caption_service_mkmail'),
                new FilterColumn($this->dataset, 'mkmail_note', 'mkmail_note', 'caption_mkmail_note'),
                new FilterColumn($this->dataset, 'service_ts', 'service_ts', 'caption_service_ts'),
                new FilterColumn($this->dataset, 'ts_note', 'ts_note', 'caption_ts_note'),
                new FilterColumn($this->dataset, 'service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate'),
                new FilterColumn($this->dataset, 'ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note'),
                new FilterColumn($this->dataset, 'service_other', 'service_other', 'caption_service_other'),
                new FilterColumn($this->dataset, 'other_note', 'other_note', 'caption_other_note'),
                new FilterColumn($this->dataset, 'active', 'active', 'caption_active'),
                new FilterColumn($this->dataset, 'created', 'created', 'caption_created'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'caption_updated')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['description'])
                ->addColumn($columns['site'])
                ->addColumn($columns['max_domain'])
                ->addColumn($columns['service_dns'])
                ->addColumn($columns['dns_note'])
                ->addColumn($columns['mx_id'])
                ->addColumn($columns['service_mail'])
                ->addColumn($columns['mail_note'])
                ->addColumn($columns['type_plan'])
                ->addColumn($columns['server_id'])
                ->addColumn($columns['mail_max_domain'])
                ->addColumn($columns['mail_max_account'])
                ->addColumn($columns['mail_max_alias'])
                ->addColumn($columns['mail_max_forward'])
                ->addColumn($columns['mail_size'])
                ->addColumn($columns['service_http'])
                ->addColumn($columns['http_note'])
                ->addColumn($columns['http_max_hosting'])
                ->addColumn($columns['http_max_virtualhost'])
                ->addColumn($columns['http_max_db'])
                ->addColumn($columns['http_size'])
                ->addColumn($columns['web_rootdir'])
                ->addColumn($columns['service_ftp'])
                ->addColumn($columns['ftp_note'])
                ->addColumn($columns['ftp_max_user'])
                ->addColumn($columns['service_smtp'])
                ->addColumn($columns['smtp_note'])
                ->addColumn($columns['smtp_max_send'])
                ->addColumn($columns['smtp_type_limit'])
                ->addColumn($columns['service_backup'])
                ->addColumn($columns['backup_note'])
                ->addColumn($columns['backup_size'])
                ->addColumn($columns['service_mkmail'])
                ->addColumn($columns['mkmail_note'])
                ->addColumn($columns['service_ts'])
                ->addColumn($columns['ts_note'])
                ->addColumn($columns['service_ip_dedicate'])
                ->addColumn($columns['ip_dedicate_note'])
                ->addColumn($columns['service_other'])
                ->addColumn($columns['other_note'])
                ->addColumn($columns['active'])
                ->addColumn($columns['created'])
                ->addColumn($columns['updated']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
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
            
            $main_editor = new TextEdit('name_edit');
            $main_editor->SetMaxLength(64);
            
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
            
            $main_editor = new TextEdit('description_edit');
            $main_editor->SetMaxLength(255);
            
            $filterBuilder->addColumn(
                $columns['description'],
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
            
            $main_editor = new TextEdit('site_edit');
            
            $filterBuilder->addColumn(
                $columns['site'],
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
            
            $main_editor = new TextEdit('max_domain_edit');
            
            $filterBuilder->addColumn(
                $columns['max_domain'],
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
            
            $main_editor = new TextEdit('dns_note');
            
            $filterBuilder->addColumn(
                $columns['dns_note'],
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
            
            $main_editor = new DynamicCombobox('mx_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_resale_mx_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('mx_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_resale_mx_id_search');
            
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
            
            $main_editor = new TextEdit('mail_note');
            
            $filterBuilder->addColumn(
                $columns['mail_note'],
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
            
            $main_editor = new ComboBox('type_plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('account', 'value_caption_account');
            $main_editor->addChoice('space', 'value_caption_space');
            $main_editor->addChoice('both', 'value_caption_both');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('type_plan');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('type_plan');
            
            $filterBuilder->addColumn(
                $columns['type_plan'],
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
            
            $main_editor = new DynamicCombobox('server_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_resale_server_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('server_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_resale_server_id_search');
            
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
            
            $main_editor = new TextEdit('mail_max_domain_edit');
            
            $filterBuilder->addColumn(
                $columns['mail_max_domain'],
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
            
            $main_editor = new TextEdit('http_note');
            
            $filterBuilder->addColumn(
                $columns['http_note'],
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
            
            $main_editor = new TextEdit('http_max_hosting_edit');
            
            $filterBuilder->addColumn(
                $columns['http_max_hosting'],
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
            
            $main_editor = new TextEdit('http_max_virtualhost_edit');
            
            $filterBuilder->addColumn(
                $columns['http_max_virtualhost'],
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
            
            $main_editor = new TextEdit('http_max_db_edit');
            
            $filterBuilder->addColumn(
                $columns['http_max_db'],
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
            
            $main_editor = new TextEdit('http_size_edit');
            
            $filterBuilder->addColumn(
                $columns['http_size'],
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
            
            $main_editor = new TextEdit('web_rootdir_edit');
            $main_editor->SetMaxLength(25);
            
            $filterBuilder->addColumn(
                $columns['web_rootdir'],
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
            
            $main_editor = new TextEdit('ftp_note');
            
            $filterBuilder->addColumn(
                $columns['ftp_note'],
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
            
            $main_editor = new TextEdit('ftp_max_user_edit');
            
            $filterBuilder->addColumn(
                $columns['ftp_max_user'],
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
            
            $main_editor = new ComboBox('service_smtp');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_smtp'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('smtp_note');
            
            $filterBuilder->addColumn(
                $columns['smtp_note'],
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
            
            $main_editor = new TextEdit('smtp_max_send_edit');
            
            $filterBuilder->addColumn(
                $columns['smtp_max_send'],
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
            
            $main_editor = new ComboBox('smtp_type_limit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('day', 'value_caption_day');
            $main_editor->addChoice('week', 'value_caption_week');
            $main_editor->addChoice('month', 'value_caption_month');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('smtp_type_limit');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('smtp_type_limit');
            
            $filterBuilder->addColumn(
                $columns['smtp_type_limit'],
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
            
            $main_editor = new ComboBox('service_backup');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_backup'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('backup_note');
            
            $filterBuilder->addColumn(
                $columns['backup_note'],
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
            
            $main_editor = new TextEdit('backup_size_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['backup_size'],
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
            
            $main_editor = new ComboBox('service_mkmail');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_mkmail'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('mkmail_note');
            
            $filterBuilder->addColumn(
                $columns['mkmail_note'],
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
            
            $main_editor = new ComboBox('service_ts');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_ts'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ts_note');
            
            $filterBuilder->addColumn(
                $columns['ts_note'],
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
            
            $main_editor = new ComboBox('service_ip_dedicate');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_ip_dedicate'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ip_dedicate_note');
            
            $filterBuilder->addColumn(
                $columns['ip_dedicate_note'],
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
            
            $main_editor = new ComboBox('service_other');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice(true, $this->GetLocalizerCaptions()->GetMessageString('True'));
            $main_editor->addChoice(false, $this->GetLocalizerCaptions()->GetMessageString('False'));
            
            $filterBuilder->addColumn(
                $columns['service_other'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('other_note');
            
            $filterBuilder->addColumn(
                $columns['other_note'],
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
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_name');
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
            // View column for service_smtp field
            //
            $column = new CheckboxViewColumn('service_smtp', 'service_smtp', 'caption_service_smtp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_smtp');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_backup field
            //
            $column = new CheckboxViewColumn('service_backup', 'service_backup', 'caption_service_backup', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_backup');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_mkmail field
            //
            $column = new CheckboxViewColumn('service_mkmail', 'service_mkmail', 'caption_service_mkmail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_mkmail');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_ts field
            //
            $column = new CheckboxViewColumn('service_ts', 'service_ts', 'caption_service_ts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_ts');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_ip_dedicate field
            //
            $column = new CheckboxViewColumn('service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_ip_dedicate');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for service_other field
            //
            $column = new CheckboxViewColumn('service_other', 'service_other', 'caption_service_other', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_service_other');
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
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_description_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_site_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for max_domain field
            //
            $column = new NumberViewColumn('max_domain', 'max_domain', 'caption_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_dns_note_handler_view');
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
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mail_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for type_plan field
            //
            $column = new TextViewColumn('type_plan', 'type_plan', 'caption_type_plan', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail_max_domain field
            //
            $column = new NumberViewColumn('mail_max_domain', 'mail_max_domain', 'caption_mail_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
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
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_http_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_max_hosting field
            //
            $column = new NumberViewColumn('http_max_hosting', 'http_max_hosting', 'caption_http_max_hosting', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_max_virtualhost field
            //
            $column = new NumberViewColumn('http_max_virtualhost', 'http_max_virtualhost', 'caption_http_max_virtualhost', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_max_db field
            //
            $column = new NumberViewColumn('http_max_db', 'http_max_db', 'caption_http_max_db', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for http_size field
            //
            $column = new NumberViewColumn('http_size', 'http_size', 'caption_http_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for web_rootdir field
            //
            $column = new TextViewColumn('web_rootdir', 'web_rootdir', 'caption_web_rootdir', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ftp_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ftp_max_user field
            //
            $column = new NumberViewColumn('ftp_max_user', 'ftp_max_user', 'caption_ftp_max_user', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_smtp field
            //
            $column = new CheckboxViewColumn('service_smtp', 'service_smtp', 'caption_service_smtp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_smtp_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for smtp_max_send field
            //
            $column = new TextViewColumn('smtp_max_send', 'smtp_max_send', 'caption_smtp_max_send', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for smtp_type_limit field
            //
            $column = new TextViewColumn('smtp_type_limit', 'smtp_type_limit', 'caption_smtp_type_limit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_backup field
            //
            $column = new CheckboxViewColumn('service_backup', 'service_backup', 'caption_service_backup', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_backup_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for backup_size field
            //
            $column = new TextViewColumn('backup_size', 'backup_size', 'caption_backup_size', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_mkmail field
            //
            $column = new CheckboxViewColumn('service_mkmail', 'service_mkmail', 'caption_service_mkmail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mkmail_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_ts field
            //
            $column = new CheckboxViewColumn('service_ts', 'service_ts', 'caption_service_ts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ts_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_ip_dedicate field
            //
            $column = new CheckboxViewColumn('service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ip_dedicate_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for service_other field
            //
            $column = new CheckboxViewColumn('service_other', 'service_other', 'caption_service_other', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_other_note_handler_view');
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
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[A-Z0-9-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for site field
            //
            $editor = new TextEdit('site_edit');
            $editColumn = new CustomEditColumn('caption_site', 'site', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for max_domain field
            //
            $editor = new TextEdit('max_domain_edit');
            $editColumn = new CustomEditColumn('caption_max_domain', 'max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
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
            // Edit column for dns_note field
            //
            $editor = new TextAreaEdit('dns_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_dns_note', 'dns_note', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'edit_resale_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_note field
            //
            $editor = new TextAreaEdit('mail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mail_note', 'mail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for type_plan field
            //
            $editor = new ComboBox('type_plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('account', 'value_caption_account');
            $editor->addChoice('space', 'value_caption_space');
            $editor->addChoice('both', 'value_caption_both');
            $editColumn = new CustomEditColumn('caption_type_plan', 'type_plan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', '_resale_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mail_max_domain field
            //
            $editor = new TextEdit('mail_max_domain_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_domain', 'mail_max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
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
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for http_note field
            //
            $editor = new TextAreaEdit('http_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_http_note', 'http_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_max_hosting field
            //
            $editor = new TextEdit('http_max_hosting_edit');
            $editColumn = new CustomEditColumn('caption_http_max_hosting', 'http_max_hosting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_max_virtualhost field
            //
            $editor = new TextEdit('http_max_virtualhost_edit');
            $editColumn = new CustomEditColumn('caption_http_max_virtualhost', 'http_max_virtualhost', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_max_db field
            //
            $editor = new TextEdit('http_max_db_edit');
            $editColumn = new CustomEditColumn('caption_http_max_db', 'http_max_db', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for http_size field
            //
            $editor = new TextEdit('http_size_edit');
            $editColumn = new CustomEditColumn('caption_http_size', 'http_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for web_rootdir field
            //
            $editor = new TextEdit('web_rootdir_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('caption_web_rootdir', 'web_rootdir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^/([a-zA-Z0-9@._-]+/?)+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for ftp_note field
            //
            $editor = new TextAreaEdit('ftp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ftp_note', 'ftp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ftp_max_user field
            //
            $editor = new TextEdit('ftp_max_user_edit');
            $editColumn = new CustomEditColumn('caption_ftp_max_user', 'ftp_max_user', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_smtp field
            //
            $editor = new CheckBox('service_smtp_edit');
            $editColumn = new CustomEditColumn('caption_service_smtp', 'service_smtp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for smtp_note field
            //
            $editor = new TextAreaEdit('smtp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_smtp_note', 'smtp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for smtp_max_send field
            //
            $editor = new TextEdit('smtp_max_send_edit');
            $editColumn = new CustomEditColumn('caption_smtp_max_send', 'smtp_max_send', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for smtp_type_limit field
            //
            $editor = new ComboBox('smtp_type_limit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('day', 'value_caption_day');
            $editor->addChoice('week', 'value_caption_week');
            $editor->addChoice('month', 'value_caption_month');
            $editColumn = new CustomEditColumn('caption_smtp_type_limit', 'smtp_type_limit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_backup field
            //
            $editor = new CheckBox('service_backup_edit');
            $editColumn = new CustomEditColumn('caption_service_backup', 'service_backup', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for backup_note field
            //
            $editor = new TextAreaEdit('backup_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_backup_note', 'backup_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for backup_size field
            //
            $editor = new TextEdit('backup_size_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_backup_size', 'backup_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_mkmail field
            //
            $editor = new CheckBox('service_mkmail_edit');
            $editColumn = new CustomEditColumn('caption_service_mkmail', 'service_mkmail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mkmail_note field
            //
            $editor = new TextAreaEdit('mkmail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mkmail_note', 'mkmail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_ts field
            //
            $editor = new CheckBox('service_ts_edit');
            $editColumn = new CustomEditColumn('caption_service_ts', 'service_ts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ts_note field
            //
            $editor = new TextAreaEdit('ts_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ts_note', 'ts_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_ip_dedicate field
            //
            $editor = new CheckBox('service_ip_dedicate_edit');
            $editColumn = new CustomEditColumn('caption_service_ip_dedicate', 'service_ip_dedicate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ip_dedicate_note field
            //
            $editor = new TextAreaEdit('ip_dedicate_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ip_dedicate_note', 'ip_dedicate_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for service_other field
            //
            $editor = new CheckBox('service_other_edit');
            $editColumn = new CustomEditColumn('caption_service_other', 'service_other', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for other_note field
            //
            $editor = new TextAreaEdit('other_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_other_note', 'other_note', $editor, $this->dataset);
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
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[A-Z0-9-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for site field
            //
            $editor = new TextEdit('site_edit');
            $editColumn = new CustomEditColumn('caption_site', 'site', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for max_domain field
            //
            $editor = new TextEdit('max_domain_edit');
            $editColumn = new CustomEditColumn('caption_max_domain', 'max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
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
            // Edit column for dns_note field
            //
            $editor = new TextAreaEdit('dns_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_dns_note', 'dns_note', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'multi_edit_resale_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_note field
            //
            $editor = new TextAreaEdit('mail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mail_note', 'mail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for type_plan field
            //
            $editor = new ComboBox('type_plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('account', 'value_caption_account');
            $editor->addChoice('space', 'value_caption_space');
            $editor->addChoice('both', 'value_caption_both');
            $editColumn = new CustomEditColumn('caption_type_plan', 'type_plan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', 'multi_edit_resale_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mail_max_domain field
            //
            $editor = new TextEdit('mail_max_domain_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_domain', 'mail_max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
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
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for http_note field
            //
            $editor = new TextAreaEdit('http_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_http_note', 'http_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_max_hosting field
            //
            $editor = new TextEdit('http_max_hosting_edit');
            $editColumn = new CustomEditColumn('caption_http_max_hosting', 'http_max_hosting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_max_virtualhost field
            //
            $editor = new TextEdit('http_max_virtualhost_edit');
            $editColumn = new CustomEditColumn('caption_http_max_virtualhost', 'http_max_virtualhost', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_max_db field
            //
            $editor = new TextEdit('http_max_db_edit');
            $editColumn = new CustomEditColumn('caption_http_max_db', 'http_max_db', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for http_size field
            //
            $editor = new TextEdit('http_size_edit');
            $editColumn = new CustomEditColumn('caption_http_size', 'http_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for web_rootdir field
            //
            $editor = new TextEdit('web_rootdir_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('caption_web_rootdir', 'web_rootdir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('^/([a-zA-Z0-9@._-]+/?)+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for ftp_note field
            //
            $editor = new TextAreaEdit('ftp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ftp_note', 'ftp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ftp_max_user field
            //
            $editor = new TextEdit('ftp_max_user_edit');
            $editColumn = new CustomEditColumn('caption_ftp_max_user', 'ftp_max_user', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_smtp field
            //
            $editor = new CheckBox('service_smtp_edit');
            $editColumn = new CustomEditColumn('caption_service_smtp', 'service_smtp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for smtp_note field
            //
            $editor = new TextAreaEdit('smtp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_smtp_note', 'smtp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for smtp_max_send field
            //
            $editor = new TextEdit('smtp_max_send_edit');
            $editColumn = new CustomEditColumn('caption_smtp_max_send', 'smtp_max_send', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for smtp_type_limit field
            //
            $editor = new ComboBox('smtp_type_limit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('day', 'value_caption_day');
            $editor->addChoice('week', 'value_caption_week');
            $editor->addChoice('month', 'value_caption_month');
            $editColumn = new CustomEditColumn('caption_smtp_type_limit', 'smtp_type_limit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_backup field
            //
            $editor = new CheckBox('service_backup_edit');
            $editColumn = new CustomEditColumn('caption_service_backup', 'service_backup', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for backup_note field
            //
            $editor = new TextAreaEdit('backup_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_backup_note', 'backup_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for backup_size field
            //
            $editor = new TextEdit('backup_size_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_backup_size', 'backup_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_mkmail field
            //
            $editor = new CheckBox('service_mkmail_edit');
            $editColumn = new CustomEditColumn('caption_service_mkmail', 'service_mkmail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mkmail_note field
            //
            $editor = new TextAreaEdit('mkmail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mkmail_note', 'mkmail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_ts field
            //
            $editor = new CheckBox('service_ts_edit');
            $editColumn = new CustomEditColumn('caption_service_ts', 'service_ts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ts_note field
            //
            $editor = new TextAreaEdit('ts_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ts_note', 'ts_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_ip_dedicate field
            //
            $editor = new CheckBox('service_ip_dedicate_edit');
            $editColumn = new CustomEditColumn('caption_service_ip_dedicate', 'service_ip_dedicate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ip_dedicate_note field
            //
            $editor = new TextAreaEdit('ip_dedicate_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ip_dedicate_note', 'ip_dedicate_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for service_other field
            //
            $editor = new CheckBox('service_other_edit');
            $editColumn = new CustomEditColumn('caption_service_other', 'service_other', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for other_note field
            //
            $editor = new TextAreaEdit('other_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_other_note', 'other_note', $editor, $this->dataset);
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
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[A-Z0-9-]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for site field
            //
            $editor = new TextEdit('site_edit');
            $editColumn = new CustomEditColumn('caption_site', 'site', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^https?://([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}(:\d+)?(/[^ ]*)?$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for max_domain field
            //
            $editor = new TextEdit('max_domain_edit');
            $editColumn = new CustomEditColumn('caption_max_domain', 'max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_dns field
            //
            $editor = new CheckBox('service_dns_edit');
            $editColumn = new CustomEditColumn('caption_service_dns', 'service_dns', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for dns_note field
            //
            $editor = new TextAreaEdit('dns_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_dns_note', 'dns_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('caption_mx_id', 'mx_id', 'mx_id_name', 'insert_resale_mx_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_mx_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_mail field
            //
            $editor = new CheckBox('service_mail_edit');
            $editColumn = new CustomEditColumn('caption_service_mail', 'service_mail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_note field
            //
            $editor = new TextAreaEdit('mail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mail_note', 'mail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for type_plan field
            //
            $editor = new ComboBox('type_plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('account', 'value_caption_account');
            $editor->addChoice('space', 'value_caption_space');
            $editor->addChoice('both', 'value_caption_both');
            $editColumn = new CustomEditColumn('caption_type_plan', 'type_plan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $editColumn = new DynamicLookupEditColumn('caption_server_id', 'server_id', 'server_id_hostname', 'insert_resale_server_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'hostname', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(resale_server_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mail_max_domain field
            //
            $editor = new TextEdit('mail_max_domain_edit');
            $editColumn = new CustomEditColumn('caption_mail_max_domain', 'mail_max_domain', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
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
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_http field
            //
            $editor = new CheckBox('service_http_edit');
            $editColumn = new CustomEditColumn('caption_service_http', 'service_http', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_note field
            //
            $editor = new TextAreaEdit('http_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_http_note', 'http_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_max_hosting field
            //
            $editor = new TextEdit('http_max_hosting_edit');
            $editColumn = new CustomEditColumn('caption_http_max_hosting', 'http_max_hosting', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_max_virtualhost field
            //
            $editor = new TextEdit('http_max_virtualhost_edit');
            $editColumn = new CustomEditColumn('caption_http_max_virtualhost', 'http_max_virtualhost', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_max_db field
            //
            $editor = new TextEdit('http_max_db_edit');
            $editColumn = new CustomEditColumn('caption_http_max_db', 'http_max_db', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for http_size field
            //
            $editor = new TextEdit('http_size_edit');
            $editColumn = new CustomEditColumn('caption_http_size', 'http_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for web_rootdir field
            //
            $editor = new TextEdit('web_rootdir_edit');
            $editor->SetMaxLength(25);
            $editColumn = new CustomEditColumn('caption_web_rootdir', 'web_rootdir', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('/var/xxx');
            $validator = new CustomRegExpValidator('^/([a-zA-Z0-9@._-]+/?)+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_ftp field
            //
            $editor = new CheckBox('service_ftp_edit');
            $editColumn = new CustomEditColumn('caption_service_ftp', 'service_ftp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ftp_note field
            //
            $editor = new TextAreaEdit('ftp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ftp_note', 'ftp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ftp_max_user field
            //
            $editor = new TextEdit('ftp_max_user_edit');
            $editColumn = new CustomEditColumn('caption_ftp_max_user', 'ftp_max_user', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_smtp field
            //
            $editor = new CheckBox('service_smtp_edit');
            $editColumn = new CustomEditColumn('caption_service_smtp', 'service_smtp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for smtp_note field
            //
            $editor = new TextAreaEdit('smtp_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_smtp_note', 'smtp_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for smtp_max_send field
            //
            $editor = new TextEdit('smtp_max_send_edit');
            $editColumn = new CustomEditColumn('caption_smtp_max_send', 'smtp_max_send', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for smtp_type_limit field
            //
            $editor = new ComboBox('smtp_type_limit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('day', 'value_caption_day');
            $editor->addChoice('week', 'value_caption_week');
            $editor->addChoice('month', 'value_caption_month');
            $editColumn = new CustomEditColumn('caption_smtp_type_limit', 'smtp_type_limit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('month');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_backup field
            //
            $editor = new CheckBox('service_backup_edit');
            $editColumn = new CustomEditColumn('caption_service_backup', 'service_backup', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for backup_note field
            //
            $editor = new TextAreaEdit('backup_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_backup_note', 'backup_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for backup_size field
            //
            $editor = new TextEdit('backup_size_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_backup_size', 'backup_size', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_mkmail field
            //
            $editor = new CheckBox('service_mkmail_edit');
            $editColumn = new CustomEditColumn('caption_service_mkmail', 'service_mkmail', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mkmail_note field
            //
            $editor = new TextAreaEdit('mkmail_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_mkmail_note', 'mkmail_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_ts field
            //
            $editor = new CheckBox('service_ts_edit');
            $editColumn = new CustomEditColumn('caption_service_ts', 'service_ts', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ts_note field
            //
            $editor = new TextAreaEdit('ts_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ts_note', 'ts_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_ip_dedicate field
            //
            $editor = new CheckBox('service_ip_dedicate_edit');
            $editColumn = new CustomEditColumn('caption_service_ip_dedicate', 'service_ip_dedicate', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ip_dedicate_note field
            //
            $editor = new TextAreaEdit('ip_dedicate_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_ip_dedicate_note', 'ip_dedicate_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for service_other field
            //
            $editor = new CheckBox('service_other_edit');
            $editColumn = new CustomEditColumn('caption_service_other', 'service_other', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for other_note field
            //
            $editor = new TextAreaEdit('other_note_edit', 50, 4);
            $editColumn = new CustomEditColumn('caption_other_note', 'other_note', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_description_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_site_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for max_domain field
            //
            $column = new NumberViewColumn('max_domain', 'max_domain', 'caption_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_dns_note_handler_print');
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
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mail_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for type_plan field
            //
            $column = new TextViewColumn('type_plan', 'type_plan', 'caption_type_plan', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mail_max_domain field
            //
            $column = new NumberViewColumn('mail_max_domain', 'mail_max_domain', 'caption_mail_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
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
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_http_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_max_hosting field
            //
            $column = new NumberViewColumn('http_max_hosting', 'http_max_hosting', 'caption_http_max_hosting', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_max_virtualhost field
            //
            $column = new NumberViewColumn('http_max_virtualhost', 'http_max_virtualhost', 'caption_http_max_virtualhost', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_max_db field
            //
            $column = new NumberViewColumn('http_max_db', 'http_max_db', 'caption_http_max_db', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for http_size field
            //
            $column = new NumberViewColumn('http_size', 'http_size', 'caption_http_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for web_rootdir field
            //
            $column = new TextViewColumn('web_rootdir', 'web_rootdir', 'caption_web_rootdir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ftp_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ftp_max_user field
            //
            $column = new NumberViewColumn('ftp_max_user', 'ftp_max_user', 'caption_ftp_max_user', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_smtp field
            //
            $column = new CheckboxViewColumn('service_smtp', 'service_smtp', 'caption_service_smtp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_smtp_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for smtp_max_send field
            //
            $column = new TextViewColumn('smtp_max_send', 'smtp_max_send', 'caption_smtp_max_send', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddPrintColumn($column);
            
            //
            // View column for smtp_type_limit field
            //
            $column = new TextViewColumn('smtp_type_limit', 'smtp_type_limit', 'caption_smtp_type_limit', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_backup field
            //
            $column = new CheckboxViewColumn('service_backup', 'service_backup', 'caption_service_backup', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_backup_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_mkmail field
            //
            $column = new CheckboxViewColumn('service_mkmail', 'service_mkmail', 'caption_service_mkmail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mkmail_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_ts field
            //
            $column = new CheckboxViewColumn('service_ts', 'service_ts', 'caption_service_ts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ts_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_ip_dedicate field
            //
            $column = new CheckboxViewColumn('service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ip_dedicate_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for service_other field
            //
            $column = new CheckboxViewColumn('service_other', 'service_other', 'caption_service_other', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_other_note_handler_print');
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
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_description_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_site_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for max_domain field
            //
            $column = new NumberViewColumn('max_domain', 'max_domain', 'caption_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_dns_note_handler_export');
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
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mail_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for type_plan field
            //
            $column = new TextViewColumn('type_plan', 'type_plan', 'caption_type_plan', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for mail_max_domain field
            //
            $column = new NumberViewColumn('mail_max_domain', 'mail_max_domain', 'caption_mail_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
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
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_http_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_max_hosting field
            //
            $column = new NumberViewColumn('http_max_hosting', 'http_max_hosting', 'caption_http_max_hosting', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_max_virtualhost field
            //
            $column = new NumberViewColumn('http_max_virtualhost', 'http_max_virtualhost', 'caption_http_max_virtualhost', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_max_db field
            //
            $column = new NumberViewColumn('http_max_db', 'http_max_db', 'caption_http_max_db', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for http_size field
            //
            $column = new NumberViewColumn('http_size', 'http_size', 'caption_http_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for web_rootdir field
            //
            $column = new TextViewColumn('web_rootdir', 'web_rootdir', 'caption_web_rootdir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ftp_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ftp_max_user field
            //
            $column = new NumberViewColumn('ftp_max_user', 'ftp_max_user', 'caption_ftp_max_user', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_smtp field
            //
            $column = new CheckboxViewColumn('service_smtp', 'service_smtp', 'caption_service_smtp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_smtp_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for smtp_max_send field
            //
            $column = new TextViewColumn('smtp_max_send', 'smtp_max_send', 'caption_smtp_max_send', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddExportColumn($column);
            
            //
            // View column for smtp_type_limit field
            //
            $column = new TextViewColumn('smtp_type_limit', 'smtp_type_limit', 'caption_smtp_type_limit', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_backup field
            //
            $column = new CheckboxViewColumn('service_backup', 'service_backup', 'caption_service_backup', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_backup_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for backup_size field
            //
            $column = new TextViewColumn('backup_size', 'backup_size', 'caption_backup_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_mkmail field
            //
            $column = new CheckboxViewColumn('service_mkmail', 'service_mkmail', 'caption_service_mkmail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mkmail_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_ts field
            //
            $column = new CheckboxViewColumn('service_ts', 'service_ts', 'caption_service_ts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ts_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_ip_dedicate field
            //
            $column = new CheckboxViewColumn('service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ip_dedicate_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for service_other field
            //
            $column = new CheckboxViewColumn('service_other', 'service_other', 'caption_service_other', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_other_note_handler_export');
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
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_description_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_site_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for max_domain field
            //
            $column = new NumberViewColumn('max_domain', 'max_domain', 'caption_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_dns field
            //
            $column = new CheckboxViewColumn('service_dns', 'service_dns', 'caption_service_dns', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_dns_note_handler_compare');
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
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mail_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for type_plan field
            //
            $column = new TextViewColumn('type_plan', 'type_plan', 'caption_type_plan', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('server_id', 'server_id_hostname', 'caption_server_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mail_max_domain field
            //
            $column = new NumberViewColumn('mail_max_domain', 'mail_max_domain', 'caption_mail_max_domain', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
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
            // View column for service_http field
            //
            $column = new CheckboxViewColumn('service_http', 'service_http', 'caption_service_http', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_http_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_max_hosting field
            //
            $column = new NumberViewColumn('http_max_hosting', 'http_max_hosting', 'caption_http_max_hosting', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_max_virtualhost field
            //
            $column = new NumberViewColumn('http_max_virtualhost', 'http_max_virtualhost', 'caption_http_max_virtualhost', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_max_db field
            //
            $column = new NumberViewColumn('http_max_db', 'http_max_db', 'caption_http_max_db', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for http_size field
            //
            $column = new NumberViewColumn('http_size', 'http_size', 'caption_http_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for web_rootdir field
            //
            $column = new TextViewColumn('web_rootdir', 'web_rootdir', 'caption_web_rootdir', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_ftp field
            //
            $column = new CheckboxViewColumn('service_ftp', 'service_ftp', 'caption_service_ftp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ftp_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ftp_max_user field
            //
            $column = new NumberViewColumn('ftp_max_user', 'ftp_max_user', 'caption_ftp_max_user', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_smtp field
            //
            $column = new CheckboxViewColumn('service_smtp', 'service_smtp', 'caption_service_smtp', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_smtp_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for smtp_max_send field
            //
            $column = new TextViewColumn('smtp_max_send', 'smtp_max_send', 'caption_smtp_max_send', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $grid->AddCompareColumn($column);
            
            //
            // View column for smtp_type_limit field
            //
            $column = new TextViewColumn('smtp_type_limit', 'smtp_type_limit', 'caption_smtp_type_limit', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_backup field
            //
            $column = new CheckboxViewColumn('service_backup', 'service_backup', 'caption_service_backup', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_backup_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for backup_size field
            //
            $column = new TextViewColumn('backup_size', 'backup_size', 'caption_backup_size', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_mkmail field
            //
            $column = new CheckboxViewColumn('service_mkmail', 'service_mkmail', 'caption_service_mkmail', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_mkmail_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_ts field
            //
            $column = new CheckboxViewColumn('service_ts', 'service_ts', 'caption_service_ts', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ts_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_ip_dedicate field
            //
            $column = new CheckboxViewColumn('service_ip_dedicate', 'service_ip_dedicate', 'caption_service_ip_dedicate', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_ip_dedicate_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for service_other field
            //
            $column = new CheckboxViewColumn('service_other', 'service_other', 'caption_service_other', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddCompareColumn($column);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('resale_other_note_handler_compare');
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
            $this->SetViewFormTitle('%name%');
            $this->SetEditFormTitle('%name%');
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
            $grid->SetInsertClientEditorValueChangedScript('showFormValueChanged(resale_services, sender, editors);');
            
            $grid->SetEditClientEditorValueChangedScript('showFormValueChanged(resale_services, sender, editors);');
            
            $grid->SetInsertClientFormLoadedScript('showFormLoad(resale_services, editors);');
            
            $grid->SetEditClientFormLoadedScript('showFormLoad(resale_services, editors);');
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_description_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_site_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_dns_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mail_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_http_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ftp_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_smtp_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_backup_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mkmail_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ts_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ip_dedicate_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_other_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_description_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_site_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_dns_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mail_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_http_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ftp_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_smtp_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_backup_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mkmail_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ts_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ip_dedicate_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_other_note_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_resale_mx_id_search', 'id', 'name', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_resale_server_id_search', 'id', 'hostname', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_resale_mx_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_resale_mx_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_resale_mx_id_search', 'id', 'name', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_resale_server_id_search', 'id', 'hostname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_description_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for site field
            //
            $column = new TextViewColumn('site', 'site', 'caption_site', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_site_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for dns_note field
            //
            $column = new TextViewColumn('dns_note', 'dns_note', 'caption_dns_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_dns_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mail_note field
            //
            $column = new TextViewColumn('mail_note', 'mail_note', 'caption_mail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mail_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for http_note field
            //
            $column = new TextViewColumn('http_note', 'http_note', 'caption_http_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_http_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ftp_note field
            //
            $column = new TextViewColumn('ftp_note', 'ftp_note', 'caption_ftp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ftp_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for smtp_note field
            //
            $column = new TextViewColumn('smtp_note', 'smtp_note', 'caption_smtp_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_smtp_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for backup_note field
            //
            $column = new TextViewColumn('backup_note', 'backup_note', 'caption_backup_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_backup_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mkmail_note field
            //
            $column = new TextViewColumn('mkmail_note', 'mkmail_note', 'caption_mkmail_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_mkmail_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ts_note field
            //
            $column = new TextViewColumn('ts_note', 'ts_note', 'caption_ts_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ts_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ip_dedicate_note field
            //
            $column = new TextViewColumn('ip_dedicate_note', 'ip_dedicate_note', 'caption_ip_dedicate_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_ip_dedicate_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for other_note field
            //
            $column = new TextViewColumn('other_note', 'other_note', 'caption_other_note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'resale_other_note_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_resale_mx_id_search', 'id', 'name', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_resale_server_id_search', 'id', 'hostname', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_resale_mx_id_search', 'id', 'name', null, 20);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'type = \'mail\''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_resale_server_id_search', 'id', 'hostname', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_resale_server_idNestedPage_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            new resale_mx_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('resale.mx_id'));
            new resale_server_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('resale.server_id'));
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
            if ($mode == PageMode::FormEdit or $mode == PageMode::View) {
            	$id = $this->dataset->GetFieldValueByName('id');
            	$SQL = "SELECT c.`id`, c.`name`, c.email, c.phone " .
            		"FROM `contact` c " .
            		"INNER JOIN `resale` r ON r.`id` = c.`resale_id` " .
            		"WHERE r.id = '$id'";
            	$params['Contacts'] = $this->GetConnection()->fetchAll($SQL);
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
        $Page = new resalePage("resale", "resale.php", GetCurrentUserPermissionSetForDataSource("resale"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("resale"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
