<?php

class UserContribution
{

    /**
     * Vérifier si un utilisateur est déjà inscrit à l'événement
     */
    public static function exists(int $userId, int $eventId): bool
    {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM user_contributions
            WHERE user_id = :user_id AND event_id = :event_id
        ");

        $stmt->execute([
            ':user_id' => $userId,
            ':event_id' => $eventId
        ]);

        return $stmt->fetchColumn() > 0;
    }


    /**
     * Ajouter un adhérent à un événement
     */
    public static function create(array $data): bool
    {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO user_contributions (
                user_id,
                event_cotisation_id,
                event_id,
                amount_due,
                amount_paid,
                remaining_amount,
                participation_date,
                created_at,
                updated_at
            ) VALUES (
                :user_id,
                :event_cotisation_id,
                :event_id,
                :amount_due,
                0,
                :remaining_amount,
                :participation_date,
                NOW(),
                NOW()
            )
        ");

        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':event_cotisation_id' => $data['event_cotisation_id'],
            ':event_id' => $data['event_id'],
            ':amount_due' => $data['amount_due'],
            ':remaining_amount' => $data['amount_due'],
            ':participation_date' => date('Y-m-d'),
        ]);
    }


    /**
     * Liste des adhérents d’un événement
     */
    public static function getByEvent(int $eventId, int $page = 1, int $perPage = 6): array
    {
        global $pdo;

        $offset = ($page - 1) * $perPage;

        $sql = "
            SELECT 
                uc.*,
                a.full_name AS user_name,
                a.email AS user_email,
                a.call_number AS user_phone,
                a.city AS user_city,
                a.gender AS user_gender,
                a.address AS user_address
            FROM user_contributions uc
            JOIN user u ON u.id = uc.user_id
            JOIN adherent a ON u.adherent_id = a.id
            WHERE uc.event_id = :event_id
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $pdo->prepare($sql);

        // ✅ Les noms correspondent EXACTEMENT à la requête SQL
        $stmt->bindValue(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 🔢 Total pour pagination
        $countStmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM user_contributions 
            WHERE event_id = :event_id
        ");
        $countStmt->execute([':event_id' => $eventId]);
        $total = (int) $countStmt->fetchColumn();

        return [
            "data" => $data,
            "total" => $total,
            "page" => $page,
            "perPage" => $perPage,
            "totalPages" => ceil($total / $perPage)
        ];
    }

    /**
     * Récupérer une participation par ID
     */
   public static function findById(int $id): ?array
    {
        global $pdo;

        $sql = "
            SELECT 
                uc.*,
                a.full_name AS user_name,
                a.email AS user_email,
                a.call_number AS user_phone,
                a.city AS user_city,
                a.gender AS user_gender,
                a.address AS user_address
            FROM user_contributions uc
            JOIN user u ON u.id = uc.user_id
            JOIN adherent a ON u.adherent_id = a.id
            WHERE uc.id = :id
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ?: null;
    }

    /**
     * Mettre à jour une participation
     */
    public static function update(int $id, int $amountDue, int $amountPaid): bool
    {
        global $pdo;

        // Sécurité métier
        if ($amountPaid > $amountDue) {
            throw new InvalidArgumentException("Le montant payé ne peut pas dépasser le montant dû.");
        }

        $remainingAmount = $amountDue - $amountPaid;

        $stmt = $pdo->prepare("
            UPDATE user_contributions
            SET 
                amount_due = :amount_due,
                amount_paid = :amount_paid,
                remaining_amount = :remaining_amount,
                updated_at = NOW()
            WHERE id = :id
        ");

        return $stmt->execute([
            ':amount_due' => $amountDue,
            ':amount_paid' => $amountPaid,
            ':remaining_amount' => $remainingAmount,
            ':id' => $id
        ]);
    }

    /**
         * Supprimer une participation
     */
    public static function delete(int $id): bool
    {
        global $pdo;

        // Vérifier s'il y a déjà un paiement
        $stmt = $pdo->prepare("
            SELECT amount_paid
            FROM user_contributions
            WHERE id = :id
        ");
        $stmt->execute([':id' => $id]);
        $amountPaid = (int) $stmt->fetchColumn();

        if ($amountPaid > 0) {
            throw new RuntimeException("Impossible de supprimer : un paiement existe déjà.");
        }

        $deleteStmt = $pdo->prepare("
            DELETE FROM user_contributions
            WHERE id = :id
        ");

        return $deleteStmt->execute([':id' => $id]);
    }

    
}