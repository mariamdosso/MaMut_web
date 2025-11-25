<?php
require_once __DIR__ . '/../controllers/EventController.php';
require_once __DIR__ . '/../controllers/ParticipantsController.php';

$eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($eventId <= 0) {
    echo "ID invalide";
    exit;
}

$controller = new EventController();
$controller->showEvent($eventId);