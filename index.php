<?php 

require_once '_connec.php';
$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend;";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
var_dump($friends);

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = "INSERT INTO friend (firstname,lastname) VALUES (:firstname,:lastname);";
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname',$firstname, PDO::PARAM_STR);
$statement->bindValue('lastname',$lastname, PDO::PARAM_STR);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
</head>
<body>
    <div>
        <li>
        <?php foreach($friends as $friend) {
    echo $friend['firstname'] . ' ' . $friend['lastname'];} ?>
        </li>
    </div>
<form action="" method="post">
        <div>
            <label for="firstname"></label>
            <input id="firstname" name="firstname" type="text" placeholder="Prénom">
        </div>
        <div>
            <label for="lastname"></label>
            <input id="lastname" name="lastname" type="text" placeholder="Nom de famille">
        </div>
        <div>
            <input type="submit" value="Envoyer le personnage">
        </div>
    </form>
</body>
</html>