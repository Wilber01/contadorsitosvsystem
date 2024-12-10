<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../models/PurchaseReceiptModel.php");

class PurchaseReceiptController
{
    private $db;
    private $purchaseReceipt;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->purchaseReceipt = new PurchaseReceiptModel($this->db);
    }

    public function index()
    {
        $result = $this->purchaseReceipt->getAll();
        $purchaseReceipts = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/purchaseReceipts/index.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->purchaseReceipt->company_id = $_POST['company_id'];
            $this->purchaseReceipt->receipt_type = $_POST['receipt_type'];
            $this->purchaseReceipt->receipt_number = $_POST['receipt_number'];
            $this->purchaseReceipt->receipt_date = $_POST['receipt_date'];
            $this->purchaseReceipt->amount = $_POST['amount'];
            $this->purchaseReceipt->supplier = $_POST['supplier'];
            $this->purchaseReceipt->attachment = file_get_contents($_FILES['attachment']['tmp_name']);

            if ($this->purchaseReceipt->create()) {
                header("Location: ../purchaseReceipts/purchaseReceipts.php");
                exit();
            }
        }
        include(dirname(__FILE__) . '/../views/purchaseReceipts/create.php');
    }

    public function edit($id)
    {
        $this->purchaseReceipt->purchase_receipt_id = $id;
        $this->purchaseReceipt->getById();

        if ($_POST) {
            $this->purchaseReceipt->company_id = $_POST['company_id'];
            $this->purchaseReceipt->receipt_type = $_POST['receipt_type'];
            $this->purchaseReceipt->receipt_number = $_POST['receipt_number'];
            $this->purchaseReceipt->receipt_date = $_POST['receipt_date'];
            $this->purchaseReceipt->amount = $_POST['amount'];
            $this->purchaseReceipt->supplier = $_POST['supplier'];
            $this->purchaseReceipt->attachment = file_get_contents($_FILES['attachment']['tmp_name']);

            if ($this->purchaseReceipt->update()) {
                header("Location: ../purchaseReceipts/purchaseReceipts.php");
                exit();
            }
        }
        $purchaseReceipt = $this->purchaseReceipt;
        include(dirname(__FILE__) . '/../views/purchaseReceipts/update.php');
    }

    public function delete($id)
    {
        $this->purchaseReceipt->purchase_receipt_id = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                if ($this->purchaseReceipt->delete()) {
                    header("Location: ../purchaseReceipts/purchaseReceipts.php");
                    exit();
                }
            } else {
                header("Location: ../purchaseReceipts/purchaseReceipts.php");
                exit();
            }
        }

        $this->purchaseReceipt->getById();
        $purchaseReceipt = $this->purchaseReceipt;

        include(dirname(__FILE__) . '/../views/purchaseReceipts/delete.php');
    }
}
?>
