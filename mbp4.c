
#include <unistd.h>
#include "p4io.h"
#include "lib/common.h"

//***************************************************************************
// Main
//***************************************************************************

int main(int argc, char** argv)
{
   Serial serial;
   // int status;
   byte b;

   loglevel = 1;
   logstdout = yes;

   P4Request request(&serial);

   if (serial.open("/dev/ttyUSB1") != success)
      return 1;

   while (yes)
   {
      while (serial.look(b, 100) == success)
         tell(0, "-> 0x%2.2x", b);

      usleep(100000);
   }

   serial.close();
   
   return 0;
}
