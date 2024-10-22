<?php
namespace Models;

class Database {
    private static $pdo;

    public static function connect() {
        if (!isset(self::$pdo)) {
            try {
                $host = 'localhost';  // Endereço do banco de dados
                $dbname = 'repros';  // Nome do banco de dados
                $user = 'root';  // Usuário do banco de dados
                $password = '';  // Senha do banco de dados

                // DSN para o MySQL
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

                // Opções adicionais
                $options = [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ];

                // Cria a conexão com PDO
                self::$pdo = new \PDO($dsn, $user, $password, $options);

            } catch (\PDOException $e) {
                die("Erro ao conectar com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>