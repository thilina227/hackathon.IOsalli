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
     $from = "";
     $to = "";
     $alertlevel = "";
     $country = "";
     $population = "";
     $severity = "";
     $eventtype = "";
    
    if(isset($_REQUEST ['from']))
        $from = $_REQUEST ['from'];
    if(isset($_REQUEST ['to']))
        $to = $_REQUEST ['to'];
    if(isset($_REQUEST ['alertlevel']))
        $alertlevel = $_REQUEST ['alertlevel'];
    if(isset($_REQUEST ['country']))
        $country = $_REQUEST ['country'];
    if(isset($_REQUEST ['population']))
        $population = $_REQUEST ['population'];
    if(isset($_REQUEST['severity']))
        $severity = $_REQUEST['severity'];
    if(isset($_REQUEST['eventtype']))
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

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_URL, 
    //     $url
    // );
    // $content = curl_exec($ch);
    
    $xml = file_get_contents($url);
    echo parseXml($xml);
    
     
}

function parseXml ($fileContents) {
    
    $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
    $fileContents = trim(str_replace('"', "'", $fileContents));
    $simpleXml = simplexml_load_string($fileContents);
    $json = json_encode($simpleXml);
    return $json;
}

    

?>