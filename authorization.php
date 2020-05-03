<?php

require_once 'phpgen_settings.php';
require_once 'components/application.php';
require_once 'components/security/permission_set.php';
require_once 'components/security/user_authentication/table_based_user_authentication.php';
require_once 'components/security/grant_manager/user_grant_manager.php';
require_once 'components/security/grant_manager/composite_grant_manager.php';
require_once 'components/security/grant_manager/hard_coded_user_grant_manager.php';
require_once 'components/security/grant_manager/table_based_user_grant_manager.php';
require_once 'components/security/table_based_user_manager.php';

include_once 'components/security/user_identity_storage/user_identity_session_storage.php';

require_once 'database_engine/mysql_engine.php';

$grants = array();

$appGrants = array();

$dataSourceRecordPermissions = array();

$tableCaptions = array('resale' => 'LabelResale',
'client' => 'LabelClient',
'contact' => 'LabelContact',
'server01' => 'LabelServer',
'pool' => 'LabelPool',
'poolweb' => 'LabelPoolWeb',
'poolcache' => 'LabelPoolCache',
'domain' => 'LabelDomain',
'certificate' => 'LabelCertificate',
'url' => 'LabelURL',
'unix_user' => 'LabelUnixUser',
'ftp_user' => 'LabelFtpUser',
'url_user' => 'LabelAuthUrlUser',
'zimbra_account' => 'LabelZimbraAccount',
'zimbra_alias' => 'LabelZimbraAlias',
'zimbra_mail' => 'LabelZimbraMail',
'zimbra_list' => 'LabelZimbraList',
'zimbra_list_mail' => 'LabelZimbraListMail',
'zimbra_trusted_domain' => 'LabelZimbraTrustedDomain',
'zimbra_trusted_ip_user' => 'LabelZimbraTrustedIpUser',
'zimbra_meeting' => 'LabelZimbraMeeting',
'spam_blackwhite' => 'LabelAntispamBlackWhiteList',
'restrict_host' => 'LabelRestrictHost',
'log' => 'LabelOperationLog',
'environment' => 'LabelEnvironment',
'config' => 'LabelConfig',
'mx' => 'LabelServerMX',
'account_size' => 'LabelAccountSize',
'param' => 'LabelParameter',
'param_detail' => 'LabelParameterDetail',
'openbasedir' => 'LabelOpenBaseDir',
'php_version' => 'LabelPhpVersion',
'directive' => 'LabelDirectiveApacheAndPHP',
'protection' => 'LabelProtection',
'poolwebserver' => 'LabelPoolWebAndServer',
'poolcacheserver' => 'LabelPoolCacheAndServer',
'domain_param' => 'LabelDomainAndParameter',
'domain01' => 'LabelDomainTrash',
'zimbra_account01' => 'LabelZimbraAccountTrash',
'zimbra_alias01' => 'LabelZimbraAliasTrash',
'zimbra_mail01' => 'LabelZimbraMailTrash',
'zimbra_list01' => 'LabelZimbraListTrash',
'zimbra_meeting01' => 'LabelZimbraMeetingTrash');

$usersTableInfo = array(
    'TableName' => 'system_user',
    'UserId' => 'id',
    'UserName' => 'username',
    'Password' => 'password',
    'Email' => 'email',
    'UserToken' => 'token',
    'UserStatus' => 'active'
);

function EncryptPassword($password, &$result)
{

}

function VerifyPassword($enteredPassword, $encryptedPassword, &$result)
{

}

function BeforeUserRegistration($username, $email, $password, &$allowRegistration, &$errorMessage)
{

}    

function AfterUserRegistration($username, $email)
{

}    

function PasswordResetRequest($username, $email)
{

}

function PasswordResetComplete($username, $email)
{

}

function CreatePasswordHasher()
{
    $hasher = CreateHasher('MD5');
    if ($hasher instanceof CustomStringHasher) {
        $hasher->OnEncryptPassword->AddListener('EncryptPassword');
        $hasher->OnVerifyPassword->AddListener('VerifyPassword');
    }
    return $hasher;
}

function CreateTableBasedGrantManager()
{
    global $tableCaptions;
    global $usersTableInfo;
    $userPermsTableInfo = array('TableName' => 'system_perm', 'UserId' => 'system_user_id', 'PageName' => 'page_name', 'Grant' => 'perms');
    
    $tableBasedGrantManager = new TableBasedUserGrantManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(),
        $usersTableInfo, $userPermsTableInfo, $tableCaptions, false);
    return $tableBasedGrantManager;
}

function CreateTableBasedUserManager() {
    global $usersTableInfo;
    return new TableBasedUserManager(MySqlIConnectionFactory::getInstance(), GetGlobalConnectionOptions(), $usersTableInfo, CreatePasswordHasher(), true);
}

function SetUpUserAuthorization()
{
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;

    $hasher = CreatePasswordHasher();

    $hardCodedGrantManager = new HardCodedUserGrantManager($grants, $appGrants);
    $tableBasedGrantManager = CreateTableBasedGrantManager();
    $grantManager = new CompositeGrantManager();
    $grantManager->AddGrantManager($hardCodedGrantManager);
    if (!is_null($tableBasedGrantManager)) {
        $grantManager->AddGrantManager($tableBasedGrantManager);
    }

    $userAuthentication = new TableBasedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, CreateTableBasedUserManager(), true, false, true);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
