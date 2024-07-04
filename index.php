<?php 
    require_once 'controllers/server.php';
    if (!isset($_SESSION['user_id'])) {
        // $_SESSION['error'] = 'Please log in!';
        header('location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IO Gateway</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <style>
 
  @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap');

        .contain {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         
        }
     .contain h1 {
    font-size:28px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    font-family: 'IBM Plex Sans Thai', sans-serif;
    
}
        .highlight {
            color: #007BFF;
            font-weight: bold;
            font-family: 'IBM Plex Sans Thai', sans-serif;
        }


        .con {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .con h1 {
    font-size:28px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    font-family: 'IBM Plex Sans Thai', sans-serif;
    
}      
       h2, h3 {
            color: #333;
            font-family: 'IBM Plex Sans Thai', sans-serif;
        }

        .left-align {
    text-align: left;
    position: relative;
    display: inline-block;
}
.left-align::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 5px; 
    width: 100%; 
    background-color: #007BFF; 
    border-radius: 10px;
}
    </style>
</head>
<body>
<?php
      include("navbar.php");
      include("sidebar.php");
  ?>
<div class="container" id="tambahOutput">
    <div class="contain">
        <h1 class="left-align">IOT คืออะไร?</h1>
        <br>
        <p><span class="highlight">IoT</span> ย่อมาจาก  <span class="highlight">"Internet of Things"</span> ซึ่งแปลว่า <span class="highlight">"อินเทอร์เน็ตของสิ่งของ"</span> หรือ  <span class="highlight">"เน็ตเวิร์คของสิ่งของ"</span> ในความหมายทั่วไป <span class="highlight">IoT</span> เป็นแนวคิดหรือเทคโนโลยีที่เชื่อมต่ออุปกรณ์และสิ่งของต่างๆ เข้ากับอินเทอร์เน็ต ทำให้สามารถสื่อสารและแลกเปลี่ยนข้อมูลระหว่างกันได้ โดยการส่งข้อมูลเพื่อควบคุมและติดตามอุปกรณ์ที่เชื่อมต่อผ่านเครือข่ายอินเทอร์เน็ตได้ระยะไกลผ่านเว็บแอพพลิเคชันต่างๆ ที่เกี่ยวข้อง <span class="highlight">IoT</span></p>
        <p>ปัจจุบันมีเว็บแอพพลิเคชั่นที่เปิดให้บริการในการเชื่อมต่อและควบคุมอุปกรณ์ <span class="highlight">IoT</span> มักมีการ<span class="highlight">จำกัด</span>ในการรับ - ส่งข้อมูล <span class="highlight">input</span> <span class="highlight">output</span> จากอุปกรณ์ <span class="highlight">IoT</span> ซึ่งส่งผลให้เมื่อนำไปใช้งานจริง ไม่สามารถตอบสมองตามวัตถุประสงค์ของผู้ใช้งานได้อย่างครบถ้วนตามขอบเขตของงาน</p>
    </div>
    <div class="con">
        <h1 class="left-align">IO Gateway คืออะไร?</h1>
        <br>
        <p><span class="highlight">IO Gateway</span> เป็นเว็บแอพพลิเคชั่นแพลตฟอร์ม <span class="highlight">IoT</span> ที่ถูกสร้างขึ้นเพื่อแก้ปัญหาการจำกัดในการรับ - ส่งข้อมูล โดย <span class="highlight">IO gateway</span> ทำหน้าที่เป็นตัวกลางคล้ายเว็บรับฝากข้อมูลจากอุปกรณ์ฝั่ง <span class="highlight">input</span> เพื่อให้อุปกรณ์ในฝั่ง <span class="highlight">output</span> รับข้อมูลไปใช้งาน อีกทั้งมีการแสดงค่าสถานะต่างๆของอุปกรณ์เพื่อให้สะดวกต่อการใช้งาน ทั้งในฝั่งของ <span class="highlight">input</span> และ <span class="highlight">output</span> ด้วยความสามารถนี้ผู้ใช้สามารถส่งค่าเพื่อควบคุมอุปกรณ์ <span class="highlight">IoT</span> ผ่านเว็บแอปพลิเคชันได้อย่างอิสระตามวัตถุประสงค์ของผู้ใช้</p>
       
    </div>
 </div>
</body>

</html>