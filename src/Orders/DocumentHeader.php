<?php
namespace Pilulka\Edi\Orders;

class DocumentHeader
{
    const PURPOSE_INITIAL = 9;
    const PURPOSE_CONFIRMATION = 42;

    const DELIVERY_DATE_PURPOSE_DELIVERY = 2;
    const DELIVERY_DATE_PURPOSE_PICKUP = 200;

    const TRANSPORT_MODE_CUSTOMER = "O";
    const TRANSPORT_MODE_SUPPLIER = "D";

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $number;

    /**
     * purpose of the order message
     * it corresponds the "doc_function" element
     * @var
     */
    private $purpose;

    /**
     * @var \DateTime
     */
    private $issueDate;
    /** @var boolean */
    private $useIssueTime;

    /**
     * @var \DateTime
     */
    private $deliveryDate;
    /** @var boolean */
    private $useDeliveryTime;

    /**
     * @var string
     */
    private $deliveryDatePurpose;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var string
     */
    private $transportMode;

    /**
     * @var string
     */
    private $promotionDeal;

    /**
     * @var string
     */
    private $contractNumber;

    /**
     * @var string
     */
    private $offerNumber;

    /**
     * @var string
     */
    private $referenceNumberFree;

    /**
     * @var Partner
     */
    private $partner;

    /**
     * @param string $number order number
     * @param \DateTime $issueDate
     * @param \DateTime $deliveryDate
     * @param Partner $partner
     */
    public function __construct($number, \DateTime $issueDate, \DateTime $deliveryDate, Partner $partner)
    {
        $maxLength = 15;
        if (strlen($number) > $maxLength) {
            throw new \InvalidArgumentException("length of number must be <= $maxLength");
        }

        $this->number = $number;
        $this->issueDate = $issueDate;
        $this->deliveryDate = $deliveryDate;
        $this->partner = $partner;
    }

    public function enableIssueTime()
    {
        $this->useIssueTime = true;
    }

    public function enableDeliveryTime()
    {
        $this->useDeliveryTime = true;
    }

    public function setType($type)
    {
        $maxLength = 3;
        if (strlen($type) > $maxLength) {
            throw new \InvalidArgumentException("length of type must be <= $maxLength");
        }

        $this->type = $type;
    }

    /**
     * @param string $purposeId one of the PURPOSE_* class constants
     */
    public function setPurpose($purposeId)
    {
        if ($purposeId != self::PURPOSE_INITIAL && $purposeId != self::PURPOSE_CONFIRMATION) {
            throw new \InvalidArgumentException("purpose must be one of the values: "
                . self::PURPOSE_INITIAL . ", " . self::PURPOSE_CONFIRMATION);
        }

        $this->purpose = $purposeId;
    }

    public function setIssueDate(\DateTime $date, $useTime = false)
    {
        $this->issueDate = $date;
        $this->useIssueTime = $useTime;
    }

    public function setDeliveryDate(\DateTime $date, $useTime = false)
    {
        $this->deliveryDate = $date;
        $this->useDeliveryTime = $useTime;
    }

    /**
     * @param string $purposeId one of the DELIVERY_DATE_PURPOSE* constants
     */
    public function setDeliveryDatePurpose($purposeId)
    {
        if ($purposeId != self::DELIVERY_DATE_PURPOSE_DELIVERY
            && $purposeId != self::DELIVERY_DATE_PURPOSE_PICKUP
        ) {
            throw new \InvalidArgumentException("delivery date purpose must be one of the values: "
                . self::DELIVERY_DATE_PURPOSE_DELIVERY . ", " . self::DELIVERY_DATE_PURPOSE_PICKUP);
        }
        $this->deliveryDatePurpose = $purposeId;
    }

    /**
     * @param string $code
     */
    public function setCurrencyCode($code)
    {
        $maxLength = 3;
        if (strlen($code) > $maxLength) {
            throw new \InvalidArgumentException("length of currency code must be <= $maxLength");
        }
        $this->currencyCode = $code;
    }

    /**
     * @param string $transportModeId one of the TRANSPORT_* class constants
     */
    public function setTransportMode($transportModeId)
    {
        if ($transportModeId != self::TRANSPORT_MODE_CUSTOMER
            && $transportModeId != self::TRANSPORT_MODE_SUPPLIER
        ) {
            throw new \InvalidArgumentException("transport mode must be one of the values: "
                . self::TRANSPORT_MODE_CUSTOMER . ", " . self::TRANSPORT_MODE_SUPPLIER);
        }
        $this->transportMode = $transportModeId;
    }

    public function setPromotionDeal($promotionInfo)
    {
        $maxLength = 35;
        if (mb_strlen($promotionInfo) > $maxLength) {
            throw new \InvalidArgumentException("length of promotion deal information must be <= $maxLength");
        }
        $this->promotionDeal = $promotionInfo;
    }

    public function setContractNumber($number)
    {
        $maxLength = 35;
        if (strlen($number) > $maxLength) {
            throw new \InvalidArgumentException("length of contract number must be <= $maxLength");
        }
        $this->contractNumber = $number;
    }

    /**
     * @param string $number
     */
    public function setOfferNumber($number)
    {
        $maxLength = 35;
        if (strlen($number) > $maxLength) {
            throw new \InvalidArgumentException("length of offer number must be <= $maxLength");
        }
        $this->offerNumber = $number;
    }

    /**
     * @param string $number
     */
    public function setFreeReferenceNumber($number)
    {
        $maxLength = 17;
        if (strlen($number) > $maxLength) {
            throw new \InvalidArgumentException("length of offer number must be <= $maxLength");
        }
        $this->referenceNumberFree = $number;
    }

    public function fillXml(\SimpleXMLElement $element)
    {
        if ($this->type) $element->addChild("doc_type", $this->type);
        $element->addChild("doc_number", $this->number);
        if ($this->purpose) $element->addChild("doc_function", $this->purpose);
        $element->addChild("doc_date_of_issue", $this->issueDate->format("Y-m-d"));
        if ($this->useIssueTime) $element->addChild("doc_time_of_issue", $this->issueDate->format("G:i:s"));
        $element->addChild("delivery_date", $this->deliveryDate->format("Y-m-d"));
        if ($this->useDeliveryTime) $element->addChild("delivery_time", $this->deliveryDate->format("G:i:s"));
        if ($this->deliveryDatePurpose) $element->addChild("delivery_type", $this->deliveryDatePurpose);
        if ($this->currencyCode) $element->addChild("currency_code", $this->currencyCode);
        if ($this->transportMode) $element->addChild("transport_mode", $this->transportMode);
        if ($this->promotionDeal) $element->addChild("promotion_deal", $this->promotionDeal);
        if ($this->contractNumber) $element->addChild("contract_number", $this->contractNumber);
        if ($this->offerNumber) $element->addChild("offer_number_supplier", $this->offerNumber);
        if ($this->referenceNumberFree) $element->addChild("reference_number_free", $this->referenceNumberFree);

        $this->partner->fillXml($element->addChild("party"));
    }
}
