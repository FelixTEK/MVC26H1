<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบติดตามคำสัญญานักการเมือง</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #eee; }
        .badge { padding: 5px 10px; color: white; border-radius: 4px; font-size: 0.8em; }
        .bg-pending { background: #f0ad4e; } /* สีส้ม */
        .bg-progress { background: #0275d8; } /* สีน้ำเงิน */
        .bg-silent { background: #d9534f; }   /* สีแดง */
    </style>
</head>
<body>
    <h1>📢 รายการคำสัญญาเลือกตั้ง</h1>

    <div>
        <?php session_start(); if(isset($_SESSION['role']) && $_SESSION['role']=='admin'): ?>
            สถานะ: <b>Admin</b> | <a href="index.php?action=logout">ออกจากระบบ</a>
        <?php else: ?>
            <a href="index.php?action=login">🔑 คลิกเพื่อ Login (สำหรับอัปเดตข้อมูล)</a>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>วันที่ประกาศ</th>
                <th>นักการเมือง</th>
                <th>พรรค</th>
                <th>คำสัญญา</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($promises as $p): ?>
            <tr>
                <td><?= $p['date_announced'] ?></td>
                <td>
                    <a href="index.php?action=politician&id=<?= $p['politician_id'] ?>">
                        <?= $p['pol_name'] ?>
                    </a>
                </td>
                <td><?= $p['party'] ?></td>
                <td><?= $p['details'] ?></td>
                <td>
                    <?php
                        if($p['status']=='pending') echo '<span class="badge bg-pending">ยังไม่เริ่ม</span>';
                        elseif($p['status']=='in_progress') echo '<span class="badge bg-progress">กำลังดำเนินการ</span>';
                        elseif($p['status']=='silent') echo '<span class="badge bg-silent">เงียบหาย</span>';
                    ?>
                </td>
                <td><a href="index.php?action=show&id=<?= $p['id'] ?>">ดูรายละเอียด</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>