<?php

include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   $user = $_POST['username'];
   $passwd = $_POST['passwort'];
   
   $hostname = $_SERVER['HTTP_HOST'];
   $path = dirname($_SERVER['PHP_SELF']);
   
   // Benutzername und Passwort werden überprüft
   
   if (checkLogin($user, $passwd))
   {
      $_SESSION['angemeldet'] = true;
      
      // Weiterleitung zur geschützten Startseite
      
      if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') 
      {
         if (php_sapi_name() == 'cgi') 
            header('Status: 303 See Other');
         else 
            header('HTTP/1.1 303 See Other');
      }
      
      header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/index.php');
      exit;
   }
}

echo "      <form action=\"login.php\" method=\"post\">\n";
echo "        <br/>\n";
echo "        <div class=\"input\">\n";
echo "          <table>\n";
echo "            <tr><td>User:&nbsp;&nbsp;</td><td><input class=\"inputEdit\" type=\"text\" name=\"username\"></input></td></tr>\n";
echo "            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "            <tr><td>Passwort:&nbsp;&nbsp;</td><td><input class=\"inputEdit\" type=\"password\" name=\"passwort\"></input></td></tr>\n";
echo "          </table>\n";
echo "          <br/>\n";
echo "          <button class=\"button3\" type=submit name=store value=login>Anmelden</button>\n";
echo "        </div>\n";
echo "      </form>\n";

include("footer.php");

?>
