<?php

session_start();

$_SESSION['mdp'] = "DECO";
header('Location: /login.php');

?>