# ratsinfobot (PHP)
Abrufen von Informationen von einem Ratsinformationssystems (Beispiel: Dresden).


#Installation Lokal

1. einen Ordner im Lokalen Verzeichniss anlegen
   in dem sich folgende Dateien befinden:
    - index.php
    - php.ini
    - setup.php
    - simple_html_dom.php 
    
    
2. importieren sie die ratsinfo.sql in ihre Lokale Datenbank

3. passen sie die setup.php an.
    ab Zeile 23 bis 26.

     .....
     
       define('ONLINE',false);
	
	       define('HOST',"localhost");
	       define('USER',"root");
	       define('PASSWORD',"x");
      	 define('DB',"ratsinfo");

     ....
     
4. Starten sie die index.php local in ihrem Browser.


#in Datenbank schreiben

in index.php Zeile 255 wird der Befehl zum schreiben in die Datenbank ausgeführt 

    $erg = sql_db($sql, null); 


#PHP Simple HTML DOM Parser

simple_html_dom.php

online Docu: http://simplehtmldom.sourceforge.net/manual.htm

