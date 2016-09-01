<?php
namespace Pilulka\Edi\Orders;

class PartnerTest extends \PHPUnit_Framework_TestCase
{
    public function testXmlOutput()
    {
        $partner = new Partner(Partner::QUALIFIER_BUYER, "8594010120008");
        $partner->setDescription("description test");
        $partner->setName("MIKEL a.s.");
        $partner->setStreet("Drhova 50");
        $partner->setPlace("Brno");
        $partner->setPostCode("625 00");
        $partner->setCountryCode("CZ");
        $partner->setCountryName("Česká Republika");
        $partner->setCompanyId("38412458");
        $partner->setTaxId("38412458");
        $partner->setVatId("CZ38412458");
        $partner->setRegistration("Společnost zapsána u MS v Praze odd. b vl. 8647");
        $partner->setContactType("účtárna");
        $partner->setContactName("Pavel Dvořák");
        $partner->setContactPhone("+420 123 456 789");
        $partner->setContactFax("+420 123 456 710");
        $partner->setContactEmail("pavel.dvorak@mikel.cz");

        $partner->fillXml($xml = new \SimpleXMLElement("<party></party>"));
        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0"?>
<party>
    <party_qualifier>BY</party_qualifier>
    <party_ean>8594010120008</party_ean>
    <party_description>description test</party_description>
    <party_name>MIKEL a.s.</party_name>
    <street>Drhova 50</street>
    <place>Brno</place>
    <postCode>625 00</postCode>
    <country_code>CZ</country_code>
    <country_name>Česká Republika</country_name>
    <company_id>38412458</company_id>
    <tax_id>38412458</tax_id>
    <vat_id>CZ38412458</vat_id>
    <registration>Společnost zapsána u MS v Praze odd. b vl. 8647</registration>
    <contact_type>účtárna</contact_type>
    <contact_name>Pavel Dvořák</contact_name>
    <contact_tel>+420 123 456 789</contact_tel>
    <contact_fax>+420 123 456 710</contact_fax>
    <contact_email>pavel.dvorak@mikel.cz</contact_email>
</party>
XML
            ,
            $xml->asXML());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidEmail()
    {
        $partner = new Partner(Partner::QUALIFIER_BUYER, "8594010120008");
        $partner->setContactEmail("invalidEmail");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidQualifier()
    {
        (new Partner("UNKNOWN", "8594010120008"));
    }
}
