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

        $partner = new Partner(Partner::QUALIFIER_BUYER, "8594010120008");
        $partners = new Partners();
        $partners->addPartner($partner);

        $message = new Message(new MessageHeader(new \DateTime("02-10-2010 12:20:22"),
            "1234", "5678"),
            new DocumentHeader("201188591", new \DateTime("2013-11-01"),
                new \DateTime("2013-11-04 10:15:00"),
                $partners),
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

    public function testOriginalExampleXml()
    {
        $buyer = new Partner(Partner::QUALIFIER_BUYER, "8594010120008");
        $buyer->setName("MIKEL a.s.");
        $buyer->setStreet("Drhova 50");
        $buyer->setPlace("Brno");
        $buyer->setPostCode("625 00");
        $buyer->setCountryCode("CZ");
        $buyer->setCountryName("Česká republika");
        $buyer->setCompanyId(38412458);
        $buyer->setTaxId(38412458);
        $buyer->setVatId("CZ38412458");
        $buyer->setRegistration("Společnost zapsána u MS v Praze odd. b vl. 8647");
        $buyer->setContactType("Účtárna");
        $buyer->setContactName("Pavel Dvořák");
        $buyer->setContactPhone("+420 541 328 111");
        $buyer->setContactFax("+420 541 328 112");
        $buyer->setContactEmail("pavel.dvorak@mikelas.cz");

        $partners = new Partners();
        $partners->addPartner($buyer);

        $supplier = new Partner(Partner::QUALIFIER_SUPPLIER, "8594010260001");
        $supplier->setName("Top Tea s.r.o.");
        $supplier->setStreet("Baškovská 50");
        $supplier->setPlace("Praha");
        $supplier->setPostCode("155 00");
        $supplier->setCountryCode("CZ");
        $supplier->setCountryName("Česká republika");
        $supplier->setCompanyId(47112458);
        $supplier->setTaxId(47112458);
        $supplier->setVatId("CZ47112458");
        $supplier->setRegistration("Společnost zapsána u MS v Praze odd. b vl. 8647");
        $supplier->setContactType("Sklad");
        $supplier->setContactName("Marie Výchová");
        $supplier->setContactPhone("+420 223 415 112");
        $supplier->setContactEmail("marie.vichova@kolonia.cz");
        $partners->addPartner($supplier);

        $deliveryParty = new Partner(Partner::QUALIFIER_DELIVERY_PARTY, "8594010125416");
        $deliveryParty->setName("Mikel Jihlava");
        $deliveryParty->setStreet("Vinařská 87");
        $deliveryParty->setPlace("Jihlava");
        $deliveryParty->setPostCode("586 01");
        $deliveryParty->setCountryCode("CZ");
        $deliveryParty->setCountryName("Česká republika");
        $deliveryParty->setCompanyId(38412458);
        $deliveryParty->setContactType("Prodejna");
        $deliveryParty->setContactName("Jiří Němec");
        $deliveryParty->setContactPhone("+420 567 213 401");
        $deliveryParty->setContactEmail("jiri.nemec@mikelas.cz");
        $partners->addPartner($deliveryParty);

        $documentHeader = new DocumentHeader(201188591, new \DateTime("2013-11-01 12:35:10"),
            new \DateTime("2013-11-04 10:15:00"), $partners);
        $documentHeader->enableDeliveryTime();
        $documentHeader->enableIssueTime();
        $documentHeader->setPurpose(DocumentHeader::PURPOSE_INITIAL);
        $documentHeader->setDeliveryDatePurpose(DocumentHeader::DELIVERY_DATE_PURPOSE_DELIVERY);
        $documentHeader->setCurrencyCode("CZK");
        $documentHeader->setTransportMode(DocumentHeader::TRANSPORT_MODE_CUSTOMER);

        $lineItem = new LineItem("8594000000204", 30, "Ovocný čaj pomeranč 50g");
        $lineItem->setSupplierArticleId("290000000");
        $lineItem->setBuyerArticleId("54120089");
        $lineItem->setQuantityType(LineItem::QUANTITY_TYPE_ORDERED);
        $lineItem->setISOQuantityUnit("PCE");
        $lineItem->setDeliveryDate(new \DateTime("2013-11-04 10:15:00"), true);
        $lineItem->setDeliveryType(LineItem::DELIVERY_TYPE_DELIVERY);
        $lineItem->setExpiryRemaining(14);
        $lineItem->setExpiryRemainingQualifier(LineItem::EXPIRY_REMAINING_QUALIFIER_DAY);
        $lineItem->setGrossPrice(10.00);
        $lineItem->setAllowanceRate(10.00);
        $lineItem->setAllowanceTotal(1);
        $lineItem->setNetPrice(9);
        $lineItem->setTotalPrice(270);

        $lineItems = new LineItems();
        $lineItems->addItem($lineItem);

        $lineItem = new LineItem("8594000000259", 20, "Ovocný čaj brusinka 50g");
        $lineItem->setSupplierArticleId("290000025");
        $lineItem->setBuyerArticleId("584148");
        $lineItem->setQuantityType(LineItem::QUANTITY_TYPE_ORDERED);
        $lineItem->setISOQuantityUnit("PCE");
        $lineItem->setDeliveryDate(new \DateTime("2013-11-04 10:15:00"), true);
        $lineItem->setDeliveryType(LineItem::DELIVERY_TYPE_DELIVERY);
        $lineItem->setGrossPrice(10);
        $lineItem->setAllowanceRate(0);
        $lineItem->setAllowanceTotal(0);
        $lineItem->setNetPrice(10);
        $lineItem->setTotalPrice(300);
        $lineItems->addItem($lineItem);

        $lineItem = new LineItem("8594000000419", 21, "Ovocný čaj šípek 100g");
        $lineItem->setSupplierArticleId("290000041");
        $lineItem->setBuyerArticleId("584469");
        $lineItem->setQuantityType(LineItem::QUANTITY_TYPE_ORDERED);
        $lineItem->setISOQuantityUnit("PCE");
        $lineItem->setDeliveryDate(new \DateTime("2013-11-04 10:15:00"), true);
        $lineItem->setDeliveryType(LineItem::DELIVERY_TYPE_DELIVERY);
        $lineItem->setGrossPrice(10);
        $lineItem->setAllowanceRate(13);
        $lineItem->setAllowanceTotal(1.30);
        $lineItem->setNetPrice(8.70);
        $lineItem->setTotalPrice(87);
        $lineItems->addItem($lineItem);

        $lineItem = new LineItem("8594000000525", 5, "Černý čaj černý bez 150g");
        $lineItem->setSupplierArticleId("290000052");
        $lineItem->setBuyerArticleId("584644");
        $lineItem->setQuantityType(LineItem::QUANTITY_TYPE_ORDERED);
        $lineItem->setISOQuantityUnit("PCE");
        $lineItem->setDeliveryDate(new \DateTime("2013-11-04 10:15:00"), true);
        $lineItem->setDeliveryType(LineItem::DELIVERY_TYPE_DELIVERY);
        $lineItem->setGrossPrice(11);
        $lineItem->setAllowanceRate(0);
        $lineItem->setAllowanceTotal(0);
        $lineItem->setNetPrice(11);
        $lineItem->setTotalPrice(55);
        $lineItems->addItem($lineItem);

        $message = new Message(new MessageHeader(new \DateTime("2013-11-01 12:43:00"),
            "8594010260001", "8594010120008"),
            $documentHeader,
            $lineItems);

        $lineText = new LineText("Domluven výnos do 1. patra");
        $lineText->setText2("Parkoviště a zadní vchod z ulice Rudná");
        $lineTexts = new LineTexts();
        $lineTexts->addText($lineText);
        $message->setLineTexts($lineTexts);

        $summary = new Summary();
        $summary->setPriceOrdered(952);
        $summary->setItemsPrice(952);
        $summary->setNumberOfItems(5);
        $summary->setNumberOfTexts(1);
        $message->setSummary($summary);

        $this->assertXmlStringEqualsXmlString(
            (new \SimpleXMLElement(__DIR__ . "/../fixtures/orders_v3_example.xml", 0, true))->asXML(),
            $message->getXml()->asXML());
    }
}
