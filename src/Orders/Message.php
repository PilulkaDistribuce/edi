<?php
namespace Pilulka\Edi\Orders;



class LineItem
{
    private $number;
    private $gtin;
    private $idBySupplier;
    private $idByBuyer;
    private $quantity;
    private $quantityType;
    private $unit;
    private $numberOfUnits;
    /**
     * @var \DateTime
     */
    private $deliveryDate;
    private $deliveryType;
    private $expiryRemaining;
    private $expiryRemainingQualifier;
    private $articleName;
    private $grossPrice;
    private $allowanceRate;
    private $allowanceTotal;
    private $netPrice;
    private $totalPrice;
    private $specification;
    private $promotionDeal;
    private $referenceNumberFee;
    private $freeText;
}

class LineItemAddition
{
    private $typeId;
    private $codeId;
    private $description;
}

class Notice
{
    private $number;
    private $text1;

    private $text2;
    private $text3;
    private $text4;
    private $text5;

    public function __construct($number, $text1)
    {
        $this->number = $number;
        $this->text1 = $text1;
    }

    /**
     * @param int $number text number, must be in range 2..5
     * @param string $text
     */
    public function setText($number, $text)
    {
        switch ($number) {
            case 2:
                $this->text2 = $text;
                break;
            case 3:
                $this->text3 = $text;
                break;
            case 4:
                $this->text4 = $text;
                break;
            case 5:
                $this->text5 = $text;
                break;
            default:
                throw new \InvalidArgumentException("text number must be in range (2..5)");
        }
    }
}

class Summary
{
    private $priceOrdered;
    private $allowanceRate;
    private $allowance;
    private $totalQuantity;
    private $itemsPrice;
    private $numberOfItems;
    private $numberOfTexts;
}
