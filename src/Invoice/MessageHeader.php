<?php
namespace Pilulka\Edi\Invoice;

class MessageHeader
{

    /** @var  \SimpleXMLElement */
    private $xml;

    private $docNumber;
    private $docType;
    private $docFunction;
    private $issueDate;
    private $taxDate;
    private $deliveryDate;
    private $dueDate;
    private $paymentMeans;
    private $currencyCode;
    private $registration;
    private $reverseCharge;
    private $orderNumber;
    private $orderNumberDate;
    private $despatchAdviceNumber;

    private $partyList;

    private $requiredParameters = ['doc_number', 'doc_type', 'doc_function', 'issue_date', 'tax_date'];

    /**
     * MessageHeader constructor.
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
        $this->setDocNumber($this->xml->doc_number);
        $this->setDocType($this->xml->doc_type);
        $this->setDocFunction($this->xml->doc_function);
        $this->setIssueDate($this->xml->issue_date);
        $this->setTaxDate($this->xml->tax_date);
        $this->setDeliveryDate($this->xml->delivery_date);
        $this->setDueDate($this->xml->due_date);
        $this->setPaymentMeans($this->xml->payment_means);
        $this->setCurrencyCode($this->xml->currency_code);
        $this->setRegistration($this->xml->registration);
        $this->setReverseCharge($this->xml->reverse_charge);
        $this->setOrderNumber($this->xml->order_number);
        $this->setOrderNumberDate($this->xml->order_number_date);
        $this->setDespatchAdviceNumber($this->xml->despatch_advice_number);

        $this->setPartyList($this->xml->party);
    }

    /**
     * @return mixed
     */
    public function getDocNumber()
    {
        return (string)$this->docNumber;
    }

    /**
     * @return mixed
     */
    public function getDocType()
    {
        return (string)$this->docType;
    }

    /**
     * @return mixed
     */
    public function getDocFunction()
    {
        return (string)$this->docFunction;
    }

    /**
     * @return mixed
     */
    public function getIssueDate()
    {
        return $this->issueDate ? new \DateTime((string)$this->issueDate) : null;
    }

    /**
     * @return mixed
     */
    public function getTaxDate()
    {
        return $this->taxDate ? new \DateTime((string)$this->taxDate) : null;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate ? new \DateTime((string)$this->deliveryDate) : null;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate ? new \DateTime((string)$this->dueDate) : null;
    }

    /**
     * @return mixed
     */
    public function getPaymentMeans()
    {
        return (string)$this->paymentMeans;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return (string)$this->currencyCode;
    }

    /**
     * @return mixed
     */
    public function getRegistration()
    {
        return (string)$this->registration;
    }

    /**
     * @return mixed
     */
    public function getReverseCharge()
    {
        return (string)$this->reverseCharge;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return (string)$this->orderNumber;
    }

    /**
     * @return mixed
     */
    public function getOrderNumberDate()
    {
        return $this->orderNumberDate ? new \DateTime($this->orderNumberDate) : null;
    }

    /**
     * @return mixed
     */
    public function getDespatchAdviceNumber()
    {
        return (string)$this->despatchAdviceNumber;
    }

    /**
     * @param mixed $docNumber
     * @return MessageHeader
     */
    public function setDocNumber($docNumber)
    {
        $this->docNumber = $docNumber;
        return $this;
    }

    /**
     * @param mixed $docType
     * @return MessageHeader
     */
    public function setDocType($docType)
    {
        $this->docType = $docType;
        return $this;
    }

    /**
     * @param mixed $docFunction
     * @return MessageHeader
     */
    public function setDocFunction($docFunction)
    {
        $this->docFunction = $docFunction;
        return $this;
    }

    /**
     * @param mixed $issueDate
     * @return MessageHeader
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @param mixed $taxDate
     * @return MessageHeader
     */
    public function setTaxDate($taxDate)
    {
        $this->taxDate = $taxDate;
        return $this;
    }

    /**
     * @param mixed $deliveryDate
     * @return MessageHeader
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @param mixed $dueDate
     * @return MessageHeader
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param mixed $paymentMeans
     * @return MessageHeader
     */
    public function setPaymentMeans($paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    /**
     * @param mixed $currencyCode
     * @return MessageHeader
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @param mixed $registration
     * @return MessageHeader
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;
        return $this;
    }

    /**
     * @param mixed $reverseCharge
     * @return MessageHeader
     */
    public function setReverseCharge($reverseCharge)
    {
        $this->reverseCharge = $reverseCharge;
        return $this;
    }

    /**
     * @param mixed $orderNumber
     * @return MessageHeader
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * @param mixed $orderNumberDate
     * @return MessageHeader
     */
    public function setOrderNumberDate($orderNumberDate)
    {
        $this->orderNumberDate = $orderNumberDate;
        return $this;
    }

    /**
     * @param mixed $despatchAdviceNumber
     * @return MessageHeader
     */
    public function setDespatchAdviceNumber($despatchAdviceNumber)
    {
        $this->despatchAdviceNumber = $despatchAdviceNumber;
        return $this;
    }

    public function setPartyList($xml)
    {
        foreach ($xml as $party) {
            $this->partyList[] = new Party($party);
        }

        return $this;
    }

    public function getPartyList()
    {
        return $this->partyList;
    }
}
