<?php
$messages = ""
?>

<html>
    <head>
        
        <meta charset="utf-8">

    </head>
    <body>
        <style> 
        /*Rectangle qui contient les messages */
        .rectangle2{
        margin-top: 10px;
        margin-left: 50px;
        margin-right: 50px;
        margin-bottom: 10px;
        padding-top : 10px;
        padding-bottom : 10px;
        padding-left : 10px;
        padding-right : 10px;
        border-top : solid;
        border-top-color : #828282;
        border-left : solid;
        border-right : solid;
        border-bottom : solid;
        border-top-width : 3px;
        background-color: rgb(141, 30, 104);
        width: 300px;
        height: 300px;
        }
        </style>
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

