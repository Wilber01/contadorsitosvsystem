<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../models/SalesReceiptModel.php");

class SalesReceiptController
{
    private $db;
    private $salesReceipt;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->salesReceipt = new SalesReceiptModel($this->db);
    }

    public function index()
    {
        $result = $this->salesReceipt->getAll();
        $salesReceipts = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/salesReceipts/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->salesReceipt->company_id = $_POST['company_id'];
            $this->salesReceipt->receipt_type = $_POST['receipt_type'];
            $this->salesReceipt->receipt_number = $_POST['receipt_number'];
            $this->salesReceipt->receipt_date = $_POST['receipt_date'];
            $this->salesReceipt->amount = $_POST['amount'];
            $this->salesReceipt->customer = $_POST['customer'];
            $this->salesReceipt->attachment = file_get_contents($_FILES['attachment']['tmp_name']);

            if ($this->salesReceipt->create()) {
                header("Location: ../salesReceipts/salesReceipts.php");
                exit();
            }
        }
        include(dirname(__FILE__) . '/../views/salesReceipts/create.php');
    }

    public function edit($id)
    {
        $this->salesReceipt->sales_receipt_id = $id;
        $this->salesReceipt->getById();

        if ($_POST) {
            $this->salesReceipt->company_id = $_POST['company_id'];
            $this->salesReceipt->receipt_type = $_POST['receipt_type'];
            $this->salesReceipt->receipt_number = $_POST['receipt_number'];
            $this->salesReceipt->receipt_date = $_POST['receipt_date'];
            $this->salesReceipt->amount = $_POST['amount'];
            $this->salesReceipt->customer = $_POST['customer'];
            $this->salesReceipt->attachment = file_get_contents($_FILES['attachment']['tmp_name']);

            if ($this->salesReceipt->update()) {
                header("Location: ../salesReceipts/salesReceipts.php");
                exit();
            }
        }
        $salesReceipt = $this->salesReceipt;
        include(dirname(__FILE__) . '/../views/salesReceipts/update.php');
    }

    public function delete($id)
    {
        $this->salesReceipt->sales_receipt_id = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->salesReceipt->delete()) {
                    header("Location: ../salesReceipts/salesReceipts.php");
                    exit();
                }
            } else {
                header("Location: ../salesReceipts/salesReceipts.php");
                exit();
            }
        }

        $this->salesReceipt->getById();
        $salesReceipt = $this->salesReceipt;

        include(dirname(__FILE__) . '/../views/salesReceipts/delete.php');
    }
}
?>
