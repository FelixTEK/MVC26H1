<?php
require_once 'models/Promise.php';

class PromiseController {

    // 1. หน้าแสดงรายการทั้งหมด
    public function index() {
        $model = new Promise();
        $promises = $model->getAll();
        require 'views/promise_list.php';
    }

    // 2. หน้าแสดงรายละเอียด + ประวัติ
    public function show($id) {
        $model = new Promise();
        $data = $model->getById($id);
        require 'views/promise_detail.php';
    }

    // 3. หน้าฟอร์มอัปเดต (มี Business Rule)
    public function updateForm($id) {
        session_start();
        // เช็คว่าเป็น Admin หรือไม่ (Mockup ง่ายๆ)
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            echo "<script>alert('กรุณา Login เป็น Admin ก่อน'); window.location.href='index.php';</script>";
            return;
        }

        $model = new Promise();
        $data = $model->getById($id);

        // **Business Rule: ถ้าสถานะ 'silent' ห้ามอัปเดต**
        if ($data['info']['status'] == 'silent') {
            echo "<script>
                alert('ไม่สามารถอัปเดตได้ เนื่องจากสถานะคือ เงียบหาย (Silent)');
                window.location.href='index.php?action=show&id=$id';
            </script>";
            return;
        }

        require 'views/promise_update.php';
    }

    // 4. บันทึกการอัปเดต
    public function saveUpdate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['promise_id'];
            $details = $_POST['details'];

            $model = new Promise();
            $model->addUpdate($id, $details);

            // บันทึกเสร็จ กลับไปหน้ารายละเอียด
            header("Location: index.php?action=show&id=$id");
        }
    }

    // 5. หน้านักการเมือง
    public function showPolitician($id) {
        $model = new Promise();
        $data = $model->getByPolitician($id);
        require 'views/politician_detail.php';
    }

    // 6. แสดงแบบฟอร์ม Login (แก้จากของเดิม)
    public function login() {
        require 'views/login.php';
    }

    // 7. ตรวจสอบรหัสผ่าน (เพิ่มใหม่)
    public function checkLogin() {
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hardcode รหัสผ่านตรงนี้เลย (User: admin / Pass: 1234)
        if ($username == 'admin' && $password == '1234') {
            $_SESSION['role'] = 'admin';
            header("Location: index.php"); // รหัสถูก -> ไปหน้าแรก
        } else {
            echo "<script>
                alert('❌ รหัสผ่านผิด! ใครอนุญาตให้คุณเข้าสภา?');
                window.location.href='index.php?action=login';
            </script>";
        }
    }

    // 8. Logout (เหมือนเดิม)
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
?>