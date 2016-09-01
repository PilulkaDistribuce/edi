<?php
namespace Pilulka\Edi\Orders;

class LineItem
{
    const QUANTITY_TYPE_ORDERED = "21";
    const QUANTITY_TYPE_PROMO = "91E";
    const QUANTITY_TYPE_FREE = "192";

    const DELIVERY_TYPE_DELIVERY = 2;
    const DELIVERY_TYPE_WITHDRAW = 200;

    const EXPIRY_REMAINING_QUALIFIER_YEAR = 801;
    const EXPIRY_REMAINING_QUALIFIER_MONTH = 802;
    const EXPIRY_REMAINING_QUALIFIER_WEEK = 803;
    const EXPIRY_REMAINING_QUALIFIER_DAY = 804;
    const EXPIRY_REMAINING_QUALIFIER_HOUR = 805;

    private $gtin;
    private $quantity;
    private $articleName;
    private $supplierArticleId;
    private $buyerArticleId;

    /**
     * @var \stdClass
     */
    private $complementaryArticle;

    private $quantityType;

    private $deliveryType;
    private $unit;
    /**
     * @var int
     */
    private $numberOfUnits;
    /**
     * @var \DateTime
     */
    private $deliveryDate;
    /**
     * @var bool
     */
    private $useDeliveryTime;

    /**
     * @var int
     */
    private $expiryRemaining;

    /**
     * @var string
     */
    private $expiryRemainingQualifier;

    /**
     * @var float
     */
    private $grossPrice;
    /**
     * @var float
     */
    private $allowanceRate;

    /**
     * @var float
     */
    private $allowanceTotal;

    /**
     * @var float
     */
    private $netPrice;

    /**
     * @var float
     */
    private $totalPrice;
    private $specification;
    private $promotionDeal;
    private $referenceNumberFree;
    private $freeText;

    public function __construct($gtin, $quantity, $articleName)
    {
        // gtin
        if (!is_numeric($gtin)) {
            throw new \InvalidArgumentException("gtin must be an number");
        }
        $maxLength = 25;
        if (strlen($gtin) > $maxLength) {
            throw new \InvalidArgumentException("length of gtin must be <= $maxLength");
        }
        $this->gtin = $gtin;

        // quantity
        if (!is_numeric($quantity)) {
            throw new \InvalidArgumentException("quantity must be an number");
        }
        $maxLength = 12;
        if (strlen($quantity) > $maxLength) {
            throw new \InvalidArgumentException("length of quantity must be <= $maxLength");
        }
        $this->quantity = $quantity;

        // article name
        $maxLength = 70;
        if (mb_strlen($articleName) > $maxLength) {
            throw new \InvalidArgumentException("length of article name must be <= $maxLength");
        }
        $this->articleName = $articleName;
    }

    public function setSupplierArticleId($id)
    {
        $maxLength = 25;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of article ID by supplier must be <= $maxLength");
        }
        $this->supplierArticleId = $id;
    }

    public function setBuyerArticleId($id)
    {
        $maxLength = 25;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of article ID by buyer must be <= $maxLength");
        }
        $this->buyerArticleId = $id;
    }

    public function setComplementaryArticle($type, $code, $description)
    {

        $complementaryArticle = new \stdClass;
        $maxLength = 3;
        if (strlen($type) > $maxLength) {
            throw new \InvalidArgumentException("length of type for complementary article must be <= $maxLength");
        }
        $complementaryArticle->type = $type;

        $maxLength = 35;
        if (strlen($code) > $maxLength) {
            throw new \InvalidArgumentException("length of code for complementary article must be <= $maxLength");
        }
        $complementaryArticle->code = $code;

        $maxLength = 70;
        if (mb_strlen($description) > $maxLength) {
            throw new \InvalidArgumentException("length of description for complementary article must be <= $maxLength");
        }
        $complementaryArticle->description = $description;

        $this->complementaryArticle = $complementaryArticle;
    }

    public function setQuantityType($type)
    {
        if ($type != self::QUANTITY_TYPE_ORDERED && $type !== self::QUANTITY_TYPE_FREE
            && $type = self::QUANTITY_TYPE_PROMO) {
            throw new \InvalidArgumentException("undefined quantity type, use one of values: "
                . self::QUANTITY_TYPE_PROMO  . ", " . self::QUANTITY_TYPE_ORDERED . ", ", self::QUANTITY_TYPE_ORDERED);
        }
        $this->quantityType = $type;
    }

    /**
     * @param string $unit e.g. PCE
     */
    public function setISOQuantityUnit($unit)
    {
        $maxLength = 3;
        if (strlen($unit) > $maxLength) {
            throw new \InvalidArgumentException("length of ISO quantity unit must be <= $maxLength");
        }
        $this->unit = $unit;
    }

    /**
     * @param int $number
     */
    public function setNumberOfUnits($number)
    {
        $this->numberOfUnits = $number;
    }

    public function setDeliveryDate(\DateTime $date, $useTime = false)
    {
        $this->deliveryDate = $date;
        $this->useDeliveryTime = $useTime;
    }

    /**
     * @param string $type
     */
    public function setDeliveryType($type)
    {
        if ($type != self::DELIVERY_TYPE_DELIVERY && $type !== self::DELIVERY_TYPE_WITHDRAW) {
            throw new \InvalidArgumentException("undefined delivery type, use one of values: "
                . self::DELIVERY_TYPE_DELIVERY . ", " . self::DELIVERY_TYPE_DELIVERY);
        }
        $this->deliveryType = $type;
    }

    /**
     * @param int $units
     */
    public function setExpiryRemaining($units)
    {
        if (!is_numeric($units)) {
            throw new \InvalidArgumentException("gtin must be an number");
        }
        $maxLength = 4;
        if (strlen($units) > $maxLength) {
            throw new \InvalidArgumentException("length of expiry remaining must be <= $maxLength");
        }
        $this->expiryRemaining = $units;
    }

    public function setExpiryRemainingQualifier($qualifier)
    {
        $qualifiers = [
            self::EXPIRY_REMAINING_QUALIFIER_YEAR,
            self::EXPIRY_REMAINING_QUALIFIER_MONTH,
            self::EXPIRY_REMAINING_QUALIFIER_DAY,
            self::EXPIRY_REMAINING_QUALIFIER_HOUR
        ];
        if (!in_array($qualifier, $qualifiers)) {
            throw new \InvalidArgumentException("undefined qualifier '$qualifier', use one of the values:"
                . implode(", ", $qualifiers));
        }
        $this->expiryRemainingQualifier = $qualifier;
    }

    /**
     * @param float|int $price
     */
    public function setGrossPrice($price)
    {
        $this->grossPrice = $price;
    }

    /**
     * @param float $rate in percentage
     */
    public function setAllowanceRate($rate)
    {
        $this->allowanceRate = $rate;
    }

    /**
     * @param float $price
     */
    public function setAllowanceTotal($price)
    {
        $this->allowanceTotal = $price;
    }

    /**
     * @param float $price
     */
    public function setNetPrice($price)
    {
        $this->netPrice = $price;
    }

    /**
     * @param float $price
     */
    public function setTotalPrice($price)
    {
        $this->totalPrice = $price;
    }

    /**
     * @param string $text
     */
    public function setSpecification($text)
    {
        $maxLength = 70;
        if (mb_strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of specification text must be <= $maxLength");
        }
        $this->specification = $text;
    }

    public function setPromotionDeal($text)
    {
        $maxLength = 35;
        if (mb_strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of promotion deal text must be <= $maxLength");
        }
        $this->promotionDeal = $text;
    }

    public function setReferenceNumberFree($id)
    {
        $maxLength = 17;
        if (mb_strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of reference number free must be <= $maxLength");
        }
        $this->referenceNumberFree = $id;
    }

    public function setFreeText($text)
    {
        $maxLength = 140;
        if (mb_strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of free text must be <= $maxLength");
        }
        $this->freeText = $text;
    }

    public function fillXml($number, \SimpleXMLElement $element)
    {
        $element->addChild("item_number", $number);
        $element->addChild("article_gtin", $this->gtin);
        if ($this->supplierArticleId) $element->addChild("article_id_supplier", $this->supplierArticleId);
        if ($this->buyerArticleId) $element->addChild("article_id_buyer", $this->buyerArticleId);
        if ($this->complementaryArticle) {
            $complementaryElement = $element->addChild("article_id_add");
            $complementaryElement->addChild("article_id_type", $this->complementaryArticle->type);
            $complementaryElement->addChild("article_id_code", $this->complementaryArticle->code);
            $complementaryElement->addChild("article_id_description", $this->complementaryArticle->description);
        }
        $element->addChild("quantity", $this->quantity);
        if ($this->quantityType) {
            $element->addChild("quantity_type", $this->quantityType);
        }
        if ($this->unit) {
            $element->addChild("unit", $this->unit);
        }
        if ($this->numberOfUnits) {
            $element->addChild("number_of_units", $this->numberOfUnits);
        }
        if ($this->deliveryDate) {
            $element->addChild("delivery_date", $this->deliveryDate->format("Y-m-d"));
        }
        if ($this->useDeliveryTime) {
            $element->addChild("delivery_time", $this->deliveryDate->format("G:i:s"));
        }
        if ($this->deliveryType) {
            $element->addChild("delivery_type", $this->deliveryType);
        }
        if ($this->expiryRemaining) {
            $element->addChild("expiry_remaining", $this->expiryRemaining);
        }
        if ($this->expiryRemainingQualifier) {
            $element->addChild("expiry_remaining_qualifier", $this->expiryRemainingQualifier);
        }
        $element->addChild("article_name", $this->articleName);
        if ($this->grossPrice) {
            $element->addChild("gross_price", $this->grossPrice);
        }
        if ($this->allowanceRate) {
            $element->addChild("allowance_rate", $this->allowanceRate);
        }
        if ($this->allowanceTotal) {
            $element->addChild("allowance_total", $this->allowanceTotal);
        }
        if ($this->netPrice) {
            $element->addChild("net_price", $this->netPrice);
        }
        if ($this->totalPrice) {
            $element->addChild("total_price", $this->totalPrice);
        }
        if ($this->specification) {
            $element->addChild("specification", $this->specification);
        }
        if ($this->promotionDeal) {
            $element->addChild("promotion_deal", $this->promotionDeal);
        }
        if ($this->referenceNumberFree) {
            $element->addChild("reference_number_free", $this->referenceNumberFree);
        }
        if ($this->freeText) {
            $element->addChild("free_text", $this->freeText);
        }
    }
}
