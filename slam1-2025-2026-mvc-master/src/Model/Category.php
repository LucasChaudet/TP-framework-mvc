<?php

namespace App\Model;

use IIA\Framework\Database\Database;
use IIA\Framework\Database\Entity;

class Category extends Entity
{
    private string $name;

    public function __construct(Database $database)
    {
        parent::__construct($database);
        $this->table = "category";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Room[]
     */
    public function getRooms(): array
    {
        return $this->database->query("SELECT * FROM room WHERE category_id = " . $this->getId(), Room::class);
    }
}