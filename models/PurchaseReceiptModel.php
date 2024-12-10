<?php
class PurchaseReceiptModel {
    private $conn;
    private $table_name = "purchase_receipts";

    public $purchase_receipt_id;
    public $company_id;
    public $receipt_type;
    public $receipt_number;
    public $receipt_date;
    public $amount;
    public $supplier;
    public $attachment;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name} 
                  (company_id, receipt_type, receipt_number, receipt_date, amount, supplier, attachment) 
                  VALUES (:company_id, :receipt_type, :receipt_number, :receipt_date, :amount, :supplier, :attachment)";
        
        $stmt = $this->conn->prepare($query);

        $this->receipt_type = htmlspecialchars(strip_tags($this->receipt_type));
        $this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
        $this->supplier = htmlspecialchars(strip_tags($this->supplier));

        $stmt->bindParam(":company_id", $this->company_id);
        $stmt->bindParam(":receipt_type", $this->receipt_type);
        $stmt->bindParam(":receipt_number", $this->receipt_number);
        $stmt->bindParam(":receipt_date", $this->receipt_date);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":supplier", $this->supplier);
        $stmt->bindParam(":attachment", $this->attachment, PDO::PARAM_LOB);

        return $stmt->execute() ? true : false;
    }

    public function getAll() {
        $query = "SELECT purchase_receipt_id, c.company_id, name, receipt_type, receipt_number, receipt_date, amount, supplier, attachment FROM {$this->table_name} p INNER JOIN companies c ON p.company_id = c.company_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM {$this->table_name} WHERE purchase_receipt_id = :purchase_receipt_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":purchase_receipt_id", $this->purchase_receipt_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->company_id = $row['company_id'];
            $this->receipt_type = $row['receipt_type'];
            $this->receipt_number = $row['receipt_number'];
            $this->receipt_date = $row['receipt_date'];
            $this->amount = $row['amount'];
            $this->supplier = $row['supplier'];
            $this->attachment = $row['attachment'];
        }
    }

    public function update() {
        $query = "UPDATE {$this->table_name} 
                  SET company_id = :company_id, 
                      receipt_type = :receipt_type, 
                      receipt_number = :receipt_number, 
                      receipt_date = :receipt_date, 
                      amount = :amount, 
                      supplier = :supplier, 
                      attachment = :attachment
                  WHERE purchase_receipt_id = :purchase_receipt_id";
        
        $stmt = $this->conn->prepare($query);

        $this->receipt_type = htmlspecialchars(strip_tags($this->receipt_type));
        $this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
        $this->supplier = htmlspecialchars(strip_tags($this->supplier));

        $stmt->bindParam(":company_id", $this->company_id);
        $stmt->bindParam(":receipt_type", $this->receipt_type);
        $stmt->bindParam(":receipt_number", $this->receipt_number);
        $stmt->bindParam(":receipt_date", $this->receipt_date);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":supplier", $this->supplier);
        $stmt->bindParam(":attachment", $this->attachment, PDO::PARAM_LOB);
        $stmt->bindParam(":purchase_receipt_id", $this->purchase_receipt_id);

        return $stmt->execute() ? true : false;
    }

    public function delete() {
        $query = "DELETE FROM {$this->table_name} WHERE purchase_receipt_id = :purchase_receipt_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":purchase_receipt_id", $this->purchase_receipt_id);

        return $stmt->execute() ? true : false;
    }
}
?>