<?php
class DatabaseConnection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $servername = getenv('DB_HOST');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function checkForSymbolicLinks() {
        $directory = new RecursiveDirectoryIterator(__DIR__);
        foreach (new RecursiveIteratorIterator($directory) as $file) {
            if (is_link($file)) {
                echo "Symbolic link found: " . $file . "\n";
            }
        }
    }

    public function checkForDeepDirectories($maxDepth = 10) {
        $directory = new RecursiveDirectoryIterator(__DIR__);
        foreach (new RecursiveIteratorIterator($directory) as $file) {
            $depth = substr_count($file->getPathname(), DIRECTORY_SEPARATOR);
            if ($depth > $maxDepth) {
                echo "Deep directory found: " . $file->getPathname() . "\n";
            }
        }
    }
}
?>
