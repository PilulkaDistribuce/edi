<?php
/** Removes empty elements from some XML file */
if (!isset($argv[1])) {
    echo "usage: php xmlRearrange.php XMLFILE\n";
    exit(1);
}
$xmlFile = $argv[1];

$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
if (!$doc->load($xmlFile)) {
    echo "cannot load xml file $xmlFile\n";
    exit(1);
}

// remove empty elements
$xpath = new DOMXPath($doc);
foreach( $xpath->query('//*[not(node())]') as $node ) {
    $node->parentNode->removeChild($node);
}

$doc->formatOutput = true;
$xml = $doc->saveXML();
// adjust price elements: 50.000 => 50
$xml = preg_replace("/(quantity|price_ordered|price|rate|total)>([0-9]+)\.0+</", "$1>$2<", $xml);
$xml = preg_replace("/<allowance_rate>0</allowance_rate>/", "", $xml);
$xml = preg_replace("/<allowance_total>0</allowance_total>/", "", $xml);
file_put_contents($xmlFile, $xml);

