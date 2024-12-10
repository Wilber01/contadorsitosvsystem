<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../models/ReportsModel.php");

class ReportController
{
    private $db;
    private $reportsModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->reportsModel = new ReportsModel($this->db);
    }

    public function buyReports()
    {
        $reports = [];
        $totalAmount = 0;
        $companies = [];

        if (!empty($_POST)) {
            $company_id = $_POST['id_company'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $reports = $this->reportsModel->getBuyReports($company_id, $start_date, $end_date);

            foreach ($reports as $report) {
                $totalAmount += $report['amount'];
            }
        }

        $sql = "SELECT company_id, name FROM companies";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include(dirname(__FILE__) . '/../views/reports/purchaseReports.php');
    }

    public function sellReports()
    {
        $reports = [];
        $totalAmount = 0;
        $companies = [];
        
        if (!empty($_POST)) {
            $company_id = $_POST['id_company'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $reports = $this->reportsModel->getSellReports($company_id, $start_date, $end_date);
            
            foreach ($reports as $report) {
                $totalAmount += $report['amount'];
            }
        }

        $sql = "SELECT company_id, name FROM companies";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include(dirname(__FILE__) . '/../views/reports/salesReports.php');
    }
}