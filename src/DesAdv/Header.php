<?php
namespace Pilulka\Edi\DesAdv;

class Header
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
    private $testing = false;

    public function __construct(\SimpleXMLElement $xml)
    {
        if ((string)$xml->message_type != "DESADV") {
            throw new \InvalidArgumentException("it seems that message type isn't DESADV");
        }

        if (!($creationDate = (string)$xml->creation_date) || !($creationTime = (string)$xml->creation_time)) {
            throw new \InvalidArgumentException("creation_date or creation_time aren't presented");
        }
        $this->creationDate = new \DateTime($creationDate . " " . $creationTime);

        if (!($receiver = (string)$xml->receiver)) {
            throw new \InvalidArgumentException("receiver isn't presented");
        }
        $this->receiver = $receiver;

        if (!($sender = (string)$xml->sender)) {
            throw new \InvalidArgumentException("sender isn't presented");
        }
        $this->sender = $sender;

        if ($xml->message_id) {
            $this->messageId = (string)$xml->message_id;
        }
        if ($xml->test_flag) {
            $this->testing = (bool)$xml->test_flag;
        }
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return bool
     */
    public function isTesting() {
        return $this->testing;
    }
}
