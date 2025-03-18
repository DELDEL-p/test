<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบว่า username และ password ไม่ว่าง
    if (empty($username) || empty($password)) {
        echo "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน!";
        exit;
    }

    // โหลด XML ที่ใช้เก็บข้อมูลบัญชี
    $xml = simplexml_load_file("users.xml");

    // **ป้องกัน XPath Injection โดยใช้ฟังก์ชัน htmlspecialchars**
    $safe_username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    // **ใช้ Hashing กับรหัสผ่านแทนการเก็บเป็น Plaintext**
    $hashed_password = hash("sha256", $password);

    // **ใช้ XPath Query ที่ปลอดภัยขึ้น**
    $query = "//user[username/text()='$safe_username' and password/text()='$hashed_password']";
    $result = $xml->xpath($query);

    if ($result) {
        echo "เข้าสู่ระบบสำเร็จ!";
    } else {
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
