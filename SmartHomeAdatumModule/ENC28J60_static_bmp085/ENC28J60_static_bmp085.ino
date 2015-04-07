#include <EtherCard.h>
#include <Wire.h> 
#include <BMP085.h>
 
BMP085 dps = BMP085();    
 
long Temperature = 0, Pressure = 0;

#define REQUEST_RATE 60000 // milliseconds

static byte mymac[] = { 0x78,0xDD,0x69,0x2D,0x30,0xF2 };
char* mack="78-DD-69-2D-30-F2"; 

static byte myip[] = { 192,168,0,109 };
static byte gwip[] = { 192,168,0,232 };
 
char website[] PROGMEM = "online.adatum.ru";

byte Ethernet::buffer[300];  
static long timer;

static void my_result_cb (byte status, word off, word len) {
  Serial.print("<<< reply ");
  Serial.print(millis() - timer);
  Serial.println(" ms");
  Serial.println((const char*) Ethernet::buffer + off);
}

void(* resetFunc) (void) = 0;

void setup () {
  Serial.begin(57600);
  Serial.println("\n[online.adatum.ru]");
  
  if (ether.begin(sizeof Ethernet::buffer, mymac) == 0) {    Serial.println( "Failed to access Ethernet controller"); resetFunc();  }

  ether.staticSetup(myip, gwip);


  if (!ether.dnsLookup(website))  {  Serial.println("DNS failed");resetFunc(); }

  ether.printIp("Server: ", ether.hisip);
  
  timer = - REQUEST_RATE; // start timing out right away
  Wire.begin(); 
  delay(1000);
  dps.init(); 
}

void loop () {
  ether.packetLoop(ether.packetReceive());
  
 if (millis() > timer + REQUEST_RATE) {
 timer = millis();
 dps.getPressure(&Pressure); 
 dps.getTemperature(&Temperature);
 int pres=Pressure/133.3;  int Tempe=Temperature*0.1;
 int zn_lum = analogRead(A0);   int zn_mic = analogRead(A6); 
  
    char Result[100]; sprintf(Result, "ID=%s&TEM=%d&P=%d&LUM=%d&MIC=%d", mack,Tempe,pres,zn_lum,zn_mic);   Serial.print(Result);
    ether.browseUrl(PSTR("/post.php?"), Result, website, my_result_cb);
  }
}
