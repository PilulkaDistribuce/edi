<?php
/** Removes empty elements from some XML file */
if (!isset($argv[1])) {
    echo "usage: php removeEmptyElements.php XMLFILE\n";
    exit(1);
}
$xmlFile = $argv[1];

$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
if (!$doc->load($xmlFile)) {
    echo "cannot load xml file $xmlFile\n";
    exit(1);
}

$xpath = new DOMXPath($doc);
foreach( $xpath->query('//*[not(node())]') as $node ) {
    $node->parentNode->removeChild($node);
}

$doc->formatOutput = true;
$doc->save($xmlFile);

