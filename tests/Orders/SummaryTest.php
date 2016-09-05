<?php
namespace Pilulka\Edi\Orders;

class SummaryTest extends \PHPUnit_Framework_TestCase
{

    public function testXmlOutput()
    {
        $summary = new Summary();
        $summary->setPriceOrdered(990);
        $summary->setTotalAllowanceRate(30);
        $summary->setTotalAllowance(33);
        $summary->setItemsPrice(990);
        $summary->setNumberOfItems(3);
        $summary->setNumberOfTexts(3);

        $summary->fillXml($xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
            . "<summary></summary>"));

        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<summary>
    <price_ordered>990</price_ordered>
    <items_price>990</items_price>
    <total_allowance_rate>30</total_allowance_rate>
    <total_allowance>33</total_allowance>
    <number_of_items>3</number_of_items>
    <number_of_texts>3</number_of_texts>
</summary>
XML
            ,
            $xml->asXML());
    }
}
