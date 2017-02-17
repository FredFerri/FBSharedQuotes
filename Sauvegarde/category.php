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
<script>

    $(".key-validation").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            $('button[type=submit] .default').click();
            return false;
        } else {
            return true;
        }
    });

</script>
</head>

<body>

<section>

<h1>Ajouter une catégorie</h1>

<div class="form-block">

<form class="main-form" id="cat-form" method="post">

       <label for="nom">Nom de la catégorie</label>
       <input type="text" name="category" id="category" />

       <label for="submit"></label>
       <input type="submit" name="submit" id="addCat" title="Envoyer"/>

</form>

</div>
<div class="list-block">

    <table>
        <tr>
            <th>Id</th>
            <th>Nom</th>
        </tr>
        <?php
        $database = new Database;
        $result = $database->find('category', '*');
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr id="'.$row["id"].'" class="row-visible"><td>'.$row['id'].'</td><td id="name-'.$row['id'].'">'.$row['name'].'</td><td><td><a class="btn-edit" href="#">Modifier</a></td><td><a href="#" id="delete-'.$row["id"].'" class="btn-delete">Supprimer</a></td></tr>';
            echo '<tr class="row-hidden" style="display:none;"><td>'.$row['id'].'</td><td><input type="text" class="required key-validation" id="catName_'.$row["id"].'" type="text" value="'.$row["name"].'"></td><td><input type="submit" name="submit_hidden" id="'.$row["id"].'" class="edit-cat" value="Valider"></td><td><button class="btn-cancel">Annuler</button></td></tr>';
        }

        ?>
    </table>

</div>

</section>
</body>
</html>
