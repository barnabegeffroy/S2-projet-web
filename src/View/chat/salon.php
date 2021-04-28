<?php
$messages = ""
?>

<html>
    <head>
        
        <meta charset="utf-8">

    </head>
    <body>
        <div class="rectangle2"><?php 
        if($messages!=""){
        foreach($messages as $message)
        {
            $content=$message->getContent();
            $emittor=$message->getEmittor();
        /*  $content=$message->getContent(); */
        echo $emittor.': '.$content.'<br/>';     

        }}?>
        


        <form action="salon.php" method="POST">
        <input type='string' autocomplete="off" placeholder="Ecrivez votre message..." name="message" style="width: 1630px;"></input>
        <button class="button" type="submit" name="Rejoindre" value="<?php echo $id ; ?>" >Envoyer</input>
        </div>
    </body>

