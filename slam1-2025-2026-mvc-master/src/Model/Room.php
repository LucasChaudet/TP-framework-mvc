<?php

namespace App\Model;

use IIA\Framework\Database\Database;
use IIA\Framework\Database\Entity;

class Room extends Entity
{
    private string $name;
    private int $category_id;

    public function __construct(Database $database)
    {
        parent::__construct($database);
        $this->table = "room";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getCategory(): Category
    {
        $categories = $this->database->query("SELECT * FROM category WHERE id = " . $this->getCategoryId(), Category::class);
        return $categories[0];
    }
}