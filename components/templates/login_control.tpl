<div class="well pgui-login">

	<div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>

    {if !is_null($SecurityFeedbackPositive)}
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">&times;</button>
        {$SecurityFeedbackPositive}
    </div>
    {/if}
    {if !is_null($SecurityFeedbackNegative)}
    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close" type="button">&times;</button>
        {$SecurityFeedbackNegative}
    </div>
    {/if}

    <form method="post" class="pgui-login-form">
        <div class="form-group">
			<label class="pgpage-login pgui-login-label">{$Captions->GetMessageString('Username')}</label>
            <input placeholder="{$Captions->GetMessageString('Username')}" type="text" name="username" class="form-control pgui-login-text" id="username">
        </div>

        <div class="form-group">
			<label class="pgpage-login pgui-login-label">{$Captions->GetMessageString('Password')}</label>
            <input placeholder="{$Captions->GetMessageString('Password')}" type="password" name="password" class="form-control pgui-login-text" id="password">
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="saveidentity" id="saveidentity" {if $LoginControl->GetLastSaveidentity()} checked="checked"{/if}>
                    {$Captions->GetMessageString('RememberMe')}
                </label>
            </div>
        </div>

        {if $LoginControl->GetErrorMessage() != '' }
            <div class="alert alert-danger">
                {$LoginControl->GetErrorMessage()}
            </div>
        {/if}

        <div class="form-group text-right">
            <button class="btn btn-primary pgui-login-button" type="submit">{$Captions->GetMessageString('Login')}</button>

            {if $LoginControl->CanLoginAsGuest()}
                &nbsp;<a href="{$LoginControl->GetLoginAsGuestLink()|escapeurl}" class="btn btn-default pgui-login-button">{$Captions->GetMessageString('LoginAsGuest')}</a>
            {/if}
        </div>

    </form>

    {if $LoginControl->getEmailBasedFeaturesEnabled()}
    <div class="pgui-login-footer">
        {if $LoginControl->getRecoveringPasswordEnabled()}
            <p class="text-center">
                {$Captions->GetMessageString('ForgotPassword')}
            </p>
        {/if}
        {if $LoginControl->getSelfRegistrationEnabled()}
            <p class="text-center">
                {$Captions->GetMessageString('RegisterHere')}
            </p>
            <p class="text-center">
                {$Captions->GetMessageString('ResendVerificationEmailHere')}
            </p>
        {/if}
    </div>
    {/if}

</div>