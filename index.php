<?php

function getPdo()
{


    $pass = "clxHWTc1w]es5UiG";
    $user = "michel";
    $dbhost = "localhost";
    $dbname = "jeanmichel";


    $pdo = new \PDO(
        "mysql:host=$dbhost;dbname=$dbname",
        $user,
        $pass,
        [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]
    );

    return $pdo;
}
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

function getTrucs()
{

    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM trucs");
    $query->execute();

    return $query->fetchAll();
}
function newTruc( $name,  $content)
{
    $pdo = getPdo();
    $query = $pdo->prepare("INSERT INTO trucs SET name=:name, content= :content");
    $query->execute([
            "name"=>$name,
            "content"=>$content
    ]);

}

$name = null;
$content = null;

if(isset($_POST['name']) && !empty($_POST['name'])) {$name = htmlspecialchars($_POST['name']);}
if(isset($_POST['content']) && !empty($_POST['content'])) {$content = htmlspecialchars($_POST['content']);}

if($name && $content){
    newTruc($name,$content);
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
<hr>
<hr>


<form action="index.php" method="post">
    <div><input type="text" name="name" placeholder = "enter the name"></div>
    <div><input type="text" name="content" placeholder = "enter the content"></div>
    <div>
        <button type="submit">post</button>
    </div>
</form>

<div class="trucs">

    <?php foreach (getTrucs() as $truc): ?>

    <div style="border : 2px solid black">
        <p><strong><?= $truc['name'] ?></strong></p>
        <p>Le contenu : <?= $truc['content'] ?></p>


    </div>

    <?php endforeach; ?>
</div>

</body>
</html>
