<main class="d-flex flex-nowrap">
  <h1 class="visually-hidden">Sidebars examples</h1>
<?php
// session_destroy()
 ?>
  <!-- <script src="assets/js/bootstrap.bunddle.js"></script> -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Mon Espace</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        
        <li class="nav-item">
            <a href="Home" class="nav-link active" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Acceuil
            </a>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#dashboardMenu" role="button" aria-expanded="true" aria-controls="dashboardMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                Membre
            </a>
            <ul class="collapse list-unstyled ps-3" id="dashboardMenu">
                <li><a href="add_member" class="nav-link text-white"> ajouter</a></li>
                <li><a href="member_list" class="nav-link text-white">lister</a></li>
            </ul>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#ordersMenu" role="button" aria-expanded="false" aria-controls="ordersMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Evenements
            </a>
            <ul class="collapse list-unstyled ps-3" id="ordersMenu">
                <li><a href="add_event" class="nav-link text-white">ajouter</a></li>
                <li><a href="event_list" class="nav-link text-white">lister</a></li>
                <li><a href="cotisation_suivie" class="nav-link text-white">Suivie de cotisation</a></li>
            </ul>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Caisses
            </a>
            <ul class="collapse list-unstyled ps-3" id="productsMenu">
                <li><a href="add_fund" class="nav-link text-white">Ajouter</a></li>
                <li><a href="fund" class="nav-link text-white">Lister</a></li>
                <li><a href="cash_flow" class="nav-link text-white">flux</a></li>
            </ul>
        </li>

    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?= $_SESSION['user_info']['user_name'];?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="destroy">Se deconnecter</a></li>
        </ul>
    </div>
</div>

<?php
$url = $_SERVER["REQUEST_URI"];
$path = parse_url($url, PHP_URL_PATH); // Removes query parameters
$url =rtrim($path, "/") ; 
if (strpos($url, '/MaMut_web/controller/') === 0) {
    return false;
}
switch ($url){

    case '/MaMut_web/Home':
        require("vews/home.php");   
        break;
    case '/MaMut_web/add_member':
        require("vews/add_member.php");   
        break;
    case '/MaMut_web/remove_member':
            require("controller/delete_member.php");   
            break;
     case '/MaMut_web/fund':
         require("vews/fund_liste.php");   
         break;
    case '/MaMut_web/member_list':
        require("vews/member_list.php");   
        break;

    case '/MaMut_web/add_event':
         require("vews/add_event.php");   
         break;

    case '/MaMut_web/destroy':
         require("controller/destroy.php");   
         break;

    case '/MaMut_web/cash_flow':
        require("vews/add_cash_flow.php");   
        break;

    case '/MaMut_web/event_list':
         require("vews/event_list.php");   
         break;
    case '/MaMut_web/update_event':
        require("vews/edit_event.php");   
        break;
    case '/MaMut_web/remove_event':
        require("controller/delete_event_controller.php");   
        break;

    case '/MaMut_web/modifier':
        require("vews/edit_member.php");   
         break;

    case '/MaMut_web/add_fund':
        require("vews/add_fund.php");   
        break;

    case '/MaMut_web/select_event_participant':
        require("vews/select_participant.php");   
        break;

    case '/MaMut_web/cotisation_suivie':
        require("vews/suivie_cotisation.php");   
        break;
         
    default:
        require("vews/home.php");
}
?>
</main>


<!-- #region -->