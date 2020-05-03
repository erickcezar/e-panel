<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escapeurl', 'login_control.tpl', 48, false),)), $this); ?>
<div class="well pgui-login">

	<div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>

    <?php if (! is_null ( $this->_tpl_vars['SecurityFeedbackPositive'] )): ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">&times;</button>
        <?php echo $this->_tpl_vars['SecurityFeedbackPositive']; ?>

    </div>
    <?php endif; ?>
    <?php if (! is_null ( $this->_tpl_vars['SecurityFeedbackNegative'] )): ?>
    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close" type="button">&times;</button>
        <?php echo $this->_tpl_vars['SecurityFeedbackNegative']; ?>

    </div>
    <?php endif; ?>

    <form method="post" class="pgui-login-form">
        <div class="form-group">
			<label class="pgpage-login pgui-login-label"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Username'); ?>
</label>
            <input placeholder="<?php echo $this->_tpl_vars['Captions']->GetMessageString('Username'); ?>
" type="text" name="username" class="form-control pgui-login-text" id="username">
        </div>

        <div class="form-group">
			<label class="pgpage-login pgui-login-label"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Password'); ?>
</label>
            <input placeholder="<?php echo $this->_tpl_vars['Captions']->GetMessageString('Password'); ?>
" type="password" name="password" class="form-control pgui-login-text" id="password">
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="saveidentity" id="saveidentity" <?php if ($this->_tpl_vars['LoginControl']->GetLastSaveidentity()): ?> checked="checked"<?php endif; ?>>
                    <?php echo $this->_tpl_vars['Captions']->GetMessageString('RememberMe'); ?>

                </label>
            </div>
        </div>

        <?php if ($this->_tpl_vars['LoginControl']->GetErrorMessage() != ''): ?>
            <div class="alert alert-danger">
                <?php echo $this->_tpl_vars['LoginControl']->GetErrorMessage(); ?>

            </div>
        <?php endif; ?>

        <div class="form-group text-right">
            <button class="btn btn-primary pgui-login-button" type="submit"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Login'); ?>
</button>

            <?php if ($this->_tpl_vars['LoginControl']->CanLoginAsGuest()): ?>
                &nbsp;<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['LoginControl']->GetLoginAsGuestLink())) ? $this->_run_mod_handler('escapeurl', true, $_tmp) : smarty_modifier_escapeurl($_tmp)); ?>
" class="btn btn-default pgui-login-button"><?php echo $this->_tpl_vars['Captions']->GetMessageString('LoginAsGuest'); ?>
</a>
            <?php endif; ?>
        </div>

    </form>

    <?php if ($this->_tpl_vars['LoginControl']->getEmailBasedFeaturesEnabled()): ?>
    <div class="pgui-login-footer">
        <?php if ($this->_tpl_vars['LoginControl']->getRecoveringPasswordEnabled()): ?>
            <p class="text-center">
                <?php echo $this->_tpl_vars['Captions']->GetMessageString('ForgotPassword'); ?>

            </p>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['LoginControl']->getSelfRegistrationEnabled()): ?>
            <p class="text-center">
                <?php echo $this->_tpl_vars['Captions']->GetMessageString('RegisterHere'); ?>

            </p>
            <p class="text-center">
                <?php echo $this->_tpl_vars['Captions']->GetMessageString('ResendVerificationEmailHere'); ?>

            </p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>