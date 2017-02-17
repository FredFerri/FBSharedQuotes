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

<h1>Ajouter un utilisateur</h1>

<div class="form-block">

<form class="main-form" id="user-form" method="post">

       <label for="pseudo">Pseudo</label>
       <input class="required" type="text" name="pseudo" id="pseudo" />
       
        <label for="password">Mot de passe</label>
       <input class="required" type="password" name="password" id="password" />

       <label for="submit"></label>
       <input type="submit" name="submit" id="addUser" title="Envoyer"/>

</form>

</div>
<div class="list-block">

    <table>
        <tr>
            <th>Id</th>
            <th>Pseudo</th>
            <th>Mot de passe</th>
        </tr>
        <?php
        $database = new Database;
        $result = $database->find('user', '*');
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr id="'.$row["id"].'" class="row-visible"><td>'.$row['id'].'</td><td id="name-'.$row['id'].'">'.$row['name'].'</td><td id="password-'.$row['id'].'">******</td><td><td><a class="btn-edit" href="#">Modifier</a></td><td><a href="#" id="delete-'.$row["id"].'" class="btn-delete">Supprimer</a></td></tr>';
            echo '<tr class="row-hidden" style="display:none;"><td>'.$row['id'].'</td><td><input type="text" class="required key-validation" id="userName_'.$row["id"].'" value="'.$row["name"].'"></td><td><input type="text" class="edit-password key-validation" id="userPassword_'.$row["id"].'" value=""></td><td><input type="submit" name="submit_hidden" id="'.$row["id"].'" class="btn-edit-hidden edit-user" value="Valider"></td><td><button class="btn-cancel">Annuler</button></td></tr>';
        }

        ?>
    </table>

</div>

</section>
</body>
</html>
