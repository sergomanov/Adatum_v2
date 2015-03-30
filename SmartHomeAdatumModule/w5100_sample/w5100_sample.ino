#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0x00, 0x1D, 0x75, 0x7B, 0xCB, 0xA5 }; //MAC-адрес Arduino
char* mack="00-1D-75-7B-CB-A5";

char server[] = "dom.omsk55.org";    // name address for Google (using DNS)
IPAddress ip(81,177,141,112);
EthernetClient client;

void setup() {
  Serial.begin(9600);
   while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }

  if (Ethernet.begin(mac) == 0) {   Serial.println("Failed to configure Ethernet using DHCP");   Ethernet.begin(mac, ip);  }
  delay(1000);
  Serial.println("connecting...");


  if (client.connect(server, 80)) {
    Serial.println("connected");
    client.println("GET /post.php?ID=00-1D-75-7B-CB-A5&P=576.11 HTTP/1.1");
    client.println("Host: www.dom.omsk55.org");
    client.println("Connection: close");
    client.println();
  } 
  else {    Serial.println("connection failed");  }
}

void loop()
{
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }

  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();
    while(true);
  }
}
