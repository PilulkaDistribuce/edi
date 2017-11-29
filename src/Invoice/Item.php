<?php


namespace Pilulka\Edi\Invoice;


class Item
{
    /** @var  \SimpleXMLElement */
    private $xml;

    private $itemNumber;
    private $articleGtin;
    private $articleIdSupplier;
    private $articleIdBuyer;
    private $articleIdAdd;
    private $articleName;
    private $itemType;
    private $quantity;
    private $grossPrice;
    private $allowanceRate;
    private $allowanceTotal;
    private $netPrice;
    private $totalPrice;
    private $vatRate;
    private $vatTotal;
    private $totalPriceVat;
    private $unit;
    private $numberOfUnits;
    private $exciseDutyGroup;
    private $exciseDutyBasis;
    private $exciseDuty;
    private $reverseCharge;
    private $countryOfOrigin;
    private $specialCondition;
    private $deliveryDate;
    private $orderNumber;
    private $orderNumberDate;
    private $orderNumberTime;
    private $supplierOrderNumber;
    private $supplierOrderNumberDate;
    private $supplierOrderNumberTime;
    private $despatchAdviceNumber;
    private $despatchAdviceDate;
    private $despatchAdviceTime;
    private $receivingAdviceNumber;
    private $receivingAdviceDate;
    private $receivingAdviceTime;
    private $reclamationNumber;
    private $dateOfReclamation;
    private $previousComdisNumber;
    private $previousComdisDate;
    private $previousComdisTime;
    private $meaningOfReferenceNumber;
    private $referenceNumber;
    private $referenceNumberDate;
    private $referenceNumberTime;
    private $promotionDeal;
    private $packagingsBalance;
    private $packagingsDelivered;
    private $packagingsReturned;
    private $packagingsTypeBalance;
    private $allowancesAndCharges;
    private $party;

    private $requiredParameters = ['item_number', 'article_gtin', 'article_name', 'allowance_total'];

    /**
     * Item constructor.
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
        $this->setItemNumber($this->xml->item_number);
        $this->setArticleGtin($this->xml->article_gtin);
        $this->setArticleIdSupplier($this->xml->article_id_supplier);
        $this->setArticleIdBuyer($this->xml->article_id_buyer);
        $this->setArticleIdAdd($this->xml->article_id_add);
        $this->setArticleName($this->xml->article_name);
        $this->setItemType($this->xml->item_type);
        $this->setQuantity($this->xml->quantity);
        $this->setGrossPrice($this->xml->gross_price);
        $this->setAllowanceRate($this->xml->allowance_rate);
        $this->setAllowanceTotal($this->xml->allowance_total);
        $this->setNetPrice($this->xml->net_price);
        $this->setTotalPrice($this->xml->total_price);
        $this->setVatRate($this->xml->vat_rate);
        $this->setVatTotal($this->xml->vat_total);
        $this->setTotalPriceVat($this->xml->total_price_vat);
        $this->setUnit($this->xml->unit);
        $this->setNumberOfUnits($this->xml->number_of_units);
        $this->setExciseDutyGroup($this->xml->excise_duty_group);
        $this->setExciseDutyBasis($this->xml->excise_duty_basis);
        $this->setExciseDuty($this->xml->excise_duty);
        $this->setReverseCharge($this->xml->reverse_charge);
        $this->setCountryOfOrigin($this->xml->country_of_origin);
        $this->setSpecialCondition($this->xml->special_condition);
        $this->setDeliveryDate($this->xml->delivery_date);
        $this->setOrderNumber($this->xml->order_number);
        $this->setOrderNumberDate($this->xml->order_number_date);
        $this->setOrderNumberTime($this->xml->order_number_time);
        $this->setSupplierOrderNumber($this->xml->supplier_order_numbe);
        $this->setSupplierOrderNumberDate($this->xml->supplier_order_number_date);
        $this->setSupplierOrderNumberTime($this->xml->supplier_order_number_time);
        $this->setDespatchAdviceNumber($this->xml->despatch_advice_number);
        $this->setDespatchAdviceDate($this->xml->despatch_advice_date);
        $this->setDespatchAdviceTime($this->xml->despatch_advice_time);
        $this->setReceivingAdviceNumber($this->xml->receiving_advice_number);
        $this->setReceivingAdviceDate($this->xml->receiving_advice_date);
        $this->setReceivingAdviceTime($this->xml->receiving_advice_time);
        $this->setReclamationNumber($this->xml->reclamation_number);
        $this->setDateOfReclamation($this->xml->date_of_reclamation);
        $this->setPreviousComdisNumber($this->xml->previous_comdis_number);
        $this->setPreviousComdisDate($this->xml->previous_comdis_date);
        $this->setPreviousComdisTime($this->xml->previous_comdis_time);
        $this->setMeaningOfReferenceNumber($this->xml->meaning_of_reference_number);
        $this->setReferenceNumber($this->xml->reference_number);
        $this->setReferenceNumberDate($this->xml->reference_number_date);
        $this->setReferenceNumberTime($this->xml->reference_number_time);
        $this->setPromotionDeal($this->xml->promotion_deal);
        $this->setPackagingsBalance($this->xml->packagings_balance);
        $this->setPackagingsDelivered($this->xml->packagings_delivered);
        $this->setPackagingsReturned($this->xml->packagings_returned);
        $this->setPackagingsTypeBalance($this->xml->packagings_type_balance);
        $this->setAllowancesAndCharges($this->xml->allowances_and_charges);
        $this->setParty($this->xml->party);

    }


    /**
     * @return int
     */
    public function getItemNumber()
    {
        return $this->itemNumber;
    }

    /**
     * @param int $itemNumber
     * @return Item
     */
    public function setItemNumber($itemNumber)
    {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleGtin()
    {
        return $this->articleGtin;
    }

    /**
     * @param string $articleGtin
     * @return Item
     */
    public function setArticleGtin($articleGtin)
    {
        $this->articleGtin = $articleGtin;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleIdSupplier()
    {
        return $this->articleIdSupplier;
    }

    /**
     * @param string $articleIdSupplier
     * @return Item
     */
    public function setArticleIdSupplier($articleIdSupplier)
    {
        $this->articleIdSupplier = $articleIdSupplier;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleIdBuyer()
    {
        return $this->articleIdBuyer;
    }

    /**
     * @param string $articleIdBuyer
     * @return Item
     */
    public function setArticleIdBuyer($articleIdBuyer)
    {
        $this->articleIdBuyer = $articleIdBuyer;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleIdAdd()
    {
        return $this->articleIdAdd;
    }

    /**
     * @param string $articleIdAdd
     * @return Item
     */
    public function setArticleIdAdd($articleIdAdd)
    {
        $this->articleIdAdd = $articleIdAdd;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * @param string $articleName
     * @return Item
     */
    public function setArticleName($articleName)
    {
        $this->articleName = $articleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param string $itemType
     * @return Item
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * @param float $grossPrice
     * @return Item
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getAllowanceRate()
    {
        return $this->allowanceRate;
    }

    /**
     * @param float $allowanceRate
     * @return Item
     */
    public function setAllowanceRate($allowanceRate)
    {
        $this->allowanceRate = $allowanceRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getAllowanceTotal()
    {
        return $this->allowanceTotal;
    }

    /**
     * @param float $allowanceTotal
     * @return Item
     */
    public function setAllowanceTotal($allowanceTotal)
    {
        $this->allowanceTotal = $allowanceTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param float $netPrice
     * @return Item
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return Item
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * @param float $vatRate
     * @return Item
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getVatTotal()
    {
        return $this->vatTotal;
    }

    /**
     * @param float $vatTotal
     * @return Item
     */
    public function setVatTotal($vatTotal)
    {
        $this->vatTotal = $vatTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPriceVat()
    {
        return $this->totalPriceVat;
    }

    /**
     * @param float $totalPriceVat
     * @return Item
     */
    public function setTotalPriceVat($totalPriceVat)
    {
        $this->totalPriceVat = $totalPriceVat;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Item
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return float
     */
    public function getNumberOfUnits()
    {
        return $this->numberOfUnits;
    }

    /**
     * @param float $numberOfUnits
     * @return Item
     */
    public function setNumberOfUnits($numberOfUnits)
    {
        $this->numberOfUnits = $numberOfUnits;
        return $this;
    }

    /**
     * @return string
     */
    public function getExciseDutyGroup()
    {
        return $this->exciseDutyGroup;
    }

    /**
     * @param string $exciseDutyGroup
     * @return Item
     */
    public function setExciseDutyGroup($exciseDutyGroup)
    {
        $this->exciseDutyGroup = $exciseDutyGroup;
        return $this;
    }

    /**
     * @return float
     */
    public function getExciseDutyBasis()
    {
        return $this->exciseDutyBasis;
    }

    /**
     * @param float $exciseDutyBasis
     * @return Item
     */
    public function setExciseDutyBasis($exciseDutyBasis)
    {
        $this->exciseDutyBasis = $exciseDutyBasis;
        return $this;
    }

    /**
     * @return float
     */
    public function getExciseDuty()
    {
        return $this->exciseDuty;
    }

    /**
     * @param float $exciseDuty
     * @return Item
     */
    public function setExciseDuty($exciseDuty)
    {
        $this->exciseDuty = $exciseDuty;
        return $this;
    }

    /**
     * @return string
     */
    public function getReverseCharge()
    {
        return $this->reverseCharge;
    }

    /**
     * @param string $reverseCharge
     * @return Item
     */
    public function setReverseCharge($reverseCharge)
    {
        $this->reverseCharge = $reverseCharge;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param string $countryOfOrigin
     * @return Item
     */
    public function setCountryOfOrigin($countryOfOrigin)
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecialCondition()
    {
        return $this->specialCondition;
    }

    /**
     * @param string $specialCondition
     * @return Item
     */
    public function setSpecialCondition($specialCondition)
    {
        $this->specialCondition = $specialCondition;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime $deliveryDate
     * @return Item
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     * @return Item
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderNumberDate()
    {
        return $this->orderNumberDate;
    }

    /**
     * @param \DateTime $orderNumberDate
     * @return Item
     */
    public function setOrderNumberDate($orderNumberDate)
    {
        $this->orderNumberDate = $orderNumberDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderNumberTime()
    {
        return $this->orderNumberTime;
    }

    /**
     * @param mixed $orderNumberTime
     * @return Item
     */
    public function setOrderNumberTime($orderNumberTime)
    {
        $this->orderNumberTime = $orderNumberTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupplierOrderNumber()
    {
        return $this->supplierOrderNumber;
    }

    /**
     * @param mixed $supplierOrderNumber
     * @return Item
     */
    public function setSupplierOrderNumber($supplierOrderNumber)
    {
        $this->supplierOrderNumber = $supplierOrderNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupplierOrderNumberDate()
    {
        return $this->supplierOrderNumberDate;
    }

    /**
     * @param mixed $supplierOrderNumberDate
     * @return Item
     */
    public function setSupplierOrderNumberDate($supplierOrderNumberDate)
    {
        $this->supplierOrderNumberDate = $supplierOrderNumberDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupplierOrderNumberTime()
    {
        return $this->supplierOrderNumberTime;
    }

    /**
     * @param mixed $supplierOrderNumberTime
     * @return Item
     */
    public function setSupplierOrderNumberTime($supplierOrderNumberTime)
    {
        $this->supplierOrderNumberTime = $supplierOrderNumberTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDespatchAdviceNumber()
    {
        return $this->despatchAdviceNumber;
    }

    /**
     * @param mixed $despatchAdviceNumber
     * @return Item
     */
    public function setDespatchAdviceNumber($despatchAdviceNumber)
    {
        $this->despatchAdviceNumber = $despatchAdviceNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDespatchAdviceDate()
    {
        return $this->despatchAdviceDate;
    }

    /**
     * @param mixed $despatchAdviceDate
     * @return Item
     */
    public function setDespatchAdviceDate($despatchAdviceDate)
    {
        $this->despatchAdviceDate = $despatchAdviceDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDespatchAdviceTime()
    {
        return $this->despatchAdviceTime;
    }

    /**
     * @param mixed $despatchAdviceTime
     * @return Item
     */
    public function setDespatchAdviceTime($despatchAdviceTime)
    {
        $this->despatchAdviceTime = $despatchAdviceTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivingAdviceNumber()
    {
        return $this->receivingAdviceNumber;
    }

    /**
     * @param mixed $receivingAdviceNumber
     * @return Item
     */
    public function setReceivingAdviceNumber($receivingAdviceNumber)
    {
        $this->receivingAdviceNumber = $receivingAdviceNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivingAdviceDate()
    {
        return $this->receivingAdviceDate;
    }

    /**
     * @param mixed $receivingAdviceDate
     * @return Item
     */
    public function setReceivingAdviceDate($receivingAdviceDate)
    {
        $this->receivingAdviceDate = $receivingAdviceDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivingAdviceTime()
    {
        return $this->receivingAdviceTime;
    }

    /**
     * @param mixed $receivingAdviceTime
     * @return Item
     */
    public function setReceivingAdviceTime($receivingAdviceTime)
    {
        $this->receivingAdviceTime = $receivingAdviceTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReclamationNumber()
    {
        return $this->reclamationNumber;
    }

    /**
     * @param mixed $reclamationNumber
     * @return Item
     */
    public function setReclamationNumber($reclamationNumber)
    {
        $this->reclamationNumber = $reclamationNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateOfReclamation()
    {
        return $this->dateOfReclamation;
    }

    /**
     * @param mixed $dateOfReclamation
     * @return Item
     */
    public function setDateOfReclamation($dateOfReclamation)
    {
        $this->dateOfReclamation = $dateOfReclamation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousComdisNumber()
    {
        return $this->previousComdisNumber;
    }

    /**
     * @param mixed $previousComdisNumber
     * @return Item
     */
    public function setPreviousComdisNumber($previousComdisNumber)
    {
        $this->previousComdisNumber = $previousComdisNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousComdisDate()
    {
        return $this->previousComdisDate;
    }

    /**
     * @param mixed $previousComdisDate
     * @return Item
     */
    public function setPreviousComdisDate($previousComdisDate)
    {
        $this->previousComdisDate = $previousComdisDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousComdisTime()
    {
        return $this->previousComdisTime;
    }

    /**
     * @param mixed $previousComdisTime
     * @return Item
     */
    public function setPreviousComdisTime($previousComdisTime)
    {
        $this->previousComdisTime = $previousComdisTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeaningOfReferenceNumber()
    {
        return $this->meaningOfReferenceNumber;
    }

    /**
     * @param mixed $meaningOfReferenceNumber
     * @return Item
     */
    public function setMeaningOfReferenceNumber($meaningOfReferenceNumber)
    {
        $this->meaningOfReferenceNumber = $meaningOfReferenceNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $referenceNumber
     * @return Item
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumberDate()
    {
        return $this->referenceNumberDate;
    }

    /**
     * @param mixed $referenceNumberDate
     * @return Item
     */
    public function setReferenceNumberDate($referenceNumberDate)
    {
        $this->referenceNumberDate = $referenceNumberDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumberTime()
    {
        return $this->referenceNumberTime;
    }

    /**
     * @param mixed $referenceNumberTime
     * @return Item
     */
    public function setReferenceNumberTime($referenceNumberTime)
    {
        $this->referenceNumberTime = $referenceNumberTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPromotionDeal()
    {
        return $this->promotionDeal;
    }

    /**
     * @param mixed $promotionDeal
     * @return Item
     */
    public function setPromotionDeal($promotionDeal)
    {
        $this->promotionDeal = $promotionDeal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackagingsBalance()
    {
        return $this->packagingsBalance;
    }

    /**
     * @param mixed $packagingsBalance
     * @return Item
     */
    public function setPackagingsBalance($packagingsBalance)
    {
        $this->packagingsBalance = $packagingsBalance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackagingsDelivered()
    {
        return $this->packagingsDelivered;
    }

    /**
     * @param mixed $packagingsDelivered
     * @return Item
     */
    public function setPackagingsDelivered($packagingsDelivered)
    {
        $this->packagingsDelivered = $packagingsDelivered;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackagingsReturned()
    {
        return $this->packagingsReturned;
    }

    /**
     * @param mixed $packagingsReturned
     * @return Item
     */
    public function setPackagingsReturned($packagingsReturned)
    {
        $this->packagingsReturned = $packagingsReturned;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPackagingsTypeBalance()
    {
        return $this->packagingsTypeBalance;
    }

    /**
     * @param mixed $packagingsTypeBalance
     * @return Item
     */
    public function setPackagingsTypeBalance($packagingsTypeBalance)
    {
        $this->packagingsTypeBalance = $packagingsTypeBalance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowancesAndCharges()
    {
        return $this->allowancesAndCharges;
    }

    /**
     * @param mixed $allowancesAndCharges
     * @return Item
     */
    public function setAllowancesAndCharges($allowancesAndCharges)
    {
        $this->allowancesAndCharges = $allowancesAndCharges;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * @param mixed $party
     * @return Item
     */
    public function setParty($party)
    {
        $this->party = $party ? new Party($party) : null;
        return $this;
    }


}