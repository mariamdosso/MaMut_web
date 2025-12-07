<?php
require_once __DIR__ . '/../config/db.php';

class User
{
    public static function allUsers()
    {
        global $pdo;

        $stmt = $pdo->query("
            SELECT 
                u.id,
                a.full_name,
                a.email,
                a.call_number,
                a.city,
                a.gender,
                a.address
            FROM user u
            JOIN adherent a ON u.adherent_id = a.id
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function toggleStatus(int $id, string $status): bool
    {
        global $pdo;

        $newStatus = $status === 'active' ? 'active' : 'inactive';

        $stmt = $pdo->prepare("UPDATE user SET status = :status WHERE id = :id");
        return $stmt->execute([
            ':status' => $newStatus,
            ':id' => $id
        ]);
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();
    }

     public static function createAccount(array $data)
    {
        global $pdo;

        $adherent_id = intval($data['adherent_id']);
        $login = trim($data['login']);
        $password = trim($data['password']);
        $confirm_password = trim($data['confirm_password']);
        $roles = $data['roles'] ?? [];

        if (empty($login) || empty($password) || empty($roles)) {
            return ['success' => false, 'message' => "Tous les champs sont obligatoires."];
        }

        if ($password !== $confirm_password) {
            return ['success' => false, 'message' => "Les mots de passe ne correspondent pas."];
        }

        $stmt = $pdo->prepare("SELECT id FROM user WHERE adherent_id = ?");
        $stmt->execute([$adherent_id]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => "Un compte existe déjà pour cet adhérent."];
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO user (login, password, status, adherent_id)
                                   VALUES (?, ?, ?, ?)");
            $stmt->execute([$login, $hashed, "active", $adherent_id]);
            $user_id = $pdo->lastInsertId();

            foreach ($roles as $role_id) {
                $sql = "INSERT INTO user_role (user_id, role_id, status)
                        VALUES (?, ?, 'active')";
                $pdo->prepare($sql)->execute([$user_id, $role_id]);
            }

            $pdo->commit();

            return ['success' => true, 'message' => "Compte créé avec succès !"];

        } catch (PDOException $e) {
            $pdo->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
