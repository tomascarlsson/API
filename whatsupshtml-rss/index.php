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

   // Test RSS, API whatsupsthlm


        $feed_url = "http://whatsupsthlm.se/rss.xml";
        $feed = simplexml_load_file($feed_url);
        echo "<pre>";
        print_r($feed);
        echo "</pre>pre>";

        
       // loopa igenom alla <item> i xml om item innehåller en link som innehåller ordet "konsert" hämta alla titles där
        foreach($feed->channel as $channel){  // Loopar igenom varje <channel> i xml-filen 
           foreach($channel->item as $item){  // Loopar igenom varje <item> i channel-elementet
                $link = $item->link;           // Hämtar link i item elementet  för att kolla om det innehåller ordet konsert
                $title = $item->title;         // Hämtar title i item elementet
                $desc = $item->description;
                if(strpos($link,'konsert') !== false){
                    echo "<h2>". $title ."</h2>";  
                    echo "<p>" . $desc . "</p><br />";
                    echo "<span class='streck'></span><br />";
                }
            }
        }



   ?>
</body>
</html>
