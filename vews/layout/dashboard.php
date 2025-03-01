<main class="d-flex flex-nowrap">
  <h1 class="visually-hidden">Sidebars examples</h1>

<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Mon Espace</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Acceuil
            </a>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#dashboardMenu" role="button" aria-expanded="false" aria-controls="dashboardMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                Membre
            </a>
            <ul class="collapse list-unstyled ps-3" id="dashboardMenu">
                <li><a href="add_member" class="nav-link text-white"> ajouter</a></li>
                <li><a href="caisse" class="nav-link text-white">lister</a></li>
            </ul>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#ordersMenu" role="button" aria-expanded="false" aria-controls="ordersMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Orders
            </a>
            <ul class="collapse list-unstyled ps-3" id="ordersMenu">
                <li><a href="#" class="nav-link text-white">blablan</a></li>
                <li><a href="#" class="nav-link text-white">lllllllllllllll</a></li>
            </ul>
        </li>

        <li>
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Products
            </a>
            <ul class="collapse list-unstyled ps-3" id="productsMenu">
                <li><a href="#" class="nav-link text-white">oooooooooooo</a></li>
                <li><a href="#" class="nav-link text-white">Mmmmmmmmmmmmm</a></li>
            </ul>
        </li>

    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<?php
$url = rtrim($_SERVER["REQUEST_URI"], "/"); 
switch ($url){

    case '/MaMut_web/Home':
        require("vews/home.php");   
        break;
    case '/MaMut_web/add_member':
        require("vews/add_member.php");   
        break;
     case '/MaMut_web/caisse':
         require("vews/Liste_caisses.php");   
         break;
    case '/MaMut_web/liste_member':
        require("vews/Liste_des_membre.php");   
        break;

    case '/MaMut_web/add_even':
         require("vews/form_evenement.php");   
         break;
    case '/MaMut_web/liste_even':
         require("vews/liste_evenement.php");   
         break;
    default:
        require("vews/home.php");
}
?>
</main>