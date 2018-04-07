<?php

//Script de tri aléatoire de la base de données (citations)

$host = '****';
$db = '******';
$user = '****';
$pwd = '******';

$connection = mysqli_connect($host, $user, $pwd, $db);
$sql = "SELECT * FROM quote ORDER BY RAND()";
$result = mysqli_query($connection, $sql);

$i = 0;
while ($quotes_tab = mysqli_fetch_array($result)) {
    $tab[$i] = $quotes_tab;
    $i++;
}

$count = count(array_keys($tab)) - 1;

$sql_truncate = "TRUNCATE TABLE quote";
mysqli_query($connection, $sql_truncate);

echo "\r\n".'Table vidée';

for ($i=0;$i<=$count;$i++) {
    $content = mysqli_real_escape_string($connection, $tab[$i]['content']);
    $author = mysqli_real_escape_string($connection, $tab[$i]['author']);
    $date = mysqli_real_escape_string($connection, $tab[$i]['date']);
    $source = mysqli_real_escape_string($connection, $tab[$i]['source']);

    $sql_update = "INSERT INTO quote(content, author, source, date) VALUES('$content', '$author', '$source', '$date')";
    if (!mysqli_query($connection, $sql_update)) {
        echo "\r\n".mysqli_error($connection);
    }
}

$sql_encode = "ALTER DATABASE citations CHARACTER SET utf8 COLLATE utf8_unicode_ci";
if (mysqli_query($connection, $sql_encode)) {
    echo "\r\n"."Base de données mise à jour !";
}
else {
    echo "\r\n".mysqli_error($connection);
}

?>

<br /><a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Retour</a>
