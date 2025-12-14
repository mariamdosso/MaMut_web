<?php
require_once __DIR__ . '/../config/db.php';

class Adherent
{
    public static function getPaginated(int $page = 1, int $perPage = 6)
    {
        global $pdo;

        $offset = ($page - 1) * $perPage;

        $totalStmt = $pdo->query("SELECT COUNT(*) FROM adherent");
        $totalAdherents = $totalStmt->fetchColumn();
        $totalPages = ceil($totalAdherents / $perPage);

        $sql = "
            SELECT 
                a.id AS adherent_id,
                a.full_name,
                a.birth_date,
                a.gender,
                a.city,
                a.date_of_joining,
                a.email,
                a.created_by,
                a.call_number,
                a.municipality_department,
                a.address,
                u.id AS user_id,
                u.login AS created_by_login,
                ua.status AS user_status,
                ua.id AS has_account_id
            FROM adherent a
            LEFT JOIN user u ON u.id = a.created_by
            LEFT JOIN user ua ON ua.adherent_id = a.id 
            ORDER BY a.id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $adherents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'data' => $adherents,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'perPage' => $perPage,
            'total' => $totalAdherents
        ];
    }

    public static function getById($id)
    {
        global $pdo;

        $sql = "
        SELECT 
            a.id AS adherent_id,
            a.full_name,
            a.birth_date,
            a.gender,
            a.city,
            a.date_of_joining,
            a.email,
            a.created_by,
            a.call_number,
            a.municipality_department,
            a.address,
            u.login AS created_by_login
        FROM adherent a
        LEFT JOIN user u ON u.id = a.created_by
        WHERE a.id = :id
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data)
    {
        global $pdo;

        $sql = "UPDATE adherent 
            SET full_name = :full_name, 
                email = :email, 
                birth_date = :birth_date, 
                date_of_joining = :date_of_joining, 
                gender = :gender, 
                city = :city, 
                municipality_department = :municipality_department, 
                call_number = :call_number, 
                address = :address
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':birth_date' => $data['birth_date'],
            ':date_of_joining' => $data['date_of_joining'],
            ':gender' => $data['gender'],
            ':city' => $data['city'],
            ':municipality_department' => $data['municipality_department'],
            ':call_number' => $data['call_number'],
            ':address' => $data['address'],
            ':id' => $id
        ]);
    }

    public static function parseDate($input)
    {
        $d = DateTime::createFromFormat('Y-m-d', $input);
        if ($d !== false) return $d;

        $d = DateTime::createFromFormat('d/m/Y', $input);
        if ($d !== false) return $d;

        return false;
    }

    public static function emailExists(string $email): bool
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM adherent WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->rowCount() > 0;
    }

    public static function add(array $data)
    {
        global $pdo;

        $birthday = self::parseDate($data['birth_date']);
        $date_adhesion = self::parseDate($data['date_of_joining']);

        if (!$birthday || !$date_adhesion) {
            return ['success' => false, 'message' => "Format de date invalide (jj/mm/aaaa ou yyyy-mm-dd)."];
        }

        $birthday = $birthday->format('Y-m-d');
        $date_adhesion = $date_adhesion->format('Y-m-d');

        if (self::emailExists($data['email'])) {
            return ['success' => false, 'message' => "Cet email est déjà utilisé !"];
        }

        $sql = "INSERT INTO adherent (
            full_name, birth_date, date_of_joining, gender, city, municipality_department,
            call_number, email, address, created_by
        ) VALUES (
            :full_name, :birth_date, :date_of_joining, :gender, :city, :municipality_department,
            :call_number, :email, :address, :created_by
        )";

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':full_name' => htmlspecialchars($data['full_name']),
            ':birth_date' => $birthday,
            ':date_of_joining' => $date_adhesion,
            ':gender' => htmlspecialchars($data['gender']),
            ':city' => htmlspecialchars($data['city']),
            ':municipality_department' => htmlspecialchars($data['municipality_department']),
            ':call_number' => htmlspecialchars($data['call_number']),
            ':email' => htmlspecialchars($data['email']),
            ':address' => htmlspecialchars($data['address']),
            ':created_by' => intval($data['created_by'])
        ]);

        if ($result) {
            return ['success' => true, 'message' => "Membre ajouté avec succès !"];
        } else {
            return ['success' => false, 'message' => "Erreur lors de l'ajout du membre."];
        }
    }
}
