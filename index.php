<?php
error_reporting(E_ALL);
// Include the library
header('Content-type: text/html; charset=UTF-8'); 
include('simple_html_dom.php');
include('setup.php');


$ort ="";
$street = "";
$mail = "";
$plz = "";
$src = "";
$phonDiFest	="";
$phonDiMo	="";
$phonPrFest	="";
$phonPrMo ="";
$zusatz = "";
$gremium_title = "";
$gremium_kgrnr = "";
$gremium_partei = "";
$gremium_art = "";
$gremium_von = "";
$gremium_bis = "";
  

// Retrieve the DOM from a given URL
$html = file_get_html('http://ratsinfo.dresden.de/kp0041.php');
 
 
// auf alle classen im DOM zugreifen
foreach($html->find('.smc_td') as $td) {
 
    // auf alle a elemente im td zugreifen
    foreach($td->find('a') as $a) {
             
       // link abrufen und lesbar machen  
       $mandatLink =  htmlspecialchars($a->href, ENT_QUOTES);
       
        // Url zum Mandatsträger
       // $mandatLink  Beispiel => kp0051.php?__kpenr=1230&amp;grnr=0
       $mandatUrl = "http://ratsinfo.dresden.de/".$mandatLink ;    
     
        
       //  die Mandatsträger id ermitteln
        $arr = explode(".php?__kpenr=", $mandatLink);  
        $kp = $arr[0];         
               
        $ddd = explode("&amp;amp;grnr=", $arr[1] );  
        
        // Mandatsträger ID    
        $kpenr = $ddd[0]; 
                       
                    
        // der name wird des mandatsträger            
        $name = $a->innertext;       
        
       
         echo "<br><h3>" . $name . "</h3> <br>";  
         echo "kpenr ID => " . $ddd[0] . '<br>';  
         
         
         // Mandatsträger Informationen abrufen     
         
         $html2 = file_get_html($mandatUrl);         
            
            
            /*
            
Für jeden Mandatsträger gibt es Kontaktdaten .. bei manchen ja bei manchen nein .. 
auch sehr unterschiedliche .. der einzige was gleich ist sind die bezeichnungen 
 Ort: ;  Straße: ;  Telefon dienstl.:  ;   Telefon privat:  ;  Mobil privat:  ;  Mobil dienstl.: und E-Mail
 
 da man nicht weis welche felder bei wn da sind geht der bot alle felder die da sind durch .. 
 er prüft den ersten Wert in der tabellenreihe und erstellt die jeweilige Variable


 
             
            
            */
	       foreach($html2->find('#smctablevorgang') as $table)   {
	       	 
	       	for ( $i =0; $i < 7; $i++ ) {
	       		
	       	 if (  $table->find('.smctablehead', $i) ) {
	       	   echo "tr ".$i;
		       	   $trHead =  $table->find('.smctablehead',$i)->innertext;  	// Wert 1 wichtig für die Variable
		       	   $trCont =  $table->find('.smctablecontent',$i)->innertext;  	// Wert 2     der text für die Variable  	  	       	  
		       	    
	             
	               echo "trHead =>  " . $trHead ."," . $trCont ."<br>";
	               // variable befüllen
	                switch( $trHead ) { 
	                
	                   case "Ort:":  $ort = $trCont; break;
	                   
	                   case "Stra&szlig;e:":    $street = $trCont; break;
	                   
	                   case "Telefon dienstl.:":  $phonDiFest = $trCont; break;
	                   
	                   case "Telefon privat:":  $phonPrFest = $trCont; break;
	                   
	                   case "Mobil privat:":  $phonPrMo = $trCont; break;
	                   
	                   case "Mobil dienstl.:":  $phonDiMo = $trCont; break;
	                   
	                   case "E-Mail:":  $mail = $trCont; break;
	                   
                       
	                }
		       	}  
	       	
	       	}
	       // ort und plz trennen
		       if (  $ort != "" ) {
    	           $arr_ort = explode(" ", $ort );
                 $plz = $arr_ort[0]; 
                 $ort = "";
                 $ort = $arr_ort[1]; 
		       }
		         // bild abrufen
		         foreach($html2->find('.smcimgperson') as $bb)   {
	       	       $src = $bb->src;
	                echo "<img  alt='". $name ."' title='". $name ."' src='http://ratsinfo.dresden.de/" . $src  . "' ><br>" ; 
	                
		         }
		         
                 /*
                   Manche Mandatsträger haben zuatzinfos ( nur DIE LINKE ;) )
                   die werden jetzt abgereufen 
                   dazu wird der link gesucht und aufgerufen 
                 */
		         // zusatzinfo suchen
		         foreach($html2->find('a') as $cc )   {
	       	       $txt = $cc->innertext;
	                 if (  $txt  == "Zusatzinfo" ) {  
	                    $href =   $cc->href;  
	                    $href =   "http://ratsinfo.dresden.de/".$href;  
	                      
                        // aufruf der zusatzinfo seite
	                    $html2_1 = file_get_html( $href );         
                        
                        // zusatzinfo text abrufen
	                    foreach($html2_1->find('font') as $font)   { 
	                        echo $font->innertext . "<br>";
	                        $zusatz .= "<div>".$font->innertext  . "<br>";
	                    }
	                 }
		         }
		                
	           
		     }	    
		         echo "plz => " . $plz . "<br>";
		         echo "ort => " . $ort . "<br>";
		         echo "street => " . $street . "<br>";
		         echo "phon DiFest => " . $phonDiFest . "<br>";
		         echo "phon DiMo => " . $phonDiMo . "<br>";
		         echo "phon PrFest => " . $phonPrFest . "<br>";
		         echo "phon PrMo => " . $phonPrMo . "<br>";
		         echo "mail => " . $mail . "<br>";
		    
		    
		    echo "<br><h3>Mitarbeit</h3> <br>";
		    
		    
		    // Mitarbeit Tab für ein Mandatsträger abrufen 
		     $html3 = file_get_html("http://ratsinfo.dresden.de/kp0050.php?__kpenr=". $kpenr);
		     // Mitarbeit für ein Mandatsträger abrufen 
		   
		    
		     foreach($html3->find('#smc_page_kp0050_contenttable1') as $table)   { 
		         
		         
		         if ( $table->find('tr') ){
		         // GremiumName abrufen
		         foreach($table->find('tr') as $tr)   {
                   if ( !  $tr->find('th',0) ) {
                   	
                   	
                   if ( ! $tr->find('td a',0) ) {
                   	  $gremium_title =  $tr->find('td',0)->innertext;
	       	          
	       	           // es gibt keine ID href ?? TODO: was soll hier gemacht werden?
	       	           $gremium_kgrnr = "";
                   	 echo "ohne ID!!  =>" .$gremium_title . "<br>";
                   } else {
                   		       	          
	       	          $gremium_title =  $tr->find('td a',0)->innertext;
	       	          
	       	          // href="kp0040.php?__kgrnr=1"
	       	          $gremium_kgrnr =    $tr->find('td a',0)->href;
	       	            echo "ID vorhanden!!  =>" .$gremium_title . "<br>";
                   }
	       	       
	       	       
	       	       
		       	      if ( $gremium_title != "" && $gremium_title != "Sortieren: nach Gremium aufsteigend " )  {
		       	        	
		       	        	
		       	        	  $gremium_partei =  $tr->find('td',1)->innertext;
	       	              $gremium_art =  $tr->find('td',2)->innertext;
	       	               if ( $tr->find('td',3) )  {
	       	                  $gremium_von =  $tr->find('td',3)->innertext;
	       	               }
	       	               if ( $tr->find('td',4) )  {
	       	                  $gremium_bis =  $tr->find('td',4)->innertext;
	       	               }
	       	       
	       	       
		       	        	 if ( $gremium_kgrnr != "" )  {
	       	                 $arrII = explode("__kgrnr=", $gremium_kgrnr);     	          
	       	                 $gremium_kgrnr =  $arrII[1]; 	       	               
	       	             }
			       	        
			       	             echo "gremium_title =>" .$gremium_title . "<br>";
					       	       echo "gremium_kgrnr =>" .$gremium_kgrnr . "<br>";
					       	       echo "gremium_partei =>" .$gremium_partei . "<br>";
					       	       echo "gremium_art =>" .$gremium_art . "<br>";
					       	       echo "gremium_von  =>" .$gremium_von . "<br>";
					       	       echo "gremium_bis =>" .$gremium_bis . "<br>";
					       	       echo "<br>";			       	       
			       	      
		       	        }  
	              
	                 // TODO : hier wird in die Datenbank geschieben und geprüft
	                
		         
		         } else { 
		         //echo "table kopf";
		         }
		         
		         $gremium_title = "";
				   $gremium_kgrnr = "";
					$gremium_partei = "";
			      $gremium_art = "";
				   $gremium_von = "";
					$gremium_bis = "";
					       	       
		           
		       }  
		     } else {
		     	
				    echo "Keine Daten für eine Mitgliedschaft vorhanden.";
				 		     	
		     	}
		         }
		          
		     

	// SQL schreiben in Datenbank   ist auskommentiert

          $sql="INSERT INTO `" . DB . "`.`mandat`( `name`, `ort`, `plz`, `street`, `phonDiFest`,	`phonDiMo`, `phonPrfest`, `phonPrMo`, `mail`, `link`, `img`, `kpenr_id`, `zusatz`) VALUES ('".$name."','".$ort."','".$plz."','".$street."','".$phonDiFest."',	'".$phonDiMo."',	'".$phonPrFest."',	'".$phonPrMo."','".$mail."','".$mandatUrl."','".$src."','".$kpenr."' ,'".$zusatz."' ) ";
                
          $erg = sql_db($sql, null);
          
         
          if ( $erg ){
             	echo ':) <br>';
          } else {
          	echo ':( <br> ';
            echo $sql . "<br>";    
          }
 
              echo '<hr>'; 
               ob_flush();              
				   flush();
				   sleep(2);
				   
				   $ort="";
					$street= "";
					 
					$mail= "";
					$plz= "";
					$src= "";
					$phonDiFest	="";
					$phonDiMo	="";
					$phonPrFest	="";
					$phonPrMo ="";
					$zusatz ="";
					$gremium_partei ="";
 	              $gremium_art ="";
 	              $gremium_von ="";
 	              $gremium_bis ="";
     }
    
    
}

?>