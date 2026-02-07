<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดคำสัญญา</title>
    <style>body { font-family: sans-serif; padding: 20px; }</style>
</head>
<body>
    <a href="index.php">⬅ กลับหน้าหลัก</a>

    <h2>รายละเอียดคำสัญญา</h2>
    <div style="border: 1px solid #ddd; padding: 20px; border-radius: 5px;">
        <h3><?= $data['info']['details'] ?></h3>
        <p><b>นักการเมือง:</b> <?= $data['info']['pol_name'] ?> (<?= $data['info']['party'] ?>)</p>
        <p><b>วันที่ประกาศ:</b> <?= $data['info']['date_announced'] ?></p>
        <p><b>สถานะ:</b> <?= $data['info']['status'] ?></p>

        <?php if($data['info']['status'] != 'silent'): ?>
            <a href="index.php?action=update&id=<?= $data['info']['id'] ?>">
                <button style="cursor: pointer; padding: 10px; background: #5cb85c; color: white; border: none;">
                    + เพิ่มความคืบหน้า
                </button>
            </a>
        <?php else: ?>
            <p style="color: red; font-weight: bold;">* คำสัญญานี้เงียบหาย ไม่สามารถอัปเดตได้</p>
        <?php endif; ?>
    </div>

    <h3>ประวัติการดำเนินการ (Timeline)</h3>
    <ul>
        <?php if(count($data['updates']) > 0): ?>
            <?php foreach($data['updates'] as $up): ?>
                <li>
                    <b><?= $up['update_date'] ?>:</b> <?= $up['details'] ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>ยังไม่มีการอัปเดตความคืบหน้า</li>
        <?php endif; ?>
    </ul>
</body>
</html>