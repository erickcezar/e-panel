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

    
    
    class server01_environment_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`environment`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new StringField('uuid', true),
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
            $editor->SetMaxLength(32);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
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
    
    class server01_php_version_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
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
            // Edit column for version field
            //
            $editor = new TextEdit('version_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('caption_version', 'version', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('^[0-9.]+$', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
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
    
    
    
    class server01Page extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleServer');
            $this->SetMenuLabel('LabelServer');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
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
                new FilterColumn($this->dataset, 'environment_id', 'environment_id_name', 'caption_environment_id'),
                new FilterColumn($this->dataset, 'hostname', 'hostname', 'caption_hostname'),
                new FilterColumn($this->dataset, 'description', 'description', 'caption_description'),
                new FilterColumn($this->dataset, 'uuid', 'uuid', 'caption_uuid'),
                new FilterColumn($this->dataset, 'type', 'type', 'caption_type'),
                new FilterColumn($this->dataset, 'php_version_id', 'php_version_id_version', 'caption_php_version_id'),
                new FilterColumn($this->dataset, 'cache_port', 'cache_port', 'caption_cache_port'),
                new FilterColumn($this->dataset, 'cache_auth', 'cache_auth', 'caption_cache_auth'),
                new FilterColumn($this->dataset, 'active', 'active', 'caption_active'),
                new FilterColumn($this->dataset, 'created', 'created', 'caption_created'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'caption_updated')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['environment_id'])
                ->addColumn($columns['hostname'])
                ->addColumn($columns['description'])
                ->addColumn($columns['uuid'])
                ->addColumn($columns['type'])
                ->addColumn($columns['php_version_id'])
                ->addColumn($columns['cache_port'])
                ->addColumn($columns['cache_auth'])
                ->addColumn($columns['active'])
                ->addColumn($columns['created'])
                ->addColumn($columns['updated']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('environment_id')
                ->setOptionsFor('hostname')
                ->setOptionsFor('type')
                ->setOptionsFor('php_version_id')
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
            
            $main_editor = new DynamicCombobox('environment_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_server01_environment_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('environment_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_server01_environment_id_search');
            
            $text_editor = new TextEdit('environment_id');
            
            $filterBuilder->addColumn(
                $columns['environment_id'],
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
            
            $main_editor = new TextEdit('hostname_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['hostname'],
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
            $main_editor->SetMaxLength(128);
            
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
            
            $main_editor = new TextEdit('uuid_edit');
            $main_editor->SetMaxLength(36);
            
            $filterBuilder->addColumn(
                $columns['uuid'],
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
            
            $main_editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('pool', 'value_caption_pool');
            $main_editor->addChoice('poolweb', 'value_caption_poolweb');
            $main_editor->addChoice('web', 'value_caption_web');
            $main_editor->addChoice('mail', 'value_caption_mail');
            $main_editor->addChoice('ftp', 'value_caption_ftp');
            $main_editor->addChoice('dns-master', 'value_caption_dns-master');
            $main_editor->addChoice('dns-slave', 'value_caption_dns-slave');
            $main_editor->addChoice('db', 'value_caption_db');
            $main_editor->addChoice('cache', 'value_caption_cache');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('type');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('type');
            
            $filterBuilder->addColumn(
                $columns['type'],
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
            
            $main_editor = new DynamicCombobox('php_version_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_server01_php_version_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('php_version_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_server01_php_version_id_search');
            
            $text_editor = new TextEdit('php_version_id');
            
            $filterBuilder->addColumn(
                $columns['php_version_id'],
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
            
            $main_editor = new TextEdit('cache_port_edit');
            
            $filterBuilder->addColumn(
                $columns['cache_port'],
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
            
            $main_editor = new TextEdit('cache_auth_edit');
            $main_editor->SetMaxLength(128);
            
            $filterBuilder->addColumn(
                $columns['cache_auth'],
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('right');
            $column->setHrefTemplate('?operation=edit&pk0=%ID%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('environment_id', 'environment_id_name', 'caption_environment_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_environment_id');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('hostname', 'hostname', 'caption_hostname', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_hostname');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_description_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_description');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'caption_type', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_type');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for version field
            //
            $column = new TextViewColumn('php_version_id', 'php_version_id_version', 'caption_php_version_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_php_version_id');
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
            $column = new NumberViewColumn('id', 'id', 'caption_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('?operation=edit&pk0=%ID%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('environment_id', 'environment_id_name', 'caption_environment_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('hostname', 'hostname', 'caption_hostname', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_description_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for uuid field
            //
            $column = new TextViewColumn('uuid', 'uuid', 'caption_uuid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'caption_type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for version field
            //
            $column = new TextViewColumn('php_version_id', 'php_version_id_version', 'caption_php_version_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cache_port field
            //
            $column = new NumberViewColumn('cache_port', 'cache_port', 'caption_cache_port', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_cache_auth_handler_view');
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
            $editColumn = new DynamicLookupEditColumn('caption_environment_id', 'environment_id', 'environment_id_name', 'edit_server01_environment_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_environment_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('pool', 'value_caption_pool');
            $editor->addChoice('poolweb', 'value_caption_poolweb');
            $editor->addChoice('web', 'value_caption_web');
            $editor->addChoice('mail', 'value_caption_mail');
            $editor->addChoice('ftp', 'value_caption_ftp');
            $editor->addChoice('dns-master', 'value_caption_dns-master');
            $editor->addChoice('dns-slave', 'value_caption_dns-slave');
            $editor->addChoice('db', 'value_caption_db');
            $editor->addChoice('cache', 'value_caption_cache');
            $editColumn = new CustomEditColumn('caption_type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for php_version_id field
            //
            $editor = new DynamicCombobox('php_version_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_php_version_id', 'php_version_id', 'php_version_id_version', '_server01_php_version_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'version', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_php_version_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cache_port field
            //
            $editor = new TextEdit('cache_port_edit');
            $editColumn = new CustomEditColumn('caption_cache_port', 'cache_port', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new MaxValueValidator(65535, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(1, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cache_auth field
            //
            $editor = new TextEdit('cache_auth_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_cache_auth', 'cache_auth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
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
            $editColumn = new DynamicLookupEditColumn('caption_environment_id', 'environment_id', 'environment_id_name', 'multi_edit_server01_environment_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_environment_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextEdit('description_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_description', 'description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('pool', 'value_caption_pool');
            $editor->addChoice('poolweb', 'value_caption_poolweb');
            $editor->addChoice('web', 'value_caption_web');
            $editor->addChoice('mail', 'value_caption_mail');
            $editor->addChoice('ftp', 'value_caption_ftp');
            $editor->addChoice('dns-master', 'value_caption_dns-master');
            $editor->addChoice('dns-slave', 'value_caption_dns-slave');
            $editor->addChoice('db', 'value_caption_db');
            $editor->addChoice('cache', 'value_caption_cache');
            $editColumn = new CustomEditColumn('caption_type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for php_version_id field
            //
            $editor = new DynamicCombobox('php_version_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_php_version_id', 'php_version_id', 'php_version_id_version', 'multi_edit_server01_php_version_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'version', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_php_version_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for cache_port field
            //
            $editor = new TextEdit('cache_port_edit');
            $editColumn = new CustomEditColumn('caption_cache_port', 'cache_port', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new MaxValueValidator(65535, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(1, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for cache_auth field
            //
            $editor = new TextEdit('cache_auth_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_cache_auth', 'cache_auth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
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
            $editColumn = new DynamicLookupEditColumn('caption_environment_id', 'environment_id', 'environment_id_name', 'insert_server01_environment_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_environment_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn->SetAllowSetToNull(true);
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
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('pool', 'value_caption_pool');
            $editor->addChoice('poolweb', 'value_caption_poolweb');
            $editor->addChoice('web', 'value_caption_web');
            $editor->addChoice('mail', 'value_caption_mail');
            $editor->addChoice('ftp', 'value_caption_ftp');
            $editor->addChoice('dns-master', 'value_caption_dns-master');
            $editor->addChoice('dns-slave', 'value_caption_dns-slave');
            $editor->addChoice('db', 'value_caption_db');
            $editor->addChoice('cache', 'value_caption_cache');
            $editColumn = new CustomEditColumn('caption_type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for php_version_id field
            //
            $editor = new DynamicCombobox('php_version_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_php_version_id', 'php_version_id', 'php_version_id_version', 'insert_server01_php_version_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'version', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(server01_php_version_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for cache_port field
            //
            $editor = new TextEdit('cache_port_edit');
            $editColumn = new CustomEditColumn('caption_cache_port', 'cache_port', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new MaxValueValidator(65535, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MaxValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new MinValueValidator(1, StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('MinValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new DigitsValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('DigitsValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for cache_auth field
            //
            $editor = new TextEdit('cache_auth_edit');
            $editor->SetMaxLength(128);
            $editColumn = new CustomEditColumn('caption_cache_auth', 'cache_auth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $column->setHrefTemplate('?operation=edit&pk0=%ID%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('environment_id', 'environment_id_name', 'caption_environment_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('hostname', 'hostname', 'caption_hostname', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('server01_description_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for uuid field
            //
            $column = new TextViewColumn('uuid', 'uuid', 'caption_uuid', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'caption_type', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for version field
            //
            $column = new TextViewColumn('php_version_id', 'php_version_id_version', 'caption_php_version_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cache_port field
            //
            $column = new NumberViewColumn('cache_port', 'cache_port', 'caption_cache_port', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_cache_auth_handler_print');
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
            $column->setHrefTemplate('?operation=edit&pk0=%ID%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('environment_id', 'environment_id_name', 'caption_environment_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('hostname', 'hostname', 'caption_hostname', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('server01_description_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for uuid field
            //
            $column = new TextViewColumn('uuid', 'uuid', 'caption_uuid', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'caption_type', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for version field
            //
            $column = new TextViewColumn('php_version_id', 'php_version_id_version', 'caption_php_version_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cache_port field
            //
            $column = new NumberViewColumn('cache_port', 'cache_port', 'caption_cache_port', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_cache_auth_handler_export');
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
            $column = new TextViewColumn('environment_id', 'environment_id_name', 'caption_environment_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for hostname field
            //
            $column = new TextViewColumn('hostname', 'hostname', 'caption_hostname', $this->dataset);
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
            $column->SetFullTextWindowHandlerName('server01_description_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for uuid field
            //
            $column = new TextViewColumn('uuid', 'uuid', 'caption_uuid', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'caption_type', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for version field
            //
            $column = new TextViewColumn('php_version_id', 'php_version_id_version', 'caption_php_version_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for cache_port field
            //
            $column = new NumberViewColumn('cache_port', 'cache_port', 'caption_cache_port', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('server01_cache_auth_handler_compare');
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
            $this->SetViewFormTitle('%hostname%');
            $this->SetEditFormTitle('%hostname%');
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
            $grid->SetInsertClientEditorValueChangedScript('if (sender.getFieldName() == \'type\')
            {
            	if (sender.getValue() == \'web\')
            	{
            		editors[\'php_version_id\'].enabled(true);
            		editors[\'cache_port\'].setValue(null);
            		editors[\'cache_port\'].enabled(false);
            		editors[\'cache_auth\'].setValue(null);
            		editors[\'cache_auth\'].enabled(false);
            	}
            	else if (sender.getValue() == \'cache\')
            	{
            		editors[\'php_version_id\'].setValue(null);
            		editors[\'php_version_id\'].enabled(false);
            		editors[\'cache_port\'].enabled(true);
            		editors[\'cache_auth\'].enabled(true);
            	}
            	else
            	{
            		editors[\'php_version_id\'].setValue(null);
            		editors[\'php_version_id\'].enabled(false);
            		editors[\'cache_port\'].setValue(null);
            		editors[\'cache_port\'].enabled(false);
            		editors[\'cache_auth\'].setValue(null);
            		editors[\'cache_auth\'].enabled(false);
            	}
            }');
            
            $grid->SetEditClientEditorValueChangedScript('if (sender.getFieldName() == \'type\')
            {
            	if (sender.getValue() == \'web\')
            	{
            		editors[\'php_version_id\'].enabled(true);
            		editors[\'cache_port\'].setValue(null);
            		editors[\'cache_port\'].enabled(false);
            		editors[\'cache_auth\'].setValue(null);
            		editors[\'cache_auth\'].enabled(false);
            	}
            	else if (sender.getValue() == \'cache\')
            	{
            		editors[\'php_version_id\'].setValue(null);
            		editors[\'php_version_id\'].enabled(false);
            		editors[\'cache_port\'].enabled(true);
            		editors[\'cache_auth\'].enabled(true);
            	}
            	else
            	{
            		editors[\'php_version_id\'].setValue(null);
            		editors[\'php_version_id\'].enabled(false);
            		editors[\'cache_port\'].setValue(null);
            		editors[\'cache_port\'].enabled(false);
            		editors[\'cache_auth\'].setValue(null);
            		editors[\'cache_auth\'].enabled(false);
            	}
            }');
            
            $grid->SetInsertClientFormLoadedScript('if (editors[\'type\'].getValue() == \'web\')
            {
            	editors[\'php_version_id\'].enabled(true);
            	editors[\'cache_port\'].setValue(null);
            	editors[\'cache_port\'].enabled(false);
            	editors[\'cache_auth\'].setValue(null);
            	editors[\'cache_auth\'].enabled(false);
            }
            else if (editors[\'type\'].getValue() == \'cache\')
            {
            	editors[\'php_version_id\'].setValue(null);
            	editors[\'php_version_id\'].enabled(false);
            	editors[\'cache_port\'].enabled(true);
            	editors[\'cache_auth\'].enabled(true);
            }
            else
            {
            	editors[\'php_version_id\'].setValue(null);
            	editors[\'php_version_id\'].enabled(false);
            	editors[\'cache_port\'].setValue(null);
            	editors[\'cache_port\'].enabled(false);
            	editors[\'cache_auth\'].setValue(null);
            	editors[\'cache_auth\'].enabled(false);
            }');
            
            $grid->SetEditClientFormLoadedScript('if (editors[\'type\'].getValue() == \'web\')
            {
            	editors[\'php_version_id\'].enabled(true);
            	editors[\'cache_port\'].setValue(null);
            	editors[\'cache_port\'].enabled(false);
            	editors[\'cache_auth\'].setValue(null);
            	editors[\'cache_auth\'].enabled(false);
            }
            else if (editors[\'type\'].getValue() == \'cache\')
            {
            	editors[\'php_version_id\'].setValue(null);
            	editors[\'php_version_id\'].enabled(false);
            	editors[\'cache_port\'].enabled(true);
            	editors[\'cache_auth\'].enabled(true);
            }
            else
            {
            	editors[\'php_version_id\'].setValue(null);
            	editors[\'php_version_id\'].enabled(false);
            	editors[\'cache_port\'].setValue(null);
            	editors[\'cache_port\'].enabled(false);
            	editors[\'cache_auth\'].setValue(null);
            	editors[\'cache_auth\'].enabled(false);
            }');
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_description_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_description_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_cache_auth_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_description_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_cache_auth_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_server01_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_server01_php_version_id_search', 'id', 'version', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_server01_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_server01_php_version_id_search', 'id', 'version', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'caption_description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_description_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for cache_auth field
            //
            $column = new TextViewColumn('cache_auth', 'cache_auth', 'caption_cache_auth', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'server01_cache_auth_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_server01_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_server01_php_version_id_search', 'id', 'version', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_server01_environment_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`php_version`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('version', true),
                    new StringField('description'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('version', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_server01_php_version_id_search', 'id', 'version', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            
            
            
            new server01_environment_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('server01.environment_id'));
            new server01_php_version_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('server01.php_version_id'));
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
            if ($mode == PageMode::FormEdit || $mode == PageMode::FormInsert) {
            	// Get ID Pool
            	$id = $this->dataset->GetFieldValueByName('id');
            
            	// Get Account Size List
            	/*$SQL = "SELECT id, name, price FROM account_size";
            	$params['AccountSizes'] = $this->GetConnection()->fetchAll($SQL);
            
            	// Get Contacts
            	$SQL = "SELECT " . 
            		"c.`id`, c.`name`, c.`email`, c.`phone` " .
            		"FROM contact c " .
            		"INNER JOIN `client` cl ON c.`client_id` = cl.`id` " .
            		"WHERE cl.`id` = '$id'";
            
            	$params['Contacts'] = $this->GetConnection()->fetchAll($SQL);*/
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
        $Page = new server01Page("server01", "server.php", GetCurrentUserPermissionSetForDataSource("server01"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("server01"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
