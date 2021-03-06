<?php
if (!$authenticatorService->isAuthenticated()) {
    $error = "Vous devez vous connecter pour accéder à cette page";
    header('Location: index.php?erreur=' . $error);
    exit;
}
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();
$userHydrator = new \Rediite\Model\Hydrator\UserHydrator();
$userRepository = new \Rediite\Model\Repository\UserRepository($dbAdapter, $userHydrator);
$userService = new \Rediite\Model\Service\UserService($userRepository);

$user = $authenticatorService->getCurrentUser();
?>
<div class="col-5">
    <h4 class="text-dark text-center pt-4">Modifiez vos informations.</h4>

    <form action="updateInfos.php" method="post">
        <div class="form-group">
            <div>
                <label class="form-label" for="prenom">Prénom :</label>
                <input class="form-control" type="text" id="prenom" name="prenom" value="<?php echo $user->getFirstName() ?>" required />
            </div>
            <div>
                <label class="form-label" for="pseudo">Pseudo :</label>
                <input class="form-control" type="text" id="pseudo" name="pseudo" value="<?php echo $user->getNickName() ?>" />
            </div>
            <div>
                <label class="form-label" for="nom">Nom :</label>
                <input class="form-control" type="text" id="nom" name="nom" value="<?php echo $user->getLastName() ?>" required />
            </div>
            <div>
                <label class="form-label" for="email">Email :</label>
                <input class="form-control" type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" value="<?php echo $user->getEMail() ?>" required />
                <?php if (isset($data['userAlreadyExist'])) : ?>
                    <span class="error-message"><?= $data['userAlreadyExist'] ?></span>
                <?php endif; ?>
            </div>
            <div>
                <label class="form-label" for="telephone">Numéro de téléphone:</label>
                <input class="form-control" type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" value="<?php echo $user->getPhoneNumber() ?>" required>
                <small>Format: 0612345678</small>
            </div>
            <?php if (isset($data['failedPassword'])) : ?>
                <span class="error-message"><?= $data['failedPassword'] ?></span>
            <?php endif; ?>
            <button class="btn btn-outline-dark btn-md my-1" type="submit">Valider</button>
        </div>
    </form>
</div>