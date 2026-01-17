<?php
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/EventType.php';
require_once __DIR__ . '/../Models/Fund.php';
require_once __DIR__ . '/../Models/EventCotisations.php';
require_once __DIR__ . '/../Models/UserContribution.php';

class EventController
{
    public function showEvent($eventId)
    {
        $event = Event::getById($eventId);
        
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $result = UserContribution::getByEvent($eventId, $page);
        $participants = $result['data'];
        $totalPages = $result['totalPages'];
        $total = $result['total'];
        $perPage = $result['perPage'];

        $eventFund = EventCotisations::getByEvent($eventId);
        $attachableFunds = Fund::getAttachableFunds();

        $allUsers = User::allUsers();

        ob_start();
        require __DIR__ . '/../views/events/event_details.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function getAllEvent()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $result = Event::allEvent($page);

        $events = $result['data'];
        $totalPages = $result['totalPages'];
        $total = $result['total'];
        $perPage = $result['perPage'];

        ob_start();
        require __DIR__ . '/../views/events/event_list.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function handleShowEvent()
    {

        $eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($eventId <= 0) {
            echo "ID invalide";
            exit;
        }

        $this->showEvent($eventId);
    }

    public function showAddEventForm()
    {
        $types = EventType::getAllActive();
        
        ob_start();
        require __DIR__ . '/../views/events/add_event.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function addEvent()
    {
        if (!isset($_SESSION['user_info']['id'])) {
            $_SESSION['errorMessage'] = "Vous devez être connecté pour ajouter un événement.";
            header('Location: /MaMut_web/login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !empty($_POST['label']) &&
                !empty($_POST['event_type_id']) &&
                !empty($_POST['event_start_date']) &&
                !empty($_POST['event_end_date']) &&
                isset($_POST['with_participation'])
            ) {
                 $eventAmount = null;
                    $eventTarget = null;
                    $contributionType = null;

                    if ($_POST['with_participation'] == 1) {
                        if (empty($_POST['contribution_type'])) {
                            $error = "Veuillez sélectionner le type de contribution.";
                            require __DIR__ . '/../views/events/add_event.php';
                            exit;
                        }

                        $contributionType = $_POST['contribution_type'];

                        if ($contributionType === 'global') {
                            if (empty($_POST['event_amount'])) {
                                $error = "Veuillez saisir le montant global.";
                                require __DIR__ . '/../views/events/add_event.php';
                                exit;
                            }
                            $eventAmount = floatval($_POST['event_amount']);
                        }

                        if ($contributionType === 'per_person') {
                            if (empty($_POST['event_target_participation'])) {
                                $error = "Veuillez saisir le montant par participant.";
                                require __DIR__ . '/../views/events/add_event.php';
                                exit;
                            }
                            $eventTarget = floatval($_POST['event_target_participation']);
                        }
                    }

                    $_POST['event_amount'] = $eventAmount;
                    $_POST['event_target_participation'] = $eventTarget;
                    $_POST['contribution_type'] = $contributionType;

                    $success = Event::create($_POST);

                if ($success) {
                    $_SESSION['message'] = "Événement ajouté avec succès !";
                    header('Location: /MaMut_web/event_list');
                    exit;
                } else {
                    $error = "Erreur lors de l'ajout de l'événement.";
                    require __DIR__ . '/../views/events/add_event.php';
                }
            } else {
                $error = "Veuillez remplir tous les champs obligatoires.";
                require __DIR__ . '/../views/events/add_event.php';
            }
        } else {
            $this->showAddEventForm();
        }
    }

    public function showEditEventForm()
    {
        $eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($eventId <= 0) {
            die("ID invalide.");
        }

        $event = Event::getById($eventId);
        if (!$event) {
            die("Événement introuvable.");
        }
       $types = EventType::getAllActive();

        ob_start();
        require __DIR__ . '/../views/events/edit_event.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function updateEvent()
    {
        if (!isset($_SESSION['user_info']['id'])) {
            $_SESSION['errorMessage'] = "Vous devez être connecté pour modifier un événement.";
            header('Location: /MaMut_web/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Méthode non autorisée.");
        }

        $eventId = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($eventId <= 0) {
            die("ID de l'événement manquant ou invalide.");
        }

        
        $requiredBaseFields = [
            'label',
            'event_start_date',
            'event_end_date',
            'with_participation',
            'event_type_id'
        ];

        foreach ($requiredBaseFields as $field) {
            if (!isset($_POST[$field]) || $_POST[$field] === '') {
                die("Le champ '$field' est requis.");
            }
        }

        $eventAmount = null;
        $eventTarget = null;
        $contributionType = null;

        if ($_POST['with_participation'] == 1) {

            if (empty($_POST['contribution_type'])) {
                die("Le type de contribution est requis.");
            }

            $contributionType = $_POST['contribution_type'];

            if ($contributionType === 'global') {
                if (empty($_POST['event_amount'])) {
                    die("Le montant global est requis.");
                }
                $eventAmount = floatval($_POST['event_amount']);
            }

            if ($contributionType === 'per_person') {
                if (empty($_POST['event_target_participation'])) {
                    die("Le montant par participant est requis.");
                }
                $eventTarget = floatval($_POST['event_target_participation']);
            }
        }
        
        $_POST['event_amount'] = $eventAmount;
        $_POST['event_target_participation'] = $eventTarget;
        $_POST['contribution_type'] = $contributionType;

        $success = Event::update($eventId, $_POST);

        if ($success) {
            $_SESSION['message'] = "Événement mis à jour avec succès !";
            header('Location: /MaMut_web/event_list');
            exit;
        } else {
            die("Erreur lors de la mise à jour de l'événement.");
        }
    }

    public function attachFund()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Méthode non autorisée');
        }

        $eventId = intval($_POST['event_id'] ?? 0);
        $fundId  = intval($_POST['fund_id'] ?? 0);

        if ($eventId <= 0 || $fundId <= 0) {
            $_SESSION['errorMessage'] = "Données invalides.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Vérifier que l'event accepte les participations
        $event = Event::getById($eventId);
        if (!$event || !$event['with_participation']) {
            $_SESSION['errorMessage'] = "Cet événement n'accepte pas de caisse.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $success = EventCotisations::attachFund($eventId, $fundId);

        if ($success) {
            $_SESSION['message'] = "Caisse ajoutée avec succès à l'événement.";
        } else {
            $_SESSION['errorMessage'] = "Une caisse est déjà associée à cet événement.";
        }

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function addParticipant()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Méthode non autorisée');
        }

        $eventId = (int)($_POST['event_id'] ?? 0);
        $userId  = (int)($_POST['user_id'] ?? 0);

        if ($eventId <= 0 || $userId <= 0) {
            $_SESSION['errorMessage'] = "Données invalides.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $event = Event::getById($eventId);
        $eventFund = EventCotisations::getByEvent($eventId);

        if (!$event || !$eventFund) {
            $_SESSION['errorMessage'] = "Événement ou caisse introuvable.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // Empêcher les doublons
        if (UserContribution::exists($userId, $eventId)) {
            $_SESSION['errorMessage'] = "Cet adhérent est déjà inscrit.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // 💡 LOGIQUE MÉTIER
        if ($event['contribution_type'] === 'global') {
            $amountDue = (int)$event['event_amount'];
        } else {
            $amountDue = (int)($_POST['amount_due'] ?? 0);
            if ($amountDue <= 0) {
                $_SESSION['errorMessage'] = "Veuillez saisir un montant valide.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $success = UserContribution::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'event_cotisation_id' => $eventFund['id'],
            'amount_due' => $amountDue,
        ]);

        $_SESSION[$success ? 'message' : 'errorMessage'] =
            $success ? "Adhérent ajouté avec succès." : "Erreur lors de l’ajout.";

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function updateParticipant()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Méthode non autorisée.");
        }

        $id = (int) ($_POST['id'] ?? 0);
        $eventId = (int) ($_POST['event_id'] ?? 0);
        $amountDue = (int) ($_POST['amount_due'] ?? 0);
        $amountPaid = (int) ($_POST['amount_paid'] ?? 0);

        if ($id <= 0 || $eventId <= 0) {
            $_SESSION['errorMessage'] = "Données invalides.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        try {
            UserContribution::update($id, $amountDue, $amountPaid);
            $_SESSION['message'] = "Participation mise à jour avec succès.";
        } catch (InvalidArgumentException $e) {
            $_SESSION['errorMessage'] = $e->getMessage();
        }

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function deleteParticipant()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Méthode non autorisée.");
        }

        $participantId = (int) ($_POST['participant_id'] ?? 0);
        $eventId = (int) ($_POST['event_id'] ?? 0);

        if ($participantId <= 0 || $eventId <= 0) {
            $_SESSION['errorMessage'] = "Données invalides.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        try {
            UserContribution::delete($participantId);
            $_SESSION['message'] = "Participant supprimé avec succès.";
        } catch (RuntimeException $e) {
            $_SESSION['errorMessage'] = $e->getMessage();
        }

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function showEditParticipant()
    {
       $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            die("ID invalide.");
        }

        // 🔎 Récupération de la participation
        $contribution = UserContribution::findById($id);

        if (!$contribution) {
            die("Participant introuvable.");
        }

        // 🔎 Récupération de l'événement lié
        $eventId = (int) $contribution['event_id'];
        $event = Event::getById($eventId);

        if (!$event) {
            die("Événement introuvable.");
        }

        // 🔎 Récupération de la liste des utilisateurs
        $allUsers = User::allUsers();

        
        ob_start();
        require __DIR__ . '/../views/events/edit_user_contribution.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

}
