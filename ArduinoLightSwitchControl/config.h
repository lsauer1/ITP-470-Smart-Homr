/************************ Device Config *******************************/
#define FEED_NAME    ""switch-one""
#define WIFI_SSID "SAUER"
#define WIFI_PASS "heffalump"

/************************ WiFi Setup *******************************/
#include "AdafruitIO_WiFi.h"

#if defined(USE_AIRLIFT) || defined(ADAFRUIT_METRO_M4_AIRLIFT_LITE) ||         \
    defined(ADAFRUIT_PYPORTAL)
// Configure the pins used for the ESP32 connection
#if !defined(SPIWIFI_SS) // if the wifi definition isnt in the board variant
// Don't change the names of these #define's! they match the variant ones
#define SPIWIFI SPI
#define SPIWIFI_SS 10  // Chip select pin
#define SPIWIFI_ACK 9  // a.k.a BUSY or READY pin
#define ESP32_RESETN 6 // Reset pin
#define ESP32_GPIO0 -1 // Not connected
#endif
AdafruitIO_WiFi io("ls1", "aio_AgFi49NCd2SOAbUlh8LiCrbjhbAG", WIFI_SSID, WIFI_PASS, SPIWIFI_SS,
                   SPIWIFI_ACK, ESP32_RESETN, ESP32_GPIO0, &SPIWIFI);
#else
AdafruitIO_WiFi io("ls1", "aio_AgFi49NCd2SOAbUlh8LiCrbjhbAG", WIFI_SSID, WIFI_PASS);
#endif
