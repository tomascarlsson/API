<!doctype html>
<html lang="sv">
<head>
    <title>Test av API, koder m.m.</title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <?php 
   error_reporting(E_ALL);

   // Test API, Webscraping Glenn Miller Café program

 		// PHP Simple HTML DOM Parser - bibliotek - http://simplehtmldom.sourceforge.net/manual_api.htm
	    include('simplehtmldom_1_5/simple_html_dom.php');
	    // Create a DOM object from a URL or file
	    $htmlglennMillerProgram= file_get_html('http://www.glennmillercafe.com/program/');
	    // Alla artiklar med skivrecensioner
	    foreach($htmlglennMillerProgram->find('div.menu-item') as $glennSpelning) {
	        //echo $glennSpelning;
	        $bandNamn = $glennSpelning->find('p.menu-thingy', 0);
	        if (stristr($bandNamn, ':') == TRUE){
	        	//echo stristr($bandNamn, ':', true); // Tar fran allt i strängen innan kolona
	        	echo $bandNamn->find('text', 0);
	        	// "<h5>". $glennSpelning->find('h4.menu-titel', 0) ."</h5>";
	         	$strDateInfo = $glennSpelning->find('h4.menu-titel', 0);
	         	$arrDateInfo = explode(" ", $strDateInfo);
	         	//echo "<pre>";
	         	//print_r($arrDateInfo);
	         	//echo "</pre>";
	         	$currDay = $arrDateInfo[4];
	         	$currTime = end($arrDateInfo);
	         	//$currMonth = $arrDateInfo[5];

	        	$months = array(1=>"januari", 2=>"februari", 3=>"mars", 4=>"april", 5=>"maj", 6=>"juni", 7=>"juli", 8=>"augusti", 9=>"september", 10=>"oktober", 11=>"november", 12=>"december");
	        	//print_r($months);
	        	$newArray = array_intersect($arrDateInfo, $months); // Matchar värden från i två arrayer och sparar dem i ny array.
	        	foreach($newArray as $currMonth){
		        	for($i=1; $i<count($months); $i++) {
		        		if($currMonth == $months[$i]) // få ut nyckelväret
		        			$keyMonth = array_search($currMonth, $months); 
		        	}

		        	$date = "2012-".$keyMonth."-".$currDay;
		        	$time = $currTime;
		        	//echo 2012-10
		        	// datum 2012-10-01 2012-$months[]
		        	// Tid 20:00
					$spelningarGlennMiller[] = array(
		               //'id' => $row['id'],
		                'bandnamn' => stristr($bandNamn, ':', true), 
		                'genre' => 'jazz',
		                'info' => 'Se hemsidan',
		                'scen' => 'Glenn Miller Café',
		                'datum' => $date,
		                'tid' => $time,
		                'intrade' => 'Fri',
		                'alder' => '18',
		                'web' => 'http://www.glennmillercafe.com/program'
		            );

	        	} // end foreach
	    	} // end if
	     
	    } // end foreach
	    echo "<pre>";
	    print_r ($spelningarGlennMiller)	;
		echo "</pre>";



   ?>
</body>
</html>
