<?php
require_once 'server.php';

$gpio_id = isset($_GET['gpio_id']) ? $_GET['gpio_id'] : null;
$device_id = isset($_GET['device_id']) ? $_GET['device_id'] : null;

$response = ['canDelete' => false, 'message' => 'Invalid request'];

if ($gpio_id) {

    $query = $conn->prepare("SELECT * FROM detail WHERE gpio_id = :gpio_id");
    $query->bindParam(":gpio_id", $gpio_id);
    $query->execute();
    $dependency = $query->fetch(PDO::FETCH_ASSOC);


    $querySensor = $conn->prepare("SELECT * FROM sensor WHERE gpio_id = :gpio_id");
    $querySensor->bindParam(":gpio_id", $gpio_id);
    $querySensor->execute();
    $sensorDependency = $querySensor->fetch(PDO::FETCH_ASSOC);

    if (!$dependency && !$sensorDependency) {
        $response = ['canDelete' => true, 'message' => 'GPIO สามารถลบได้'];
    } else {
        $response = ['canDelete' => false, 'message' => 'GPIO ใช้งานอยู่ไม่สามารถลบได้'];
    }
} elseif ($device_id) {
    
    $query = $conn->prepare("SELECT * FROM gpio WHERE device_id = :device_id");
    $query->bindParam(":device_id", $device_id);
    $query->execute();
    $dependency = $query->fetch(PDO::FETCH_ASSOC);

    if (!$dependency) {
        $response = ['canDelete' => true, 'message' => 'อุปกรณ์สามารถลบได้'];
    } else {
        $response = ['canDelete' => false, 'message' => 'อุปกรณืมีการเชื่อมโยงข้อมูลอยู่ไม่สามารถลบได้'];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
