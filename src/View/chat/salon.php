<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$messageRepository = new \Rediite\Model\Repository\MessageRepository($dbAdapter);

$messages = $messageRepository->viewMessage($authenticatorService->getCurrentUserId());

if($messages=="")
{
    echo $messages;
}
else
{
    foreach($messages as $message)
    {
    $description=htmlspecialchars($message->getDescription());
    $idEmetteur=($message->getIdEmetteur());

    }
}

?>

<html>
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />


    </head>
    <body>
        <div class="rectangle2"><?php 
        if($messages!=""){
        foreach($messages as $message)
        {
            $description=$message->getDescription();
            $idEmetteur=$message->getIdEmetteur();
        /*  $content=$message->getContent(); */
        echo $idEmetteur.': '.$description.'<br/>';     

        }}?>
        


        <form action="salon.php" method="POST">
        <input type='string' autocomplete="off" placeholder="Ecrivez votre message..." name="message" style="width: 1630px;"></input>
        <button class="button" type="submit" name="Rejoindre" value="<?php echo $id ; ?>" >Envoyer</input>
        </div>
    </body>

