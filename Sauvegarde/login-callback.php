<?php

ini_set('display_errors', 1);

session_start();

require_once 'vendor/autoload.php';
require_once 'backend/database_class.php';

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

//$db = new Database();
//$quotes = $db->find('quote', '*');
//$quotes_tab = mysqli_fetch_array($quotes);
//var_dump($quotes_tab);


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

$author = $tab[$i]['author'];
$content = '"'.$tab[$i]['content'].'"';
$source = $tab[$i]['source'];
$date = $tab[$i]['date'];
$quote_id = $tab[$i]['id'];

$quote[$i] = [$content, $author, $source, $date];
$final_post[$i] = array_values(array_filter($quote[$i]));

$today_post = join(', ', $final_post[$i]);
echo $today_post;


$appId = '1326861237345505';

$appSecret = '18aa7d983b097ba2a3120a3867e58a5d';

$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
    $oAuth2Client = $fb->getOAuth2Client();
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
} catch(FacebookResponseException $e) {
    // When Graph returns an error
    var_dump($helper->getError());
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(FacebookSDKException $e) {
    // When validation fails or other local issues
    var_dump($helper->getError());
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']

//    try {
//        // Returns a `Facebook\FacebookResponse` object
//        $response = $fb->post('/340154846383112/feed', array('message' => 'test'), $longLivedAccessToken);
//    } catch(FacebookResponseException $e) {
//        echo 'Graph returned an error: ' . $e->getMessage();
//        exit;
//    } catch(FacebookSDKException $e) {
//        echo 'Facebook SDK returned an error: ' . $e->getMessage();
//        exit;
//    }

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/340154846383112?fields=access_token', $longLivedAccessToken);
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $graphNode = $response->getGraphNode();

    $page_token = $graphNode['access_token'];

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/340154846383112/feed', array('message'=>$today_post), $page_token);
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    echo 'Posted with id: ' . $graphNode['id'];

    $sql_statut = "UPDATE quote SET statut=1 WHERE id=".$quote_id;
    if (mysqli_query($connection, $sql_statut)) {
        echo "Statut mis à jour pour la citation num: ".$quote_id;
    }
    else {
        echo mysqli_error($connection);

    }
}

?>