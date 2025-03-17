<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // โหลด XML ที่ใช้เก็บข้อมูลบัญชี
    $xml = simplexml_load_file("users.xml");

    // ค้นหาผู้ใช้ใน XML โดยใช้ XPath (ช่องโหว่)
    $query = "//user[username/text()='$username' and password/text()='$password']";
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
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
