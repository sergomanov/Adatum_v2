#include <EtherCard.h>
  #include "DHT.h"
  #define DHTPIN 3     // what pin we're connected to
  #define DHTTYPE DHT11   // DHT 11 
  DHT dht(DHTPIN, DHTTYPE);
#define REQUEST_RATE 600000 // milliseconds (10 минут)
static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x71 };
char* mack="74-69-69-2D-30-71";     
static byte myip[] = { 192,168,0,109 };
static byte gwip[] = { 192,168,0,232 };
static byte hisip[] = { 192,168,0,100 };
char website[] PROGMEM = "192.168.0.100";
byte Ethernet::buffer[300];  
static long timer;


static void my_result_cb (byte status, word off, word len) {
  Serial.print("<<< reply ");
  Serial.print(millis() - timer);
  Serial.println(" ms");
  Serial.println((const char*) Ethernet::buffer + off);
}

void setup () {
  Serial.begin(57600);
    dht.begin();
  Serial.println("\n[getStaticIP]");
  
  if (ether.begin(sizeof Ethernet::buffer, mymac, 10) == 0)  Serial.println( "Failed to access Ethernet controller");

  ether.staticSetup(myip, gwip);
  ether.copyIp(ether.hisip, hisip);
  ether.printIp("Server: ", ether.hisip);

  while (ether.clientWaitingGw())    ether.packetLoop(ether.packetReceive());
  Serial.println("Gateway found");
  
  timer = - REQUEST_RATE; // start timing out right away
}


void loop () {
  ether.packetLoop(ether.packetReceive());
  
  if (millis() > timer + REQUEST_RATE) {        timer = millis();
    int h = dht.readHumidity();  int t = dht.readTemperature();  if (isnan(t) || isnan(h)) {    Serial.println("Failed to read from DHT");  } else {   Serial.print("HUM:"); Serial.println(h);   Serial.print("TEM:");Serial.println(t);  } 
        int zn_lum = analogRead(A0);  Serial.print("LUM:");  Serial.println(zn_lum);
        int zn_mic = analogRead(A6);  Serial.print("MIC:"); Serial.println(zn_mic);
        char Result[100]; sprintf(Result, "ID=%s&TEM=%d&HUM=%d&LUM=%d&MIC=%d", mack,t,h,zn_lum,zn_mic);   Serial.print(Result);
    Serial.println("\n>>> REQ");
    ether.browseUrl(PSTR("/post.php?"), Result, website, my_result_cb);
  }
}
