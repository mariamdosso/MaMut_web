<?php

require_once __DIR__ . '/../Models/Participant.php';

class ParticipantController
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

    // Supprimer un participant d'un événement
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

    // Detail d'un participant sur un évenement
    public function showParticipantDetails()
    {
        if (!isset($_GET['id'])) {
            die("Aucun participant sélectionné.");
        }

        $id = intval($_GET['id']);

        // On demande au modèle d’aller chercher le user_event + user + adherent + event
        $details = Participant::getDetails($id);

        if (!$details) {
            die("Détails introuvables.");
        }

        // Appeler la vue
        require __DIR__ . '/../views/details_user_event.php';
    }
}
