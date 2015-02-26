<?php
error_reporting(E_ALL);
// Include the library
include('simple_html_dom.php');

// Retrieve the DOM from a given URL
$html = file_get_html('http://ratsinfo.dresden.de/kp0041.php');
$i = 0;
// Find all <li> in <ul> 
foreach($html->find('.smc_td') as $td) {
	   if ( $i < 1) {
    foreach($td->find('a') as $a) {
             
       $mandatLink =  htmlspecialchars($a->href, ENT_QUOTES);
       
       $mandatUrl = "http://ratsinfo.dresden.de/".$mandatLink ;    
     
       // $mandatLink => kp0051.php?__kpenr=1230&amp;grnr=0
         
        $arr = explode(".php?__kpenr=", $mandatLink);  
        $kp = $arr[0];         
               
        $ddd = explode("&amp;amp;grnr=", $arr[1] );          
             $kpenr = $ddd[0]; 
             
              
                    
        // der name wird so übertragen => "Details anzeigen: Pia Barkow"              
        $name = $a->title;       
        $name = str_replace("Details anzeigen: ", "", $name);
       
         echo "<br><h3>" . $name . "</h3> <br>";  
         echo "kpenr ID => " . $ddd[0] . '<br>';  
         
         
         // Mandatsträger Informationen einzeln abrufen     
         
         $html2 = file_get_html($mandatUrl);         
           
	       foreach($html2->find('#smctablevorgang') as $table)   {
	       	  
	       	  // Adresse Telefon Mail abrufen   
	       	  foreach($table->find('.smctablecontent') as $b)   {
	       	        echo $b->innertext . '<br>';
	       	     //   TODO: hier sollte einzelne ergebnisse erstellt werden .. bitte auseinandernehmen
	      
		         }
		         foreach($html2->find('.smcimgperson') as $bb)   {
	       	       $src = $bb->src;
	                echo "<img  alt='". $name ."' title='". $name ."' src='http://ratsinfo.dresden.de/" . $src  . "' >" ; 
		         }       
	           
		    }	    
		    
		    
		    
		    echo "<br><h3>Mitarbeit</h3> <br>";
		    
		    
		    // Mitarbeit für ein Mandatsträger abrufen 
		     $html3 = file_get_html("http://ratsinfo.dresden.de/kp0050.php?__kpenr=". $kpenr);
		    
		     foreach($html3->find('#smc_page_kp0050_contenttable1') as $table)   { 
		         
		         foreach($table->find('.smc_field_grname a') as $c)   {
                   
	       	        $gremium_title =  $c->title;
	       	        $gremium_title =  $gremium_title = str_replace("Details anzeigen: ", "", $gremium_title) ;
	       	        // href="kp0040.php?__kgrnr=1"
	       	        $gremium_kgrnr =  $c->href; 
	       	       
	       	        
		       	        if ( $gremium_title != "" && $gremium_title != "Sortieren: nach Gremium aufsteigend " )  {
		       	        	
		       	        	 if ( $gremium_kgrnr != "" )  {
	       	                 $arrII = explode("__kgrnr=", $gremium_kgrnr);     	          
	       	                 $gremium_kgrnr =  $arrII[1];       	            
	       	               }
			       	        
			       	        echo $gremium_title = $gremium_title . ' /  ID => ' . $gremium_kgrnr .   '<br>';
			       	       
			       	      
		       	        }  
	                 
		         }
		     
		     }





              echo '<hr>';
               ob_flush();
				    flush();
				    sleep(2);
     }
     $i++; 
   }
}

?>