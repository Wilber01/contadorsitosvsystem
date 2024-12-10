<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../models/CompanyModel.php");

class CompanyController
{
    private $db;
    private $company;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->company = new CompanyModel($this->db);
    }

    public function index()
    {
        $result = $this->company->getAll();
        $companies = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/company/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->company->name = $_POST['name'];
            $this->company->company_type = $_POST['company_type'];
            $this->company->address = $_POST['address'];
            $this->company->phone = $_POST['phone'];
            $this->company->email = $_POST['email'];

            if ($this->company->create()) {
                header("Location: ../company/company.php");
                exit();
            }
        }
        include(dirname(__FILE__) . '/../views/company/create.php');
    }

    public function edit($id)
    {
        $this->company->company_id = $id;
        $this->company->getById();

        if ($_POST) {
            $this->company->name = $_POST['name'];
            $this->company->company_type = $_POST['company_type'];
            $this->company->address = $_POST['address'];
            $this->company->phone = $_POST['phone'];
            $this->company->email = $_POST['email'];

            if ($this->company->update()) {
                header("Location: ../company/company.php");
                exit();
            }
        }
        $companies = $this->company;
        include(dirname(__FILE__) . '/../views/company/update.php');
    }

    public function delete($id)
    {
        $this->company->company_id = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->company->delete()) {
                    header("Location: ../company/company.php");
                    exit();
                }
            } else {
                header("Location: ../company/company.php");
                exit();
            }
        }

        $this->company->getById();
        $companies = $this->company;

        include(dirname(__FILE__) . '/../views/company/delete.php');
    }
}
