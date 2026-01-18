<?php
require_once __DIR__ . '/../Models/EventType.php';

class EventTypeController
{
    // Affiche la liste des types
    public function index()
    {
        $perPage = 9;
        $page = isset($_GET['page']) && $_GET['page'] > 0
        ? (int) $_GET['page'] : 1;

        $offset = ($page - 1) * $perPage;

        $types = EventType::getAllPaginated($perPage, $offset);
        $totalTypes = EventType::countAll();
        $totalPages = ceil($totalTypes / $perPage);
        
        ob_start();
        require __DIR__ . '/../views/configs/type_event/type_event_list.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    // Création d'un type
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /MaMut_web/event_types');
            exit;
        }

        $label = trim($_POST['label'] ?? '');

        if (empty($label)) {
            $_SESSION['error'] = 'Le libellé est obligatoire';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        EventType::create($label);

        $_SESSION['success'] = 'Type d’événement ajouté avec succès';
        header('Location: /MaMut_web/event_type_list');
        exit;
    }

    // Mise à jour d'un type (modifie seulement le label)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $label = trim($_POST['label'] ?? '');

        if ($id <= 0) {
            $_SESSION['error'] = 'Identifiant invalide';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        if (empty($label)) {
            $_SESSION['error'] = 'Le libellé est obligatoire';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        // Vérifie que le type existe
        $eventType = EventType::getById($id);
        if (!$eventType) {
            $_SESSION['error'] = 'Type d’événement introuvable';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        // Mise à jour (label uniquement)
        EventType::update(
            $id,
            $label,
            $eventType['code'],
            $eventType['status']
        );

        $_SESSION['success'] = 'Type d’événement modifié avec succès';
        header('Location: /MaMut_web/event_type_list');
        exit;
    }

   // Désactiver un type d'événement
    public function deactivate()
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'Identifiant invalide';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        $eventType = EventType::getById($id);
        if (!$eventType) {
            $_SESSION['error'] = 'Type d’événement introuvable';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        EventType::deactivate($id);

        $_SESSION['success'] = 'Type d’événement désactivé avec succès';
        header('Location: /MaMut_web/event_type_list');
        exit;
    }

    // Activer un type d'événement
   public function activate()
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'Identifiant invalide';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        $eventType = EventType::getById($id);
        if (!$eventType) {
            $_SESSION['error'] = 'Type d’événement introuvable';
            header('Location: /MaMut_web/event_type_list');
            exit;
        }

        EventType::activate($id);

        $_SESSION['success'] = 'Type d’événement activé avec succès';
        header('Location: /MaMut_web/event_type_list');
        exit;
    }


}