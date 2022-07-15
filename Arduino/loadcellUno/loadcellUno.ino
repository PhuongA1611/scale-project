#include <SoftwareSerial.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <HX711.h>


LiquidCrystal_I2C lcd(0x27, 16, 2); // 0x27 là địa chỉ của I2C
HX711 scale;
#define button 4
const int LOADCELL_DOUT_PIN = 2;
const int LOADCELL_SCK_PIN = 3;
SoftwareSerial espSerial(5, 6); //RX, TX

int t;
int Kg;
int Gam;
String data;
void calibrate(){
  t= scale.get_units(); 
  lcd.clear();
  lcd.setCursor(2, 0);
  lcd.print("CAN DIEN TU");  
  if(t < 1000)
  {  
    lcd.setCursor(0, 1);
    lcd.print("  KL: ");  
    lcd.print(t);
    lcd.print("  Gam");
    delay(3000);
    }
  else{
      lcd.setCursor(0, 1);
      lcd.print("  KL:");  
      Kg = t/1000;
      Gam=t-Kg*1000;
      lcd.print(Kg);
      lcd.print(",");
      lcd.print(Gam);
      lcd.print(" KG");
      delay(3000);
  }
}

void setup() {
  Serial.begin(115200); // mở cổng serial với tốc độ truyền 115200
  espSerial.begin(115200);
  Wire.begin(); //Khởi tạo thư viện I2C
  pinMode(button, INPUT_PULLUP);
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  lcd.begin(); // bắt đầu kết nối vs LCD
  lcd.backlight(); // bật đèn nền của LCD
  scale.set_scale(393.4261539f);// giá trị này nhận được bằng cách hiệu chuẩn cân với các trọng lượng đã biết
  scale.tare();// đặt lại tỷ lệ thành 0
} 
void loop() {
 calibrate();
 if(digitalRead(button)==0)
    {
    scale.tare();// đặt lại tỷ lệ thành 0
    }
 data = ""+String(t);
 //Serial.print(t);
 Serial.println(data);
 espSerial.println(data); //gửi cho esp
 delay(10);
}
