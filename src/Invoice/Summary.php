<?php


namespace Pilulka\Edi\Invoice;


class Summary
{
    /** @var  \SimpleXMLElement */
    private $xml;

    private $numberOfItems;
    private $totalQuantity;
    private $priceInvoiced;
    private $itemsPrice;
    private $taxableAmount;
    private $advancePaymentRate;
    private $advancePaymentPrice;
    private $advancePaymentPaid;
    private $remainsUnsettled;
    private $roundingDifference;
    private $tax_details;

    private $requiredParameters = ['price_invoiced'];

    /**
     * Summary constructor.
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
        $this->setNumberOfItems($this->xml->number_of_items);
        $this->setTotalQuantity($this->xml->total_quantity);
        $this->setPriceInvoiced($this->xml->price_invoiced);
        $this->setItemsPrice($this->xml->items_price);
        $this->setTaxableAmount($this->xml->taxable_amount);
        $this->setAdvancePaymentRate($this->xml->advance_payment_rate);
        $this->setAdvancePaymentPrice($this->xml->advance_payment_price);
        $this->setAdvancePaymentPaid($this->xml->advance_payment_paid);
        $this->setRemainsUnsettled($this->xml->remains_unsettled);
        $this->setRoundingDifference($this->xml->rounding_difference);
        $this->setTaxDetails(new TaxDetail($this->xml->tax_details));
    }

    /**
     * @return mixed
     */
    public function getNumberOfItems()
    {
        return (int)$this->numberOfItems;
    }

    /**
     * @param mixed $numberOfItems
     * @return Summary
     */
    public function setNumberOfItems($numberOfItems)
    {
        $this->numberOfItems = $numberOfItems;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalQuantity()
    {
        return (int)$this->totalQuantity;
    }

    /**
     * @param mixed $totalQuantity
     * @return Summary
     */
    public function setTotalQuantity($totalQuantity)
    {
        $this->totalQuantity = $totalQuantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceInvoiced()
    {
        return (float)$this->priceInvoiced;
    }

    /**
     * @param mixed $priceInvoiced
     * @return Summary
     */
    public function setPriceInvoiced($priceInvoiced)
    {
        $this->priceInvoiced = $priceInvoiced;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemsPrice()
    {
        return (float)$this->itemsPrice;
    }

    /**
     * @param mixed $itemsPrice
     * @return Summary
     */
    public function setItemsPrice($itemsPrice)
    {
        $this->itemsPrice = $itemsPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxableAmount()
    {
        return (float)$this->taxableAmount;
    }

    /**
     * @param mixed $taxableAmount
     * @return Summary
     */
    public function setTaxableAmount($taxableAmount)
    {
        $this->taxableAmount = $taxableAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvancePaymentRate()
    {
        return (float)$this->advancePaymentRate;
    }

    /**
     * @param mixed $advancePaymentRate
     * @return Summary
     */
    public function setAdvancePaymentRate($advancePaymentRate)
    {
        $this->advancePaymentRate = $advancePaymentRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvancePaymentPrice()
    {
        return (float)$this->advancePaymentPrice;
    }

    /**
     * @param mixed $advancePaymentPrice
     * @return Summary
     */
    public function setAdvancePaymentPrice($advancePaymentPrice)
    {
        $this->advancePaymentPrice = $advancePaymentPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdvancePaymentPaid()
    {
        return (float)$this->advancePaymentPaid;
    }

    /**
     * @param mixed $advancePaymentPaid
     * @return Summary
     */
    public function setAdvancePaymentPaid($advancePaymentPaid)
    {
        $this->advancePaymentPaid = $advancePaymentPaid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemainsUnsettled()
    {
        return (float)$this->remainsUnsettled;
    }

    /**
     * @param mixed $remainsUnsettled
     * @return Summary
     */
    public function setRemainsUnsettled($remainsUnsettled)
    {
        $this->remainsUnsettled = $remainsUnsettled;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoundingDifference()
    {
        return (float)$this->roundingDifference;
    }

    /**
     * @param mixed $roundingDifference
     * @return Summary
     */
    public function setRoundingDifference($roundingDifference)
    {
        $this->roundingDifference = $roundingDifference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxDetails()
    {
        return $this->tax_details;
    }

    /**
     * @param mixed $tax_details
     * @return Summary
     */
    public function setTaxDetails($tax_details)
    {
        $this->tax_details = $tax_details;
        return $this;
    }


}