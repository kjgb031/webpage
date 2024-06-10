<?php

// if request is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // parse xml file
    $xml_file = 'MuseumData.xml';
    $json = parse_xml($xml_file);
    $result = array();
    // if request has query parameter "search"
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = search($json, $search);
    }
    else {
        $data = json_decode($json, true);
        $result = json_encode($data['Museums']);
    }

    // return result as xml
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<Museums/>');
    $json_data = json_decode($result, true);
    $json_data = array_values($json_data);
    // museums{museumType, name}
    foreach ($json_data as $museum) {
        $song_xml = $xml->addChild('Museums');
        $song_xml->addChild('MuseumType', $museum['MuseumType']);
        $song_xml->addChild('Name', $museum['Name']);
    }

    echo $xml->asXML();

   

}

function parse_xml($xml_file) {
    $xml = simplexml_load_file($xml_file);
    $json = json_encode($xml);
    return $json;
}

function search($json, $search) {
    $data = json_decode($json, true);
    $result = array();
    foreach ($data['Museums'] as $museum) {
        if (strpos($museum['Name'], $search) !== false) {
            $result[] = $museum;
        }
    }
    return json_encode($result);
}
