<?php 

    session_start();
    require_once 'server.php';

    if (isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        if (empty($firstname)) {
            $_SESSION['error'] = 'กรุณาใส่ชื่อของคุณ';
            header("location: /io_gateway/register.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณาใส่นามสกุลของคุณ';
            header("location: /io_gateway/register.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณาใส่อีเมล์ของคุณ';
            header("location: /io_gateway/register.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email format';
            header("location: /io_gateway/register.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณาใส่รหัสผ่าน';
            header("location: /io_gateway/register.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: /io_gateway/register.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณาใส่ยืนยันรหัสผ่าน';
            header("location: /io_gateway/register.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
            header("location: /io_gateway/register.php");
        } else {
       
            try {
                $check_email = $conn->prepare("SELECT email FROM user WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);
    
                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "อีเมลนี้มีอยู่แล้วในระบบ. <a href='login.php'>Click here to login.</a>";
                    header("location: /io_gateway/register.php");
                } else if (!isset($_SESSION['error'])) {
                 
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    
                    $stmt = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, token) 
                                            VALUES(:firstname, :lastname, :email, :password, :token)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":token", $token); 
    
                    $stmt->execute();
                    $_SESSION['success'] = "You have successfully applied for membership!";
                    header("location: /io_gateway/login.php");
                } else {
                    $_SESSION['error'] = "Something went wrong! Please check.";
                    header("location: /io_gateway/register.php");
                }
    
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>