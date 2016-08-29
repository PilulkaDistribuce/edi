<?php
namespace Pilulka\Edi\Orders;

class MessageHeader
{

    /**
     * @var string
     */
    private $messageId;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var string
     */
    private $receiver;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var bool
     */
    private $testing;

    /**
     * @param string $id
     */
    public function setMessageId($id)
    {
        $maxLength = 15;
        if (strlen($id) > $maxLength) {
            throw new \InvalidArgumentException("length of message id must be <= $maxLength");
        }

        $this->messageId = $id;
    }

    public function setCreationDate(\DateTime $date)
    {
        $this->creationDate = $date;
    }

    /**
     * @param string $receiver
     */
    public function setReceiverGLN($receiver)
    {
        $maxLength = 14;
        if (strlen($receiver) > $maxLength) {
            throw new \InvalidArgumentException("length of receiver GLN must be <= $maxLength");
        }

        $this->receiver = $receiver;
    }

    /**
     * @param string $sender
     */
    public function setSenderGLN($sender)
    {
        $maxLength = 14;
        if (strlen($sender) > $maxLength) {
            throw new \InvalidArgumentException("length of sender GLN must be <= $maxLength");
        }

        $this->sender = $sender;
    }

    /**
     * sets the flag which means message is for testing purposes
     */
    public function setTesting()
    {
        $this->testing = true;
    }

    private function checkMandatoryItems()
    {
        $errorMessage = "";
        if (!$this->creationDate) {
            $errorMessage .= "Creation date is mandatory, use setCreationDate\n";
        }
        if (!$this->receiver) {
            $errorMessage .= "Receiver is mandatory, use setReceiver.\n";
        }
        if (!$this->sender) {
            $errorMessage .= "Sender is mandatory, use setSender.\n";
        }
        if ($errorMessage) {
            throw new \LogicException($errorMessage);
        }
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXml()
    {
        $this->checkMandatoryItems();

        $element = new \SimpleXMLElement("<header></header>");
        $element->addChild("message_type", "ORDERS");
        $element->addChild("version", "3.0.0");
        if ($this->messageId) {
            $element->addChild("message_id", $this->messageId);
        }
        $element->addChild("creation_date", $this->creationDate->format("Y-M-d"));
        $element->addChild("creation_time", $this->creationDate->format("G:i:s"));
        $element->addChild("receiver", $this->receiver);
        $element->addChild("sender", $this->sender);
        if ($this->testing) {
            $element->addChild("test_flat", 1);
        }

        return $element;
    }
}
