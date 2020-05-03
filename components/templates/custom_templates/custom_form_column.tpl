<div class="row">
{foreach item=Group from=$Grid.FormLayout->getGroups()}
    {if count($Group->getRows()) > 0}
    <{if $isViewForm}div{else}fieldset{/if} class="col-md-{$Group->getWidth()}">
        {if $Group->getName()}<legend>{$Group->getName()}</legend>{/if}
        {foreach item=Row from=$Group->getRows()}
            <div class="row">
				{if isset($Column)}
					{foreach item=Col from=$Row->getCols()}
						{if $Col->getName() == $Column->getName()}
							{assign var='ColumnViewData' value=$Col->getViewData()}
							{assign var='Editor' value=$ColumnViewData.EditorViewData.Editor}

							{if $Editor}
								{assign var='editorId' value=$Grid.FormId|cat:'_'|cat:$Editor->getName()}
							{/if}

							<div class="form-group {if $Grid.FormLayout->isHorizontal()}col-sm-{$Col->getLabelWidth()} form-group-label{else}col-sm-{$Col->getWidth()}{/if}"{if $Editor and not $Editor->getVisible()} style="display: none"{/if}>
								{if $Grid.FormLayout->isHorizontal() or not $ColumnViewData.EditorViewData or not $Editor->isInlineLabel()}
									{include file='custom_templates/field_label.tpl' editorId=$editorId}
								{/if}

								{if $Grid.FormLayout->isHorizontal()}
									</div>
									<div class="form-group col-sm-{$Col->getInputWidth()}"{if $Editor and not $Editor->getVisible()} style="display: none"{/if}>
								{/if}

								{if not $isViewForm}
									<div class="col-input" style="width:100%; max-width:{$Editor->getMaxWidth()}" data-column="{$ColumnViewData.FieldName}">
									
										{if $Button == 'yes' || isset($ButtonLabel) || isset($ButtonIcon)}										
											<div class="input-group">
										{/if}

										{include file='editors/'|cat:$Editor->getEditorName()|cat:'.tpl' Editor=$Editor ViewData=$ColumnViewData.EditorViewData FormId=$Grid.FormId id=$editorId}
										{if not $Grid.FormLayout->isHorizontal() and $Editor->isInlineLabel()}
											{include file='custom_templates/field_label.tpl' editorId=$editorId}
										{/if}

										{if $Button == 'yes' && isset($ButtonIcon)}
											<div class="btn-group input-group-btn">
												<button type="button" class="btn btn-default js-nested-insert" data-content-link="#" data-display-field-name="{$ColumnViewData.FieldName}" title="{if isset($ButtonTitle)}{$ButtonTitle}{/if}">
													<span class="{$ButtonIcon}"></span>
												</button>
											</div>
											</div>
										{elseif isset($ButtonLabel) || isset($ButtonIcon)}
											<span class="input-group-addon">
												{if isset($ButtonIcon)}<span class="{$ButtonIcon}"></span>{else}{$ButtonLabel}{/if}
											</span>
											</div>
										{/if}
										
									</div>
								{else}
									{assign var='ColumnName' value=$Col->getName()}
									{assign var='CellEditUrl' value=$Grid.CellEditUrls[$ColumnName]}

									<div class="form-control-static{if $CellEditUrl} pgui-cell-edit{/if}"{if $CellEditUrl} data-column-name="{$ColumnName}" data-edit-url="{$CellEditUrl}"{/if}>
										{if isset($ENUM)}
											{assign var='fieldvalue' value='value_caption_'|cat:$Col->getDisplayValue($Renderer)}
											{$Captions->GetMessageString($fieldvalue)}
										{else}
											{$Col->getDisplayValue($Renderer)}
										{/if}
									</div>
								{/if}
								
							</div>
						{/if}
					{/foreach}
				{/if}
            </div>
        {/foreach}
    </{if $isViewForm}div{else}fieldset{/if}>
    {/if}
{/foreach}
</div>
