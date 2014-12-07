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


    $xml = file_get_contents($url);
    
    $xml = prepareXml($xml);
    
    $jsonObj = parseXml($xml);
    
    $jsonObj = json_encode(json_decode($jsonObj));

    print_r($jsonObj);
     
}

function parseXml ($fileContents) {
    $fileContents = str_replace("geo:", "", $fileContents);
    $fileContents = str_replace("gdacs:", "", $fileContents);
    $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
    $fileContents = trim(str_replace('"', "'", $fileContents));
    $simpleXml = simplexml_load_string($fileContents);
    
    $array = array();
    foreach ($simpleXml->channel->item as $item) {
        $marker = array();
        $marker["title"]= (string)$item->title;
        $marker["description"]= str_replace((string) $item->description);
        $marker["latitude"]= (string) $item->Point->lat;
        $marker["longitude"]=  (string)$item->Point->long;
        $marker["eventtype"]=  (string)$item->eventtype;
        $marker["alertlevel"]=  (string)$item->alertlevel;
        array_push($array, $marker);
    }
    
    $json = json_encode($array);
    return $json;
}


function removeElement($element, $xml){
    $dom = new DOMDocument();
    $dom->loadXML($xml);
    $featuredde1 = $dom->getElementsByTagName($element);
    foreach ($featuredde1 as $node) {
        $node->parentNode->removeChild($node);
    }
    
}

function prepareXml($xml){
    $xml = str_replace("geo:", "", $xml);
    $xml = str_replace("gdacs:", "", $xml);
    return $xml;
}
    

?>