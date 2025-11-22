<?php ob_start(); ?>



<?php

include("config/db.php");
require('controllers/info_user_controller.php')
?>


<main class="d-flex flex-nowrap">
    <h1 class="visually-hidden">Sidebars examples</h1>


    <script src="assets/js/bootstrap.bundle.js"></script>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100 sidebar" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Mat_Mut</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">

            <li class="nav-item">
                <a href="Home" class="nav-link active" aria-current="page">
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
                    <!-- <li><a href="cash_flow" class="nav-link text-white">flux</a></li> -->
                </ul>
            </li>

        </ul>
        </hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?= htmlspecialchars($adherent['full_name'] ?? $user['login']); ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="info_user">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="destroy">Se déconnecter</a></li>
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
        case '/MaMut_web/Home':
            require("views/home.php");
            break;

        case '/MaMut_web/login':
            require("views/login.php");
            break;

        case '/MaMut_web/modifier_compte':
            require("views/eddit_acount.php");
            break;

        case '/MaMut_web/info_user':
            require("views/info_user.php");
            break;

        case '/MaMut_web/destroy':
            require("controllers/destroy.php");
            break;

        case '/MaMut_web/member_list':
            require("views/member_list.php");
            break;

        
    
        // Routes for management event 
        case '/MaMut_web/add_event':
            require("views/add_event.php");
            break;

        case '/MaMut_web/add_event_controller':
            require("controllers/add_event_controller.php");
            break;

        case '/MaMut_web/event_list':
            require("views/event_list.php");
            break;

        case '/MaMut_web/edit_event':
            require("views/edit_event.php");
            break;

        case '/MaMut_web/edit_event_controller':
            require("controllers/update_event_controller.php");
            break;

        case '/MaMut_web/event_details':
            require("controllers/details_event_controller.php");
            break;

        case '/MaMut_web/remove_event':
            require("controllers/delete_event_controller.php");
            break;


        // Routes for management adherent
        case '/MaMut_web/update_adherent':
            require("controllers/update_adherent.php");
            break;

        case '/MaMut_web/update_adherent_controller':
            require("controllers/update_adherent_controller.php");
            break;

        case '/MaMut_web/details_adherent':
            require("controllers/details_adherent.php");
            break;

        case '/MaMut_web/create_account':
            require("controllers/create_account.php");
            break;

        case '/MaMut_web/toggle_status':
            require("controllers/toggle_status.php");
            break;

        case '/MaMut_web/add_member':
            require("views/add_member.php");
            break;

        case '/MaMut_web/add_member_controller':
            require("controllers/add_member_controller.php");
            break;

        case '/MaMut_web/remove_member':
            require("controllers/delete_member.php");
            break;


        // Routes for management fund
        case '/MaMut_web/add_fund':
            require("views/add_fund.php");
            break;

        case '/MaMut_web/select_event_participant':
            require("views/select_participant.php");
            break;

        case '/MaMut_web/cotisation_suivie':
            require("views/suivie_cotisation.php");
            break;

        case '/MaMut_web/fund':
            require("views/fund_liste.php");
            break;

         case '/MaMut_web/paiement':
            require("views/paiement.php");
            break;

        case '/MaMut_web/cash_flow':
            require("views/add_cash_flow.php");
            break;


        default:
            require("views/home.php");
    }
    ?>
    <?php
    ob_end_flush(); ?>
</main>