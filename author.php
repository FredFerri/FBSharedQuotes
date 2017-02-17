<?php

require_once 'backend/database_class.php';

session_start();

if ($_SESSION['mdp'] != 'OK') {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Citations</title>
<meta charset="utf-8"/>
<script src="assets/Js/jQuery.js"></script>
<script src="assets/Js/AjaxFunctions.js"></script>
<style>
    label, input {
        display: block;
    }
</style>
</head>

<body>

<section>

<h1>Ajouter un auteur</h1>

<a href="logout.php">Se déconnecter</a>
<a href="author.php">Auteurs</a>
<a href="user.php">Comptes utilisateurs</a><br />
<a href="quote.php">Citations</a><br />

<div class="form-block">

<form class="main-form" id="author-form" method="post">

    
       <label for="name">Nom*</label>
       <input type="text" name="name" id="name" class="required"/>
       
       <label for="firstname">Prénom*</label>
       <input type="text" name="firstname" id="firstname" class="required"/>
       
       <label for="category">Catégorie</label>
       <input type="text" name="category" id="category"/>

       <label for="biography">Biographie</label>
       <textarea name="biography" id="biography" cols="40" rows="5"></textarea>
       
       <label for="country">Pays</label>
       <input type="text" name="country" id="country" />

       <label for="birthdate">Année de naissance</label>
       <input type="date" name="birthdate" id="birthdate" maxlength="4"/>
       
       <label for="deathdate">Année de décès</label>
       <input type="date" name="deathdate" id="deathdate" maxlength="4"/>

       <label for="submit"></label>
       <input type="submit" name="submit" id="add" title="Envoyer"/>

</form>

</div>
<div class="list-block">

    <table>
        <tr>
            <th>Id</th>
            <th>Nom*</th>
            <th>Prénom*</th>
            <th>Catégorie(s)</th>
            <th>Biographie</th>
            <th>Pays</th>
            <th>Année de naissance</th>
            <th>Année de décès</th>
        </tr>
        <?php
        $database = new Database;
        $result = $database->find('author', '*');
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr id="'.$row["id"].'" class="row-visible"><td>'.$row['id'].'</td><td id="lastname-'.$row['id'].'">'.$row['last_name'].'</td><td id="firstname-'.$row['id'].'">'.$row['first_name'].'</td><td id="cat-'.$row['id'].'">'.$row['category_txt'].'</td><td id="biography-'.$row['id'].'">'.$row['biography'].'</td><td id="country-'.$row['id'].'">'.$row['country'].'</td><td id="birthdate-'.$row['id'].'">'.$row['birthdate'].'</td><td id="deathdate-'.$row['id'].'">'.$row['deathdate'].'</td><td><a class="btn-edit" href="#">Modifier</a></td><td><a href="#" id="delete-'.$row["id"].'" class="btn-delete">Supprimer</a></td></tr>';
            echo '<tr class="row-hidden" style="display:none;"><td>'.$row['id'].'</td><td><input type="text" class="required key-validation" id="h-lastname_'.$row["id"].'" type="text" value="'.$row["last_name"].'"></td><td><input type="text" class="required key-validation" id="h-firstname_'.$row["id"].'" type="text" value="'.$row["first_name"].'"></td><td><input type="text" class="key-validation" id="h-category_'.$row["id"].'" type="text" value="'.$row["category_txt"].'"></td><td><input type="text" class="key-validation" id="h-biography_'.$row["id"].'" type="text" value="'.$row["biography"].'"></td><td><input type="text" class="key-validation" id="h-country_'.$row["id"].'" type="text" value="'.$row["country"].'"></td><td><input type="text" class="key-validation" id="h-birthdate_'.$row["id"].'" type="text" value="'.$row["birthdate"].'"></td><td><input type="text" class="key-validation" id="h-deathdate_'.$row["id"].'" type="text" value="'.$row["deathdate"].'"></td><td><input type="submit" name="submit_hidden" id="'.$row["id"].'" class="btn-edit-hidden edit-author" value="Valider"></td><td><button class="btn-cancel">Annuler</button></td></tr>';
        }

        ?>
    </table>

</div>

</section>
</body>
</html>
