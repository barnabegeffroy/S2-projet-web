<?php
include_once '../src/utils/autoloader.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// create the database connection
$dbfactory = new \Rediite\Model\Factory\dbFactory();
$dbAdapter = $dbfactory->createService();


$sex = !empty($_POST['choix']) ? $_POST['choix'] : null;
$prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : null;
$nom = !empty($_POST['nom']) ? $_POST['nom'] : null;
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$date = !empty($_POST['date']) ? $_POST['date'] : null;
list($annee, $mois, $jour) = explode('-', $date);

//problème lors de la saisie de la date
if (!checkdate($mois, $jour, $annee)) {
	// on renvoie vers l'index /!\ message d'erreur à ajouter
	afficherErreur("Date saisie non valide");
	return;
} else {
	// création/initialisation des objets pour manipuler les données
	$person = new \Rediite\Model\Entity\Person($prenom, $nom, $email);
	$personRepository = new \Rediite\Model\Repository\PersonRepository($dbAdapter);
	$addSign = $personRepository->changeDateToSign($person, intval($jour), intval($mois));
	if (!$addSign) {
		// on renvoie vers l'index /!\ message d'erreur à ajouter
		afficherErreur("Erreur lors de la conversion date en signe astrologique avec ces valeurs :");
		return;
	}
	$success = $personRepository->createPerson($person);
	if (!$success) {
		// on renvoie vers l'index /!\ message d'erreur à ajouter
		afficherErreur("Erreur lors de la création de la personne (existe-t-il déjà ?).");
		return;
	}
?>

<?php
	// Visualise la personne créée
	$data = $person;
	include_once '../src/View/template.php';
	loadView('person', $data);
}


function afficherErreur(string $error)
{
	header('Location: index.php?erreur=' . $error);
}

?>