<?php
namespace Pilulka\Edi\Ordrsp;

class DeliveryInfo
{
    const DOCUMENT_TYPE = 231;

    const PURPOSE_ORIGINAL = 9;
    const PURPOSE_CANCEL = 1;
    const PURPOSE_COMPENSATION = 5;
    const PURPOSE_DUPLICATE = 7;
    const PURPOSE_COPY = 31;
    const PURPOSE_ADDITION = 43;

    /**
     * @var string
     */
    private $documentNumber;

    /**
     * @var string
     */
    private $orderNumber;

    /**
     * one of the PURPOSE_* constants
     * @var int
     */
    private $purpose;

    /**
     * @var \DateTime
     */
    private $dateOfIssue;

    /**
     * @var \DateTime
     */
    private $deliveryDate;

    public function __construct(\SimpleXMLElement $xml)
    {
        if ((!$documentNumber = (string)$xml->doc_number)) {
            throw new \InvalidArgumentException("doc_number isn't presented");
        }
        $this->documentNumber = $documentNumber;

        if ((!$orderNumber = (string)$xml->order_number)) {
            throw new \InvalidArgumentException("order_number isn't presented");
        }
        $this->orderNumber = $orderNumber;

        if ((int)$xml->doc_type != self::DOCUMENT_TYPE) {
            throw new \InvalidArgumentException("it seems that doc_type isn't expected value " . self::DOCUMENT_TYPE);
        }

        if (($purpose = (int)$xml->doc_function)) {
            $this->purpose = $purpose;
        }

        if ((!$dateOfIssue = (string)$xml->doc_date_of_issue)) {
            throw new \InvalidArgumentException("doc_date_of_issue isn't presented");
        }
        $this->dateOfIssue = new \DateTime($dateOfIssue . " " . $xml->doc_time_of_issue);

        if ($xml->delivery_date) {
            $this->deliveryDate = new \DateTime($xml->delivery_date . " " . $xml->delivery_time);
        }
    }

    public function getDocumentNumber() {
        return $this->documentNumber;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    public function getPurpose() {
        if (!$this->purpose) return;

        switch ($this->purpose) {
            case self::PURPOSE_ORIGINAL:
                return self::PURPOSE_ORIGINAL;
                break;
            case self::PURPOSE_CANCEL:
                return self::PURPOSE_CANCEL;
                break;
            case self::PURPOSE_COMPENSATION:
                return self::PURPOSE_COMPENSATION;
                break;
            case self::PURPOSE_DUPLICATE:
                return self::PURPOSE_DUPLICATE;
                break;
            case self::PURPOSE_COPY:
                return self::PURPOSE_COPY;
                break;
            case self::PURPOSE_ADDITION:
                return self::PURPOSE_ADDITION;
                break;
            default:
                throw new \UnexpectedValueException("unknown purpose (doc_function): '$this->purpose'");
                break;
        }
    }

    /**
     * @return \DateTime
     */
    public function getDateOfIssue() {
        return $this->dateOfIssue;
    }

    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }
}
