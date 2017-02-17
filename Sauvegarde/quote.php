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
<style>
    label, input {
        display: block;
    }
</style>
</head>

<body>

<section>

<h1>Ajouter une citation</h1>

<div class="form-block">

<form class="main-form" id="quote-form" method="post">

       <label for="author">Auteur*</label>
       <select class="required" name="auth-quote" id="auth-quote">
        <?php
        $database = new Database;
        $result = $database->find('author', '*');
        while ($row = mysqli_fetch_array($result)) {
            echo '<option id="select-'.$row["id"].'" value="'.$row["last_name"].'">'.$row["first_name"]. " ".$row["last_name"].'</option>';
            $auth_list = '<option id="select-'.$row["id"].'" value="'.$row["last_name"].'">'.$row["first_name"]. " ".$row["last_name"].'</option>';
        }
        ?>
        </select>

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
        $auth_result = $database->find('author', 'first_name, last_name, id', $row['author']);
        $i=1;
        while ($author = mysqli_fetch_array($auth_result)) {
            $list_authors[$i]["first_name"] = $author["first_name"];
            $list_authors[$i]["last_name"] = $author["last_name"];
            $list_authors[$i]["id"] = $author["id"];
            $i++;
        }

        $result = $database->find('quote', '*');
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $list_quotes[$i]['content'] = $row['content'];
            $list_quotes[$i]['source'] = $row['source'];
            $list_quotes[$i]['date'] = $row['date'];
            $list_quotes[$i]['id'] = $row['id'];
            $list_quotes[$i]['author'] = $row['author'];
            $i++;
        

            $auth = $list_quotes[$i]['author'];
            ?>
            <tr id="<?php echo $row['id'];?>" class="row-visible">
                <td><?php echo $row['id'];?></td>
                <td id="author-<?php echo $row['id'];?>"><?php echo $list_authors[$row['author']]["first_name"];?>  <?php  echo $list_authors[$row['author']]["last_name"];?></td>
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
                    <select class="required" name="auth-quotelist" id="select_edit_<?php echo $row['id'];?>"><?php echo $list_authors[$i]["first_name"];?>
                    <?php
                    for ($i=1; $i<=count($list_authors); $i++) {
                    ?>
                    <option value="<?php echo $list_authors[$i]["first_name"]; ?>" id="option_edit_<?php echo $list_authors[$i]["id"];?>"><?php echo $list_authors[$row['author']]["first_name"];?> - <?php echo $list_authors[$row['author']]["last_name"];?></option>
                    <?php
                    }
                    ?>
                    </select>
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
