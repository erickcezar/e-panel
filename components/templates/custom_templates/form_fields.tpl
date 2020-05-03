<div class="row">
    {foreach item=Group from=$Grid.FormLayout->getGroups()}
        {if count($Group->getRows()) > 0}
            <fieldset class="col-md-{$Group->getWidth()}">
                {if $Group->getName()}
                    <legend>
                        {$Group->getName()}
                    </legend>
                {/if}
                {foreach item=Row from=$Group->getRows()}
                    <div class="row">
                        {foreach item=Col from=$Row->getCols()}
                            {include file='custom_templates/form_field.tpl' Column=$Col Help='NOME_FORM_'|cat:$Col->getName() ButtonLabel=XXX}
                        {/foreach}
                    </div>
                {/foreach}
            </fieldset>
        {/if}
    {/foreach}
</div>
