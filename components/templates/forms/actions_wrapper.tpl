{if not $top}
<div class="form-actions row">
    <div class="{if $isHorizontal}col-lg-8{else}col-md-12{/if}">
        <div class="row">
            <div class="{if $isHorizontal}col-sm-9 col-sm-offset-3{else}col-md-8 col-md-offset-2{/if}">
                <div class="btn-toolbar">{$ActionsContent}</div>
            </div>
        </div>
    </div>
</div>
{/if}
