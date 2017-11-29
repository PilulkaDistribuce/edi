<?php


namespace Pilulka\Edi\Invoice;


class Vat
{
    /** @var  \SimpleXMLElement */
    private $xml;

    private $vatGroup;
    private $vatBasis;
    private $vatRate;
    private $vatTotal;
    private $reverseCharge;
    private $localCurrency;

    private $requiredParameters = [];

    /**
     * Vat constructor.
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
        $this->setVatGroup($this->xml->vat_group);
        $this->setVatBasis($this->xml->vat_basis);
        $this->setVatRate($this->xml->vat_rate);
        $this->setVatTotal($this->xml->vat_total);
        $this->setReverseCharge($this->xml->reverse_charge);
        $this->setLocalCurrency($this->xml->local_currency);
    }


    /**
     * @return mixed
     */
    public function getVatGroup()
    {
        return (string)$this->vatGroup;
    }

    /**
     * @param mixed $vatGroup
     * @return Vat
     */
    public function setVatGroup($vatGroup)
    {
        $this->vatGroup = $vatGroup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatBasis()
    {
        return (float)$this->vatBasis;
    }

    /**
     * @param mixed $vatBasis
     * @return Vat
     */
    public function setVatBasis($vatBasis)
    {
        $this->vatBasis = $vatBasis;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatRate()
    {
        return (float)$this->vatRate;
    }

    /**
     * @param mixed $vatRate
     * @return Vat
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatTotal()
    {
        return (float)$this->vatTotal;
    }

    /**
     * @param mixed $vatTotal
     * @return Vat
     */
    public function setVatTotal($vatTotal)
    {
        $this->vatTotal = $vatTotal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReverseCharge()
    {
        return (string)$this->reverseCharge;
    }

    /**
     * @param mixed $reverseCharge
     * @return Vat
     */
    public function setReverseCharge($reverseCharge)
    {
        $this->reverseCharge = $reverseCharge;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocalCurrency()
    {
        return (string)$this->localCurrency;
    }

    /**
     * @param mixed $localCurrency
     * @return Vat
     */
    public function setLocalCurrency($localCurrency)
    {
        $this->localCurrency = $localCurrency;
        return $this;
    }



}