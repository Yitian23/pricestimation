<?php
class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            // Get all MySQL connection details from environment
            $host = getenv('MYSQLHOST') ?: 'mysql.railway.internal';
            $port = getenv('MYSQLPORT') ?: '3306';
            $database = getenv('MYSQLDATABASE') ?: 'real_estate_management';
            $username = getenv('MYSQLUSER') ?: 'root';
            $password = getenv('MYSQLPASSWORD') ?: 'kMoDqjGAhbHCuRXrkOQcTQizechnbzlI';

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO($dsn, $username, $password, $options);
            
        } catch(PDOException $exception) {
            error_log("Database connection error: " . $exception->getMessage());
            throw new Exception("Database connection failed");
        }
        
        return $this->conn;
    }
}
?>
