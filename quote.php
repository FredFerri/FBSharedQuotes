<?php

require_once 'backend/database_class.php';

session_start();


if ($_SESSION['mdp'] == 'DECO') {
    session_destroy();
    $_SESSION = array();
    unset($_SESSION['mdp']);
}

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

<h1>Ajouter une citation</h1>

<a href="logout.php">Se déconnecter</a>
<a href="author.php">Auteurs</a>
<a href="user.php">Comptes utilisateurs</a><br />
<a href="quote.php">Citations</a><br />
<a href="shuffle-database.php">Shuffle</a>



<div class="form-block">

<form class="main-form" id="quote-form" method="post">

       <label for="author">Auteur*</label>
       <input class="required" name="auth-quote" id="auth-quote"/>

       <label for="quote">Citation*</label>
       <textarea class="required" name="quote" id="quote" cols="40" rows="5"></textarea>
       
       <label for="source">Source</label>
       <input type="text" name="source" id="source"/>
       
       <label for="date">Date</label>
       <input type="text" name="date" id="date"/>

       <label for="submit"></label>
       <input type="submit" name="submit" id="addQuote" title="Envoyer"/>

</form>

</div>
<div class="list-block">

    <table>
        <tr>
            <th>Id</th>
            <th>Auteur*</th>
            <th>Citation*</th>
            <th>Source</th>
            <th>Date</th>
        </tr>

        <?php

        $database = new Database;
        $result = $database->find('quote', '*');
        $i = 0;

        while ($row = mysqli_fetch_array($result)) {
        ?>
        
            <tr id="<?php echo $row['id'];?>" class="row-visible">
                <td><?php echo $row['id'];?></td>
                <td id="author-<?php echo $row['id'];?>"><?php echo $row['author'];?></td>
                <td id="quote-<?php echo $row['id'];?>"><?php echo $row['content'];?></td><td id="source-<?php echo $row['id'];?>"><?php echo $row['source'];?></td>
                <td id="date-<?php echo $row['id'];?>"><?php echo $row['date'];?></td>
                <td><a class="btn-edit" href="#">Modifier</a></td>
                <td><a href="#" id="delete-<?php echo $row['id'];?>" class="btn-delete">Supprimer</a></td>
            </tr>
            
            <tr class="row-hidden" style="display:none;">
                <td>
                    <?php  echo $row['id'];?>
                </td>
                <td>
                    <input type="text" class="required key-validation" id="authName_<?php echo $row['id']; ?>" type="text" value="<?php echo $row['author']; ?>">
                </td>
                <td>
                    <input type="text" class="required key-validation" id="quoteName_<?php echo $row['id']; ?>" type="text" value="<?php echo $row['content']; ?>">
                </td>
                <td>
                    <input type="text" class="required key-validation" id="sourceName_<?php echo $row['id'];?>" type="text" value="<?php echo $row['source'];?>">
                </td>
                <td>
                    <input type="text" class="required key-validation" id="dateName_<?php echo $row['id'];?>" type="text" value="<?php echo $row['date'];?>">
                </td>
                <td><button name="submit_hidden" id="<?php echo $row['id'];?>" class="btn-edit-hidden edit-quote">Valider</button></td><td><button class="btn-cancel">Annuler</button></td>
            </tr>
        <?php
        }
        ?>
    </table>

</div>

</section>
</body>
</html>
