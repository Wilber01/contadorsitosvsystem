<?php
class ReportsModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getBuyReports($company_id, $start_date, $end_date)
    {
        $query = "
            SELECT 
                pr.purchase_receipt_id, 
                pr.receipt_type, 
                pr.receipt_number, 
                pr.receipt_date, 
                pr.amount, 
                pr.supplier
            FROM 
                purchase_receipts pr
            JOIN 
                companies c ON pr.company_id = c.company_id
            WHERE 
                pr.company_id = :company_id 
                AND pr.receipt_date BETWEEN :start_date AND :end_date
            ORDER BY 
                pr.receipt_date";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":company_id", $company_id, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellReports($company_id, $start_date, $end_date)
    {
        $query = "
            SELECT 
                sr.sales_receipt_id, 
                sr.receipt_type, 
                sr.receipt_number, 
                sr.receipt_date,
                sr.amount, 
                sr.customer
            FROM 
                sales_receipts sr
            JOIN 
                companies c ON sr.company_id = c.company_id
            WHERE 
                sr.company_id = :company_id 
                AND sr.receipt_date BETWEEN :start_date AND :end_date
            ORDER BY 
                sr.receipt_date";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":company_id", $company_id, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}