<?php

require_once 'database_class.php';

if (isset($_POST['log_pseudo'])) {
    
    $database = new Database;
    $pseudo = $_POST['log_pseudo'];
    $password = $_POST['log_password'];
    
    $sql = "SELECT * FROM user WHERE name='$pseudo'";
    if ($result = mysqli_query($database->connection, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $check = hash('sha512', $password);
        $check = substr($check, 0, 64);
            if ($row['password'] == $check) {
                echo 'OK';
            }
            else {
                echo 'Identifiants incorrects';
            }
    }

    else {
        echo 'Ce pseudo n\'existe pas';
    }
}

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $category = "'$category'";
    $database = new Database;
    if ($database->add('category', 'name', $category)) {
        $result = $database->getLast('category');
        while ($row = mysqli_fetch_array($result)) {
            echo $row['name'];
        }
    }
    else {
        echo 'PB';
    }
    
}

if (isset($_POST['newCat'])) {
    $category = $_POST['newCat'];
    $id = $_POST['id'];
    $database = new Database;
    if ($database->edit("category", "name = '$category'", $id)) {
        $result = $database->find('category', '*', $id);
        while ($row = mysqli_fetch_array($result)) {
            echo $row['name'];
        }
    }
    else {
        echo 'PB';
    }
    
};

if (isset($_POST['newPseudo'])) {

    $database = new Database;

    $pseudo = mysqli_real_escape_string($database->connection, $_POST['newPseudo']);
    $id = $_POST['id'];
    if (($_POST['newPassword'] != null)) {
        $password = mysqli_real_escape_string($database->connection, $_POST['newPassword']);
        $password = hash('sha512', $password);

        if ($database->edit("user", "name = '$pseudo', password = '$password'", $id)) {
        $result = $database->find('user', 'name', $id);
            while ($row = mysqli_fetch_array($result)) {
                echo $row['name'];
            }
        }
        else {
            echo 'PB';
        }
    }

    else {
        if ($database->edit("user", "name = '$pseudo'", $id)) {
        $result = $database->find('user', 'name', $id);
            while ($row = mysqli_fetch_array($result)) {
                echo $row['name'];
            }
        }
        else {
            echo 'PB';
        }
    }


};

if (isset($_POST['newQuote'])) {
    
    $database = new Database;
    
    $id = $_POST['id'];
    $authorId = $_POST['newAuth'];
    $quote = mysqli_real_escape_string($database->connection, $_POST['newQuote']);
    $source = mysqli_real_escape_string($database->connection, $_POST['newSource']);
    $date = mysqli_real_escape_string($database->connection, $_POST['newDate']);
    
    //$sql = "INSERT INTO quote(content, date, author, source) VALUES($quote, $date, $author, $source)";
    
    if ($database->edit("quote", "content = '$quote', source = '$source', date = '$date', author = '$authorId'", $id)) {
        $result = $database->find('quote', '*', $id);
        $row = mysqli_fetch_array($result);
        $sql2 = "SELECT first_name, last_name FROM author WHERE id=$authorId";
        $result2 = mysqli_query($database->connection, $sql2);
        $row2 = mysqli_fetch_array($result2);
        array_push($row, $row2[0], $row2[1]);
        echo json_encode($row);
        }    
    else {
        echo 'PB';
    }
}


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

    if ($database->edit("author", "last_name = '$lastname', first_name = '$firstname', biography = '$biography', birthdate = '$birthdate', deathdate = '$deathdate', country = '$country''", $id)) {
        $result = $database->find('author', '*', $id);
        while ($row = mysqli_fetch_array($result)) {
            echo $row['name'];
        }
    }
    else {
        echo 'PB';
    }

};


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
        $sql2 = "SELECT last_name FROM author WHERE id=$author";
        $result2 = mysqli_query($database->connection, $sql2);
        $row2 = mysqli_fetch_array($result2);
        
        array_push($row, $row2[0]);
        echo json_encode($row);
    }
    
    else {
        echo 'PB';
    }
}

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






if (isset($_POST['authName'])) {
    
    $connection = mysqli_connect('localhost', 'root', 'kingston', 'citations') or die ("Problème de connexion à la base de données:" . mysqli_connect_error());

    $name = mysqli_real_escape_string($connection, $_POST['authName']);
    $firstname = isset($_POST['authFirstname']) ? mysqli_real_escape_string($connection, $_POST['authFirstname']) : ' ';
    $country = isset($_POST['authCountry']) ? mysqli_real_escape_string($connection, $_POST['authCountry']) : ' ';
    $bio = isset($_POST['authBiography']) ? mysqli_real_escape_string($connection, $_POST['authBiography']) : ' ';
    $birthdate = isset($_POST['authBirthdate']) ? mysqli_real_escape_string($connection, $_POST['authBirthdate']) : ' ';
    $deathdate = isset($_POST['authDeathdate']) ? mysqli_real_escape_string($connection, $_POST['authDeathdate']) : ' ';
    //$category = isset($_POST['authCategoryId']) ? mysqli_real_escape_string($connection, $_POST['authCategoryId']) : ' ';
    
    $sql = "INSERT INTO author(first_name, last_name, biography, country, birthdate, deathdate) VALUES('$firstname', '$name', '$bio', '$country', '$birthdate', '$deathdate')";

    if (isset($_POST['authCategoryId'])) {
    $category = explode(',', $_POST['authCategoryId']);
        for ($i=0; $i<=count($category); $i++) {
            $sql_last_id = "SELECT MAX(id) FROM author";
            if ($last_id = mysqli_query($connection, $sql_last_id)) {
                while ($result_cat = mysqli_fetch_array($last_id)) {
                    $category_author = $result_cat[0];
                }
            }
            $last_id = $category_author + 1;
            $sql_cat = "INSERT INTO author_category(author_id, category_id) VALUES($last_id, $category[$i])";
            mysqli_query($connection, $sql_cat);

        }
    }
    

    if ($result = mysqli_query($connection, $sql)) {
        echo 'Auteur ajouté';
    }
    else {
        echo 'Probleme';
    }
    
}


?>