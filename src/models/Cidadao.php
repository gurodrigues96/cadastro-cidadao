<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Cidadao {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cpfExiste(string $cpf): bool {
        $stmt =$this->db->prepare("SELECT COUNT(*) FROM cidadaos WHERE cpf = :cpf");
        $stmt->execute([':cpf' =>$cpf]);
        return $stmt->fetchColumn() > 0;
    }

    public function salvar(string $nome, string$cpf): bool {
        try {
            $stmt =$this->db->prepare("INSERT INTO cidadaos (nome, cpf) VALUES (:nome, :cpf)");
            return $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function buscar(string $termo): array {
        $stmt =$this->db->prepare("SELECT nome, cpf FROM cidadaos WHERE cpf = :termo OR nome LIKE :nomeLike");
        $stmt->execute([
            ':termo' => $termo,
            ':nomeLike' => '%' . $termo . '%'
        ]);
        return $stmt->fetchAll();
    }
}