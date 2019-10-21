#include<SPI.h>
#include<MFRC522.h>
#include<SoftwareSerial.h>
#include <Ethernet.h>
#define SS_PIN 4
#define RST_PIN 9
#define No_Of_Card 8
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char server[] = "192.168.43.105";   //YOUR SERVER
IPAddress ip(192,168,137,1); //172.16.230.78 169.254.174.251 192,168,137,1
EthernetClient client;
SoftwareSerial mySerial(8, 9);
MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;
byte id[No_Of_Card][4] = {
  {53, 162, 173, 229},          //RFID NO-1
  {236, 108, 214, 2},          //RFID NO-2
  {143, 44, 34, 41},
  {214, 249, 151,229},
  {50, 88, 254, 239}
};
byte id_temp[3][3];
byte i;
int j = 0;
void setup()
{
  Serial.begin(9600);
  mySerial.begin(9600);
  SPI.begin();
  Serial.println("start");
  rfid.PCD_Init();
  for (byte i = 0; i < 6; i++)
  {
    key.keyByte[i] = 0xFF;
  }

  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    Ethernet.begin(mac, ip);
  }
  else
  {
    Serial.println("conn");
  }
  delay(100);
  Serial.println("connecting...");
}
void loop()
{ int m = 0;
  if (!rfid.PICC_IsNewCardPresent())
    return;

  if (!rfid.PICC_ReadCardSerial())
    return;
  else
    Serial.println("Card detected");
  for (i = 0; i < 4; i++)
  {
    id_temp[0][i] = rfid.uid.uidByte[i];
    delay(50);
  }
  Serial.print("your card no :");
  for (int s = 0; s < 4; s++)
  {
    Serial.print(rfid.uid.uidByte[s]);
    Serial.print(" ");

  }
  for (i = 0; i < No_Of_Card; i++)
  {
    if (id[i][0] == id_temp[0][0])
    {
      if (id[i][1] == id_temp[0][1])
      {
        if (id[i][2] == id_temp[0][2])
        {
          if (id[i][3] == id_temp[0][3])
          {
            Serial.println("\nVALID");
            Sending_To_DB();
            j = 0;
            rfid.PICC_HaltA(); rfid.PCD_StopCrypto1();   return;
          }
        }
      }
    }
    else
    {
      j++;
      if (j == No_Of_Card)
      {
        Serial.println("INVALID CARD");
        Sending_To_DB();
        j = 0;
      }
    }
  }

  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();
}

void Sending_To_DB()   //CONNECTING WITH MYSQL
{
  if (client.connect(server, 80)) {
    Serial.println("Attenence recorded");
    // Make a HTTP request:
    client.print("GET /ether/ethernet.php?allow=");     //YOUR URL
    if (j != No_Of_Card)
    {
      client.print('1');
    }
    else
    {
      client.print('0');
    }

    client.print("&id=");
    for (int s = 0; s < 4; s++)
    {
      client.print(rfid.uid.uidByte[s]);
    }
    client.print(" ");
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.43.105");
    client.println("Connection: close");
    client.println();
  }
  else
  {
    Serial.println("connection failed");
  }
  client.stop();
}



