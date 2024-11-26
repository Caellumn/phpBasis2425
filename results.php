<?php 

require('db.inc.php');

$total = getTotalVotes();
$votes = getVotesPerCoach();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Resultaten</h1>
    <?php foreach ($votes as $index => $vote ): ?>
                                                               
    <p><?= $vote['naam']; ?>: <strong><?= $vote['count(id)']; ?></strong> stemmen (<?= round(($vote['count(id)'] / $total) *100,2); ?>%)</p> 
    <?php endforeach; ?>

    <p>Totaal aantal votes: <strong><?= $total; ?></strong></p>

</body>
</html>

<?php 
    print '<pre>';
    print_r($votes);
    print '</pre>'; 
?>