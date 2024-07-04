<?php
require_once 'server.php';

if (isset($_POST['create'])) {
    $device = $_POST["projectname"];
    $board  = $_POST["board"];

    if (empty($device)) {
        $_SESSION['error'] = 'กรุณาสร้างชื่ออุปกรณ์';
        header("location: /io_gateway/device.php");
        exit;
    } elseif (preg_match('/\s/', $device)) {
        $_SESSION['error'] = 'ชื่ออุปกรณ์ไม่สามารถมีช่องว่างได้';
        header("location: /io_gateway/device.php");
        exit;
    } elseif (mb_strlen($device, 'UTF-8') > 12) {
        $_SESSION['error'] = 'ชื่ออุปกรณ์ไม่สามารถเกิน 10 ตัวอักษร';
        header("location: /io_gateway/device.php");
        exit;
    } elseif (preg_match('/[^a-zA-Z0-9_\p{Thai}]/u', $device)) {
        $_SESSION['error'] = 'ชื่ออุปกรณ์ไม่สามารถมีอักขระพิเศษ';
        header("location: /io_gateway/device.php");
        exit;
    } elseif (empty($board)) {
        $_SESSION['error'] = 'กรุณาเลือกชนิดบอร์ดของคุณ';
        header("location: /io_gateway/device.php");
        exit;
    }

    $checkSQL = "SELECT * FROM device WHERE device_name = :projectname AND user_id = :user_id";
    $stmt = $conn->prepare($checkSQL);
    $stmt->bindParam(":projectname", $device);
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
    
        $_SESSION['error_message'] = "ชื่ออุปกรณ์นี้มีอยู่ในระบบแล้ว";
        header("location: /io_gateway/device.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO device(device_name, board, user_id, create_at) VALUES (:projectname, :board, :user_id, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":projectname", $device);
    $stmt->bindParam(":board", $board);
    $stmt->bindParam(":user_id", $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "สร้างอุปกรณ์สำเร็จ!";
        sleep(1);
        header("location: /io_gateway/gpio.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Error creating the device!";
        header("location: /io_gateway/device.php");
        exit;
    }
}
?>
