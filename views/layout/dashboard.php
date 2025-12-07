<main class="d-flex flex-nowrap">
    <h1 class="visually-hidden">Sidebars examples</h1>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100 sidebar" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Mat_Mut</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="home" class="nav-link active" aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#home" />
                    </svg>
                    Acceuil
                </a>
            </li>

            <li>
                <a class="nav-link text-white" href="/MaMut_web/member_list">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#speedometer2" />
                    </svg>
                    Gestion des adhérents
                </a>
            </li>

            <li>
                <a class="nav-link text-white" href="/MaMut_web/event_list">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#speedometer2" />
                    </svg>
                    Gestion des Evenements
                </a>
            </li>

            <li>
                <a class="nav-link text-white" href="/MaMut_web/fund">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#grid" />
                    </svg>
                    Gestion des Caisses
                </a>
            </li>
            <li>
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#grid" />
                    </svg>
                    Configuration
                </a>
                <ul class="collapse list-unstyled ps-3" id="productsMenu">
                    <li><a href="add_fund" class="nav-link text-white">Type d'évenement</a></li>
                    <li><a href="fund" class="nav-link text-white">Mode paiement</a></li>
                </ul>
            </li>

        </ul>
        </hr>
        <div class="dropdown mt-3">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong><?= htmlspecialchars($adherent['full_name'] ?? $user['login']); ?></strong>
            </a>

            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="/MaMut_web/info_user">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/MaMut_web/logout">Se déconnecter</a></li>
            </ul>
        </div>
    </div>

    <script>
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

    <?php
    $url = $_SERVER["REQUEST_URI"];
    $path = parse_url($url, PHP_URL_PATH);
    $url = rtrim($path, "/");
    if (strpos($url, '/MaMut_web/controllers/') === 0) {
        return false;
    }
    switch ($url) {

        // Routes for all user
        case '/MaMut_web/home':
            require_once "controllers/DashboardController.php";
            $controller = new DashboardController();
            $controller->showDashboard();
            break;

        case '/MaMut_web/update_account':
            require_once __DIR__ . "/controllers/UserController.php";
            $user = new UserController();
            $user->showEditAccount();
            break;

        case '/MaMut_web/info_user':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->showProfile();
            break;

        case '/MaMut_web/logout':
            require_once __DIR__ . "/controllers/UserController.php";
            $user = new UserController();
            $user->logout();
            break;


        // Routes for management event 
        case '/MaMut_web/add_event':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->showAddEventForm();
            break;

        case '/MaMut_web/add_event_controller':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->addEvent();
            break;

        case '/MaMut_web/event_list':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->getAllEvent();
            break;

        case '/MaMut_web/edit_event':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->showEditEventForm();
            break;

        case '/MaMut_web/edit_event_controller':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->updateEvent();
            break;

        case '/MaMut_web/event_details':
            require_once "controllers/EventController.php";
            $controller = new EventController();
            $controller->handleShowEvent();
            break;

        case '/MaMut_web/add_participant':
            require_once "controllers/ParticipantsController.php";
            $controller = new ParticipantController();
            $controller->addParticipant();
            break;

        case '/MaMut_web/delete_participant':
            require_once "controllers/ParticipantsController.php";
            $controller = new ParticipantController();
            $controller->deleteParticipant();
            break;

        case '/MaMut_web/details_user_event':
            require_once "controllers/ParticipantsController.php";
            $controller = new ParticipantController();
            $controller->showParticipantDetails();
            break;


        
            // Routes for management adherent

        case '/MaMut_web/create_user_adherent_account':
            require_once  "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->showCreateUserForm();
            break;

        case '/MaMut_web/store_user_account':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->storeUserAccount(); 
            break;

        case '/MaMut_web/update_adherent':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->showEditForm();
            break;

        case '/MaMut_web/update_adherent_controller':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->updateAdherent();
            break;

        case '/MaMut_web/details_adherent':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->detailsAdherent();
            break;


        case '/MaMut_web/toggle_status':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->toggleUserStatus();
            break;

        case '/MaMut_web/member_list':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->list();
            break;

        case '/MaMut_web/add_member':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->showAddForm();
            break;

        case '/MaMut_web/add_member_controller':
            require_once "controllers/AdherentController.php";
            $controller = new AdherentController();
            $controller->addAdherent();
            break;

        default:
            require_once "controllers/DashboardController.php";
            $controller = new DashboardController();
            $controller->showDashboard();
            break;
    }
    ?>
    <?php
    ob_end_flush(); ?>
</main>