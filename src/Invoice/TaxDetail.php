<?php


namespace Pilulka\Edi\Invoice;


class TaxDetail
{
    /** @var  \SimpleXMLElement */
    private $xml;

    private $vat;
    private $vatTotal;
    private $exciseDuty;

    private $requiredParameters = [];

    /**
     * TaxDetail constructor.
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
        $this->setVat(new Vat($this->xml->vat));
        $this->setVatTotal($this->xml->vat_total);
        $this->setExciseDuty($this->xml->excise_duty);
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     * @return TaxDetail
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
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
     * @return TaxDetail
     */
    public function setVatTotal($vatTotal)
    {
        $this->vatTotal = $vatTotal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExciseDuty()
    {
        return (float)$this->exciseDuty;
    }

    /**
     * @param mixed $exciseDuty
     * @return TaxDetail
     */
    public function setExciseDuty($exciseDuty)
    {
        $this->exciseDuty = $exciseDuty;
        return $this;
    }


}