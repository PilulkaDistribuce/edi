<?php
namespace Pilulka\Edi\Orders;

class LineItemTest extends \PHPUnit_Framework_TestCase
{
    public function testXmlOutput()
    {
        $lineItem = new LineItem("8594000000204", 30000, "Ovocný čaj");
        $lineItem->setSupplierArticleId(290);
        $lineItem->setBuyerArticleId(541);
        $lineItem->setComplementaryArticle("NB", "513918", "Central Code");
        $lineItem->setQuantityType(LineItem::QUANTITY_TYPE_ORDERED);
        $lineItem->setISOQuantityUnit("PCE");
        $lineItem->setNumberOfUnits(1);
        $lineItem->setDeliveryDate(new \DateTime("2013-11-04 11:10:00"), true);
        $lineItem->setDeliveryType(LineItem::DELIVERY_TYPE_DELIVERY);
        $lineItem->setExpiryRemaining(14);
        $lineItem->setExpiryRemainingQualifier(LineItem::EXPIRY_REMAINING_QUALIFIER_DAY);
        $lineItem->setExpiryRemainingQualifier(LineItem::EXPIRY_REMAINING_QUALIFIER_DAY);
        $lineItem->setGrossPrice(100.50);
        $lineItem->setAllowanceRate(2.2);
        $lineItem->setAllowanceTotal(3.20);
        $lineItem->setNetPrice(97.30);
        $lineItem->setSpecification("specification info");
        $lineItem->setPromotionDeal("promotion deal info");
        $lineItem->setReferenceNumberFree("2222");
        $lineItem->setFreeText("free text");

        $lineItem->fillXml(1, $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><item></item>"));

        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<item>
    <item_number>1</item_number>
    <article_gtin>8594000000204</article_gtin>
    <article_id_supplier>290</article_id_supplier>
    <article_id_buyer>541</article_id_buyer>
    <article_id_add>
        <article_id_type>NB</article_id_type>
        <article_id_code>513918</article_id_code>
        <article_id_description>Central Code</article_id_description>
    </article_id_add>
    <quantity>30000</quantity>
    <quantity_type>21</quantity_type>
    <unit>PCE</unit>
    <number_of_units>1</number_of_units>
    <delivery_date>2013-11-04</delivery_date>
    <delivery_time>11:10:00</delivery_time>
    <delivery_type>2</delivery_type>
    <expiry_remaining>14</expiry_remaining>
    <expiry_remaining_qualifier>804</expiry_remaining_qualifier>
    <article_name>Ovocný čaj</article_name>
    <gross_price>100.50</gross_price>
    <allowance_rate>2.20</allowance_rate>
    <allowance_total>3.20</allowance_total>
    <net_price>97.30</net_price>
    <specification>specification info</specification>
    <promotion_deal>promotion deal info</promotion_deal>
    <reference_number_free>2222</reference_number_free>
    <free_text>free text</free_text>
</item>
XML
            , $xml->asXML());
    }
}
