<?php

class Validator
{
    public static function validateProjectStructure()
    {
        $required = [
            ".env",
            "composer.json",
            "composer.lock",
            "public/",
            "src/",
            "SQLDatabase/",
            "startup.sh"
        ];

        foreach ($required as $item) {
            if (!file_exists($item)) {
                echo "MISSING REQUIRED FILE/DIR: $item\n";
                exit(1);
            }
        }

        echo "All required files/directories present\n";
        exit(0);
    }
}
?>
