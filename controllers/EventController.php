<?php

require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/Participant.php';
require_once __DIR__ . '/../Models/User.php';


class EventController
{
    public function showEvent($eventId)
    {
        $event = Event::getById($eventId);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $result = Participant::getByEvent($eventId, $page);

        $participants = $result['data'];
        $totalPages = $result['totalPages'];
        $total = $result['total'];
        $perPage = $result['perPage'];

        $allUsers = User::allUsers();

        require __DIR__ . '/../views/event_details.php';
    }

    public function deleteParticipant()
    {
        if (!isset($_POST['participant_id'])) {
            die("Aucun participant sélectionné.");
        }

        $id = intval($_POST['participant_id']);
        Participant::delete($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function getAllEvent()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $result = Event::allEvent($page);

        $events = $result['data'];
        $totalPages = $result['totalPages'];
        $total = $result['total'];
        $perPage = $result['perPage'];

        require __DIR__ . '/../views/event_list.php';
    }

    public function handleShowEvent()
    {
        // Récupérer ID depuis URL si aucun paramètre n’est passé
        $eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($eventId <= 0) {
            echo "ID invalide";
            exit;
        }

        // Appeler automatiquement showEvent()
        $this->showEvent($eventId);
    }

    // Affiche le formulaire pour ajouter un événement
    public function showAddEventForm()
    {
        require __DIR__ . '/../views/add_event.php';
    }

    // Traite le formulaire d'ajout
    public function addEvent()
    {
        if (!isset($_SESSION['user_info']['id'])) {
            $_SESSION['errorMessage'] = "Vous devez être connecté pour ajouter un événement.";
            header('Location: /MaMut_web/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !empty($_POST['label']) &&
                !empty($_POST['event_type_id']) &&
                !empty($_POST['event_start_date']) &&
                !empty($_POST['event_end_date']) &&
                isset($_POST['with_participation']) &&
                isset($_POST['event_amount']) &&
                isset($_POST['event_target_participation'])
            ) {
                $success = Event::create($_POST);

                if ($success) {
                    $_SESSION['message'] = "Événement ajouté avec succès !";
                    header('Location: /MaMut_web/event_list');
                    exit;
                } else {
                    $error = "Erreur lors de l'ajout de l'événement.";
                    require __DIR__ . '/../views/add_event.php';
                }
            } else {
                $error = "Veuillez remplir tous les champs obligatoires.";
                require __DIR__ . '/../views/add_event.php';
            }
        } else {
            $this->showAddEventForm();
        }
    }

    // Afficher le formulaire pour éditer un évenement 
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

        require __DIR__ . '/../views/edit_event.php';
    }

    // Traite le formulaire de mise à jour
    public function updateEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Méthode non autorisée.");
        }

        $eventId = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($eventId <= 0) {
            die("ID de l'événement manquant ou invalide");
        }

        $requiredFields = ['label', 'event_amount', 'event_target_participation', 'event_start_date', 'event_end_date', 'with_participation', 'event_type_id'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || $_POST[$field] === '') {
                die("Le champ '$field' est requis.");
            }
        }

        $success = Event::update($eventId, $_POST);

        if ($success) {
            $_SESSION['message'] = "Événement mis à jour avec succès !";
            header('Location: /MaMut_web/event_list');
            exit;
        } else {
            die("Erreur lors de la mise à jour de l'événement.");
        }
    }
}
