<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Price;
use App\Model\Size;
use Core\Repository\Repository;

class PriceRepository extends Repository
{
    public function getTableName(): string
    {
        return 'price';
    }

    // NOTE: méthode qui recupere les prix d'une pizza
    public function getPriceByPizzaId(int $pizza_id)
    {
        // on déclare un tableau vide
        $array_result = [];

        // on crée la requete
        $query = sprintf(
            'SELECT pr.*, s.label
            FROM %1$s AS pr
            INNER JOIN %2$s AS s ON pr.size_id = s.id
            WHERE pr.pizza_id = :id',
            $this->getTableName(),
            AppRepoManager::getRm()->getSizeRepository()->getTableName()
        );
        
        // on prépare la requete
        $stmt = $this->pdo->prepare($query);

        // on vérifie que la requete est bien préparée
        if(!$stmt) return $array_result;

        // on exécute la requete
        $stmt->execute(['id' => $pizza_id]);
        
        // on récupère les résultats
        while($row_data = $stmt->fetch())
        {
            $price = new Price($row_data);
        

            // on doit reconstruire un tableau pour créer une instance de Size
            $size_data = [
                'id' => $row_data['size_id'],
                'label' => $row_data['label']
            ];

            $size = new Size($size_data);
            // on hydrate Price avec Size
            $price->size = $size;

            // on ajoute l'objet Price dans le tableau
            $array_result[] = $price;

        }
        // on retourne le tableau
        return $array_result;
    }

    // NOTE: méthode pour créer un prix
    public function insertPrice(array $data)
    {
        // on crée la requête
        $query = sprintf(
            'INSERT INTO %s (`price`, `size_id`, `pizza_id`)
            VALUES (:price, :size_id, :pizza_id)',
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

    // NOTE: Méthode pour supprimer un prix
    public function deletePrice(array $data)
    {
        // on crée la requete
        $query = sprintf(
            'DELETE FROM %s
            WHERE `pizza_id` = :pizza_id',
            $this->getTableName()
        );
        
        // on prépare la requête
        $stmt = $this->pdo->prepare($query);

        // on vérifie si la requete s'est bien préparée
        if(!$stmt) return false;

        // on execute la requete en bindant les parametres
        $stmt->execute($data);

        return $stmt->rowCount() > 0;
    }
}