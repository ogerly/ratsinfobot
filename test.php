<?php

include_once ('simple_html_dom.php');

 
 // Mitarbeit für ein Mandatsträger abrufen 
		     $html3 = file_get_html("http://ratsinfo.dresden.de/kp0050.php?__kpenr=271");
		    if ( $html3->find('#smc_page_kp0050_contenttable1')  ){
		     foreach($html3->find('#smc_page_kp0050_contenttable1') as $table)   { 
		         
		         
		         if ( $table->find('tr') ){
		         // GremiumName abrufen
		         foreach($table->find('tr') as $tr)   {
                   if ( !  $tr->find('th',0) ) {
                   	
                   	
                   if ( ! $tr->find('td a',0) ) {
                   	  $gremium_title =  $tr->find('td',0)->innertext;
	       	          
	       	           // es gibt keine ID href ?? TODO: was soll hier gemacht werden?
	       	           $gremium_kgrnr = "";
                   	  echo "if gremium_title =>" .$gremium_title . "<br>";
                   } else {
                   		       	          
	       	          $gremium_title =  $tr->find('td a',0)->innertext;
	       	          
	       	          // href="kp0040.php?__kgrnr=1"
	       	          $gremium_kgrnr =    $tr->find('td a',0)->href;
	       	            echo "else gremium_title =>" .$gremium_title . "<br>";
                   }
	       	       
	       	       
	       	       
		       	      if ( $gremium_title != "" && $gremium_title != "Sortieren: nach Gremium aufsteigend " )  {
		       	        	
		       	        	
		       	        	  $gremium_partei =  $tr->find('td',1)->innertext;
	       	              $gremium_art =  $tr->find('td',2)->innertext;
	       	              $gremium_von =  $tr->find('td',3)->innertext;
	       	              $gremium_bis =  $tr->find('td',4)->innertext;
	       	       
	       	       
	       	       
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
	              
	                 
	                
		         
		         } else { 
		         //echo "table kopf";
		         }
		         
		       }  
		     } else {
		     	
				    echo "Keine Daten für eine Mitgliedschaft vorhanden.";
				 		     	
		     	}
		         }
		          
		     }
?>