<?php
class SalesReceiptModel {
    private $conn;
    private $table_name = "sales_receipts";

    public $sales_receipt_id;
    public $company_id;
    public $receipt_type;
    public $receipt_number;
    public $receipt_date;
    public $amount;
    public $customer;
    public $attachment;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name} 
                  (company_id, receipt_type, receipt_number, receipt_date, amount, customer, attachment) 
                  VALUES (:company_id, :receipt_type, :receipt_number, :receipt_date, :amount, :customer, :attachment)";
        
        $stmt = $this->conn->prepare($query);

        $this->receipt_type = htmlspecialchars(strip_tags($this->receipt_type));
        $this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
        $this->customer = htmlspecialchars(strip_tags($this->customer));

        $stmt->bindParam(":company_id", $this->company_id);
        $stmt->bindParam(":receipt_type", $this->receipt_type);
        $stmt->bindParam(":receipt_number", $this->receipt_number);
        $stmt->bindParam(":receipt_date", $this->receipt_date);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":customer", $this->customer);
        $stmt->bindParam(":attachment", $this->attachment, PDO::PARAM_LOB);

        return $stmt->execute() ? true : false;
    }

    public function getAll() {
        $query = "SELECT sales_receipt_id, name, receipt_type, receipt_number, receipt_date, amount, customer, attachment FROM {$this->table_name} p INNER JOIN companies c ON p.company_id = c.company_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM {$this->table_name} WHERE sales_receipt_id = :sales_receipt_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sales_receipt_id", $this->sales_receipt_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->company_id = $row['company_id'];
            $this->receipt_type = $row['receipt_type'];
            $this->receipt_number = $row['receipt_number'];
            $this->receipt_date = $row['receipt_date'];
            $this->amount = $row['amount'];
            $this->customer = $row['customer'];
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
                      customer = :customer, 
                      attachment = :attachment
                  WHERE sales_receipt_id = :sales_receipt_id";
        
        $stmt = $this->conn->prepare($query);

        $this->receipt_type = htmlspecialchars(strip_tags($this->receipt_type));
        $this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
        $this->customer = htmlspecialchars(strip_tags($this->customer));

        $stmt->bindParam(":company_id", $this->company_id);
        $stmt->bindParam(":receipt_type", $this->receipt_type);
        $stmt->bindParam(":receipt_number", $this->receipt_number);
        $stmt->bindParam(":receipt_date", $this->receipt_date);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":customer", $this->customer);
        $stmt->bindParam(":attachment", $this->attachment, PDO::PARAM_LOB);
        $stmt->bindParam(":sales_receipt_id", $this->sales_receipt_id);

        return $stmt->execute() ? true : false;
    }

    public function delete() {
        $query = "DELETE FROM {$this->table_name} WHERE sales_receipt_id = :sales_receipt_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sales_receipt_id", $this->sales_receipt_id);

        return $stmt->execute() ? true : false;
    }
}
?>