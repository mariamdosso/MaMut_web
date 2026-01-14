<?php
require_once __DIR__ . '/../Models/Fund.php';
require_once __DIR__ . '/../Models/FundStatus.php';

class FundController
{
    public function showAllFunds()
    {
        $limit = 9;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $limit;

        $funds = Fund::getAllPaginated($limit, $offset);
        $totalFunds = Fund::countAll();
        $totalPages = ceil($totalFunds / $limit);
         $statuses = FundStatus::getAll();

        ob_start();
        require __DIR__ . '/../views/fund/fund_list.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function showCreateFundForm()
    {
        $statuses = FundStatus::getAll();

        ob_start();
        require __DIR__ . '/../views/fund/create_fund.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function createFund()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['label'])) {
                $error = "Fund name is required.";
                $this->showCreateFundForm();
                return;
            }

            $success = Fund::create([
                'label' => $_POST['label']
            ]);

            if ($success) {
                $_SESSION['message'] = "Fund created successfully!";
                header('Location: /MaMut_web/fund_list');
                exit;
            } else {
                $error = "Error creating fund.";
                $this->showCreateFundForm();
            }
        } else {
            $this->showCreateFundForm();
        }
    }

    public function showEditFundForm()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id <= 0) {
            die("Invalid fund ID.");
        }

        $fund = Fund::findById($id);
        $statuses = FundStatus::getAll();

        ob_start();
        require __DIR__ . '/../views/fund/edit_fund.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function updateFund()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) die("Invalid fund ID.");

            $label = $_POST['label'] ?? '';
            if (empty($label)) {
                $_SESSION['errorMessage'] = "Fund label cannot be empty.";
                $this->showEditFundForm();
                return;
            }

            $success = Fund::updateLabel($id, $label);

            if ($success) {
                $_SESSION['message'] = "Fund label updated successfully!";
                header('Location: /MaMut_web/fund_list');
                exit;
            } else {
                $_SESSION['errorMessage'] = "Error updating fund label.";
                $this->showEditFundForm();
            }
        }
    }

    public function changeFundStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $newStatus = intval($_POST['fund_status_id'] ?? 1);

            if ($id <= 0) die("Invalid fund ID.");

            $success = Fund::changeStatus($id, $newStatus);

            if ($success) {
                $_SESSION['message'] = "Fund status updated successfully!";
            } else {
                $_SESSION['errorMessage'] = "Error updating fund status.";
            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function viewFund($id)
    {
        $id = intval($id);
        if ($id <= 0) die("Invalid fund ID.");

        $fund = Fund::findById($id);

        ob_start();
        require __DIR__ . '/../views/fund/fund_details.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }

}   