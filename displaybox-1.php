<?php 
    require_once 'controllers/server.php';
    if (!isset($_SESSION['user_id'])) {
        // $_SESSION['error'] = 'Please log in!';
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
    width: 800px;
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
    margin-bottom: 6px;
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
    border-radius: 50px;  
    padding: 10px 30px; 
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
    padding: 8px 16px;  
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 14px; 
}
.nextButton:hover {
    background-color: #0056b3;
}

.backButton {
    background-color: #6c757d;
    color: white;
    padding: 8px 16px;  
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 14px; 
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
    overflow-x: auto;  
}
code {
    font-family: 'Courier New', Courier, monospace;  
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
            <p>ในหน้านี้จะแสดงข้อมูลการจับคู่ของ 2 อุปกรณ์ ผู้ใช้งานสามารถเขียนโค้ดจากฝั่ง Arduino เพื่อทำการส่งข้อมูลมาที่เว็บ "IO Gateway" โดยสิ่งที่ผู้ใช้งานควรเตรียมให้พร้อม คือ ESP8266 จำนวน 2 บอร์ด <br>ผู้ใช้งานสามรถนำโค้ดที่เราจัดเตรียมไว้ไปใช้งานได้เพียงเปลี่ยนค่าที่ทางเราคอมเม้นต์ไว้ตามการใช้งานของท่านได้อย่างอิสระ</p>
            <h3>สิ่งที่ต้องเตรียม</h3>
            <ul>
                <li>ESP8266 boards (x2)</li>
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
    <h1>รายละเอียดโค้ด(โค้ดทางฝั่งINPUT)</h1>
    <h3>โค้ดนี้ใช้ ESP8266 ในการอ่านสถานะของสวิทช์หรือปุ่มกด  ตัวที่ต่อกับพิน จากนั้นมันจะส่งสถานะของปุ่มไปยังเซิร์ฟเวอร์ที่ URL ที่กำหนด ผ่าน HTTP POST request หน้าที่ของแต่ละส่วนของโค้ดคือดังนี้:</h3>
    <h3>setup()</h3>
            <ol>
            <li>ตั้งค่าสวิทช์หรือปุ่มที่เชื่อมต่อกับพินให้ทำหน้าที่เป็นอินพุตแบบ pull-up</li>
            <li>อัรอเชื่อมต่อ WiFi และแสดงข้อความเมื่อเชื่อมต่อสำเร็จ</li>
  </ol>
     <h3>sendData()</h3>
     <ol>
            <li>สร้าง HTTP POST request และส่งข้อมูล devicename, gpio, status, และ usertoken ไปยังเซิร์ฟเวอร์</li>
            <li>รับและแสดง HTTP response code และ response body</li>
  </ol>
  <h3>loop()</h3>
     <ol>
            <li>ตรวจสอบว่า WiFi ยังคงเชื่อมต่ออยู่</li>
            <li>อ่านและส่งสถานะของสวิทช์หรือปุ่มที่เชื่อมต่อกับพินที่เรากำหนดไปยังเซิร์ฟเวอร์</li>
            <li>หน่วงเวลา 500 ms ระหว่างการส่งสถานะของแต่ละปุ่ม</li>
            <li>หน่วงเวลา 2 วินาทีหลังจากส่งสถานะของปุ่มทั้งหมด</li>
  </ol>

    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>
<div class="page hidden" id="page5">
<h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งINPUT)</h1>
    <h3>กำหนดขา GPIO ตามขาที่คุณเลือกไว้ เช่น (D1, D2, D4) ที่ใช้เชื่อมต่อกับสวิตช์</h3>
    <pre><code>
#define SWITCH_PIN1 D1
#define SWITCH_PIN2 D2
#define SWITCH_PIN4 D4
    </code></pre>
    <h3>การตั้งค่าเริ่มต้น</h3>
    <pre><code>
void setup() {
 Serial.begin(115200);// เปิด Serial ที่ baud rate 115200
  pinMode(SWITCH_PIN1, INPUT_PULLUP);//กำหนดโหมดขา GPIO ให้เป็น INPUT_PULLUP
    ...
 WiFi.begin(ssid, password);//สั่งให้ ESP8266 เชื่อมต่อ WiFi
    ...
}
    </code></pre>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>
<div class="page hidden" id="page6">
<h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งINPUT)</h1>
    <h3>ฟังก์ชัน sendData(const char* gpio, const String& status) ในโค้ดนี้ทำหน้าที่ส่งข้อมูลผ่าน HTTP POST request ไปยังเซิร์ฟเวอร์</h3>
    <pre><code>
    void sendData(const char* gpio, const String& status) {
    HTTPClient http;
    WiFiClient client;

    String completeUrl = String(serverBaseUrl) + String(apiEndpoint);
    http.begin(client, completeUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String postData = "devicename=" + String(devicename) 
      + "&gpio=" + gpio + "&status=" + status 
      + "&usertoken=" + String(YOUR_USER_TOKEN);
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
    </code></pre>
    <ol>
     <li>HTTPClient http; WiFiClient client;: สร้างอ็อบเจ็กต์ http และ client จากคลาส </li>
     <li>http.begin(client, completeUrl);: บอกอ็อบเจ็กต์ http ให้เริ่มต้นการเชื่อมต่อไปยัง URL ที่ระบุ</li>
     <li>String postData = สร้างสตริง postData ที่รวมข้อมูลทั้งหมดที่จะส่งไปในรูปแบบ application/x-www-form-urlencoded</li>
     <li>int httpResponseCode = http.POST(postData);: ทำการส่ง HTTP POST request และเก็บรหัส HTTP response ไว้ในตัวแปร httpResponseCode</li>
            </ol>  
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>

<div class="page hidden" id="page7">
<h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งINPUT)</h1>
    <h3>ส่วนของโค้ดใน loop()</h3>
    <pre><code>
    void loop() {
    if (WiFi.status() == WL_CONNECTED) {
        sendData("D1", digitalRead(SWITCH_PIN1) ? "On" : "Off");
        delay(500); 
        sendData("D2", digitalRead(SWITCH_PIN2) ? "On" : "Off");
        delay(500);
        sendData("D3", digitalRead(SWITCH_PIN3) ? "On" : "Off");
        delay(500);
        sendData("D4", digitalRead(SWITCH_PIN4) ? "On" : "Off");
    }
    delay(2000);
    </code></pre>
    <ol>
     <li>if (WiFi.status() == WL_CONNECTED) { ... }: ตรวจสอบว่าอุปกรณ์ต่อกับ Wi-Fi สำเร็จหรือไม่ ถ้าสำเร็จ โค้ดภายในบล็อกจะถูกเรียกใช้</li>
     <li>sendData("D1", digitalRead(SWITCH_PIN1) ? "On" : "Off");: อ่านสถานะของพิน SWITCH_PIN1 และส่งข้อมูลไปยังเซิร์ฟเวอร์โดยใช้ฟังก์ชัน sendData ถ้าพินมีสถานะ HIGH (รีเทิร์น true จาก digitalRead) จะส่งสถานะ "On" ถ้าเป็น LOW จะส่ง "Off"</li>
     <li>delay(500);: หน่วงเวลา 500 มิลลิวินาที หรือครึ่งวินาที</li>
     <li>โค้ดเดิมจะถูกทำซ้ำสำหรับ SWITCH_PIN2, SWITCH_PIN3, และ SWITCH_PIN4 ตามลำดับ โดยหน่วงเวลา 500 มิลลิวินาทีหลังจากแต่ละการส่งข้อมูล</li>
     <li>delay(2000);: หน่วงเวลา 2 วินาที หลังจากที่ส่งข้อมูลทั้งหมด </li>
            </ol>  
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>


<div class="page hidden" id="page8">
  <h1>รายละเอียดโค้ด(โค้ดทางฝั่งOUTPUT)</h1>
  <h3>โค้ดนี้เป็นโค้ดของ ESP8266 ที่ใช้ในการควบคุมสถานะของ LED โดยใช้ HTTP POST request ส่งไปยังเซิร์ฟเวอร์เพื่อรับสถานะของแต่ละ LED จากนั้นเปลี่ยนสถานะของ LED ตามที่ได้รับ หน้าที่ของโค้ดแต่ละส่วนเป็นดังนี้</h3>
   <h3>setup()</h3>
            <ol>
            <li>ตั้งพินสำหรับ LED ให้เป็น OUTPUT</li>
            <li>เชื่อมต่อไวไฟ</li>
            <li>แสดงข้อความเมื่อเชื่อมต่อไวไฟสำเร็จ</li>
   </ol>
     <h3>setLEDStatus()</h3>
     <ol>
            <li>ตรวจสอบว่ามีการเชื่อมต่อ Wi-Fi หรือไม่</li>
            <li>สร้าง HTTP POST request ในรูปแบบ application/x-www-form-urlencoded</li>
            <li>ส่งข้อมูล devicename, gpio, และ usertoken ไปยังเซิร์ฟเวอร์</li>
            <li>รับสถานะ LED กลับมา (เป็น "On" หรือ "Off") แล้วตั้งค่าพินตามสถานะที่ได้รับ</li>
  </ol>
  <h3>loop()</h3>
     <ol>
            <li>โค้ดนี้จะเรียก setLEDStatus() สำหรับแต่ละ LED ด้วยการหน่วงเวลา 500 มิลลิวินาทีระหว่างแต่ละการเรียก</li>
            <li>หลังจากที่รับสถานะของ LED ทั้งหมดแล้ว จะหน่วงเวลา 1 วินาที (1000 มิลลิวินาที) ก่อนที่จะเริ่มรอบใหม่</li>
  </ol>

    <div class="button-container">
    <button class="backButton">Back</button>
      <button class="nextButton">Next</button>
   </div>
</div>

<div class="page hidden" id="page9">
  <h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งOUTPUT)</h1>
  <h3>กำหนดขา GPIO ตามขาที่คุณเลือกไว้ เช่น (D6, D5, D4) ที่ใช้เชื่อมต่อกับLED</h3>
  <pre><code>
#define LED_PIN1 D6
#define LED_PIN2 D5
#define LED_PIN3 D4
    </code></pre>
    <h3>การตั้งค่าเริ่มต้น</h3>
    <pre><code>
    void setup() {
  Serial.begin(115200);//กำหนดความเร็วในการสื่อสารผ่าน Serial port เป็น 115200 baud. การสื่อสารผ่าน Serial ใช้ในการดูข้อมูลและข้อความที่บอร์ดส่งออก
  pinMode(LED_PIN1, OUTPUT);กำหนดขา GPIO ที่เชื่อมต่อกับ LED แรก (LED_PIN1 หรือ D6) เป็น OUTPUT
  pinMode(LED_PIN2, OUTPUT);
  pinMode(LED_PIN3, OUTPUT);
  WiFi.begin(ssid, password);
  while (WiFi.status() !=  WL_CONNECTED) {//วนซ้ำในลูปนี้จนกว่าการเชื่อมต่อ Wi-Fi จะสำเร็จ
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}
    </code></pre>
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>

<div class="page hidden" id="page10">
  <h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งOUTPUT)</h1>
  <h3>ฟังก์ชัน setLEDStatus() ในโค้ดนี้มีหน้าที่ควบคุมสถานะของ LED ด้วยการส่ง HTTP POST request ไปยังเซิร์ฟเวอร์และรับค่าตอบกลับมาเพื่อตั้งค่า LED ตามที่ระบุ</h3>
  <pre><code>
  void setLEDStatus(const char* gpio, uint8_t pin) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient client;
    http.begin(client, serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    String postData = "devicename=" + String(devicename) + "&gpio=" + gpio + "&usertoken=" + String(YOUR_USER_TOKEN);
    int httpResponseCode = http.POST(postData);
    if (httpResponseCode > 0) {
      String response = http.getString();
      if (response == "On") {
        digitalWrite(pin, HIGH);
      } else if (response == "Off") {
        digitalWrite(pin, LOW);
      }
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.println("Error on HTTP request");
    }
    http.end();
  }
}
    </code></pre>
    <ol>
     <li>HTTPClient http; WiFiClient client;: สร้างอ็อบเจ็กต์ http และ client จากคลาส </li>
     <li>http.begin(client, completeUrl);: บอกอ็อบเจ็กต์ http ให้เริ่มต้นการเชื่อมต่อไปยัง URL ที่ระบุ</li>
     <li>String postData = สร้างสตริง postData ที่รวมข้อมูลทั้งหมดที่จะส่งไปในรูปแบบ application/x-www-form-urlencoded</li>
     <li>int httpResponseCode = http.POST(postData);: ทำการส่ง HTTP POST request และเก็บรหัส HTTP response ไว้ในตัวแปร httpResponseCode</li>
     <li>if (response == "On"): ถ้าข้อความตอบกลับเป็น "On" ให้ตั้งค่า LED เป็น HIGH (เปิด)</li>
     <li>else if (response == "Off"): ถ้าข้อความตอบกลับเป็น "Off" ให้ตั้งค่า LED เป็น LOW (ปิด)</li>

            </ol>  
    <div class="button-container">
    <button class="backButton">Back</button>
    <button class="nextButton">Next</button>
</div>
</div>




<div class="page hidden" id="page11">
  <h1>โค้ดที่ต้องเตรียม(โค้ดทางฝั่งOUTPUT)</h1>
  <h3>ส่วนของโค้ดในฟังก์ชัน loop() จะวนซ้ำอย่างต่อเนื่อง ทำให้สถานะของแต่ละ LED ถูกตรวจสอบและปรับเปลี่ยนตามข้อมูลที่ได้รับจากเซิร์ฟเวอร์ทุก 0.5-1 วินาที </h3>
  <pre><code>
  void loop() {
  setLEDStatus("D6", LED_PIN1);
  delay(500);
  setLEDStatus("D5", LED_PIN2);
  delay(500);
  setLEDStatus("D4", LED_PIN3);
  delay(500);
   setLEDStatus("D8", LED_PIN4);
  delay(1000);
}
    </code></pre>
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
    document.getElementById('page8'),
    document.getElementById('page9'),
    document.getElementById('page10'),
    document.getElementById('page11'),
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

