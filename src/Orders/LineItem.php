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
        if (!$gtin) {
            throw new \InvalidArgumentException("gtin is mandatory and must be a number - {$gtin} given");
        }
        if (!is_numeric($gtin)) {
            throw new \InvalidArgumentException("Invalid gtin: {$gtin} given.");
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
        $maxLength = 70;
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

    /**
     * @param string $type
     * @param string $code
     * @param string $description
     */
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
                . self::QUANTITY_TYPE_PROMO . ", " . self::QUANTITY_TYPE_ORDERED . ", ", self::QUANTITY_TYPE_ORDERED);
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

    /**
     * @param \DateTime $date
     * @param bool $enableTime enable/disable usage of time part from the "date" parameter
     */
    public function setDeliveryDate(\DateTime $date, $enableTime = false)
    {
        $this->deliveryDate = $date;
        $this->useDeliveryTime = $enableTime;
    }

    /**
     * @param string $type one of the DELIVERY_TYPE* constants
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

    /**
     * @param int $qualifier one of the EXPIRY_REMAINING_QUALIFIER_* constants
     */
    public function setExpiryRemainingQualifier($qualifier)
    {
        if (!in_array($qualifier, $qualifiers = [
            self::EXPIRY_REMAINING_QUALIFIER_YEAR,
            self::EXPIRY_REMAINING_QUALIFIER_MONTH,
            self::EXPIRY_REMAINING_QUALIFIER_DAY,
            self::EXPIRY_REMAINING_QUALIFIER_HOUR
        ])) {
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

    /**
     * @param float $price
     * @return string
     */
    private static function formatPrice($price)
    {
        if ((int)($price * 100) !== (int)$price * 100) {
            return number_format($price, 2, ".", "");
        }
        return $price;
    }

    public function fillXml($number, \SimpleXMLElement $element)
    {
        $element->addChild("item_number", $number);
        $element->addChild("article_gtin", $this->gtin);
        if ($this->supplierArticleId) {
            $element->addChild("article_id_supplier", $this->supplierArticleId);
        }
        if ($this->buyerArticleId) {
            $element->addChild("article_id_buyer", $this->buyerArticleId);
        }
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
        $articleName = htmlspecialchars($this->articleName);
        $element->addChild("article_name", iconv(mb_detect_encoding($articleName), "UTF-8", $articleName));
        if ($this->grossPrice) {
            $element->addChild("gross_price", self::formatPrice($this->grossPrice));
        }
        if ($this->allowanceRate) {
            $element->addChild("allowance_rate", self::formatPrice($this->allowanceRate));
        }
        if ($this->allowanceTotal) {
            $element->addChild("allowance_total", self::formatPrice($this->allowanceTotal));
        }
        if ($this->netPrice) {
            $element->addChild("net_price", self::formatPrice($this->netPrice));
        }
        if ($this->totalPrice) {
            $element->addChild("total_price", self::formatPrice($this->totalPrice));
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

    /**
     * @return int|string
     */
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * @return int|string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * @return mixed
     */
    public function getSupplierArticleId()
    {
        return $this->supplierArticleId;
    }

    /**
     * @return mixed
     */
    public function getBuyerArticleId()
    {
        return $this->buyerArticleId;
    }

    /**
     * @return \stdClass
     */
    public function getComplementaryArticle()
    {
        return $this->complementaryArticle;
    }

    /**
     * @return mixed
     */
    public function getQuantityType()
    {
        return $this->quantityType;
    }

    /**
     * @return mixed
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return int
     */
    public function getNumberOfUnits()
    {
        return $this->numberOfUnits;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @return bool
     */
    public function isUseDeliveryTime()
    {
        return $this->useDeliveryTime;
    }

    /**
     * @return int
     */
    public function getExpiryRemaining()
    {
        return $this->expiryRemaining;
    }

    /**
     * @return string
     */
    public function getExpiryRemainingQualifier()
    {
        return $this->expiryRemainingQualifier;
    }

    /**
     * @return float
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @return float
     */
    public function getAllowanceRate()
    {
        return $this->allowanceRate;
    }

    /**
     * @return float
     */
    public function getAllowanceTotal()
    {
        return $this->allowanceTotal;
    }

    /**
     * @return float
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @return mixed
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @return mixed
     */
    public function getPromotionDeal()
    {
        return $this->promotionDeal;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumberFree()
    {
        return $this->referenceNumberFree;
    }

    /**
     * @return mixed
     */
    public function getFreeText()
    {
        return $this->freeText;
    }


}
