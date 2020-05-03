<div class="row">
    <div class="form-group form-group-label col-sm-3">
        <label class="control-label">
            {$Captions->GetMessageString($Col->getCaption())}:
        </label>
    </div>

    <div class="form-group col-sm-9">
        <div class="form-control-static">
            {if isset($ENUM)}
                {assign var='fieldvalue' value='value_caption_'|cat:$Col->getDisplayValue($Renderer)}
                {$Captions->GetMessageString($fieldvalue)}
            {else}
                {$Col->getDisplayValue($Renderer)}
            {/if}
        </div>
    </div>
</div>
