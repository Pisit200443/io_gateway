<?php 
require_once 'server.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล์';
        header("location: /io_gateway/login.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header("location: /io_gateway/login.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: /io_gateway/login.php");
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $check_data->bindParam(":email", $email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if ($row['status'] == 1) { 
                    if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['user_id'] = $row['user_id'];
                            header("location: /io_gateway/index.php");
                        } else {
                            $_SESSION['error'] = 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง';
                            header("location: /io_gateway/login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง';
                        header("location: /io_gateway/login.php");
                    }
                } else {
                    $_SESSION['error'] = 'โปรดยืนยันอีเมล์ของคุณก่อนใช้งาน';
                    header("location: /io_gateway/login.php");
                }
            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลผู้ใช้อยู่ในระบบ";
                header("location: /io_gateway/login.php");
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
