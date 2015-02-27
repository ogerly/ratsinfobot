# ratsinfobot (PHP)
Abrufen von Information der Webseite von einem Ratsinfosystem (Dresden).


#Installation Lokal

1. einen Ordner im Lokalen Verzeichniss anlegen
   in dem sich folgende Dateien befinden:
    - index.php
    - php.ini
    - setup.php
    - simple_html_dom.php 
    
    
2. importieren sie die ratsinfo.sql in ihre Lokale Datenbank

3. pasen sie die setup.php an.
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

in Zeile 255 wird der befehl zum schreiben in die Datenbank ausgeführt 

[ $erg = sql_db($sql, null); ]
