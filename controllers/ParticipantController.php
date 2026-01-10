<?php

require_once __DIR__ . '/../Models/Participant.php';

class ParticipantController
{
    public function index()
    {
        $participants = Participant::all();
    }

    public function getParticipants($eventId)
    {
        $participants = Participant::getByEvent($eventId);
    }

    public function addParticipant()
    {
        if (!isset($_POST['event_id']) || !isset($_POST['user_id'])) {
            die("Requête invalide.");
        }

        $eventId = intval($_POST['event_id']);
        $userId  = intval($_POST['user_id']);

        $result = Participant::addToEvent($eventId, $userId);

        if (!$result) {
            echo "Cet utilisateur est déjà ajouté à cet événement.";
        }

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function deleteParticipant()
    {
        if (!isset($_POST['participant_id']) || !isset($_POST['event_id'])) {
            die("Requête invalide.");
        }

        $participantId = intval($_POST['participant_id']);
        $eventId = intval($_POST['event_id']);

        Participant::delete($participantId);

        header("Location: /MaMut_web/event_details?id=" . $eventId);
        exit;
    }

    public function showParticipantDetails()
    {
        if (!isset($_GET['id'])) {
            die("Aucun participant sélectionné.");
        }

        $id = intval($_GET['id']);
        $details = Participant::getDetails($id);

        if (!$details) {
            die("Détails introuvables.");
        }

        ob_start();
        require __DIR__ . '/../views/events/details_user_event.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }
}
