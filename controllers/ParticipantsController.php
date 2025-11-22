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
    
}
