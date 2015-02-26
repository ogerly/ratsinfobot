<?php
header('Content-type: text/html; charset=UTF-8'); 



if(     isset($_SERVER['HTTP_HOST'] ) && $_SERVER['HTTP_HOST']  != 'localhost'  )
{
	
	define('HOST',""); # bei steffen
	define('USER',"");
	define('PASSWORD',"");
	define('DB',"");
	
	define('ONLINE',true);

	#define("IMAGEURI", "/.alpha/images/" );
	#define("IMAGEURI", "404.jpeg" );
}
else
{
	define('ONLINE',false);
	
	define('HOST',"localhost");
	define('USER',"root");
	define('PASSWORD',"x");
	define('DB',"ratsinfo");

#	define("IMAGEURI", "/blogcupy/images/" );
}
if(ONLINE){
	error_reporting(0);
} else {
	error_reporting(E_ALL);
}



define('LASTINPUTID',""); //   $GLOBALS["LASTINPUTID"] = mysql_insert_id();
define('MYSQLROWS',""); //  $GLOBALS["MYSQLROWS"]   = mysql_num_rows($result);
define('FETCHASSOC',""); //    $GLOBALS["fetch_assoc"]    = mysql_fetch_assoc($result);



define('DTR',"#|#"); // Datensatztrenner (eigentlich \n)
define('FTR',"#$#"); // Feldtrenner (eigentlich; oder ,)

define('SUCCESS','OK');
define('ERROR','ERROR');


// GLOBALE VARIABLE PHP

 $LASTINPUTID;  // die letzte ID wenn ein INPUT INTO ausgeführt wird

 
/*
   Function: sql_db

   Die Schnittstelle zum SQL

   Parameters:
      string - die vollständige sql anfrage
      NUMBER:  ----> leer oder null indiziertes array (zahl)
      NUMBER:  ----> 1  assoziatives Array (wort)

   Returns:
      string mit den zentralen FTR und DTR

*/
function sql_db($query, $ss){

	$rp = mysql_connect(HOST, USER, PASSWORD); 
    
     if ( $ss === "UTF8zuschalten") {
	   mysql_query("SET NAMES 'utf8'");
	   $ss = null;
   }
     //   echo "<script>console.log( 'Debug Objects: " . implode( ',', $query) . "' );</script>"; 
    
	 $meinString = $query;
    $findMich   = 'INSERT';
    $INSERT = strpos($meinString, $findMich);
    $findMich   = 'UPDATE';
    $UPDATE = strpos($meinString, $findMich);    

	// Der !==-Operator kann ebenfalls verwendet werden. Die Verwendung von != von
	// != würde in unserem Beispiel nicht wie erwartet arbeiten, da die Position
	// von 'a' 0 ist. Das Statement (0 != false) evaluiert hierbei zu false.
  if ($INSERT !== false || $UPDATE !== false) {

     $result = mysql_query($query, $rp);
    
    // echo "Letzer eingefügter Datensatz hat id ". mysql_insert_id() ."";
     $GLOBALS["LASTINPUTID"] = mysql_insert_id();  


  } else {
    //echo "Der String '$findMich' wurde nicht im String '$meinString' gefunden";
    $result = mysql_query($query, $rp);
    $GLOBALS["MYSQLROWS"]   = mysql_num_rows($result);
    	
  }


	mysql_close($rp);

	if($result === true) return SUCCESS;
	if(!$result) return ERROR;
	
	// assoc geht nur wenn EIN(1) ergbniss zurückkommt wenn mehrere ergbnisse dann z.z. unbrauchbar
	if ( $ss !== 'assoc' || $ss  === null) {
		$str = "";
		$col_count =  mysql_num_fields ($result);
	
	
		while(  ($row_array = mysql_fetch_row ($result ) ) != false)
		{
			for ($i = 0; $i < $col_count; $i++){
				//TODO sind die nächsten zwei Zeilen oki? (texte mit zeilenumbrüchen)
				$str = $str .  str_replace("\r",'',$row_array[$i]);
				$str = str_replace("\n",'',$str);
				if ($col_count - 1  > $i)
				{
					$str = $str . FTR; //Feldtrenner
				}
			}
			$str = $str . DTR; //Datentrenner
		}
		mysql_free_result ($result);
		$str = substr($str,0, strlen($str) - strlen(DTR));
		return $str;
   } else {
   	
   	  $GLOBALS["MYSQLROWS"]   = mysql_num_rows($result);   	  
   	  // TODO : geht nur bei einem ergbniss !!! 
     	  $GLOBALS["fetch_assoc"]    = mysql_fetch_assoc($result);
   }
}


/*
Function: htmlIItxt

löscht javascript, html tags, STYLE Tags,Komentare und PHP code aus beliebiegen text

 
*/
function htmlIItxt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',   // Strip out javascript
                '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                '@<![\s\S]*?--[ \t\n\r]*>@',        // Strip multi-line comments including CDATA
                '/<\?php.*\?>/s'                    // Strip out php
		);
		$text = preg_replace($search, '', $document); 
		return $text;

}
?>