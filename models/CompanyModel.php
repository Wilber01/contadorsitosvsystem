<?php
class CompanyModel {
    private $conn;
    private $table_name = "companies";

    public $company_id;
    public $name;
    public $company_type;
    public $address;
    public $phone;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table_name} 
                  (name, company_type, address, phone, email) 
                  VALUES (:name, :company_type, :address, :phone, :email)";
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->company_type = htmlspecialchars(strip_tags($this->company_type));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":company_type", $this->company_type);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);

        return $stmt->execute() ? true : false;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM {$this->table_name} WHERE company_id = :company_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":company_id", $this->company_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->name = $row['name'];
            $this->company_type = $row['company_type'];
            $this->address = $row['address'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
        }
    }

    public function update() {
        $query = "UPDATE {$this->table_name} 
                  SET name = :name, 
                      company_type = :company_type, 
                      address = :address, 
                      phone = :phone, 
                      email = :email
                  WHERE company_id = :company_id";
        
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->company_type = htmlspecialchars(strip_tags($this->company_type));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":company_type", $this->company_type);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":company_id", $this->company_id);

        return $stmt->execute() ? true : false;
    }

    public function delete() {
        $query = "DELETE FROM {$this->table_name} WHERE company_id = :company_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":company_id", $this->company_id);

        return $stmt->execute() ? true : false;
    }
}
?>