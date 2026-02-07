<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>อัปเดตความคืบหน้า</title>
    <style>body { font-family: sans-serif; padding: 20px; }</style>
</head>
<body>
    <h2>📝 บันทึกความคืบหน้า</h2>
    <p><b>คำสัญญา:</b> <?= $data['info']['details'] ?></p>

    <form method="post" action="index.php?action=save">
        <input type="hidden" name="promise_id" value="<?= $data['info']['id'] ?>">
        
        <label>รายละเอียดความคืบหน้า:</label><br>
        <textarea name="details" rows="5" cols="50" required></textarea>
        <br><br>
        <button type="submit">บันทึกข้อมูล</button>
        <a href="index.php?action=show&id=<?= $data['info']['id'] ?>">ยกเลิก</a>
    </form>
</body>
</html>