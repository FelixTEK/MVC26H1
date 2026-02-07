<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลนักการเมือง</title>
    <style>body { font-family: sans-serif; padding: 20px; }</style>
</head>
<body>
    <a href="index.php">⬅ กลับหน้าหลัก</a>

    <h2>ข้อมูลนักการเมือง</h2>
    <div style="background: #f9f9f9; padding: 15px; border: 1px solid #ddd;">
        <h3>ชื่อ: <?= $data['politician']['name'] ?></h3>
        <p><b>พรรค:</b> <?= $data['politician']['party'] ?></p>
    </div>

    <h3>📜 คำสัญญาที่ให้ไว้ทั้งหมด</h3>
    <ul>
        <?php foreach($data['promises'] as $p): ?>
            <li>
                <?= $p['details'] ?> (สถานะ: <?= $p['status'] ?>)
                <a href="index.php?action=show&id=<?= $p['id'] ?>">[ดูรายละเอียด]</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>