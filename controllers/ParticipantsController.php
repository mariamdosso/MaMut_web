<?php

require_once __DIR__ . '/../Models/Participant.php';

class ParticipantsController
{
    // Tous les participants
    public function index()
    {
        $participants = Participant::all();
    }

    // Participants d'un événement spécifique
    public function getParticipants($eventId)
    {
        $participants = Participant::getByEvent($eventId);
    }


    // Ajouter un participant à un événement
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
}
