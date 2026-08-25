<?php
class Conexion{
    private $conect;
    public function __construct()
    {
        $pdo = "mysql:host=".HOST.";dbname=".DB.";".CHARSET;
        try {
            $this->conect = new PDO($pdo, USER, PASS);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Error de conexion a la base de datos: " . $e->getMessage());
            http_response_code(500);
            die("No se pudo conectar con el servidor. Intenta mas tarde.");
        }
    }
    public function conect()
    {
        return $this->conect;
    }
}
 
?>