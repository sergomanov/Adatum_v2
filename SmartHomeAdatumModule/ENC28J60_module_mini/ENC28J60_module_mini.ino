  #include <EtherCard.h>
  #define CS_PIN       10
  #include "DHT.h"
  #define DHTPIN 3     // what pin we're connected to
  #define DHTTYPE DHT11   // DHT 11 
  DHT dht(DHTPIN, DHTTYPE);
  static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x99 };
//  static byte myip[] = { 192,168,0,109 };                     //закоментировать для  работы поDHCP
 // static byte gwip[] = { 192,168,0,232 };                     //закоментировать для  работы поDHCP

  char* mack="74-69-69-2D-30-99";  
  byte Ethernet::buffer[700];
  static uint32_t timer;
  char website[] PROGMEM = "online.adatum.ru";
  
void(* resetFunc) (void) = 0;

static void my_callback (byte status, word off, word len) {
//  Serial.println(">>>");  Ethernet::buffer[off+300] = 0;  Serial.print((const char*) Ethernet::buffer + off); 
Serial.println("...");
}

void setup () {
  Serial.begin(57600);
  dht.begin();
  Serial.println("\n[connecting online.adatum.ru ...]");
  if (ether.begin(sizeof Ethernet::buffer, mymac, CS_PIN) == 0)  {   Serial.println( "Failed to access Ethernet controller"); resetFunc();}
//  ether.staticSetup(myip, gwip);                              //закоментировать для  работы поDHCP
  if (!ether.dhcpSetup())   { Serial.println("DHCP failed"); resetFunc();}//раскоментировать для работы по DHCP
  ether.printIp("IP:  ", ether.myip);
  ether.printIp("GW:  ", ether.gwip);  
  ether.printIp("DNS: ", ether.dnsip);  
  if (!ether.dnsLookup(website)) {   Serial.println("DNS failed");  resetFunc(); }
  ether.printIp("SRV: ", ether.hisip);
}

void loop () {
  ether.packetLoop(ether.packetReceive()); 

  if (millis() > timer) {
  timer = millis() + 60000;
  int h = dht.readHumidity();  int t = dht.readTemperature();  if (isnan(t) || isnan(h)) {    Serial.println("Failed to read from DHT");  } else {   Serial.print("HUM:"); Serial.println(h);   Serial.print("TEM:");Serial.println(t);  } 
  int zn_lum = analogRead(A0);  Serial.print("LUM:");  Serial.println(zn_lum);
  int zn_mic = analogRead(A6);  Serial.print("MIC:"); Serial.println(zn_mic);
  char Result[100]; sprintf(Result, "ID=%s&TEM=%d&HUM=%d&LUM=%d&MIC=%d", mack,t,h,zn_lum,zn_mic); 
   Serial.print(Result);
   ether.browseUrl(PSTR("/post.php?"), Result, website, my_callback);
  }
}
