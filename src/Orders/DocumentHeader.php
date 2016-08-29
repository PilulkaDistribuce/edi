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
     * @var array
     */
    private $partners;


    /**
     * @param string $number order number
     * @param \DateTime $issueDate
     * @param \DateTime $deliveryDate
     */
    public function __construct($number, \DateTime $issueDate, \DateTime $deliveryDate)
    {
        $maxLength = 15;
        if (strlen($number) > $maxLength) {
            throw new \InvalidArgumentException("length of number must be <= $maxLength");
        }

        $this->issueDate = $issueDate;
        $this->deliveryDate = $issueDate;
    }

    public function enableIssueTime()
    {
        $this->useIssueTime = true;
    }

    public function enableDeliveryTime()
    {
        $this->useDeliveryTime = true;
    }

    public function setPurpose($purposeId)
    {
        if ($purposeId != self::PURPOSE_INITIAL || $purposeId != self::PURPOSE_CONFIRMATION) {
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

    public function setDeliveryDatePurpose($purposeId)
    {
        if ($purposeId != self::DELIVERY_DATE_PURPOSE_DELIVERY
            || $purposeId != self::DELIVERY_DATE_PURPOSE_PICKUP) {
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
     * @param string $transportModeId
     */
    public function setTransportMode($transportModeId)
    {
        if ($transportModeId != self::TRANSPORT_MODE_CUSTOMER
            || $transportModeId != self::TRANSPORT_MODE_SUPPLIER) {
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
}
