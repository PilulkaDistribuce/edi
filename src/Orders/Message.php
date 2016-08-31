<?php
namespace Pilulka\Edi\Orders;

class Message
{
    /**
     * @var MessageHeader
     */
    private $header;

    /**
     * @var Partner
     */
    private $partner;

    /**
     * @var LineItems
     */
    private $lineItems;

    public function __construct(MessageHeader $header, Partner $partner, LineItems $items)
    {
        $this->header = $header;
        $this->partner = $partner;
        $this->lineItems = $items;
    }

    public function setLineTexts(LineTexts $texts)
    {
        $this->texts = $texts;
    }

    public function setSummary(Summary $summary)
    {
        $this->summary = $summary;
    }

    public function getXml()
    {
        $message = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><orion_message></orion_message>");
        $this->header->getXml($message->addChild("header"));
        $bodyElement = $message->addChild("body");
        $this->$bodyElement->addChild("doc_header");
    }
}
