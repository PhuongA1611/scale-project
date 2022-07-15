#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "Canh Hoa Dao-T2"; //wifi ssid / wifi name
const char* password = "0395745100"; //wifi password

String serverName = "http://192.168.23.104:8080/candientu/postdata.php?weight=";

// thời gian đo bằng ms
unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
//unsigned long timerDelay = 600000;
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 10;
String berat; // biến giá trị cân nhận đc đo bằng gam

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password); //chuyển đổi esp sang chế độ station
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { // check kết nối
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP()); // lấy địa chỉ IP của ESP station
 
  Serial.println("Mất 5s để đọc lần đầu");
}

void loop() {
  if ((millis() - lastTime) > timerDelay) { //refresh
    //Check WiFi connection status
    if(WiFi.status()== WL_CONNECTED){
      WiFiClient client; //khai báo đối tượng lớp WiFiClient
      HTTPClient http;  //truy vấn các http

      receive_data(); // nhận dữ liệu cân được

      String serverPath = serverName + berat;
      Serial.println(serverPath);
      
      // Your Domain name with URL path or IP address with path
      http.begin(client, serverPath);
      
      // Send HTTP GET request
      int httpResponseCode = http.GET(); //lấy thông tin từ server
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload); // đọc phản hồi
        Serial.println(serverPath);
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}
void receive_data(){
if(Serial.available()){
    String RxBuffer="";
    while(Serial.available()){
      RxBuffer = Serial.readString();//Đọc tất cả bộ đệm
      Serial.println("recieve");
      Serial.println(RxBuffer);
    }
    berat = RxBuffer;
  }
}
