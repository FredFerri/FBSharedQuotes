<?php

ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

session_start();

$appId = '1326861237345505';

$appSecret = '18aa7d983b097ba2a3120a3867e58a5d';

$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['manage_pages', 'publish_pages'];
$loginUrl = $helper->getLoginUrl('http://rec-3.irienet.fr/login-callback.php', $permissions);

//header('Location: '.$loginUrl);

echo $loginUrl;

?>

<a href="<?php echo $loginUrl; ?>">Se connecter</a>