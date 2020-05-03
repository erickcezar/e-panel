<?php if (! $this->_tpl_vars['top']): ?>
<div class="form-actions row">
    <div class="<?php if ($this->_tpl_vars['isHorizontal']): ?>col-lg-8<?php else: ?>col-md-12<?php endif; ?>">
        <div class="row">
            <div class="<?php if ($this->_tpl_vars['isHorizontal']): ?>col-sm-9 col-sm-offset-3<?php else: ?>col-md-8 col-md-offset-2<?php endif; ?>">
                <div class="btn-toolbar"><?php echo $this->_tpl_vars['ActionsContent']; ?>
</div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>