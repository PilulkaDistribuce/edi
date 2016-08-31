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

    public function __construct(\DateTime $creationDate, $receiverGLN, $senderGLN)
    {
        $this->creationDate = $creationDate;

        $maxLength = 14;
        if (strlen($receiverGLN) > $maxLength) {
            throw new \InvalidArgumentException("length of receiver GLN must be <= $maxLength");
        }
        $this->receiver = $receiverGLN;

        if (strlen($senderGLN) > $maxLength) {
            throw new \InvalidArgumentException("length of sender GLN must be <= $maxLength");
        }
        $this->sender = $senderGLN;
    }

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

    /**
     * message will be used for the testing
     */
    public function setTesting()
    {
        $this->testing = true;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXml(\SimpleXMLElement $element)
    {
        $element->addChild("message_type", "ORDERS");
        $element->addChild("version", "3.0.0");
        if ($this->messageId) {
            $element->addChild("message_id", $this->messageId);
        }
        $element->addChild("creation_date", $this->creationDate->format("Y-m-d"));
        $element->addChild("creation_time", $this->creationDate->format("G:i:s"));
        $element->addChild("receiver", $this->receiver);
        $element->addChild("sender", $this->sender);
        if ($this->testing) {
            $element->addChild("test_flat", 1);
        }

        return $element;
    }
}
