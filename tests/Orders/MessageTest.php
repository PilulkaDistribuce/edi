<?php
namespace Pilulka\Edi\Orders;

class MessageTest extends \PHPUnit_Framework_TestCase
{

    public function testXml()
    {
        $lineItem = new LineItem("8594000000204", 30000, "Ovocný čaj");
        $lineItem->setSupplierArticleId(290);
        $lineItem->setBuyerArticleId(541);
        $lineItems = new LineItems();
        $lineItems->addItem($lineItem);

        $message = new Message(new MessageHeader(new \DateTime("02-10-2010 12:20:22"),
            "1234", "5678"),
            new DocumentHeader("201188591", new \DateTime("2013-11-01"),
                new \DateTime("2013-11-04 10:15:00"),
                new Partner(Partner::QUALIFIER_BUYER, "8594010120008")),
            $lineItems);

        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<orion_message>
    <header>
        <message_type>ORDERS</message_type>
        <version>3.0.0</version>
        <creation_date>2010-10-02</creation_date>
        <creation_time>12:20:22</creation_time>
        <receiver>1234</receiver>
        <sender>5678</sender>
    </header>
    <body>
        <doc_header>
            <doc_number>201188591</doc_number>
            <doc_date_of_issue>2013-11-01</doc_date_of_issue>
            <delivery_date>2013-11-04</delivery_date>
            <party>
                <party_qualifier>BY</party_qualifier>
                <party_ean>8594010120008</party_ean>
            </party>
        </doc_header>
        <line_items>
            <item>
                <item_number>1</item_number>
                <article_gtin>8594000000204</article_gtin>
                <article_id_supplier>290</article_id_supplier>
                <article_id_buyer>541</article_id_buyer>
                <quantity>30000</quantity>
                <article_name>Ovocný čaj</article_name>
            </item>
        </line_items>
    </body>
</orion_message>
XML
            , $message->getXml()->asXML());
    }
}
