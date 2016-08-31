<?php
namespace Pilulka\Edi\Orders;

class Message
{
    /**
     * @var MessageHeader
     */
    private $header;

    /**
     * @var DocumentHeader
     */
    private $documentHeader;

    /**
     * @var LineItems
     */
    private $lineItems;

    public function __construct(MessageHeader $header, DocumentHeader $documentHeader, LineItems $items)
    {
        $this->header = $header;
        $this->documentHeader = $documentHeader;
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
        $this->documentHeader->getXml($bodyElement->addChild("doc_header"));
    }
}
