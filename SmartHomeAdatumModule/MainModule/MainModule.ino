#include <IRremote.h>
IRrecv irrecv(8);
decode_results results;
char Sname[] = "T6DNAE0S" ;              // серийный номер устройства в сети     
#include "etherShield.h"
#include "ETHER_28J60.h"
static uint8_t mac[6] = {0x54, 0x55, 0x58, 0x10, 0x00, 0x24};                                                              
static uint8_t ip[4] = {192, 168, 171, 2};                      
static uint16_t port = 80;                                      

char* params;

#include "DHT.h"
#define DHTPIN 4    
#define DHTTYPE DHT11  
DHT dht(DHTPIN, DHTTYPE);
long previousMillis = 0;   // здесь будет храниться время последнего изменения состояния
long interval = 10000;      // интервал  в миллисекундах
int h = 32767;
int t = 32767;
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

char* Ir1[3]={0,0,0};
long Ir2[3]={0,0,0};
long Ir3[3]={0,0,0};

int val3=0;
int pirVal=0;
int pirPin = 9; 
long previousMillis2 = 0;   // здесь будет храниться время последнего изменения состояния
long interval2 = 1000;      // интервал  в миллисекундах
int beepval;
int val;

void setup()
{ 
  ethernet.setup(mac, ip, port);
  Serial.begin(9600);
  irrecv.enableIRIn(); // Start the receiver
  dht.begin();
  mySwitch.enableReceive(1);                // Приемник RF 0 => это pin #3 
  mySwitch.enableTransmit(7);               // Передатчик RF is connected
  mySwitch.setRepeatTransmit(5);            // Передатчик RF setRepeatTransmit
}

void loop()
{
  
    //Датчик шума    
   if (beepval>0){
  val = analogRead(analogPin);
  if (abs((beepval-val)/10)>5)
      {  
  val3=val/10;
  beepval = 0; 
      }
  } else {beepval = analogRead(analogPin);}
  //Датчик шума
  
// запрос по интернету  
   if (params = ethernet.serviceRequest())
      {
    
 char *p = params;
 char *str,*typed,*uid,*par1,*par2,*par3,*par4,*typep;
 int i=0; while ((str = strtok_r(p, ",", &p)) != NULL) 
{
  i++;
   if(i==1){typed=str;}
   if(i==2){uid=str;}
   if(i==3){par1=str;}
   if(i==4){par2=str;}
   if(i==5){par3=str;}
   if(i==6){par4=str;}
   if(i==7){typep=str;}
   
}
    
   
  if(String(typed)==String(typep))  
    {

  
    

      if(strcmp(uid, Sname) == 0 && strcmp(typed, "QA") == 0 && h != 32767 && t != 32767)  //QA,EQOX293J,0,0,0,0,QA
    {
      ethernet.print("TEM,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(t); ethernet.print(",0,0,0,TEM;");   
      ethernet.print("HUM,");  ethernet.print(Sname); ethernet.print(","); ethernet.print(h); ethernet.print(",0,0,0,HUM;");    
      ethernet.print("BEEP,"); ethernet.print(Sname); ethernet.print(","); ethernet.print(val2/10); ethernet.print(",0,0,0,BEEP;");    
    }       
 
      if(strcmp(uid, Sname) == 0 && strcmp(typed, "QUIZ") == 0)  //QUIZ,T6DNAE0S,0,0,0,0,QUIZ
    {
   
if(collPir!=0) {ethernet.print("PIR,"); ethernet.print(Sname); ethernet.print(",1,0,0,0,TEM;"); ; collPir=0;}     
      
if(Gr1[0]!=0){  char Z0[20]; sprintf(Z0, "%ld", Gr1[0] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z0);ethernet.print(",");ethernet.print(Gr2[0]);ethernet.print(",");ethernet.print(Gr3[0]);ethernet.print(",RF;");   Gr1[0]=0; } 
if(Gr1[1]!=0){  char Z1[20]; sprintf(Z1, "%ld", Gr1[1] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z1);ethernet.print(",");ethernet.print(Gr2[1]);ethernet.print(",");ethernet.print(Gr3[1]);ethernet.print(",RF;");   Gr1[1]=0; } 
if(Gr1[2]!=0){  char Z2[20]; sprintf(Z2, "%ld", Gr1[2] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z2);ethernet.print(",");ethernet.print(Gr2[2]);ethernet.print(",");ethernet.print(Gr3[2]);ethernet.print(",RF;");   Gr1[2]=0; } 
if(Gr1[3]!=0){  char Z3[20]; sprintf(Z3, "%ld", Gr1[3] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z3);ethernet.print(",");ethernet.print(Gr2[3]);ethernet.print(",");ethernet.print(Gr3[3]);ethernet.print(",RF;");   Gr1[3]=0; } 
if(Gr1[4]!=0){  char Z4[20]; sprintf(Z4, "%ld", Gr1[4] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z4);ethernet.print(",");ethernet.print(Gr2[4]);ethernet.print(",");ethernet.print(Gr3[4]);ethernet.print(",RF;");   Gr1[4]=0; } 
if(Gr1[5]!=0){  char Z5[20]; sprintf(Z5, "%ld", Gr1[5] );    ethernet.print("RF,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Z5);ethernet.print(",");ethernet.print(Gr2[5]);ethernet.print(",");ethernet.print(Gr3[5]);ethernet.print(",RF;");   Gr1[5]=0; } 

 
if(Ir2[0]!=0){ char R0[20]; sprintf(R0, "%ld", Ir2[0] );   ethernet.print("IR,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Ir1[0]);ethernet.print(",");ethernet.print(R0);ethernet.print(",");ethernet.print(Ir3[0]);ethernet.print(",RF;");      Ir2[0]=0; } 
if(Ir2[1]!=0){ char R1[20]; sprintf(R1, "%ld", Ir2[1] );   ethernet.print("IR,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Ir1[1]);ethernet.print(",");ethernet.print(R1);ethernet.print(",");ethernet.print(Ir3[1]);ethernet.print(",RF;");      Ir2[1]=0; } 
if(Ir2[2]!=0){ char R2[20]; sprintf(R2, "%ld", Ir2[2] );   ethernet.print("IR,"); ethernet.print(Sname);ethernet.print(","); ethernet.print(Ir1[2]);ethernet.print(",");ethernet.print(R2);ethernet.print(",");ethernet.print(Ir3[2]);ethernet.print(",RF;");      Ir2[2]=0; } 
     
if(val3!=0)    {ethernet.print("BEEP,"); ethernet.print(Sname); ethernet.print(","); ethernet.print(val3); ethernet.print(",0,0,0,BEEP;");    val3=0;}            
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

if(Gr1[0]==0){
Gr1[0]=rf_dt;
Gr2[0]=RBlength;
Gr3[0]=RDelay;
}
if(Gr1[1]==0&&Gr1[0]!=0&&Gr1[0]!=rf_dt){
Gr1[1]=rf_dt;
Gr2[1]=RBlength;
Gr3[1]=RDelay;
}
if(Gr1[2]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt){
Gr1[2]=rf_dt;
Gr2[2]=RBlength;
Gr3[2]=RDelay;
}
if(Gr1[3]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt){
Gr1[3]=rf_dt;
Gr2[3]=RBlength;
Gr3[3]=RDelay;
}
if(Gr1[4]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[3]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt&&Gr1[3]!=rf_dt){
Gr1[4]=rf_dt;
Gr2[4]=RBlength;
Gr3[4]=RDelay;
}
if(Gr1[5]==0&&Gr1[0]!=0&&Gr1[1]!=0&&Gr1[2]!=0&&Gr1[3]!=0&&Gr1[4]!=0&&Gr1[0]!=rf_dt&&Gr1[1]!=rf_dt&&Gr1[2]!=rf_dt&&Gr1[3]!=rf_dt&&Gr1[4]!=rf_dt){
Gr1[5]=rf_dt;
Gr2[5]=RBlength;
Gr3[5]=RDelay;
}



   mySwitch.resetAvailable(); 
}
// Радио датчик 




  
    // опрос датчиков раз в 10 секунд
       if (millis() - previousMillis > interval) 
       {        
       previousMillis = millis(); 
       val2 = analogRead(analogPin); 
       h = dht.readHumidity();
       t = dht.readTemperature();
       }
  // опрос датчиков раз в 10 секунд
  
  
  
  
// опрос датчика движения
       pirVal = digitalRead (pirPin);
       if (millis() - previousMillis2 > interval2) 
       {        
       previousMillis2 = millis();  
       if(pirVal==1){collPir=1;}
       }
// опрос датчика движения
  
  
  
// Опрос Ик приёмника  
  if (irrecv.decode(&results)) {
  if (results.value > 0 && results.value < 0xFFFFFFFF)  {     

  
  char* Dtype;  long Rbits;  long Rvalue;
   
        if (results.decode_type == NEC)      {  Dtype="NEC";  Rvalue = results.value; Rbits = results.bits;  }     
   else if (results.decode_type == SONY)     {  Dtype="SONY"; Rvalue = results.value; Rbits = results.bits;  }      
   else if (results.decode_type == RC5)      {  Dtype="RC5";  Rvalue = results.value; Rbits = results.bits;  }  
   else if (results.decode_type == RC6)      {  Dtype="RC6";  Rvalue = results.value; Rbits = results.bits;  }
   else if (results.decode_type == JVC)      {  Dtype="JVC";  Rvalue = results.value; Rbits = results.bits;  }
   else if (results.decode_type == PANASONIC){  Dtype="PAN";  Rvalue = results.value; Rbits = results.panasonicAddress;  }  



if(Ir2[0]==0&&Rvalue!=0&&Dtype!=NULL){
Ir1[0]=Dtype;
Ir2[0]=Rvalue;
Ir3[0]=Rbits;
}
if(Ir2[1]==0&&Ir2[0]!=0&&Ir2[0]!=Rvalue&&Rvalue!=0&&Dtype!=NULL){
Ir1[1]=Dtype;
Ir2[1]=Rvalue;
Ir3[1]=Rbits;
}
if(Ir2[2]==0&&Ir2[0]!=0&&Ir2[1]!=0&&Ir2[0]!=Rvalue&&Ir2[1]!=Rvalue&&Rvalue!=0&&Dtype!=NULL){
Ir1[2]=Dtype;
Ir2[2]=Rvalue;
Ir3[2]=Rbits;
}



 }
    irrecv.enableIRIn();
}  
// Опрос Ик приёмника    
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  delay(10);
}

