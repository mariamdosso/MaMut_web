<?php

require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Dashboard.php';
require_once __DIR__ . '/AdherentController.php';


class DashboardController
{
    public function showDashboard()
    {
        $totalMembers = Dashboard::getTotalMembers();
        $totalEvents  = Dashboard::getTotalEvents();
        $totalFunds   = Dashboard::getTotalFunds();

        $adherentController = new AdherentController();
        $adherent = $adherentController->getCurrentAdherent();
        $user     = $_SESSION['user_info'] ?? null;

        ob_start();
        require __DIR__ . '/../views/home.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function index()
    {
        $this->showDashboard();
    }
}
