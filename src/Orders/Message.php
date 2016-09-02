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

    /**
     * @var LineTexts
     */
    private $texts;

    /**
     * @var Summary
     */
    private $summary;

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

    /**
     * @return \SimpleXMLElement
     */
    public function getXml()
    {
        $message = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\"?><orion_message></orion_message>");
        $this->header->fillXml($message->addChild("header"));
        $bodyElement = $message->addChild("body");
        $this->documentHeader->fillXml($bodyElement->addChild("doc_header"));
        $this->lineItems->fillXml($bodyElement->addChild("line_items"));
        if ($this->texts) {
            $this->texts->fillXml($bodyElement->addChild("line_texts"));
        }
        if ($this->summary) {
            $this->summary->fillXml($bodyElement->addChild("summary"));
        }
        return $message;
    }
}
