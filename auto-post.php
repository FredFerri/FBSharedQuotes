<?php

ini_set('display_errors', 1);

session_start();

require_once 'vendor/autoload.php';
require_once 'backend/database_class.php';

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookRequest;

// Connexion à la base de données et récupération du premier article non-publié

$host = 'localhost';
$db = 'citations';
$user = 'root';
$pwd = 'kingston';

$connection = mysqli_connect($host, $user, $pwd, $db);
$sql = "SELECT * FROM quote WHERE statut=0 LIMIT 1";
$result = mysqli_query($connection, $sql);

$i = 0;
while ($quotes_tab = mysqli_fetch_array($result)) {
    $tab[$i] = $quotes_tab;
    $i++;
}

$count = count(array_keys($tab)) - 1;

$i = 0;

//Conversion au bon format de publication de la citation récupérée

$author = $tab[$i]['author'];
$content = '"'.$tab[$i]['content'].'"';
$source = $tab[$i]['source'];
$date = $tab[$i]['date'];
$quote_id = $tab[$i]['id'];

$quote[$i] = [$content, $author, $source, $date];
$final_post[$i] = array_values(array_filter($quote[$i]));

$today_post = join(', ', $final_post[$i]);
echo $today_post;


//Connexion à l'API Facebook

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


//Publication sur la page FB

$fbApp = new \Facebook\FacebookApp($appId, $appSecret);
$request = new FacebookRequest($fbApp, 'EAAS2xfS33OEBADTA4yL9Bx1SWn5W4ORKErNxJpgokANJdPPLJyAsPDFlgRB32kwyHLXVQO6NFaZBhtnCZBfTVuKlZCMotorFF7WLbAbf4pYG7KV1q1lHbMZBEp4Qu0v0WzQtErqmoAzPrGE8wFtBUK89VDDCEG8YbSI4qZB8ZBT3dklEaieL5G', 'POST', '/340154846383112/feed', array('message'=>$today_post));

try {
    $response = $fb->getClient()->sendRequest($request);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo "\r\n".'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo "\r\n".'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$graphNode = $response->getGraphNode();

echo "\r\n".'Posted with id: ' . $graphNode['id'];

//Modification du statut de la citation (Non-publiée --> Publiée)

$sql_statut = "UPDATE quote SET statut=1 WHERE id=".$quote_id;
if (mysqli_query($connection, $sql_statut)) {
    echo "\r\n".'Statut mis à jour pour la citation num: '.$quote_id."\r\n";
}
else {
    echo "\r\n".mysqli_error($connection)."\r\n";
}


?>