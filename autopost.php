<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'backend/database_class.php';

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Connexion à la base de données et récupération du premier article non-publié

$host = 'your_host';
$db = 'your_database';
$user = 'your_username';
$pwd = 'your_password';

$connection = mysqli_connect($host, $user, $pwd, $db);
$sql = "SELECT * FROM quote WHERE statut=0 LIMIT 1";
$result = mysqli_query($connection, $sql);

//Conversion au bon format de publication de la citation récupérée

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

//Connexion à l'API Facebook

$appId = 'your_app_id';

$appSecret = 'your_app_secret_token';

$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
try {
    //Récupérez un user access token à la durée de vie illimitée et insérez le ci-dessous (voir la documentation de l'API Facebook)
    $longLivedAccessToken = 'your_longlived_token';
} catch(FacebookResponseException $e) {
    // Affichage du message d'erreur de l'API Graph
    var_dump($helper->getError());
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(FacebookSDKException $e) {
    // Affichage du message d'erreur en cas de problème de validation lié au Facebook SDK
    var_dump($helper->getError());
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

//Récupération de l'autorisation d'accès à la page Fb finale, et publication de la citation

if (isset($longLivedAccessToken)) {

    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/{your_page_id}?fields=access_token', $longLivedAccessToken);
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
        $response = $fb->post('/{your_page_id}/feed', array('message'=>$today_post), $page_token);
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    echo 'Posted with id: your_page_id';
    
    //Mise à jour de la base de données (indication de la dernière citation publiée)

    $sql_statut = "UPDATE quote SET statut=1 WHERE id=".$quote_id;
    if (mysqli_query($connection, $sql_statut)) {
        echo "Statut mis à jour pour la citation num: ".$quote_id;
    }
    else {
        echo mysqli_error($connection);

    }
}


?>
