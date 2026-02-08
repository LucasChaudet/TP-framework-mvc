<?php

namespace IIA\Framework\Controller;

use IIA\Framework\Database\Database;

class Controller
{
    protected string $viewPath;
    protected string $template;
    private Database $database;

    protected function render(string $view, array $variables = []): void
    {
        ob_start(); // Start buffering the output
        extract($variables); // Convert array to variables
        require($this->viewPath . $view . '.html.php');
        $content = ob_get_clean(); // Store the output in a variable
        require($this->viewPath . $this->template . '.html.php');
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

// redirige vers une autre page
    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }
}