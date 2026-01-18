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

    // General routes for all user
    case '/MaMut_web/home':
        require_once __DIR__ . "/../controllers/DashboardController.php";
        (new DashboardController())->index();
        break;

    case '/MaMut_web/update_account':
        require_once __DIR__ . "/../controllers/UserController.php";
        (new UserController())->showEditAccount();
        break;

    
        
    // Management Event routes    
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

    case '/MaMut_web/event/attach_fund':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->attachFund();
        break;


    case '/MaMut_web/event/add_participant':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->addParticipant();
        break;

    
    case '/MaMut_web/event/show_edit_participant_form':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->showEditParticipant();
        break;

    
    case '/MaMut_web/event/edit_participant':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->updateParticipant();
        break;


    case '/MaMut_web/event/participant/delete':
        require_once __DIR__ . "/../controllers/EventController.php";
        (new EventController())->deleteParticipant();
        break;



    // Management Adherent routes   
    case '/MaMut_web/create_user_adherent_account':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showCreateUserForm();
        break;

    case '/MaMut_web/info_user':
        require_once __DIR__ . "/../controllers/AdherentController.php";
        (new AdherentController())->showProfile();
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


    // Management Fund routes  
    case '/MaMut_web/fund_list':
    require_once __DIR__ . "/../controllers/FundController.php";
    (new FundController())->showAllFunds();
    break;

    case '/MaMut_web/add_fund':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->showCreateFundForm();
        break;

    case '/MaMut_web/add_fund_controller':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->createFund();
        break;

    case '/MaMut_web/edit_fund':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->showEditFundForm();
        break;

    case '/MaMut_web/edit_fund_controller':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->updateFund();
        break;

    case '/MaMut_web/change_fund_status':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->changeFundStatus();
        break;

    case '/MaMut_web/fund_details':
        require_once __DIR__ . "/../controllers/FundController.php";
        (new FundController())->viewFund($_GET['id'] ?? 0);
        break;
    


    // Management Event Type routes
    case '/MaMut_web/event_type_list':
        require_once __DIR__ . "/../controllers/EventTypeController.php";
        (new EventTypeController())->index();
        break;

    case '/MaMut_web/store_event_type':
        require_once __DIR__ . "/../controllers/EventTypeController.php";
        (new EventTypeController())->store();
        break;

    case '/MaMut_web/update_event_type':
        require_once __DIR__ . "/../controllers/EventTypeController.php";
        (new EventTypeController())->update($_POST['id'] ?? 0, $_POST);
        break;

    case '/MaMut_web/activate_event_type':
        require_once __DIR__ . "/../controllers/EventTypeController.php";
        (new EventTypeController())->activate();
        break;

    case '/MaMut_web/deactivate_event_type':
        require_once __DIR__ . "/../controllers/EventTypeController.php";
        (new EventTypeController())->deactivate();
        break;


    default:
        require_once __DIR__ . "/../controllers/DashboardController.php";
        (new DashboardController())->index();
        break;
}
