<?php

require_once 'backend/database_class.php';

?>

<!DOCTYPE html>
<html>
<head>
<title>Citations</title>
<meta charset="utf-8"/>
<script src="assets/Js/jQuery.js"></script>
<script src="assets/Js/AjaxFunctionsAuthor.js"></script>
</head>
<body>

<section>

<h1>Authentification</h1>

<div class="form-block">

<form id="connect-form" method="post">

       <label for="log_pseudo">Pseudo</label>
       <input class="required" type="text" name="log_pseudo" id="log_pseudo" />
       
        <label for="log_password">Mot de passe</label>
       <input class="required" type="password" name="log_password" id="log_password" />

       <label for="submit"></label>
       <input type="submit" name="submit" id="login" title="Envoyer"/>

</form>

</div>

</section>

</body>

</html>