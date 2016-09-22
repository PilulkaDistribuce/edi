<?php
namespace Pilulka\Edi\DesAdv;


class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testValidInfo()
    {
        $deliveryInfo = new DeliveryInfo(new \SimpleXMLElement(<<<XML
<message_header>
    <doc_number>1001302452</doc_number>
    <doc_type>351</doc_type>
    <doc_function>9</doc_function>
    <doc_date_of_issue>2013-11-04</doc_date_of_issue>
    <doc_time_of_issue>22:20</doc_time_of_issue>
    <delivery_date>2013-11-04</delivery_date>
    <delivery_time>10:00</delivery_time>
    <collection_date>2013-11-04</collection_date>
    <collection_time>10:00</collection_time>
    <delivery_date_latest>2013-11-04</delivery_date_latest>
    <delivery_time_latest>10:00</delivery_time_latest>
    <delivery_date_earliest>2013-11-04</delivery_date_earliest>
    <delivery_time_earliest>10:00</delivery_time_earliest>
    <departure_date>2013-11-04</departure_date>
    <departure_time>10:00</departure_time>
    <country_of_origin>CZE</country_of_origin>
    <transport_mode>30</transport_mode>
    <transport>KAMION</transport>
    <vehicle_id>AHX 26-91</vehicle_id>
    <free_text>Dodací podmínky</free_text>
    <registration>Společnost zapsána u MS v Praze odd. b vl. 8647</registration>
    <contract_number/>
    <order_number>201188591</order_number>
    <order_number_date>2013-11-01</order_number_date>
    <order_number_time>10:00</order_number_time>
    <supplier_order_number>479665087</supplier_order_number>
    <supplier_order_date>2013-11-02</supplier_order_date>
    <supplier_order_time>07:00</supplier_order_time>
    <despatch_advice_number>225557</despatch_advice_number>
    <despatch_advice_date>2013-11-08</despatch_advice_date>
    <despatch_advice_time>10:00</despatch_advice_time>
    <promotion_number/>
    <party>
        <party_qualifier>BY</party_qualifier>
        <party_ean>8594010120008</party_ean>
        <party_description/>
        <party_name>MIKEL a.s.</party_name>
        <street>Drhova 50</street>
        <place>Brno</place>
        <postcode>625 00</postcode>
        <country_code>CZ</country_code>
        <country_name>Česká republika</country_name>
        <company_id>38412458</company_id>
        <tax_id>CZ38412458</tax_id>
        <vat_id/>
        <contact_type>Účtárna</contact_type>
        <contact_name>Pavel Dvořák</contact_name>
        <contact_tel>+420 541 328 111</contact_tel>
        <contact_fax>+420 541 328 112</contact_fax>
        <contact_email>pavel.dvorak@mikelas.cz</contact_email>
    </party>
    <party>
        <party_qualifier>OB</party_qualifier>
        <party_ean>8594010120008</party_ean>
    </party>
    <party>
        <party_qualifier>DP</party_qualifier>
        <party_ean>8594010125416</party_ean>
        <party_name>Mikel Jihlava</party_name>
        <street>Vinařská 87</street>
        <place>Jihlava</place>
        <postcode>586 01</postcode>
        <country_code>CZ</country_code>
        <country_name>Česká republika</country_name>
        <contact_type>Prodejna</contact_type>
        <contact_name>Jiří Němec</contact_name>
        <contact_tel>+420 567 213 401</contact_tel>
        <contact_fax>+420 567 213 402</contact_fax>
        <contact_email>jiri.nemec@mikelas.cz</contact_email>
    </party>
    <party>
        <party_qualifier>IV</party_qualifier>
        <party_ean>8594010120008</party_ean>
        <party_name>MIKEL a.s.</party_name>
        <street>Drhova 50</street>
        <place>Brno</place>
        <postcode>625 00</postcode>
        <country_code>CZ</country_code>
        <country_name>Česká republika</country_name>
        <company_id>38412458</company_id>
        <tax_id>CZ38412458</tax_id>
        <contact_type>Účtárna</contact_type>
        <contact_name>Pavel Dvořák</contact_name>
        <contact_tel>+420 541 328 111</contact_tel>
        <contact_fax>+420 541 328 112</contact_fax>
        <contact_email>pavel.dvorak@mikelas.cz</contact_email>
    </party>
    <party>
        <party_qualifier>SN</party_qualifier>
        <party_ean>8594010125416</party_ean>
    </party>
    <party>
        <party_qualifier>UC</party_qualifier>
        <party_ean>8594010125416</party_ean>
    </party>
    <party>
        <party_qualifier>SU</party_qualifier>
        <party_ean>8594010260001</party_ean>
        <party_name>Top Tea s.r.o.</party_name>
        <street>Baškovská 50</street>
        <place>Praha</place>
        <postcode>155 00</postcode>
        <country_code>CZ</country_code>
        <country_name>Česká republika</country_name>
        <company_id>47112458</company_id>
        <tax_id>CZ47112458</tax_id>
        <contact_type>Sklad</contact_type>
        <contact_name>Marie Víchová</contact_name>
        <contact_tel>+420 223 415 112</contact_tel>
        <contact_fax>+420 223 415 113</contact_fax>
        <contact_email>marie.vichova@kolonia.cz</contact_email>
    </party>
    <party>
        <party_qualifier>SF</party_qualifier>
        <party_ean>8594010260001</party_ean>
    </party>
    <party>
        <party_qualifier>SE</party_qualifier>
        <party_ean>8594010260001</party_ean>
    </party>
</message_header>
XML
        ));

        $this->assertSame("1001302452", $deliveryInfo->getDocumentNumber());
        $this->assertSame(DeliveryInfo::PURPOSE_ORIGINAL, $deliveryInfo->getPurpose());
        $this->assertEquals(new \DateTime("2013-11-04 22:20"), $deliveryInfo->getDateOfIssue());
        $this->assertEquals(new \DateTime("2013-11-04 10:00"), $deliveryInfo->getDeliveryDate());
    }
}
