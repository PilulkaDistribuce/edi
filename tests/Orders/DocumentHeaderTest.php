<?php
namespace Pilulka\Edi\Orders;

class DocumentHeaderTest extends \PHPUnit_Framework_TestCase
{
    public function testXmlOutput()
    {
        $documentHeader = new DocumentHeader("201188591", new \DateTime("2013-11-01"),
            new \DateTime("2013-11-04 10:15:00"));
        $documentHeader->enableDeliveryTime();
        $documentHeader->setType("220");
        $documentHeader->setPurpose(DocumentHeader::PURPOSE_INITIAL);
        $documentHeader->setDeliveryDatePurpose(DocumentHeader::DELIVERY_DATE_PURPOSE_DELIVERY);
        $documentHeader->setCurrencyCode("CZK");
        $documentHeader->setTransportMode(DocumentHeader::TRANSPORT_MODE_CUSTOMER);
        $documentHeader->setPromotionDeal("promotion deal info");
        $documentHeader->setContractNumber("150KZ");
        $documentHeader->setOfferNumber("OFFER21");
        $documentHeader->setFreeReferenceNumber("REF33");

        $partner = new Partner(Partner::QUALIFIER_BUYER, "8594010120008");
        $partner->setDescription("testing description");

        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0"?>
<doc_header>
    <doc_type>220</doc_type>
    <doc_number>201188591</doc_number>
    <doc_function>9</doc_function>
    <doc_date_of_issue>2013-11-01</doc_date_of_issue>
    <delivery_date>2013-11-04</delivery_date>
    <delivery_time>10:15:00</delivery_time>
    <delivery_type>2</delivery_type>
    <currency_code>CZK</currency_code>
    <transport_mode>O</transport_mode>
    <promotion_deal>promotion deal info</promotion_deal>
    <contract_number>150KZ</contract_number>
    <offer_number_supplier>OFFER21</offer_number_supplier>
    <reference_number_free>REF33</reference_number_free>
    <party>
        <party_qualifier>BY</party_qualifier>
        <party_ean>8594010120008</party_ean>
        <party_description>testing description</party_description>
    </party>
</doc_header>
XML
            ,
            $documentHeader->getXml(new \SimpleXMLElement("<doc_header></doc_header>"), $partner)->asXML());
    }
}
