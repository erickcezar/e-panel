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
    
    
    
    class contactPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('TitleContact');
            $this->SetMenuLabel('LabelContact');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contact`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('resale_id'),
                    new IntegerField('client_id'),
                    new StringField('name', true),
                    new StringField('role'),
                    new StringField('email'),
                    new StringField('phone'),
                    new DateTimeField('created', true),
                    new DateTimeField('updated', true)
                )
            );
            $this->dataset->AddLookupField('resale_id', 'resale', new IntegerField('id'), new StringField('name', false, false, false, false, 'resale_id_name', 'resale_id_name_resale'), 'resale_id_name_resale');
            $this->dataset->AddLookupField('client_id', '`client`', new IntegerField('id'), new StringField('name', false, false, false, false, 'client_id_name', 'client_id_name_client'), 'client_id_name_client');
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
                new FilterColumn($this->dataset, 'resale_id', 'resale_id_name', 'caption_resale_id'),
                new FilterColumn($this->dataset, 'client_id', 'client_id_name', 'caption_client_id'),
                new FilterColumn($this->dataset, 'name', 'name', 'caption_name'),
                new FilterColumn($this->dataset, 'role', 'role', 'caption_role'),
                new FilterColumn($this->dataset, 'email', 'email', 'caption_email'),
                new FilterColumn($this->dataset, 'phone', 'phone', 'caption_phone'),
                new FilterColumn($this->dataset, 'created', 'created', 'caption_created'),
                new FilterColumn($this->dataset, 'updated', 'updated', 'caption_updated')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['resale_id'])
                ->addColumn($columns['client_id'])
                ->addColumn($columns['name'])
                ->addColumn($columns['role'])
                ->addColumn($columns['email'])
                ->addColumn($columns['phone'])
                ->addColumn($columns['created'])
                ->addColumn($columns['updated']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('resale_id')
                ->setOptionsFor('client_id')
                ->setOptionsFor('name')
                ->setOptionsFor('role')
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
            
            $main_editor = new DynamicCombobox('resale_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_contact_resale_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('resale_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_contact_resale_id_search');
            
            $text_editor = new TextEdit('resale_id');
            
            $filterBuilder->addColumn(
                $columns['resale_id'],
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
            
            $main_editor = new DynamicCombobox('client_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_contact_client_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('client_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_contact_client_id_search');
            
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
            
            $main_editor = new TextEdit('role_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['role'],
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
            
            $main_editor = new TextEdit('email_edit');
            
            $filterBuilder->addColumn(
                $columns['email'],
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
            
            $main_editor = new TextEdit('phone_edit');
            $main_editor->SetMaxLength(64);
            
            $filterBuilder->addColumn(
                $columns['phone'],
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
            $column = new TextViewColumn('resale_id', 'resale_id_name', 'caption_resale_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
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
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for role field
            //
            $column = new TextViewColumn('role', 'role', 'caption_role', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('header_hint_role');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_email_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for phone field
            //
            $column = new TextViewColumn('phone', 'phone', 'caption_phone', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
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
            $column->setHrefTemplate('?operation=edit&pk0=%ID%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator('.');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('resale_id', 'resale_id_name', 'caption_resale_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'caption_name', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for role field
            //
            $column = new TextViewColumn('role', 'role', 'caption_role', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for phone field
            //
            $column = new TextViewColumn('phone', 'phone', 'caption_phone', $this->dataset);
            $column->SetOrderable(true);
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
            // Edit column for resale_id field
            //
            $editor = new DynamicCombobox('resale_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_resale_id', 'resale_id', 'resale_id_name', 'edit_contact_resale_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'edit_contact_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for role field
            //
            $editor = new TextEdit('role_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_role', 'role', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('caption_email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for phone field
            //
            $editor = new TextEdit('phone_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_phone', 'phone', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for resale_id field
            //
            $editor = new DynamicCombobox('resale_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_resale_id', 'resale_id', 'resale_id_name', 'multi_edit_contact_resale_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'multi_edit_contact_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextEdit('name_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for role field
            //
            $editor = new TextEdit('role_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_role', 'role', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('caption_email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for phone field
            //
            $editor = new TextEdit('phone_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_phone', 'phone', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for resale_id field
            //
            $editor = new DynamicCombobox('resale_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('caption_resale_id', 'resale_id', 'resale_id_name', 'insert_contact_resale_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('caption_client_id', 'client_id', 'client_id_name', 'insert_contact_client_id_search', $editor, $this->dataset, $lookupDataset, 'id', 'name', '');
            $editColumn->SetAllowSetToNull(true);
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
            
            //
            // Edit column for role field
            //
            $editor = new TextEdit('role_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_role', 'role', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('caption_email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new CustomRegExpValidator('(^$|^[a-zA-Z0-9._-]+@([a-zA-Z0-9]+-?(([a-zA-Z0-9]+-?)?)+(([a-zA-Z0-9])\.)+?)+[a-zA-Z]{2,6}$)', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for phone field
            //
            $editor = new TextEdit('phone_edit');
            $editor->SetMaxLength(64);
            $editColumn = new CustomEditColumn('caption_phone', 'phone', $editor, $this->dataset);
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
            $column = new TextViewColumn('resale_id', 'resale_id_name', 'caption_resale_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
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
            // View column for role field
            //
            $column = new TextViewColumn('role', 'role', 'caption_role', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for phone field
            //
            $column = new TextViewColumn('phone', 'phone', 'caption_phone', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
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
            $column = new TextViewColumn('resale_id', 'resale_id_name', 'caption_resale_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
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
            // View column for role field
            //
            $column = new TextViewColumn('role', 'role', 'caption_role', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for phone field
            //
            $column = new TextViewColumn('phone', 'phone', 'caption_phone', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
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
            $column = new TextViewColumn('resale_id', 'resale_id_name', 'caption_resale_id', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('client_id', 'client_id_name', 'caption_client_id', $this->dataset);
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
            // View column for role field
            //
            $column = new TextViewColumn('role', 'role', 'caption_role', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for phone field
            //
            $column = new TextViewColumn('phone', 'phone', 'caption_phone', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
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
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_email_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_contact_resale_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_contact_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_contact_resale_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_contact_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'caption_email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_contact_resale_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_contact_client_id_search', 'id', 'name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`resale`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_contact_resale_id_search', 'id', 'name', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_contact_client_id_search', 'id', 'name', null, 20);
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
        $Page = new contactPage("contact", "contact.php", GetCurrentUserPermissionSetForDataSource("contact"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("contact"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
