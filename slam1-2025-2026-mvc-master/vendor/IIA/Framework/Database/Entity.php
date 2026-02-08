<?php

namespace IIA\Framework\Database;

class Entity
{
    protected Database $database;
    protected string $table;
    protected int $id;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAll(): array
    {
        return $this->database->query("SELECT * FROM " . $this->table, static::class);
    }

    public function __get(string $key)
    {
        $method = 'get' . ucfirst($key);
        return $this->$method();
    }

    public function getDefaultTableName(): string
    {
        $className = (new \ReflectionClass(static::class))->getShortName();
        
        // Insère un underscore avant les majuscules (sauf la première)
        $tableName = preg_replace('/([a-z])([A-Z])/', '$1_$2', $className);
        
        // Convertit en minuscules
        return strtolower($tableName);
    }

// fonction qui perment de delete qui permet de supprimer un objet de la base de données.

    public function delete(): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->database->execute($query, [':id' => $this->id]);
    }

// Méthode save : sauvegarde un objet en base de données (INSERT ou UPDATE)
    public function save(): bool
    {
        // Récupère toutes les propriétés de l'objet
        $properties = get_object_vars($this);
        
        // Supprime les propriétés système qui ne doivent pas aller en base de données
        unset($properties['database'], $properties['table']);

        // Vérifie si l'objet a déjà un ID
        if (isset($this->id) && $this->id > 0) {
            // Si oui, c'est une mise à jour (UPDATE)
            return $this->update($properties);
        } else {
            // Si non, c'est une insertion (INSERT)
            return $this->insert($properties);
        }
    }


    public function getOne(int $id): ?Entity
    {
        // Exécute une requête SELECT pour trouver l'objet avec cet ID
        // La requête cherche dans la table et filtre par id 
        $results = $this->database->query(
            "SELECT * FROM " . $this->table . " WHERE id = :id",
            static::class,
            [':id' => $id]
        );
        
        // Vérifie si des résultats ont été trouvés
        // Si oui, retourne le premier résultat 
        // Si non (tableau vide), retourne null
        return !empty($results) ? $results[0] : null;
    }

}