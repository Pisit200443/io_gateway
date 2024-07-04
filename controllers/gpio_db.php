<?php
require_once 'server.php';

if (isset($_POST['create'])) {
    $gpio = $_POST["gpio"];
    $type_id = $_POST["typed"];
    $device_id = $_POST["device"];

function redirectToGPIOWithError($gpio, $errorMessage) {

    if ($errorMessage != 'กรุณาเลือกพิน' && $errorMessage != 'กรุณาเลือกอุปกรณ์' && $errorMessage != 'กรุณาเลือกประเภทพิน' && !empty($gpio)) {
        $_SESSION['error'] = $errorMessage . ' ' . $gpio . ' แล้ว';
    } else {
        $_SESSION['error'] = $errorMessage;
    }
    header("location: /io_gateway/gpio.php");
    exit;
}

  
    if (empty($device_id)) {
        redirectToGPIOWithError($gpio, 'กรุณาเลือกอุปกรณ์');
    } elseif (empty($gpio)) {
        redirectToGPIOWithError($gpio, 'กรุณาเลือกพิน');
    } elseif (empty($type_id)) {
        redirectToGPIOWithError($gpio, 'กรุณาเลือกประเภทพิน');
    }


$check_sql = "SELECT gpio.*, type.typename FROM gpio 
INNER JOIN type ON gpio.type_id = type.type_id 
WHERE gpio.gpio_pin = :gpio AND gpio.type_id = :typed AND gpio.device_id = :device";

$check_stmt = $conn->prepare($check_sql);
$check_stmt->bindParam(":gpio", $gpio);
$check_stmt->bindParam(":typed", $type_id);
$check_stmt->bindParam(":device", $device_id);
$check_stmt->execute();

if ($check_stmt->rowCount() > 0) {

$data = $check_stmt->fetch(PDO::FETCH_ASSOC);
$typename = $data['typename'];  
redirectToGPIOWithError($gpio, 'อุปกรณ์ที่เลือกได้ทำการเพิ่มพินประเภท ' . $typename , 'แล้ว');
    } else {
    
        $sql = "INSERT INTO gpio(gpio_pin, type_id, device_id) VALUES (:gpio, :typed, :device)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":gpio", $gpio);
        $stmt->bindParam(":typed", $type_id);
        $stmt->bindParam(":device", $device_id);

        if ($stmt->execute()) {
            $type_sql = "SELECT typename FROM type WHERE type_id = :type_id";
            $type_stmt = $conn->prepare($type_sql);
            $type_stmt->bindParam(":type_id", $type_id);
            $type_stmt->execute();
            $type = $type_stmt->fetch(PDO::FETCH_ASSOC);
        
            $typename = isset($type['typename']) ? $type['typename'] : 'Unknown';
            $_SESSION['success_message'] = 'เพิ่มพิน ' . $gpio . ' ประเภท ' . $typename . ' สำเร็จ!';
        
        } else {
            $_SESSION['error'] = 'มีบางอย่างผิดพลาด ไม่สามารถเพิ่มพินได้';
        }
        
        header("location: /io_gateway/gpio.php");
    }
}
?>
