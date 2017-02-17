<?php

require_once 'database_class.php';

//Authentification

if (isset($_GET['pseudo'])) {
    
    $database = new Database;
    $pseudo = $_GET['pseudo'];
    $password = $_GET['password'];
    
    $sql = "SELECT * FROM user WHERE name='$pseudo'";
    if ($result = mysqli_query($database->connection, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $check = hash('sha512', $password);
        $check = substr($check, 0, 64);
            if ($row['password'] == $check) {
                session_start();
                $_SESSION['mdp'] = 'OK';
                header('Location: /quote.php');
            }
            else {
                echo 'Identifiants incorrects';
            }
    }

    else {
        echo 'Ce pseudo n\'existe pas';
    }
}


//Suppression d'une entrée


if (isset($_POST['idRemove'])) {
    $id = $_POST['idRemove'];
    $table = $_POST['page'];
    $database = new Database;
    if ($database->delete($table, $id)) {
        echo 'OK';
    }
    else {
        echo 'PB';
    }
};


//Ajout d'une citation

if (isset($_POST['quote'])) {

    $database = new Database;

    $quote = mysqli_real_escape_string($database->connection, $_POST['quote']);
    $author = mysqli_real_escape_string($database->connection, $_POST['author']);
    $source = mysqli_real_escape_string($database->connection, $_POST['source']);
    $date = mysqli_real_escape_string($database->connection, $_POST['date']);

    $sql = "INSERT INTO quote(author, content, source, date) VALUES('$author', '$quote', '$source', '$date')";

    if (mysqli_query($database->connection, $sql)) {
        $sql = "SELECT * FROM quote ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($database->connection, $sql);
        $row = mysqli_fetch_array($result); 
        
        echo 'OK';
    }
    
    else {
        echo 'PB';
    }
}


//Edition d'une citation

if (isset($_POST['newQuote'])) {
    
    $database = new Database;
    
    $id = $_POST['id'];
    $author = mysqli_real_escape_string($database->connection, $_POST['newAuthor']);
    $quote = mysqli_real_escape_string($database->connection, $_POST['newQuote']);
    $source = mysqli_real_escape_string($database->connection, $_POST['newSource']);
    $date = mysqli_real_escape_string($database->connection, $_POST['newDate']);
        
    if ($database->edit("quote", "content = '$quote', source = '$source', date = '$date', author = '$author'", $id)) {
        echo 'OK';
        }    
    else {
        echo 'PB';
    }
}


//Ajout d'un utilisateur

if (isset($_POST['pseudo'])) {

    $database = new Database;

    $pseudo = mysqli_real_escape_string($database->connection, $_POST['pseudo']);
    $password = mysqli_real_escape_string($database->connection, $_POST['password']);
    $password = hash('sha512', $password);
    
    $sql_control = "SELECT name FROM user WHERE name='$pseudo'";
    
    $query = mysqli_query($database->connection, $sql_control);
    
    if (mysqli_num_rows($query) != 0) {
        echo 'Ce pseudo est déja pris';
    }
    else {
    
        $sql = "INSERT INTO user(name, password) VALUES('$pseudo', '$password')";
        
        if (mysqli_query($database->connection, $sql)) {
            echo 'OK';
        }
        else {
            echo 'PB';
        }
    }

}


//Edition d'un utilisateur

if (isset($_POST['newPseudo'])) {

    $database = new Database;

    $pseudo = mysqli_real_escape_string($database->connection, $_POST['newPseudo']);
    $id = $_POST['id'];
    if (($_POST['newPassword'] != null)) {
        $password = mysqli_real_escape_string($database->connection, $_POST['newPassword']);
        $password = hash('sha512', $password);

        if ($database->edit("user", "name = '$pseudo', password = '$password'", $id)) {
                echo 'OK';
            }
        else {
            echo 'Problème';
        }
    }

    else {
        
        echo 'Problème';
    }

};


//Ajout d'un auteur

if (isset($_POST['authName'])) {
    
    $connection = mysqli_connect('localhost', 'root', 'kingston', 'citations') or die ("Problème de connexion à la base de données:" . mysqli_connect_error());

    $name = mysqli_real_escape_string($connection, $_POST['authName']);
    $firstname = isset($_POST['authFirstname']) ? mysqli_real_escape_string($connection, $_POST['authFirstname']) : ' ';
    $country = isset($_POST['authCountry']) ? mysqli_real_escape_string($connection, $_POST['authCountry']) : ' ';
    $bio = isset($_POST['authBiography']) ? mysqli_real_escape_string($connection, $_POST['authBiography']) : ' ';
    $birthdate = isset($_POST['authBirthdate']) ? mysqli_real_escape_string($connection, $_POST['authBirthdate']) : ' ';
    $deathdate = isset($_POST['authDeathdate']) ? mysqli_real_escape_string($connection, $_POST['authDeathdate']) : ' ';
    $category = isset($_POST['authCategory']) ? mysqli_real_escape_string($connection, $_POST['authCategory']) : ' ';
    
    $sql = "INSERT INTO author(first_name, last_name, biography, country, birthdate, deathdate, category_txt) VALUES('$firstname', '$name', '$bio', '$country', '$birthdate', '$deathdate', '$category')";
    
    if ($result = mysqli_query($connection, $sql)) {
        echo 'OK';
    }
    else {
        echo 'Probleme';
    }
    
}


//Edition d'un auteur

if (isset($_POST['newLastname'])) {
    $database = new Database;

    $lastname = mysqli_real_escape_string($database->connection, $_POST['newLastname']);
    $firstname = mysqli_real_escape_string($database->connection, $_POST['newFirstname']);
    $category = mysqli_real_escape_string($database->connection, $_POST['newCategory']);
    $biography = mysqli_real_escape_string($database->connection, $_POST['newBiography']);
    $birthdate = mysqli_real_escape_string($database->connection, $_POST['newBirthdate']);
    $deathdate = mysqli_real_escape_string($database->connection, $_POST['newDeathdate']);
    $country = mysqli_real_escape_string($database->connection, $_POST['newCountry']);
    $id = $_POST['id'];

    if ($database->edit("author", "last_name = '$lastname', first_name = '$firstname', biography = '$biography', birthdate = '$birthdate', deathdate = '$deathdate', country = '$country', category_txt = '$category'", $id)) {
        $result = $database->find('author', '*', $id);
        while ($row = mysqli_fetch_array($result)) {
            echo 'OK';

        }
    }
    
    else {
        echo 'Problème';
    }

};


?>
