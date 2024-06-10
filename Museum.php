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
        $result = json_encode($data['Song']);
    }

    // return result as xml
    header('Content-Type: application/xml');

    $xml = new SimpleXMLElement('<Songs/>');
    $json_data = json_decode($result, true);
    $json_data = array_values($json_data);
    // song{name, date_created}
    foreach ($json_data as $song) {
        $song_xml = $xml->addChild('Song');
        $song_xml->addChild('Name', $song['Name']);
        $song_xml->addChild('DateCreated', $song['DateCreated']);
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
    foreach ($data['Song'] as $song) {
        if (strpos($song['Name'], $search) !== false) {
            $result[] = $song;
        }
    }
    return json_encode($result);
}
