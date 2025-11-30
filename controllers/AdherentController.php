<?php
require_once __DIR__ . '/../Models/Adherent.php';
require_once __DIR__ . '/../Models/User.php';

class AdherentController
{
    public function list()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = 6; 

        $result = Adherent::getPaginated($page, $perPage);

        $adherents = $result['data'];
        $totalPages = $result['totalPages'];
        $currentPage = $result['currentPage'];
        $total = $result['total'];
        $perPage = $result['perPage'];

        require __DIR__ . '/../views/member_list.php';
    }

    public function showEditForm()
    {
        $id = $_GET['id'] ?? 0;

        if ($id <= 0) {
            die("ID invalide !");
        }

        $adherent = Adherent::getById($id);

        if (!$adherent) {
            die("Adhérent non trouvé !");
        }

        require __DIR__ . '/../views/edit_member.php';
    }

    public function updateAdherent()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Méthode non autorisée");
        }

        $id = $_POST['adherent_id'] ?? 0;

        $data = [
            'full_name' => $_POST['full_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'birth_date' => $_POST['birth_date'] ?? '',
            'date_of_joining' => $_POST['date_of_joining'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'city' => $_POST['city'] ?? '',
            'municipality_department' => $_POST['municipality_department'] ?? '',
            'call_number' => $_POST['call_number'] ?? '',
            'address' => $_POST['address'] ?? '',
        ];

        if (empty($data['full_name']) || empty($data['email'])) {
            $_SESSION['errorMessage'] = "Nom et email obligatoires !";
            header("Location: /MaMut_web/update_adherent?id=$id");
            exit;
        }

        $success = Adherent::update($id, $data);

        if ($success) {
            $_SESSION['successMessage'] = "Adhérent mis à jour avec succès !";
        } else {
            $_SESSION['errorMessage'] = "Erreur lors de la mise à jour !";
        }

        header("Location: /MaMut_web/member_list");
        exit;
    }

    public function showAddForm()
    {
        require __DIR__ . '/../views/add_member.php';
    }

    public function addAdherent()
    {
        if (!isset($_SESSION['user_info']['id'])) {
            $_SESSION['errorMessage'] = "Vous devez être connecté pour ajouter un adhérent.";
            header('Location: /MaMut_web/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requiredFields = [
                'full_name',
                'birth_date',
                'date_of_joining',
                'gender',
                'city',
                'municipality_department',
                'call_number',
                'address',
                'email'
            ];

            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || $_POST[$field] === '') {
                    $_SESSION['errorMessage'] = "Le champ '$field' est requis.";
                    require __DIR__ . '/../views/add_member.php';
                    return;
                }
            }

            $_POST['created_by'] = $_SESSION['user_info']['id'];
            $result = Adherent::add($_POST);

            if ($result['success']) {
                $_SESSION['successMessage'] = $result['message'];
                header('Location: /MaMut_web/member_list');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['message'];
                require __DIR__ . '/../views/add_member.php';
            }
        } else {
            $this->showAddForm();
        }
    }

    public function toggleUserStatus()
    {
        if (!isset($_GET['id'], $_GET['user_status'])) {
            $_SESSION['errorMessage'] = "Paramètres manquants pour changer le statut.";
            header('Location: /MaMut_web/member_list');
            exit();
        }

        $id = intval($_GET['id']);
        $status = $_GET['user_status'] === 'active' ? 'active' : 'inactive';

        $result = User::toggleStatus($id, $status);

        if ($result) {
            $_SESSION['successMessage'] = "Statut utilisateur mis à jour avec succès.";
        } else {
            $_SESSION['errorMessage'] = "Erreur lors de la mise à jour du statut utilisateur.";
        }

        header('Location: /MaMut_web/member_list');
        exit();
    }

    public function detailsAdherent()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id <= 0) {
            die("ID invalide !");
        }

        $adherent = Adherent::getById($id);

        if (!$adherent) {
            die("Adhérent introuvable !");
        }

        require __DIR__ . '/../views/details_info_adherent.php';
    }

    public function getCurrentAdherent()
    {
        session_start();

        if (!isset($_SESSION['user_info'])) {
            return null; 
        }

        $user = $_SESSION['user_info'];
        $adherentId = $user['adherent_id'] ?? $user['id'];

        return Adherent::getById($adherentId);
    }

    public function showProfile()
    {

        if (!isset($_SESSION['user_info'])) {
            header("Location: /MaMut_web/login");
            exit;
        }

        $user = $_SESSION['user_info'];
        $adherentId = $user['adherent_id'] ?? $user['id'];

        $adherent = Adherent::getById($adherentId);

        require_once __DIR__ . '/../views/info_user.php';
    }
}
