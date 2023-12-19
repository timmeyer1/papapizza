<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Pizza;
use Core\Repository\Repository;

class PizzaRepository extends Repository
{
    public function getTableName(): string
    {
        return 'pizza';
    }

    //PING: on crée une méthode qui va récupérer toutes les pizzas actives
    public function getAllPizzas(): array
    {
        //on déclare un tableau vide
        $array_result = [];

        //on déclare la requete SQL
        $query = sprintf(
            'SELECT p.`id`, p.`name`, p.`image_path` 
            FROM %1$s AS p
            INNER JOIN %2$s AS u ON p.`user_id`=u.`id` 
            WHERE p.`is_active`=1 
            AND u.`is_admin`=1',
            $this->getTableName(),
            AppRepoManager::getRm()->getUserRepository()->getTableName()
        );

        //on peut directement executer la requete avec la méthode query()
        $stmt = $this->pdo->query($query);
        //on vérifie si la requete s'est bien exécutée
        if (!$stmt) return $array_result;

        //on récupère les données de la table dans une boucle
        while ($row_data = $stmt->fetch()) {
            $array_result[] = new Pizza($row_data);
        }

        return $array_result;
    }

    //PING: on crée une méthode qui va récupérer toutes les pizzas avec ses infos
    public function getAllPizzasWithInfo(): array
    {
        //on déclare un tableau vide
        $array_result = [];

        //on déclare la requete SQL
        $query = sprintf(
            'SELECT p.`id`, p.`name`, p.`image_path` 
            FROM %1$s AS p
            INNER JOIN %2$s AS u ON p.`user_id`=u.`id` 
            WHERE p.`is_active`=1 
            AND u.`is_admin`=1',
            $this->getTableName(),
            AppRepoManager::getRm()->getUserRepository()->getTableName()
        );

        //on peut directement executer la requete avec la méthode query()
        $stmt = $this->pdo->query($query);
        //on vérifie si la requete s'est bien exécutée
        if (!$stmt) return $array_result;

        //on récupère les données de la table dans une boucle
        while ($row_data = $stmt->fetch()) {
            $pizza = new Pizza($row_data);
            //on va hydrater les ingrédients de la pizza
            $pizza->ingredients = AppRepoManager::getRm()->getPizzaIngredientRepository()->getIngredientByPizzaId($pizza->id);
            //on va hydrater les prix de la pizza
            $pizza->prices = AppRepoManager::getRm()->getPriceRepository()->getPriceByPizzaId($pizza->id);

            $array_result[] = $pizza;
        }

        return $array_result;
    }

    //PING: on crée une méthode qui va récupérer une pizza par son id
    public function getPizzaById(int $pizza_id): ?Pizza
    {
        //on crée la requete
        $query = sprintf(
            'SELECT * FROM %s WHERE `id`=:id',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($query);

        //on vérifie si la requete s'est bien préparée
        if (!$stmt) return null;

        //on execute la requete en bindant les paramètres
        $stmt->execute(['id' => $pizza_id]);

        //on recupère le resultat
        $result = $stmt->fetch();

        //si je n'ai pas de résultat on retourne null
        if (!$result) return null;

        //on retourne une nouvelle instance de Pizza
        $pizza = new Pizza($result);

        //on va hydrater les ingrédients de la pizza
        $pizza->ingredients = AppRepoManager::getRm()->getPizzaIngredientRepository()->getIngredientByPizzaId($pizza->id);
        //on va hydrater les prix de la pizza
        $pizza->prices = AppRepoManager::getRm()->getPriceRepository()->getPriceByPizzaId($pizza->id);

        // on retourne la pizza
        return $pizza;
    }

    //PING: on crée une méthode qui va inserer une nouvelle pizza
    public function insertPizza(array $data): ?Pizza
    {
        // on crée la reqûete
        $query = sprintf(
            'INSERT INTO %s (`name`, `image_path`, `is_active` ,`user_id`) 
            VALUES (:name, :image_path, :is_active, :user_id)',
            $this->getTableName()
        );

        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if (!$stmt) return null;

        // on exécute la requete en bindant les paramètres
        $stmt->execute($data);

        // on récupère l'id de la pizza fraichement créée
        $pizza_id = $this->pdo->lastInsertId();

        // on retourne la pizza
        return $this->getPizzaById($pizza_id);
    }

    // PING: pour rendre une pizza "supprimer" (invisible)
    public function deletePizza(int $id): bool
    {
        //on créer la requete
        $query = sprintf(
            'UPDATE %s SET `is_active` = 0 WHERE `id` =:id',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($query);

        //on verifie que la requete est bien préparée
        if (!$stmt) return false;

        //on execute la requete si la requete est passé on retourne true sinon false
        return $stmt->execute(['id' => $id]);
    }

    // PING: pour modifier une pizza déjà existante
    public function editName(array $data)
    {

        $query = sprintf(
            'UPDATE %s SET `name` = :name
            WHERE `id` = :id',
            $this->getTableName()
        );

        // On prépare la requête
        $stmt = $this->pdo->prepare($query);

        // On vérifie si la requête s'est bien préparée
        if (!$stmt) return null;
        // On exécute la requête en bindant les paramètres
        $stmt->execute($data);
    }

    // PING: pour modifier l'image d'une pizza
    public function editImage(array $data)
    {

        $query = sprintf(
            'UPDATE %s SET `image_path` = :image_path
            WHERE `id` = :id',
            $this->getTableName()
        );

        // On prépare la requête
        $stmt = $this->pdo->prepare($query);

        // On vérifie si la requête s'est bien préparée
        if(!$stmt) return null;

        // On exécute la requête en bindant les paramètres
        $stmt->execute($data);
    }

    public function createPizzaByUser(array $data): ?Pizza
    {

        $query = sprintf(
            'INSERT INTO %s (`name`, `image_path`, `is_active` ,`user_id`) 
            VALUES (:name, :image_path, :is_active, :user_id)',
            $this->getTableName()
        );

        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if (!$stmt) return null;

        // on exécute la requete en bindant les paramètres
        $stmt->execute($data);

        // on récupère l'id de la pizza fraichement créée
        $pizza_id = $this->pdo->lastInsertId();

        // on retourne la pizza
        return $this->getPizzaById($pizza_id);

    }

    public function getPizzaByUserId(int $user_id)
    {
        $query = sprintf(
            'SELECT * FROM %s
            WHERE `user_id` = :user_id',
            $this->getTableName()
        );

        $array_result = [];

        $stmt = $this->pdo->prepare($query);

        if (!$stmt) return $array_result;

        $stmt->execute(['user_id' => $user_id]);

        while ($row_data = $stmt->fetch()) {
            $pizza = new Pizza($row_data);

            $array_result[] = $pizza;
        }

        return $array_result;
    }
}
