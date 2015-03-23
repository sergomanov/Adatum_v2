#include <EtherCard.h>
static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x31 };
//static byte myip[] = { 192,168,100,247 };
//static byte gwip[] = { 192,168,100,1 };
#include <Wire.h> 
#include <BMP085.h>
 
BMP085 dps = BMP085();    
 
long Temperature = 0, Pressure = 0;

int ledPin  = 5;
int ledState = LOW;   
long ledpreviousMillis = 0;        // храним время последнего переключения светодиода
long ledinterval = 0;           // интервал между включение/выключением светодиода (1 секунда)
int ledcol=0;

char* mack="74-69-69-2D-30-31";


byte Ethernet::buffer[700];
static uint32_t timer;
static uint32_t timer2;

//char website[] PROGMEM = "192.168.100.2";
char website[] PROGMEM = "online.adatum.ru";

static void my_callback (byte status, word off, word len) {

Ethernet::buffer[off+500] = 0; char* SER=( char*) Ethernet::buffer + off;

//Serial.print(SER);

char *p = SER; char *str,*tpar,*par,*controld;int i=0; while ((str = strtok_r(p, "#", &p)) != NULL) {  i++; if(i==3){tpar=str;}   if(i==4){par=str;} if(i==2){controld=str;}}

  if(String(controld)==String(mack))
      {
        Serial.print("Accepted: ");Serial.print(tpar);Serial.print("#");Serial.println(par); 
        
        
              if(strcmp(tpar, "LED") == 0 )  //LED,T6DNAE0S,100,15,0,0,LED
              {
                char *stru,*par1,*par2,*par3;        int i=0;   while ((stru = strtok_r(par, ",", &par)) != NULL) {  i++; if(i==1){par1=stru;}   if(i==2){par2=stru;}  if(i==3){par3=stru;}}
                ledinterval = atoi(par1); 
                ledcol=atoi(par2);
               
                Serial.print("Accepted: *P1:");     Serial.print(par1);  Serial.print("*P2:");Serial.print(par2);Serial.print("*P3:");Serial.print(par3);Serial.println("*");  
              }
        
      } else {Serial.println("NULL");}

}




void setup () {
Serial.begin(57600);
pinMode(ledPin, OUTPUT);  
 
if (ether.begin(sizeof Ethernet::buffer, mymac) == 0)     Serial.println( "Failed to access Ethernet controller");

if (!ether.dhcpSetup())    Serial.println("DHCP failed");
 //  ether.staticSetup(myip, gwip);
  ether.printIp("IP:  ", ether.myip);  ether.printIp("GW:  ", ether.gwip);    ether.printIp("DNS: ", ether.dnsip);  

  if (!ether.dnsLookup(website))    Serial.println("DNS failed");  // для работы по днс имени

//ether.parseIp(ether.hisip, "192.168.100.2");

ether.printIp("SRV: ", ether.hisip);
 Wire.begin(); 
  delay(1000);
  dps.init();  
}




void loop () {

  
  
  
  
    //Функция мигания диодом
 unsigned long ledcurrentMillis = millis();
 if(ledcurrentMillis - ledpreviousMillis > ledinterval && ledcol > 0) {
    ledpreviousMillis = ledcurrentMillis; 
    if (ledState == LOW)      ledState = HIGH;
    else{      ledState = LOW;       ledcol=ledcol-1;}
  digitalWrite(ledPin, ledState);
  }
//Функция мигания диодом
  
  
  
  
  
  
  
  
  ether.packetLoop(ether.packetReceive()); 



  if (millis() > timer) 
  {
   timer = millis() + 5000;
    char Result[100]; sprintf(Result, "ID=%s&QQ=1", mack); 
    ether.browseUrl(PSTR("/post.php?"), Result, website, my_callback);
  }
  
    if (millis() > timer2) 
  {
   timer2 = millis() + 6000;
   dps.getPressure(&Pressure);   dps.getTemperature(&Temperature); int pres=Pressure/133.3;  int Tempe=Temperature*0.1;
   char Result[100]; sprintf(Result, "ID=%s&TEM=%d&P=%d", mack,Tempe,pres); 
   ether.browseUrl(PSTR("/post.php?"), Result, website, my_callback);
  }
  
  
  
  
  
}
