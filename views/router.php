<?php
$path = rtrim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
if ($path === '/MaMut_web/logout') {
    require_once __DIR__ . "/../controllers/UserController.php";
    (new UserController())->logout();
    exit;
}

if (strpos($path, '/MaMut_web/controllers/') === 0) {
    http_response_code(403);
    exit('Accès interdit');
}

switch ($path) {
    case '/MaMut_web/home':
        require_once __DIR__ . "/../controllers/DashboardController.php";
        (new DashboardController())->index();
        break;

    case '/MaMut_web/update_account':
        require_once __DIR__ . "/../controllers/UserController.php";
        (new UserController())->showEditAccount();
        break;

    case '/MaMut_web/info_user':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showProfile();
        break;

    case '/MaMut_web/add_event':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->showAddEventForm();
        break;

    case '/MaMut_web/add_event_controller':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->addEvent();
        break;

    case '/MaMut_web/event_list':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->getAllEvent();
        break;

    case '/MaMut_web/edit_event':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->showEditEventForm();
        break;

    case '/MaMut_web/edit_event_controller':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->updateEvent();
        break;

    case '/MaMut_web/event_details':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->handleShowEvent();
        break;

    case '/MaMut_web/add_participant':
        require_once __DIR__ . "/../controllers/ParticipantController.php";
        (new ParticipantController())->addParticipant();
        break;

    case '/MaMut_web/delete_participant':
        require_once __DIR__ . "/../controllers/ParticipantController.php";
        (new ParticipantController())->deleteParticipant();
        break;

    case '/MaMut_web/details_user_event':
        require_once __DIR__ . "/../controllers/ParticipantController.php";
        (new ParticipantController())->showParticipantDetails();
        break;

    case '/MaMut_web/create_user_adherent_account':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showCreateUserForm();
        break;

    case '/MaMut_web/store_user_account':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->storeUserAccount();
        break;

    case '/MaMut_web/update_adherent':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showEditForm();
        break;

    case '/MaMut_web/update_adherent_controller':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->updateAdherent();
        break;

    case '/MaMut_web/details_adherent':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->detailsAdherent();
        break;

    case '/MaMut_web/toggle_status':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->toggleUserStatus();
        break;

    case '/MaMut_web/member_list':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->list();
        break;

    case '/MaMut_web/add_member':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showAddForm();
        break;

    case '/MaMut_web/add_member_controller':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->addAdherent();
        break;

    case '/MaMut_web/fund':
        require_once __DIR__ . "/../controllers/CashController.php";
        (new CashController())->showCashList();
        break;

    case '/MaMut_web/add_fund':
        require_once __DIR__ . "/../controllers/CashController.php";
        (new CashController())->showCashForm();
        break;

    default:
        require_once __DIR__ . "/../controllers/DashboardController.php";
        (new DashboardController())->index();
        break;
}
