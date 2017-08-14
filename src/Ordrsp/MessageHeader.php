<?php


namespace Pilulka\Edi\Ordrsp;


class MessageHeader
{
    private $doc_type;
    private $doc_number;
    private $doc_function;
    private $doc_date_of_issue;
    private $doc_time_of_issue;
    private $delivery_type;
    private $delivery_date;
    private $order_number;
    private $order_number_date;
    private $party;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->verification($xml);

        $this->doc_type = (int)$xml->doc_type;
        $this->doc_number = (string)$xml->doc_number;
        $this->doc_function = (int)$xml->doc_function;
        $this->doc_date_of_issue = new \DateTime($xml->doc_date_of_issue . " " . $xml->doc_time_of_issue);
        $this->delivery_type = (int)$xml->delivery_type;
        $this->delivery_date = new \DateTime($xml->delivery_date);
        $this->order_number = (string)$xml->order_number;
        $this->order_number_date = new \DateTime($xml->order_number_date);
        $this->party = (array)$xml->party;
    }


    private function verification($xml)
    {
        if(!isset($xml->doc_type)) {
            throw new \InvalidArgumentException("doc_type isn't presented");
        }
        if(!isset($xml->doc_number)) {
            throw new \InvalidArgumentException("doc_number isn't presented");
        }
        if(!isset($xml->doc_function)) {
            throw new \InvalidArgumentException("doc_function isn't presented");
        }
        if(!isset($xml->doc_date_of_issue)) {
            throw new \InvalidArgumentException("doc_date_of_issue isn't presented");
        }
        if(!isset($xml->doc_time_of_issue)) {
            throw new \InvalidArgumentException("doc_time_of_issue isn't presented");
        }
        if(!isset($xml->delivery_type)) {
            throw new \InvalidArgumentException("delivery_type isn't presented");
        }
        if(!isset($xml->delivery_date)) {
            throw new \InvalidArgumentException("delivery_date isn't presented");
        }
        if(!isset($xml->order_number)) {
            throw new \InvalidArgumentException("order_number isn't presented");
        }
        if(!isset($xml->order_number_date)) {
            throw new \InvalidArgumentException("order_number_date isn't presented");
        }
        if(!isset($xml->party)) {
            throw new \InvalidArgumentException("party isn't presented");
        }

    }

    /**
     * @return mixed
     */
    public function getDocType()
    {
        return $this->doc_type;
    }

    /**
     * @return mixed
     */
    public function getDocNumber()
    {
        return $this->doc_number;
    }

    /**
     * @return mixed
     */
    public function getDocFunction()
    {
        return $this->doc_function;
    }

    /**
     * @return mixed
     */
    public function getDocDateOfIssue()
    {
        return $this->doc_date_of_issue;
    }

    /**
     * @return mixed
     */
    public function getDocTimeOfIssue()
    {
        return $this->doc_time_of_issue;
    }

    /**
     * @return mixed
     */
    public function getDeliveryType()
    {
        return $this->delivery_type;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * @return mixed
     */
    public function getOrderNumberDate()
    {
        return $this->order_number_date;
    }

    /**
     * @return mixed
     */
    public function getParty()
    {
        return $this->party;
    }


}