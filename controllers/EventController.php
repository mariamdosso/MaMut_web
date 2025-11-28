<?php

require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/Participant.php';
require_once __DIR__ . '/../Models/User.php';


class EventController
{
    public function showEvent($eventId)
    {
        $event = Event::getById($eventId);

        // Récupérer les participants de cet événement
        $participants = Participant::getByEvent($eventId);

        // Charger tous les utilisateurs
        $allUsers = User::allUsers();

         // Envoyer les données à la vue
        require __DIR__ . '/../views/event_details.php';
    }
}

