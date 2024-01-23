<?php



function getMessage()
{
    $message = "Visiteur";
    $messageVisiteur = null;

    if(isset($_GET['name']) && !empty($_GET['name'])){
        $messageVisiteur = htmlspecialchars($_GET['name']);
    }

    if($messageVisiteur){
        $message = $messageVisiteur;
    }


    return $message;
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projet Gaetan</title>


</head>
<body>

<h1>Bonjour je suis le projet gaetan</h1>
<p>si vous voyez cette page c'est que je suis en ligne</p>

<h4>Bonjour <?= getMessage() ?></h4>



<form action="index.php" method="get">
    <div><input type="text" name="name" id="" placeholder="name"></div>
    <div>
        <button type="submit">OK</button>
    </div>
</form>

</body>
</html>
