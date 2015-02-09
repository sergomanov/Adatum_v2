char Sname[] = "T6DNAE0S" ;              // серийный номер устройства в сети     
#include "etherShield.h"
#include "ETHER_28J60.h"
static uint8_t mac[6] = {0x54, 0x55, 0x58, 0x10, 0x00, 0x24};                                                              
static uint8_t ip[4] = {192, 168, 171, 2};                      
static uint16_t port = 80;     

int ledPin  = 6;
int ledState = LOW;   
long ledpreviousMillis = 0;        // храним время последнего переключения светодиода
long ledinterval = 0;           // интервал между включение/выключением светодиода (1 секунда)
int ledcol=0;

char* params;

#include "DHT.h"
#define DHTPIN 4    
#define DHTTYPE DHT11  
DHT dht(DHTPIN, DHTTYPE);
long previousMillis = 0;   // здесь будет храниться время последнего изменения состояния
long interval = 10000;      // интервал  в миллисекундах
int h = 32767;
int t = 32767;
int Pre = 32767;
int val2;
const int analogPin = 2;

ETHER_28J60 ethernet;
int collPir=0;
#include <RCSwitch.h>                         // RF подключаем библиотеку
RCSwitch mySwitch = RCSwitch();               // RF  приёмник
unsigned long rf_dt;
long RBlength;
long RDelay;
char Styped[100];
char Suid[100];
char Spar1[100];
char Spar2[100];
char Spar3[100];
char Spar4[100];
char Stypep[100];
unsigned long Gr1[6]={0,0,0,0,0,0};
long Gr2[6]={0,0,0,0,0,0};
long Gr3[6]={0,0,0,0,0,0};

int speakerOut = 5;
long beepprevious = 0;  
unsigned long beepcurrent =0;
long beeptone;



int val3=0;
int pirVal=0;
int pirPin = 9; 
int Pird = 0;

long previousMillis2 = 0;   // здесь будет храниться время последнего изменения состояния
long interval2 = 10000;      // интервал  в миллисекундах
int beepval;
int val;
int sensorPinRR = A1;                           // устанавливаем входную ногу для АЦП
int mq9;

int lumen,l,lum;
int sensorPin = A0;                           // устанавливаем входную ногу для АЦП
int lumenha=0;

#include <Wire.h> 
#include <BMP085.h>
BMP085 dps = BMP085();    
long Temperature = 0, Pressure = 0;


void setup()
{ 
  ethernet.setup(mac, ip, port);
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT);  
   pinMode(speakerOut, OUTPUT);
  dht.begin();
  mySwitch.enableReceive(1);                // Приемник RF 0 => это pin #3 
  mySwitch.enableTransmit(7);               // Передатчик RF is connected
  mySwitch.setRepeatTransmit(5);            // Передатчик RF setRepeatTransmit
   Wire.begin(); 
  delay(1000);
  dps.init();  
}

void loop()
{
  
  
  //Функция мигания диодом
 unsigned long ledcurrentMillis = millis();
 if(ledcurrentMillis - ledpreviousMillis > ledinterval && ledcol > 0) {
    ledpreviousMillis = ledcurrentMillis; 
    if (ledState == LOW)      ledState = HIGH;
    else{      ledState = LOW;       ledcol=ledcol-1;}
  digitalWrite(ledPin, ledState);
  }
//Функция мигания диодом

//Датчик света    
  lumen = analogRead(sensorPin);
  if(lum > 0){  l = analogRead(sensorPin);  if (abs((lum-l)/10)>10)  {     lumenha=l/10l;   lum=0;}  }   else    {      lum = analogRead(sensorPin);    }
//Датчик света    

  
  
  // пищалка 
   beepcurrent = millis(); 
 if(beepcurrent < beepprevious) 
      {        
    digitalWrite(speakerOut,HIGH);  
    delayMicroseconds(beeptone / 2);   
    digitalWrite(speakerOut, LOW);   
    delayMicroseconds(beeptone / 2);
    
           }
  // пищалка  
  
  
  
 
  
 //Датчик шума    
  if (beepval>0){  val = analogRead(analogPin);  if (abs((beepval-val)/10)>5)   {    val3=val/10;  beepval = 0;       }  } else {beepval = analogRead(analogPin);}
 //Датчик шума
  
  
  
  
// запрос по интернету  
if (params = ethernet.serviceRequest())
      {
   
 char *p = params; char *str,*typed,*uid,*par1,*par2,*par3,*par4,*typep;
 int i=0; while ((str = strtok_r(p, ",", &p)) != NULL) 
{  i++;   if(i==1){typed=str;}   if(i==2){uid=str;}   if(i==3){par1=str;}   if(i==4){par2=str;}   if(i==5){par3=str;}   if(i==6){par4=str;}   if(i==7){typep=str;}}
    
   
  if(String(typed)==String(typep))  
    {

      
      
 if(strcmp(uid, Sname) == 0 && strcmp(typed, "LED") == 0 )  //LED,T6DNAE0S,100,15,0,0,LED
    {
    ledinterval = atoi(par1);          
    ledcol=atoi(par2);
    ethernet.print("SEND,");  ethernet.print(Sname); ethernet.print(",0,0,0,LED,SEND;");        
    }


 if(strcmp(uid, Sname) == 0 && strcmp(typed, "MU") == 0 )  // MU,T6DNAE0S,100,100,0,0,MU


    {  
        
     ethernet.print("SEND,");  ethernet.print(Sname);ethernet.print(",");ethernet.print(par1);ethernet.print(",");ethernet.print(par2);ethernet.print(",0,MU,SEND;");
           

      beeptone=atoi(par1);
      beepprevious = millis()+atoi(par2); 
    } 








  
    if(strcmp(uid, Sname) == 0 && strcmp(typed, "RF") == 0 )  //RF,T6DNAE0S,2683960,24,300,0,RF
    {
      
      mySwitch.setPulseLength(atol(par3)-64); 
      mySwitch.send(atol(par1), atol(par2));    
      mySwitch.resetAvailable();  
      ethernet.print("SEND,");  ethernet.print(Sname);ethernet.print(",");ethernet.print(par1);ethernet.print(",");ethernet.print(par2);ethernet.print(",");ethernet.print(par3);ethernet.print(",RF,SEND;");  
         
     
      
     }    
    
      
      if(strcmp(uid, Sname) == 0 && strcmp(typed, "QA") == 0 && h != 32767 && t != 32767)  //QA,T6DNAE0S,0,0,0,0,QA
    {
      ethernet.print("TEM,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(t); ethernet.print(",0,0,0,TEM;");   
      ethernet.print("HUM,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(h); ethernet.print(",0,0,0,HUM;");  
      ethernet.print("PRE,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(Pre); ethernet.print(",0,0,0,PRE;");   
      ethernet.print("MQ9,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(mq9); ethernet.print(",0,0,0,MQ9;");   
      ethernet.print("LUM,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(lumen); ethernet.print(",0,0,0,LUM;");
      ethernet.print("BEEP,"); ethernet.print(Sname); ethernet.print(","); ethernet.print(val2/10); ethernet.print(",0,0,0,BEEP;");    
      
    }       
 
      if(strcmp(uid, Sname) == 0 && strcmp(typed, "QUIZ") == 0)  //QUIZ,T6DNAE0S,0,0,0,0,QUIZ
    {
   
if(collPir!=0) {ethernet.print("PIR,"); ethernet.print(Sname); ethernet.print(",1,0,0,0,PIR;"); ; collPir=0;}     
      
if(Gr1[0]!=0){  char Z0[20]; sprintf(Z0, "%ld", Gr1[0] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z0);ethernet.print(",");ethernet.print(Gr2[0]);ethernet.print(",");ethernet.print(Gr3[0]);ethernet.print(",0,RF;");   Gr1[0]=0; } 
if(Gr1[1]!=0){  char Z1[20]; sprintf(Z1, "%ld", Gr1[1] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z1);ethernet.print(",");ethernet.print(Gr2[1]);ethernet.print(",");ethernet.print(Gr3[1]);ethernet.print(",0,RF;");   Gr1[1]=0; } 
if(Gr1[2]!=0){  char Z2[20]; sprintf(Z2, "%ld", Gr1[2] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z2);ethernet.print(",");ethernet.print(Gr2[2]);ethernet.print(",");ethernet.print(Gr3[2]);ethernet.print(",0,RF;");   Gr1[2]=0; } 
if(Gr1[3]!=0){  char Z3[20]; sprintf(Z3, "%ld", Gr1[3] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z3);ethernet.print(",");ethernet.print(Gr2[3]);ethernet.print(",");ethernet.print(Gr3[3]);ethernet.print(",0,RF;");   Gr1[3]=0; } 
if(Gr1[4]!=0){  char Z4[20]; sprintf(Z4, "%ld", Gr1[4] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z4);ethernet.print(",");ethernet.print(Gr2[4]);ethernet.print(",");ethernet.print(Gr3[4]);ethernet.print(",0,RF;");   Gr1[4]=0; } 
if(Gr1[5]!=0){  char Z5[20]; sprintf(Z5, "%ld", Gr1[5] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z5);ethernet.print(",");ethernet.print(Gr2[5]);ethernet.print(",");ethernet.print(Gr3[5]);ethernet.print(",0,RF;");   Gr1[5]=0; } 

 
if(val3!=0)    {ethernet.print("BEEP,"); ethernet.print(Sname); ethernet.print(","); ethernet.print(val3); ethernet.print(",0,0,0,BEEP;");    val3=0;}   
if(lumenha!=0)    {ethernet.print("LUM,"); ethernet.print(Sname); ethernet.print(","); ethernet.print(lumenha); ethernet.print(",0,0,0,LUM;");    lumenha=0;}   

    }       
  
      }
        ethernet.respond();
      }
  // запрос по интернету  
  
  
  
  
 // Радио датчик
if (mySwitch.available()>0 ) 
{  

    rf_dt=mySwitch.getReceivedValue();
    RBlength = mySwitch.getReceivedBitlength();
    RDelay = mySwitch.getReceivedDelay();

    if(Gr1[0]==0){Gr1[0]=rf_dt;Gr2[0]=RBlength;Gr3[0]=RDelay;}
    if(Gr1[1]==0&&Gr1[0]!=0&&Gr1[0]!=rf_dt){Gr1[1]=rf_dt;Gr2[1]=RBlength;Gr3[1]=RDelay;}
    if(Gr1[2]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt){Gr1[2]=rf_dt;Gr2[2]=RBlength;Gr3[2]=RDelay;}
    if(Gr1[3]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt){Gr1[3]=rf_dt;Gr2[3]=RBlength;Gr3[3]=RDelay;}
    if(Gr1[4]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[3]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt&&Gr1[3]!=rf_dt){Gr1[4]=rf_dt;Gr2[4]=RBlength;Gr3[4]=RDelay;}
    if(Gr1[5]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[3]!=0&&Gr1[4]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt&&Gr1[3]!=rf_dt&&Gr1[4]!=rf_dt){Gr1[5]=rf_dt;Gr2[5]=RBlength;Gr3[5]=RDelay;}

   mySwitch.resetAvailable(); 
}
// Радио датчик 




  
// опрос датчиков раз в 10 секунд
       if (millis() - previousMillis > interval) 
       {        
       previousMillis = millis(); 
       val2 = analogRead(analogPin); 
       h = dht.readHumidity();
 //      t = dht.readTemperature();
       mq9 = analogRead(sensorPinRR);
      
      dps.getPressure(&Pressure); 
      dps.getTemperature(&Temperature);
 
t=Temperature*0.1;
Pre=Pressure/133.3;


       }
  // опрос датчиков раз в 10 секунд
  
  
  
  
// опрос датчика движения
       pirVal = digitalRead (pirPin); 
       if(pirVal==1){Pird=1;}
      if (millis() - previousMillis2 > interval2) {   previousMillis2 = millis();        if(Pird==1){collPir=1;Pird=0;}       }
// опрос датчика движения
  
  
  
  
  
  delay(10);
}

