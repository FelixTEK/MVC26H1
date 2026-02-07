<?php
class Promise {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // 1. ดึงข้อมูลคำสัญญาทั้งหมด (สำหรับหน้า List)
    public function getAll() {
        $sql = "SELECT p.*, pol.name as pol_name, pol.party 
                FROM promises p 
                JOIN politicians pol ON p.politician_id = pol.id 
                ORDER BY p.date_announced DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. ดึงข้อมูลสัญญาเจาะจง + ประวัติการอัปเดต (สำหรับหน้า Detail)
    public function getById($id) {
        // ข้อมูลสัญญา
        $sql = "SELECT p.*, pol.name as pol_name, pol.party 
                FROM promises p 
                JOIN politicians pol ON p.politician_id = pol.id 
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $promise = $stmt->fetch(PDO::FETCH_ASSOC);

        // ประวัติการอัปเดต
        $sqlUp = "SELECT * FROM promise_updates WHERE promise_id = ? ORDER BY update_date DESC";
        $stmtUp = $this->conn->prepare($sqlUp);
        $stmtUp->execute([$id]);
        $updates = $stmtUp->fetchAll(PDO::FETCH_ASSOC);

        return ['info' => $promise, 'updates' => $updates];
    }

    // 3. เพิ่มข้อมูลการอัปเดต (สำหรับหน้า Update)
    public function addUpdate($promise_id, $details) {
        $sql = "INSERT INTO promise_updates (promise_id, details) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$promise_id, $details]);
    }

    // 4. ดึงสัญญาตามนักการเมือง (สำหรับหน้านักการเมือง)
    public function getByPolitician($pol_id) {
        // ดึงชื่อนักการเมืองก่อน
        $sqlPol = "SELECT * FROM politicians WHERE id = ?";
        $stmtPol = $this->conn->prepare($sqlPol);
        $stmtPol->execute([$pol_id]);
        $politician = $stmtPol->fetch(PDO::FETCH_ASSOC);

        // ดึงสัญญาของเขา
        $sqlProm = "SELECT * FROM promises WHERE politician_id = ?";
        $stmtProm = $this->conn->prepare($sqlProm);
        $stmtProm->execute([$pol_id]);
        $promises = $stmtProm->fetchAll(PDO::FETCH_ASSOC);

        return ['politician' => $politician, 'promises' => $promises];
    }
}
?>