{assign var='ColumnViewData' value=$Col->getViewData()}

{if $isViewForm}
    {include file='custom_templates/form_view_field.tpl'}
{else}
    {include file='custom_templates/form_edit_field.tpl'}
{/if}
