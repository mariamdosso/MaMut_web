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

        // Retour à la page précédente
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
