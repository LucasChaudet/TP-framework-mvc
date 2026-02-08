<?php

namespace IIA;

class Autoloader
{
    /** @var string[] $paths */
    private static array $paths = [];

    /**
     * Require the file for the specific class
     * @param string $class Class name
     */
    private static function autoload(string $class): void
    {
        $parts = explode("\\", $class);
        $filepath = __DIR__ . "/../" . implode(DIRECTORY_SEPARATOR, $parts) . ".php";

        if (!file_exists($filepath)) {
            array_shift($parts);
            foreach (self::$paths as $namespace => $path) {
                $filepath = $path . "/" . implode(DIRECTORY_SEPARATOR, $parts) . ".php";
                if (file_exists($filepath)) {
                    break;
                }
            }
        }

        require_once $filepath;
    }

    /**
     * Register class autoloader
     */
    public static function register(): void
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function addPath(string $namespace, string $path): void
    {
        self::$paths[$namespace] = $path;
    }
}