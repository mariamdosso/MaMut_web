<?php
require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/Participant.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/EventType.php';


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

        ob_start();
        require __DIR__ . '/../views/events/event_details.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
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

}
