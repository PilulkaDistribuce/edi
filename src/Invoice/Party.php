<?php


namespace Pilulka\Edi\Invoice;


class Party
{
    /** @var  \SimpleXMLElement */
    private $xml;


    private $partyQualifier;
    private $partyId;
    private $partyDescription;
    private $partyName;
    private $street;
    private $place;
    private $postcode;
    private $countryCode;
    private $countryName;
    private $companyId;
    private $taxId;
    private $vatId;
    private $contactType;
    private $contactName;
    private $contactTel;
    private $contactFax;
    private $contactEmail;
    private $accountNumber;
    private $bankCode;
    private $bankName;
    private $iban;
    private $swift;
    private $constantSymbol;
    private $variableSymbol;
    private $specialSymbol;

    private $requiredParameters = ['party_qualifier'];

    /**
     * Party constructor.
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;

        $this->validate();
        $this->fillData();
    }

    private function validate()
    {
        foreach ($this->requiredParameters as $param) {
            if (!isset($this->xml->{$param}) || empty($this->xml->{$param})) {
                throw new \Exception("$param is empty");
            }
        }
    }

    private function fillData()
    {
        $this->setPartyQualifier($this->xml->party_qualifier);
        $this->setPartyId($this->xml->party_id);
        $this->setPartyDescription($this->xml->party_description);
        $this->setPartyName($this->xml->party_name);
        $this->setStreet($this->xml->street);
        $this->setPlace($this->xml->place);
        $this->setPostcode($this->xml->postcode);
        $this->setCountryCode($this->xml->country_code);
        $this->setCountryName($this->xml->country_name);
        $this->setCompanyId($this->xml->company_id);
        $this->setTaxId($this->xml->tax_id);
        $this->setVatId($this->xml->vat_id);
        $this->setContactType($this->xml->contact_type);
        $this->setContactName($this->xml->contact_name);
        $this->setContactTel($this->xml->contact_tel);
        $this->setContactFax($this->xml->contact_fax);
        $this->setContactEmail($this->xml->contact_email);
        $this->setAccountNumber($this->xml->account_number);
        $this->setBankCode($this->xml->bank_code);
        $this->setBankName($this->xml->bank_name);
        $this->setIban($this->xml->iban);
        $this->setSwift($this->xml->swift);
        $this->setConstantSymbol($this->xml->constant_symbol);
        $this->setVariableSymbol($this->xml->variable_symbol);
        $this->setSpecialSymbol($this->xml->specific_symbol);
    }

    /**
     * @return mixed
     */
    public function getPartyQualifier()
    {
        return (string)$this->partyQualifier;
    }

    /**
     * @param mixed $partyQualifier
     * @return Party
     */
    public function setPartyQualifier($partyQualifier)
    {
        $this->partyQualifier = $partyQualifier;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartyId()
    {
        return (string)$this->partyId;
    }

    /**
     * @param mixed $partyId
     * @return Party
     */
    public function setPartyId($partyId)
    {
        $this->partyId = $partyId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartyDescription()
    {
        return (string)$this->partyDescription;
    }

    /**
     * @param mixed $partyDescription
     * @return Party
     */
    public function setPartyDescription($partyDescription)
    {
        $this->partyDescription = $partyDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartyName()
    {
        return (string)$this->partyName;
    }

    /**
     * @param mixed $partyName
     * @return Party
     */
    public function setPartyName($partyName)
    {
        $this->partyName = $partyName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return (string)$this->street;
    }

    /**
     * @param mixed $street
     * @return Party
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return (string)$this->place;
    }

    /**
     * @param mixed $place
     * @return Party
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return (string)$this->postcode;
    }

    /**
     * @param mixed $postcode
     * @return Party
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return (string)$this->countryCode;
    }

    /**
     * @param mixed $countryCode
     * @return Party
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return (string)$this->countryName;
    }

    /**
     * @param mixed $countryName
     * @return Party
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return (string)$this->companyId;
    }

    /**
     * @param mixed $companyId
     * @return Party
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxId()
    {
        return (string)$this->taxId;
    }

    /**
     * @param mixed $taxId
     * @return Party
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatId()
    {
        return (string)$this->vatId;
    }

    /**
     * @param mixed $vatId
     * @return Party
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactType()
    {
        return (string)$this->contactType;
    }

    /**
     * @param mixed $contactType
     * @return Party
     */
    public function setContactType($contactType)
    {
        $this->contactType = $contactType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactName()
    {
        return (string)$this->contactName;
    }

    /**
     * @param mixed $contactName
     * @return Party
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactTel()
    {
        return (string)$this->contactTel;
    }

    /**
     * @param mixed $contactTel
     * @return Party
     */
    public function setContactTel($contactTel)
    {
        $this->contactTel = $contactTel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactFax()
    {
        return (string)$this->contactFax;
    }

    /**
     * @param mixed $contactFax
     * @return Party
     */
    public function setContactFax($contactFax)
    {
        $this->contactFax = $contactFax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return (string)$this->contactEmail;
    }

    /**
     * @param mixed $contactEmail
     * @return Party
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return (string)$this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     * @return Party
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return (string)$this->bankCode;
    }

    /**
     * @param mixed $bankCode
     * @return Party
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return (string)$this->bankName;
    }

    /**
     * @param mixed $bankName
     * @return Party
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return (string)$this->iban;
    }

    /**
     * @param mixed $iban
     * @return Party
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSwift()
    {
        return (string)$this->swift;
    }

    /**
     * @param mixed $swift
     * @return Party
     */
    public function setSwift($swift)
    {
        $this->swift = $swift;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConstantSymbol()
    {
        return (string)$this->constantSymbol;
    }

    /**
     * @param mixed $constantSymbol
     * @return Party
     */
    public function setConstantSymbol($constantSymbol)
    {
        $this->constantSymbol = $constantSymbol;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariableSymbol()
    {
        return (string)$this->variableSymbol;
    }

    /**
     * @param mixed $variableSymbol
     * @return Party
     */
    public function setVariableSymbol($variableSymbol)
    {
        $this->variableSymbol = $variableSymbol;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecialSymbol()
    {
        return (string)$this->specialSymbol;
    }

    /**
     * @param mixed $specialSymbol
     * @return Party
     */
    public function setSpecialSymbol($specialSymbol)
    {
        $this->specialSymbol = $specialSymbol;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredParameters()
    {
        return (string)$this->requiredParameters;
    }

    /**
     * @param array $requiredParameters
     * @return Party
     */
    public function setRequiredParameters($requiredParameters)
    {
        $this->requiredParameters = $requiredParameters;
        return $this;
    }


}