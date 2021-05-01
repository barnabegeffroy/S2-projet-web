<div class="col-12 text-center mt-5">
    <h1 class="text-dark pt-4">Messagerie</h1>
</div>
<?php
$data = $chatRepository->getConvFromId($_GET['idConv']);
$userSessionId = $authenticatorService->getCurrentUserId();
if (empty($data)) : ?>
    <h3>Annonce introuvable</h3>
<?php elseif ($data['id1'] !== $userSessionId && $data['id2'] !== $userSessionId) : ?>
    <h3>Accès refusé</h3>
<?php else :
    $other = $userRepository->getIdentity($data['id1'] !== $userSessionId ? $data['id1'] : $data['id2']);
    $messages = $chatRepository->getMessagesFromConvId($_GET['idConv']); ?>
    <p class="lead">
        Conversation avec <?php echo $other['prenom'] . (isset($other['pseudo']) ? ' \'' . $other['pseudo'] . '\' ' : ' ') . $other['nom']; ?>
    </p>
    <form action="announce.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $data['conv_idannonce'] ?>">
        <button class="btn btn-outline-dark btn-md my-1" type="submit">Voir l'annonce</button>
    </form>
    <div class="border-top border-primary w-25 mx-auto my-3"></div>
    <?php foreach ($messages as &$message) : ?>
        <div class="<?php echo ($message->getIdAuteur() == $userSessionId) ? "text-right" : "text-left" ?>">
            <p class="lead"><?php echo $message->getDate() ?></p>
            <div><?php $content = $message->getDescription();
                    if ($message->getDemandeResa()) : ?>
                    Demande de reservation sur cet intervalle :
                    <?php echo $content;
                        if ($message->getIdAuteur() !== $userSessionId) : ?>
                        <form action="addReservation.php" name="addResa" class="form-container" method="POST">
                            <input type="hidden" name="ref_conv" value="<?php echo $data['id'] ?>">
                            <input type="hidden" name="idAnnonce" value="<?php echo $data['conv_idannonce']; ?>">
                            <input type="hidden" name="idMessage" value="<?php echo $message->getMessageId(); ?>">
                            <input type="hidden" name="idAuteur" value="<?php echo $message->getIdAuteur() ?>">
                            <input type="hidden" name="message" value="<?php echo $content; ?>">
                            <input type="hidden" name="start" value="">
                            <input type="hidden" name="end" value="">
                            <button type="submit" class="btn btn-outline-dark btn-md my-1">Accepter</button>
                        </form>
                        <form action="declineResa.php" name="declineResa" class="form-container" method="POST">
                            <input type="hidden" name="ref_conv" value="<?php echo $data['id']; ?>">
                            <input type="hidden" name="resaDates" value="<?php
                                                                            $resas = $announceRepository->findReservationsByAnnounce($data['id']);
                                                                            foreach ($resas as &$resa) {
                                                                                $date = strtotime($resa['datedebut']);
                                                                                $endDate = strtotime($resa['datefin']);
                                                                                while ($date <= $endDate) {
                                                                                    $printedDate = date("Y/m/d", $date);
                                                                                    echo $printedDate . " ";
                                                                                    $date = strtotime("+1 day", $date);
                                                                                }
                                                                            } ?>">
                            <input type="hidden" name="idMessage" value="<?php echo $message->getMessageId(); ?>">
                            <input type="hidden" name="message" value="<?php echo $content; ?>">
                            <button type="submit" class="btn btn-outline-dark btn-md my-1">Refuser</button>
                        </form>

                        <script src="../src/assets/scripts/availability.js"></script>
                        <script type="text/javascript">
                            console.log("Run script");
                            document.onload = checkResa(<?php echo $announceRepository->getDuration($data['conv_idannonce']); ?>);
                        </script>
                <?php endif;
                    else : echo $content;

                    endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <form action="addMessage.php" method="POST">
        <input type="hidden" name="ref_conv" value="<?php echo $data['id'] ?>">
        <input type="hidden" name="idAnnonce" value="<?php echo $data['idannonce'] ?>">
        <input type="hidden" name="idAuteur" value="<?php echo $userSessionId ?>">
        <input class="form-control" type="text" placeholder="Ecrivez votre message..." name="message"></input>
        <button class="btn btn-outline-dark btn-md my-1" type="submit" name="Rejoindre" value="<?php echo $id; ?>">Envoyer</button>
    </form>
<?php endif; ?>