<?php
class Database {
    private static $host = 'localhost';
    private static $db_name = 'mvc'; // ชื่อฐานข้อมูล
    private static $username = 'root';
    private static $password = '';
    public static $conn;

    public static function connect() {
        self::$conn = null;
        try {
            self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->exec("set names utf8mb4"); // รองรับภาษาไทยสมบูรณ์
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return self::$conn;
    }
}
?>