<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">

    <div>
        <label  for="firstname">Fristname :</label>
        <input  type="text"  id="firstname"  name="user_firstname">
        </div>

        <div>
        <label  for="lastname">Lastname :</label>
        <input  type="text"  id="lastname"  name="user_lastname">
        </div>

        <button  type="submit">SUBMIT</button>
    </form>
</body>
</html>



<?php
require '_connect.php';
$pdo = new PDO(DSN, USER, PASS);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['user_firstname']) || trim($_POST['user_firstname']) === ''){
        $errors[] = "Please enter your firstname";
    }
    if(!isset($_POST['user_lastname']) || trim($_POST['user_lastname']) === ''){
        $errors[] = "Please enter your lastname";
    }
    if (!empty($errors)) {
        foreach($errors as $error) {
            echo $error."<br>";
        }
    }
    
    // On récupère les informations saisies précédemment dans un formulaire
    $firstname = trim($_POST['user_firstname']); 
    $lastname = trim($_POST['user_lastname']);
    
    // On prépare notre requête d'insertion
    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($query);
    
    // On lie les valeurs saisies dans le formulaire à nos placeholders
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    
    $statement->execute();
}
    

?>