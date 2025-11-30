<?php

require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/Participant.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../models/Dashboard.php';
require_once __DIR__ . '/AdherentController.php';


class DashboardController
{
    public function showDashboard()
    {
        $totalMembers = Dashboard::getTotalMembers();
        $totalEvents = Dashboard::getTotalEvents();
        $totalFunds = Dashboard::getTotalFunds();

        require_once __DIR__ . '/../views/home.php';
    }

    public function dashboard()
    {
        session_start();

        $adherentController = new AdherentController();
        $adherent = $adherentController->getCurrentAdherent();

        require __DIR__ . '/../views/dashboard.php';
    }

    public function index()
    {
        $user = $_SESSION['user_info'];
        require __DIR__ . '/../views/layout/dashboard.php';
    }
}
