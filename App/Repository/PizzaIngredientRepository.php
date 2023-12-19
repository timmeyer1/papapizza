<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Ingredient;
use Core\Repository\Repository;

class PizzaIngredientRepository extends Repository
{
    public function getTableName(): string
    {
        return 'pizza_ingredient';
    }

    // NOTE: méthode qui récupère la liste des ingrédients d'une pizza
    public function getIngredientByPizzaId(int $pizza_id)
    {
        // on déclare un tableau vide
        $array_result = [];
        // on crée la requete

        $query = sprintf(
            'SELECT *
            FROM %1$s AS pi
            INNER JOIN %2$s AS i ON pi.ingredient_id = i.id
            WHERE pi.pizza_id=:id',
            $this->getTableName(),
            AppRepoManager::getRm()->getIngredientRepository()->getTableName()
        );
        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if(!$stmt) return $array_result;

        // on execute la requete en bindant les parametres
        $stmt->execute(['id' => $pizza_id]);

        // on recupere les resultats
        while($row_data = $stmt->fetch()){
            $array_result[] = new Ingredient($row_data);
        }

        return $array_result;
    }

    // NOTE: méthode pour créer une pizza_ingredient
    public function insertPizzaIngredient(array $data)
    {
        // on crée la requête
        $query = sprintf(
            'INSERT INTO %s (pizza_id, ingredient_id, unit_id, quantity)
            VALUES (:pizza_id, :ingredient_id, :unit_id, :quantity)',
            $this->getTableName()
        );

        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if(!$stmt) return false;

        // on execute la requete en bindant les parametres
        $stmt->execute($data);

        // on regarde si au moins une ligne a été enregistrée
        return $stmt->rowCount() > 0;
    }

    public function editPizzaIngredient(array $data)
    {
        // on crée la requête
        $query = sprintf(
            'UPDATE %s
            SET `ingredient_id` =:ingredient_id
            WHERE `id`=:id',
            $this->getTableName()
        );

        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if(!$stmt) return false;

        // on execute la requete en bindant les parametres
        $stmt->execute($data);
    }
}