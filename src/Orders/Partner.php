<?php
namespace Pilulka\Edi\Orders;

class Partner
{
    const QUALIFIER_BUYER = "BY";
    const QUALIFIER_ORDERED_BY = "OB";
    const QUALIFIER_DELIVERY_PARTY = "DP";
    const QUALIFIER_STORE_NUMBER = "SN";
    const QUALIFIER_ULTIMATE_CUSTOMER = "UD";
    const QUALIFIER_INVOICEE = "IV";
    const QUALIFIER_SUPPLIER = "SU";
    const QUALIFIER_SHIP_FROM = "SF";

    private $qualifier;
    private $ean;
    private $description;
    private $name;
    private $street;
    private $place;
    private $postCode;
    private $countryCode;
    private $countryName;
    private $companyId;
    private $taxId;
    private $vatId;
    private $registration;
    private $contactType;
    private $contactName;
    private $contactPhone;
    private $contactFax;
    private $contactEmail;

    /**
     * @param string $qualifier
     * @param string $ean
     */
    public function __construct($qualifier, $ean)
    {
        if (!in_array($qualifier, $qualifiers = [
            self::QUALIFIER_BUYER, self::QUALIFIER_ORDERED_BY,
            self::QUALIFIER_DELIVERY_PARTY, self::QUALIFIER_STORE_NUMBER,
            self::QUALIFIER_ULTIMATE_CUSTOMER, self::QUALIFIER_INVOICEE,
            self::QUALIFIER_SUPPLIER, self::QUALIFIER_SHIP_FROM
        ])) {
            throw new \InvalidArgumentException("undefined qualifier '$qualifier', use one of values: "
                . implode(", ", $qualifiers));
        }
        $this->qualifier = $qualifier;

        $maxLength = 17;
        if (!$ean || !is_numeric($ean) || strlen($ean) > $maxLength) {
            throw new \InvalidArgumentException("EAN code is mandatory, length of it must be <= $maxLength");
        }
        $this->ean = $ean;
        $this->warehouseQualifier = $warehouseQualifier;
        $this->warehouseEan = $warehouseEan;
    }

    public function setDescription($text)
    {
        $maxLength = 175;
        if (mb_strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of description must be <= $maxLength");
        }
        $this->description = $text;
    }

    public function setName($name)
    {
        $maxLength = 175;
        if (mb_strlen($name) > $maxLength) {
            throw new \InvalidArgumentException("length of name must be <= $maxLength");
        }
        $this->name = $name;
    }

    public function setStreet($streetName)
    {
        $maxLength = 140;
        if (mb_strlen($streetName) > $maxLength) {
            throw new \InvalidArgumentException("length of street name must be <= $maxLength");
        }
        $this->street = $streetName;
    }

    public function setPlace($placeName)
    {
        $maxLength = 35;
        if (mb_strlen($placeName) > $maxLength) {
            throw new \InvalidArgumentException("length of place must be <= $maxLength");
        }
        $this->place = $placeName;
    }

    public function setPostCode($postCode)
    {
        $maxLength = 17;
        if (strlen($postCode) > $maxLength) {
            throw new \InvalidArgumentException("length of post code must be <= $maxLength");
        }
        $this->postCode = $postCode;
    }

    public function setCountryCode($code)
    {
        $maxLength = 3;
        if (strlen($code) > $maxLength) {
            throw new \InvalidArgumentException("length of company code must be <= $maxLength");
        }
        $this->countryCode = $code;
    }

    public function setCountryName($name)
    {
        $maxLength = 35;
        if (mb_strlen($name) > $maxLength) {
            throw new \InvalidArgumentException("length of company name must be <= $maxLength");
        }
        $this->countryName = $name;
    }

    public function setCompanyId($id)
    {
        $maxLength = 15;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of company ID must be <= $maxLength");
        }
        $this->companyId = $id;
    }

    public function setTaxId($id)
    {
        $maxLength = 15;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of company ID must be <= $maxLength");
        }
        $this->taxId = $id;
    }

    public function setVatId($id)
    {
        $maxLength = 15;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of VAT ID must be <= $maxLength");
        }
        $this->vatId = $id;
    }

    public function setRegistration($text)
    {
        $maxLength = 140;
        if (mb_strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of contact type must be <= $maxLength");
        }
        $this->registration = $text;
    }

    public function setContactType($type)
    {
        $maxLength = 17;
        if (mb_strlen($type) > $maxLength) {
            throw new \InvalidArgumentException("length of contact type must be <= $maxLength");
        }
        $this->contactType = $type;
    }

    public function setContactName($name)
    {
        $maxLength = 35;
        if (mb_strlen($name) > $maxLength) {
            throw new \InvalidArgumentException("length of contact name must be <= $maxLength");
        }
        $this->contactName = $name;
    }

    public function setContactPhone($phoneNumber)
    {
        $maxLength = 35;
        if (strlen($phoneNumber) > $maxLength) {
            throw new \InvalidArgumentException("length of contact email must be <= $maxLength");
        }
        $this->contactPhone = $phoneNumber;
    }

    public function setContactFax($faxNumber)
    {
        $maxLength = 35;
        if (strlen($faxNumber) > $maxLength) {
            throw new \InvalidArgumentException("length of contact fax must be <= $maxLength");
        }
        $this->contactFax = $faxNumber;
    }

    /**
     * @param string $email
     */
    public function setContactEmail($email)
    {
        $maxLength = 70;
        if (strlen($email) > $maxLength) {
            throw new \InvalidArgumentException("length of contact email must be <= $maxLength");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("email contact '$email' isn't valid email");
        }
        $this->contactEmail = $email;
    }

    public function fillXml(\SimpleXMLElement $element)
    {
        $element->addChild("party_qualifier", $this->qualifier);
        $element->addChild("party_ean", $this->ean);
        if ($this->description) {
            $element->addChild("party_description", $this->description);
        }
        if ($this->name) {
            $element->addChild("party_name", $this->name);
        }
        if ($this->street) {
            $element->addChild("street", $this->street);
        }
        if ($this->place) {
            $element->addChild("place", $this->place);
        }
        if ($this->postCode) {
            $element->addChild("postcode", $this->postCode);
        }
        if ($this->countryCode) {
            $element->addChild("country_code", $this->countryCode);
        }
        if ($this->countryName) {
            $element->addChild("country_name", $this->countryName);
        }
        if ($this->companyId) {
            $element->addChild("company_id", $this->companyId);
        }
        if (isset($this->taxId)) {
            $element->addChild("tax_id", $this->taxId);
        }
        if (isset($this->vatId)) {
            $element->addChild("vat_id", $this->vatId);
        }
        if ($this->registration) {
            $element->addChild("registration", $this->registration);
        }
        if ($this->contactType) {
            $element->addChild("contact_type", $this->contactType);
        }
        if ($this->contactName) {
            $element->addChild("contact_name", $this->contactName);
        }
        if ($this->contactPhone) {
            $element->addChild("contact_tel", $this->contactPhone);
        }
        if ($this->contactFax) {
            $element->addChild("contact_fax", $this->contactFax);
        }
        if ($this->contactEmail) {
            $element->addChild("contact_email", $this->contactEmail);
        }
    }
}
