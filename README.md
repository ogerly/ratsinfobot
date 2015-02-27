# ratsinfobot
Abrufen der Information der Webseite von einem Ratsinfosystem (Dresden)


#Installation Lokal

1. einen Ordner im Lokalen Verzeichniss anlegen
   in dem sich folgende Dateien befinde.
    - index.php
    - php.ini
    - setup.php
    - simple_html_dom.php
    - 
    - 
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
