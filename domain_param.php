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

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class domain_paramPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleDomainAndParameter');
            $this->SetMenuLabel('LabelDomainAndParameter');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domain_param`');
            $this->dataset->addFields(
                array(
                    new IntegerField('domain_id', true, true),
                    new IntegerField('param_id', true, true),
                    new IntegerField('active', true)
                )
            );
            $this->dataset->AddLookupField('domain_id', 'domain', new IntegerField('id'), new StringField('domain', false, false, false, false, 'domain_id_domain', 'domain_id_domain_domain'), 'domain_id_domain_domain');
            $this->dataset->AddLookupField('param_id', 'param', new IntegerField('id'), new StringField('name', false, false, false, false, 'param_id_name', 'param_id_name_param'), 'param_id_name_param');
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
                new FilterColumn($this->dataset, 'domain_id', 'domain_id_domain', 'caption_domain_id'),
                new FilterColumn($this->dataset, 'param_id', 'param_id_name', 'caption_param_id'),
                new FilterColumn($this->dataset, 'active', 'active', 'caption_active')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['domain_id'])
                ->addColumn($columns['param_id'])
                ->addColumn($columns['active']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('domain_id')
                ->setOptionsFor('param_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('domain_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_param_domain_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('domain_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_param_domain_id_search');
            
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
            
            $main_editor = new DynamicCombobox('param_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_domain_param_param_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('param_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_domain_param_param_id_search');
            
            $text_editor = new TextEdit('param_id');
            
            $filterBuilder->addColumn(
                $columns['param_id'],
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
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('?operation=edit&pk0=%domain_id%&pk1=%param_id%');
            $column->setTarget('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_domain_id');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('param_id', 'param_id_name', 'caption_param_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('param_detail.php');
            $column->setTarget('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_param_id');
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
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('?operation=edit&pk0=%domain_id%&pk1=%param_id%');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('param_id', 'param_id_name', 'caption_param_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('param_detail.php');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_id', 'domain_id', 'domain_id_domain', 'edit_domain_param_domain_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'domain', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for param_id field
            //
            $editor = new DynamicCombobox('param_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $editColumn = new DynamicLookupEditColumn('caption_param_id', 'param_id', 'param_id_name', 'edit_domain_param_param_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`domain_root` is null'));
            $editColumn = new DynamicLookupEditColumn('caption_domain_id', 'domain_id', 'domain_id_domain', 'insert_domain_param_domain_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'domain', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for param_id field
            //
            $editor = new DynamicCombobox('param_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $editColumn = new DynamicLookupEditColumn('caption_param_id', 'param_id', 'param_id_name', 'insert_domain_param_param_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new CheckBox('active_edit');
            $editColumn = new CustomEditColumn('caption_active', 'active', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('1');
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
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('?operation=edit&pk0=%domain_id%&pk1=%param_id%');
            $column->setTarget('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('param_id', 'param_id_name', 'caption_param_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('param_detail.php');
            $column->setTarget('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('?operation=edit&pk0=%domain_id%&pk1=%param_id%');
            $column->setTarget('');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('param_id', 'param_id_name', 'caption_param_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('param_detail.php');
            $column->setTarget('');
            $grid->AddExportColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for domain field
            //
            $column = new TextViewColumn('domain_id', 'domain_id_domain', 'caption_domain_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('?operation=edit&pk0=%domain_id%&pk1=%param_id%');
            $column->setTarget('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('param_id', 'param_id_name', 'caption_param_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setHrefTemplate('param_detail.php');
            $column->setTarget('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for active field
            //
            $column = new CheckboxViewColumn('active', 'active', 'caption_active', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
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
            $this->SetViewFormTitle('%domain_id%/%param_id%');
            $this->SetEditFormTitle('%domain_id%/%param_id%');
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
    
        }
    
        protected function doRegisterHandlers() {
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_param_domain_id_search', 'id', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_domain_param_param_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_param_domain_id_search', 'id', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_param_param_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_domain_param_param_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_domain_param_domain_id_search', 'id', 'domain', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`param`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('name', true),
                    new IntegerField('active', true),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $lookupDataset->setOrderByField('name', 'ASC');
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), '`active` = 1'));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_domain_param_param_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
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
        $Page = new domain_paramPage("domain_param", "domain_param.php", GetCurrentUserPermissionSetForDataSource("domain_param"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("domain_param"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
