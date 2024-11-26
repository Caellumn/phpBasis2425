<?php
require('db.inc.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$errors= [];
$submitted = false;
// CONNECTIE MAKEN MET DE DB


if (@$_POST['submit']) { // is "submit" als key aanwezig in de $_POST array

    $submitted = true;
    $naam = "";
    

    // 1: alle default values declareren
    // $name = "";
   

    // 2: validatie uitvoeren
    if (!isset($_POST['naam']) ) { // zit title in mijn POST?
        $errors[] = "Selecteer een naam";
    } else {

        $naam = $_POST['naam'];
        if ((strlen($_POST['naam']) == 0) )  { // is het title field ingevuld?
            $errors[] = 'selecteer een naam indien "andere" selecteer en vul een naam in';
            
        }
        if(($_POST['naam'] == "andere") && ($_POST['andere_naam'] == null)) {
            $errors[] = "vul een naam in";
        }
    
        if(($_POST['naam'] == "andere")) {
            $naam = $_POST['andere_naam'];
        }
    }
    
    
    print '<pre>';
    print_r($_POST);
    print '</pre>';
    
    if (count($errors) == 0) { // er werden geen fouten geregistreerd tijdens validatie
        insertNewCoach($naam);
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wie wordt bondscoach</title>
</head>
<body>

<h1>wie wordt de nieuwe bondscoach</h1>

<?php foreach ($errors as $error): ?>
    <p style="background-color: red;"><?= $error; ?></p>
<?php endforeach; ?>

<?php if ($submitted && count($errors) == 0): ?>
    <p style="background-color: limegreen;"> uw stem is genoteerd!</p>   
<?php endif; ?>

<p> kies een nieuwe bondscoach</p>
   
<form action="index.php" method="post">
  
    <input type="radio" id="sonck" name="naam" value="sonck">
    <label for="sonck">Sonck</label><br>

    <input type="radio" id="martinez" name="naam" value="martinez">
    <label for="martinez">Martinez</label><br>

    <input type="radio" id="wilmots" name="naam" value="wilmots">
    <label for="wilmots">Wilmots</label><br>

    <input type="radio" id="andere" name="naam" value="andere">
    <label for="andere">andere</label>

    <input type="text" name="andere_naam" maxlength="45">

    
    <br><br>

    <input type="submit" name="submit" id="submit" />
</form>
<a href="results.php">Resultaten</a>

</body>
</html>