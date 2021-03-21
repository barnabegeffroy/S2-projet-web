<?php

namespace Rediite\Model\Repository;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use \Rediite\Model\Entity\Person as PersonEntity;

class PersonRepository
{

  /**
   * @var \PDO
   */
  private $dbAdapter;

  /**
   * constructor
   * @param \PDO $dbAdapter
   * @return void
   */
  public function __construct(
    \PDO $dbAdapter
  ) {
    $this->dbAdapter = $dbAdapter;
  }

  /**
   * Set person's zodiac sign
   * @param PersonEntity $person
   * @param mixed $jour
   * @param mixed $mois
   * 
   * @return mixed
   */
  function changeDateToSign(PersonEntity $person, $jour, $mois)
  {
    $request = $this->dbAdapter->prepare(
      'SELECT nom_signe_astro
      FROM astro_signe
      WHERE 
          CASE WHEN mois_debut <= mois_fin 
              THEN (mois_debut * 100 + jour_debut) <= (:mounth * 100 + :jour) AND  (:mounth * 100 + :jour) <= (mois_fin * 100 + jour_fin)
              ELSE (mois_debut * 100 + jour_debut) <= (:mounth * 100 + :jour) OR (:mounth * 100 + :jour) <= (mois_fin * 100 + jour_fin) 
          END'
    );
    $request->bindValue(':jour', $jour, \PDO::PARAM_INT);
    $request->bindValue(':mounth', $mois, \PDO::PARAM_INT);
    $request->execute();

    $person->setZodiacSign($request->fetch()['nom_signe_astro']);
    return $this;
  }
  /**
   * add person's datas in our data base
   * @param PersonEntity $person
   * @return bool
   */
  function createPerson(PersonEntity $person)
  {
    $sql =
      <<<SQL
  INSERT INTO astro_personne (num_enregistrement, nom, prenom, email, nom_signe_astro)
    VALUES (:id, :nom, :prenom, :email, :signe_astro);
SQL;

    $stmt = $this->dbAdapter->prepare($sql);
    $stmt->bindValue(':id', $person->getId(), \PDO::PARAM_INT);
    $stmt->bindValue(':nom', $person->getLastName(), \PDO::PARAM_STR);
    $stmt->bindValue(':prenom', $person->getFirstName(), \PDO::PARAM_STR);
    $stmt->bindValue(':email', $person->getEMail(), \PDO::PARAM_STR);
    $stmt->bindValue(':signe_astro', $person->getZodiacSign(), \PDO::PARAM_STR);
    return $stmt->execute();
  }
}
