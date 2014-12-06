<?php
/*
take a get or post request and respond with disaster data as json
Backed from http://portal.gdacs.org/data/GDACS-Platform
*/

if($_GET || $_POST){

    /**
    from, to: data range
    alertlevel: minimum alert level
    country: GDACS country name
    population: minimum affected population
    severity: earthquake magnitude or cyclone wind speed or flood magnitude latitude, longitude: nearby events
    eventtype: comma separated list EQ, FL, TC
    */
    
     $from = $_REQUEST ['from'];
     $to = $_REQUEST ['$to'];
     $alertlevel = $_REQUEST ['alertlevel'];
     $country = $_REQUEST ['$country'];
     $population = $_REQUEST ['population'];
     $severity = $_REQUEST['severity'];
     $eventtype = $_REQUEST['eventtype'];
     
     $url = "http://www.gdacs.org/rss.aspx?profile=ARCHIVE";
     
    if(!empty($from))
        $url = $url."&from=".$from;
    if(!empty($to))
        $url = $url."&to=".$to;
    if(!empty($alertlevel))
        $url = $url."&alertlevel=".$alertlevel;
    if(!empty($country))
        $url = $url."&country=".$country;
    if(!empty($population))
        $url = $url."&population=".$population;
    if(!empty($severity))        
        $url = $url."&severity=".$severity;
    if(!empty($eventtype))
        $url = $url."&eventtype=".$eventtype;
    
    echo "url ";
    echo $url;
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 
        'http://www.gdacs.org/rss.aspx?profile=ARCHIVE'
    );
    $content = curl_exec($ch);
    echo $content;
    
    echo $response;
     
}

function parseXml ($url) {
    
    $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
    $fileContents = trim(str_replace('"', "'", $fileContents));
    $simpleXml = simplexml_load_string($fileContents);
    $json = json_encode($simpleXml);
    return $json;
}

    

?>