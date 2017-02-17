<?php

$host = 'your_host';
$user = 'your_username';
$pwd = 'your_password';
$db = 'your_database';

$connection = mysqli_connect($host, $user, $pwd, $db);

if ($connection == false) {
    die("Erreur: Impossible de se connecter à la base de données:" . mysqli_connect_error());
}
else {
    $sql = "SELECT * FROM category";
    $result = mysqli_query($connection, $sql);
}

?>
