<?php
namespace Pilulka\Edi\Orders;

class Summary
{
    /**
     * @var float
     */
    private $priceOrdered;

    /**
     * @var float
     */
    private $totalAllowanceRate;

    /**
     * @var float
     */
    private $totalAllowance;

    /**
     * @var int
     */
    private $totalQuantity;

    /**
     * @var float
     */
    private $itemsPrice;

    /**
     * @var int
     */
    private $numberOfItems;

    /**
     * @var int
     */
    private $numberOfTexts;

    /**
     * @param float $price
     */
    public function setPriceOrdered($price)
    {
        $this->priceOrdered = $price;
    }

    /**
     * @param float $rate
     */
    public function setTotalAllowanceRate($rate)
    {
        $this->totalAllowanceRate = $rate;
    }

    /**
     * @param float $price
     */
    public function setTotalAllowance($price)
    {
        $this->totalAllowance = $price;
    }

    /**
     * @param int $amount
     */
    public function setTotalQuantity($amount)
    {
        $this->totalQuantity = $amount;
    }

    /**
     * @param float $price
     */
    public function setItemsPrice($price)
    {
        $this->itemsPrice = $price;
    }

    /**
     * @param int $count
     */
    public function setNumberOfItems($count)
    {
        $this->numberOfItems = $count;
    }

    /**
     * @param int $count
     */
    public function setNumberOfTexts($count)
    {
        $this->numberOfTexts = $count;
    }

    public function fillXml(\SimpleXMLElement $element)
    {
        if ($this->priceOrdered) {
            $element->addChild("price_ordered", $this->priceOrdered);
        }
        if ($this->itemsPrice) {
            $element->addChild("items_price", $this->itemsPrice);
        }
        if ($this->totalAllowanceRate) {
            $element->addChild("total_allowance_rate", $this->totalAllowanceRate);
        }
        if ($this->totalAllowance) {
            $element->addChild("total_allowance", $this->totalAllowance);
        }
        if ($this->totalQuantity) {
            $element->addChild("total_quantity", $this->totalQuantity);
        }
        if ($this->numberOfItems) {
            $element->addChild("number_of_items", $this->numberOfItems);
        }
        if ($this->numberOfTexts) {
            $element->addChild("number_of_texts", $this->numberOfTexts);
        }
    }
}

