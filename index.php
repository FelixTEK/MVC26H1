<?php
// เปิด Error Reporting (จำเป็นตอนสอบ)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Config & Controller
require_once 'config/Database.php';
require_once 'controllers/PromiseController.php';

// รับ Action จาก URL
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new PromiseController();

// Routing Logic
switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'show': // หน้ารายละเอียด
        $controller->show($_GET['id']);
        break;
    case 'update': // หน้าฟอร์มอัปเดต
        $controller->updateForm($_GET['id']);
        break;
    case 'save': // บันทึกข้อมูล
        $controller->saveUpdate();
        break;
    case 'politician': // หน้านักการเมือง
        $controller->showPolitician($_GET['id']);
        break;
    case 'login':
        $controller->login(); // เรียกหน้าฟอร์ม
        break;
        
    case 'login_check':       // ** เพิ่มอันนี้ **
        $controller->checkLogin(); // ตรวจรหัส
        break;
        
    case 'logout':
        $controller->logout();
        break;
        
    default:
        $controller->index();
        break;
}
?>