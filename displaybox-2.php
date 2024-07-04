<?php 
    require_once 'controllers/server.php';
    if (!isset($_SESSION['user_id'])) {
        header('location: login.php');
    }

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show and Close Display Box</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai&display=swap');

.display-box {
    display: none;
    background: linear-gradient(135deg, #ffffff, #f3f5f7);
    border-radius: 12px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -60%) scale(0.9);
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.1);
    transition: opacity 0.4s, transform 0.4s;
    opacity: 0;
    width:800px;
    height: 660px;
     position: absolute;

     z-index: 1001;
}

pre {
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 16px;
    overflow-x: auto; 
    overflow-y: auto; 
    max-height: 200px; 
}

.display-box.show {
    display: block;
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}
.display-box p {
    font-size: 15px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    font-family: 'Noto Sans Thai', sans-serif;

}

.display-box h1 {
    font-size:21px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    font-family: 'Noto Sans Thai', sans-serif;
    
}
.display-box h3 {
    font-size:17px;
    color: #333;
    line-height: 1.5;
    margin-bottom: 20px;
    font-family: 'Noto Sans Thai', sans-serif;

    
}
.display-box li {
    font-size:16px;
    color: #333;
    line-height: 1.5;
    margin-bottom: 5px;
    font-family: 'Noto Sans Thai', sans-serif; 
}
.close-button {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #aaa;
    transition: color 0.3s, transform 0.3s;
}

.close-button:hover {
    color: #777;
    transform: rotate(90deg);
}

#toggleButton {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    border-radius: 50px;  /* Adjusted for a pill-like button */
    padding: 10px 30px;  /* More spacing */
    font-size: 16px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
}

#toggleButton:hover {
    background: linear-gradient(135deg, #0056b3, #003f8a);
    box-shadow: 0 5px 15px rgba(0, 56, 179, 0.2);
    transform: translateY(-3px);
}

.hidden {
    display: none;
}

.nextButton {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;  /* ลดขนาดและขอบของปุ่ม */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 14px;  /* ลดขนาดตัวอักษร */
}
.nextButton:hover {
    background-color: #0056b3;
}
/* ตกแต่งปุ่ม Back */
.backButton {
    background-color: #6c757d;
    color: white;
    padding: 8px 16px;  /* ลดขนาดและขอบของปุ่ม */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 14px;  /* ลดขนาดตัวอักษร */
}
.backButton:hover {
    background-color: #5a6268;
}

pre {
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 16px;
    overflow-x: auto;  /* แสดงแถบเลื่อนถ้าโค้ดยาวเกินไป */
}
code {
    font-family: 'Courier New', Courier, monospace;  /* ตัวอักษรสำหรับโค้ด */
    color: #333;
    font-size: 16px;
}

.button-container {
    position: absolute;
    bottom: 0;
    right: 0;
    margin: 20px;
}



    </style>
</head>
<body>
    

    <div class="display-box" id="displayBox">
        <button class="close-button" id="closeButton">&times;</button>



        <div class="page" id="page1">
            <h1>ขั้นตอนการใช้งาน</h1>
            <p>ในหน้านี้จะแสดงข้อมูลของอุปกรณ์ ผู้ใช้งานสามารถเขียนโค้ดจากฝั่ง Arduino เพื่อทำการส่งข้อมูลมาที่เว็บ "IO Gateway" โดยสิ่งที่ผู้ใช้งานควรเตรียมให้พร้อม คือ ESP8266 <br>ผู้ใช้งานสามรถนำโค้ดที่เราจัดเตรียมไว้ไปใช้งานได้เพียงเปลี่ยนค่าที่ทางเราคอมเม้นต์ไว้ตามการใช้งานของท่านได้อย่างอิสระ</p>
            <h3>สิ่งที่ต้องเตรียม</h3>
            <ul>
                <li>ESP8266 boards (x1)</li>
                <li>Arduino IDE</li>
            </ul>
            <h3>สิ่งที่ต้องทำ</h3>
            <ol>
            <li>แก้ไขโค้ดตามที่ทางเราวางเอาไว้</li>
            <li>อัพโหลดโค้ดจากบอร์ด ESP8266</li>
            </ol>
            <div class="button-container">
    <button class="nextButton">Next</button>
</div>
</div>




        <div class="page hidden" id="page2">
    <h1>โค้ดที่ต้องเตรียม</h1>
    <h3>นำเข้าไลบารี่ นำเข้าไลบรารี ESP8266WiFi และ ESP8266HTTPClient</h3>
    <pre><code>
#include&lt;ESP8266WiFi.h&gt;
#include&lt;ESP8266HTTPClient.h&gt;
    </code></pre>

    <h3>กำหนดค่าคงที่สำหรับ SSID และรหัสผ่านของ WiFi </h3>
    <pre><code>
const char* ssid = ""; // ใส่ชื่อ WiFi SSID ของคุณ
const char* password = ""; // ใส่รหัสผ่าน WiFi ของคุณ
    </code></pre>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


<div class="page hidden" id="page3">
       <h1>โค้ดที่ต้องเตรียม</h1>
       <h3>auth token(scriptส่วนนี้ใช้ในการติดต่อ IO Gateway) HTTP request</h3>
    <pre><code>
#define YOUR_USER_TOKEN "80913d9585c08480500ff41c57e1faa2" //โทเค็นของคุณ 
#define YOUR_DEVICENAME "dev_1" //ชื่ออุปกรณ์ของคุณ
#define SERVER_URL "http://www.iogateway.com" //webserver ของเว็บไซต์นี้
    </code></pre>
<h3>#define YOUR_USER_TOKEN</h3>
            <ul>
                <li>โทเค็นของผู้ใช้หรือ token ถูกใช้เพื่อระบุตัวตนของผู้ใช้หรืออุปกรณ์ที่ส่งข้อมูลไปยังเซิร์ฟเวอร์ ทั้งนี้เพื่อความปลอดภัยและการจัดการสิทธิ์การเข้าถึง</li>
            </ul>
            <h3>#define YOUR_DEVICENAME</h3>
            <ul>
                <li>ชื่อของอุปกรณ์ที่ใช้ส่งข้อมูล ชื่อนี้ถูกใช้เพื่อระบุอุปกรณ์ที่ส่งข้อมูล ซึ่งเป็นสิ่งที่มีประโยชน์ในการจัดการหลายอุปกรณ์</li>
            </ul>
                        <h3>#define SERVER_URL</h3> 
            <ul>
                <li>URL ของเว็บเซิร์ฟเวอร์ที่เก็บข้อมูล ข้อมูลจะถูกส่งไปยัง URL นี้ผ่าน HTTP POST request</li>
            </ul>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


<div class="page hidden" id="page4">
    <h1>รายละเอียดโค้ด</h1>
    <h3>โค้ดนี้เป็นโปรแกรม Arduino สำหรับบอร์ดที่ใช้ ESP8266 WiFi module ร่วมกับเซ็นเซอร์ความชื้นและอุณหภูมิ DHT11 (หรือ DHT รุ่นอื่นๆ ก็ได้)</h3>
    <h3>ฟังก์ชัน setup()</h3>
            <ol>
            <li>เริ่มการทำงานของเซ็นเซอร์ DHT</li>
  </ol>
     <h3>ฟังก์ชัน sendSensorData()</h3>
     <ol>
            <li>ฟังก์ชันนี้เป็นการส่งข้อมูลจากเซ็นเซอร์ไปยังเว็บเซิร์ฟเวอร์ผ่าน HTTP POST request.</li>
  </ol>
  <h3>ฟังก์ชัน loop()</h3>
     <ol>
            <li>อ่านข้อมูลความชื้น (h) และอุณหภูมิ (t) จากเซ็นเซอร์</li>    
            <li>ส่งข้อมูลไปยังเว็บเซิร์ฟเวอร์ หากข้อมูลที่อ่านได้ถูกต้อง</li>
  </ol>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


<div class="page hidden" id="page5">
    <h1>โค้ดที่ต้องเตรียม</h1>
    <h3>การเรียกใช้ไลบรารี</h3>
    <pre><code>
#include&lt;ESP8266WiFi.h&gt;
#include&lt;ESP8266HTTPClient.h&gt;
#include&lt;DHT.h&gt;
</code></pre>
     <h3>การกำหนดเซ็นเซอร์ DHT</h3>
<pre><code>
#define DHTPIN D4 //ขาที่ต่อจากเซนเซอร์
#define DHTTYPE DHT11 //ชนิดเซนเซอร์ dht ของคุณ
DHT dht(DHTPIN, DHTTYPE);
</code></pre>

  <h3>กำหนดให้เซ็นเซอร์ DHT ต่อที่ขา D4 และเป็นประเภท DHT11</h3>
  <p>ไลบรารีที่ใช้ในการเชื่อมต่อ WiFi, ใช้ HTTP client, และอ่านข้อมูลจากเซ็นเซอร์ DHT กำหนดให้เซ็นเซอร์ DHT ในโค้ดนี้ต่อที่ขา D4 และเป็นประเภท DHT11</p>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>

<div class="page hidden" id="page6">
    <h1>โค้ดที่ต้องเตรียม</h1>
    <h3>ฟังก์ชัน setup()</h3>
    <pre><code>
    void setup() {
  Serial.begin(115200);
  dht.begin();
  WiFi.begin(ssid, password);
  while (WiFi.status() !=  WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}
</code></pre>
<p>เริ่มต้นการทำงานของ Serial Communication และเซ็นเซอร์ DHT11</p>
     <h3>ฟังก์ชัน sendSensorData()</h3>
<pre style ="max-height: 135px"><code>
void sendSensorData(const char* gpio_pin, float value) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient client;
    http.begin(client, serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  
    String postData = "devicename=" + String(devicename) + "&gpio=" + String(gpio_pin) + "&value=" + String(value) + "&usertoken=" + YOUR_USER_TOKEN;  
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.println("Error on HTTP request");
    }
    http.end();
  }
}
</code></pre>
  <p>รับข้อมูลที่จะส่ง (gpio_pin และ value) และทำการส่งข้อมูลไปยังเซิร์ฟเวอร์โดยใช้ HTTP POST request</p>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


<div class="page hidden" id="page7">
    <h1>โค้ดที่ต้องเตรียม</h1>
    <h3>ฟังก์ชัน loop()</h3>
    <pre><code>
void loop() {
 float h = dht.readHumidity();
 float t = dht.readTemperature();
  ...
  if (!isnan(h) && !isnan(t)) {
    sendSensorData("D2", h); 
    delay(5000);
    sendSensorData("D6", t); 
  } else {
    Serial.println("Failed to read from DHT sensor!");
  }
delay(30000);
}
</code></pre>
<p>วัดค่าความชื้นและอุณหภูมิจากเซ็นเซอร์ DHT11</p>
<p>ทำการอ่านค่าความชื้น (h) และอุณหภูมิ (t) จากเซ็นเซอร์ DHT11 แล้วจัดเก็บไว้ในตัวแปร h และ t ตามลำดับ</p>
<p>if (!isnan(h) && !isnan(t)): ตรวจสอบว่าค่าที่ได้จากเซ็นเซอร์ไม่เป็น NaN (Not a Number) ถ้าเป็นจริง ให้ทำการส่งข้อมูล</p>
<p>ตัวอย่าง sendSensorData("D2", h); และ sendSensorData("D6", t);: โค้ดส่วนนี้จะเรียกใช้ฟังก์ชัน sendSensorData ในการส่งค่าความชื้นและอุณหภูมิไปยังเซิร์ฟเวอร์</p>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


    </div>
    <script>
    const toggleButton = document.getElementById('toggleButton');
    const closeButton = document.getElementById('closeButton');
    const displayBox = document.getElementById('displayBox');

    toggleButton.addEventListener('click', () => {
        if (displayBox.classList.contains('show')) {
            displayBox.classList.remove('show');
        } else {
            displayBox.classList.add('show');
        }
    });

    closeButton.addEventListener('click', () => {
        displayBox.classList.remove('show');
    });

    let currentPage = 0;
const pages = [
    document.getElementById('page1'),
    document.getElementById('page2'),
    document.getElementById('page3'),
    document.getElementById('page4'),
    document.getElementById('page5'),
    document.getElementById('page6'),
    document.getElementById('page7'),

];
 
const nextButtons = document.querySelectorAll('.nextButton');
const backButtons = document.querySelectorAll('.backButton');

nextButtons.forEach((nextButton) => {
    nextButton.addEventListener('click', () => {
        pages[currentPage].classList.add('hidden');
        currentPage = (currentPage + 1) % pages.length;
        pages[currentPage].classList.remove('hidden');
    });
});

backButtons.forEach((backButton) => {
    backButton.addEventListener('click', () => {
        pages[currentPage].classList.add('hidden');
        currentPage = (currentPage - 1 + pages.length) % pages.length;
        pages[currentPage].classList.remove('hidden');
    });
});

</script>
</body>
</html>

