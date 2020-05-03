{capture assign="ContentBlock"}
<div class="well pgui-login">

	<div class="card-header justify-content-center"><h3 class="font-weight-light my-4">{$Captions->GetMessageString('PasswordRecovery')}</h3></div>

    <div class="js-form-container">
        <div class="js-form-collection">
            <form id="recoveringPasswordForm" method="post" class="pgui-login-form">
                <label class="pgpage-login pgui-login-label" style="padding-bottom: 15px;">{$Captions->GetMessageString('RecoveringPasswordInfo')}</label>
                <label class="pgpage-login pgui-login-label">{$Captions->GetMessageString('UsernameOrEmailShort')}</label>
                <div class="form-group">
                    <input required="true" placeholder="{$Captions->GetMessageString('UsernameOrEmail')}" type="text" name="account-name" class="form-control pgui-login-text" id="account-name"
                           data-validation="required" data-required-error-message="Username is required">
                </div>

                <div class="form-error-container">
                </div>

                <div class="form-group text-right" style="margin-top: 30px;">                    
                    <a href="login.php" class="">{$Captions->GetMessageString('BackToLogin')}</a>&nbsp;
					<button class="btn btn-primary js-save pgui-login-button" data-action="open" data-url="login.php">{$Captions->GetMessageString('SendPasswordResetLink')}</button>
                </div>
            </form>
			
			<div class="pgui-login-footer">&nbsp;</div>			
        </div>
    </div>
</div>
{/capture}

{* Base template *}
{include file=$layoutTemplate}