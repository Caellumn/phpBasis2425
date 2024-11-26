<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CONNECTEER MET DE DB
function connectToDB()
{
    // CONNECTIE CREDENTIALS
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'bondscoach';
    $db_port = 8889;
   
    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}

// VOEG EEN NIEUWE COACH TOE AAN DE DB
function insertNewCoach(String $naam)
{
    print "'$naam' is in de database toegevoegd";
    $db = connectToDB();
    $sql = "INSERT INTO antwoorden_geklikt(naam) VALUES (:naam)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':naam' => $naam,
    
    ]);
    return $db->lastInsertId();
}

// TOTAAL AANTAL STEMMEN
function getTotalVotes()
{
    $sql = "SELECT count(*) as Totaal from antwoorden_geklikt";
    
    
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getVotesPerCoach()
{
    $sql = "SELECT count(id), naam from antwoorden_geklikt group by naam";
    
    
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}