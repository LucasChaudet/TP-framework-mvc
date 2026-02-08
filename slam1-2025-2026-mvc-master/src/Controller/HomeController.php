<?php

namespace App\Controller;

use App\Model\Room;

class HomeController extends AppController
{
    public function index(): void
    {
        /** @var Room[] $rooms */
        $rooms = $this->getDatabase()->getEntity(Room::class)->getAll();

        $this->render("home/index", ["username" => "johndoe", "rooms" => $rooms]);
    }

    public function about(): void
    {
        echo "<h1>À propos</h1>";
    }
}