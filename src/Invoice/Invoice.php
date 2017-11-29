<?php

namespace Pilulka\Edi\Invoice;

class Invoice
{
    /**
     * @var \SimpleXMLElement
     */
    private $xmlMessage;

    public function __construct(\SimpleXMLElement $xml = null)
    {
        $this->xmlMessage = $xml;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return new Header($this->xmlMessage->header);
    }

    /**
     * @return MessageHeader
     */
    public function getMessageHeader()
    {
        return new MessageHeader($this->xmlMessage->body->message_header);
    }

    /**
     * @return Item[]
     */
    public function getLineItems()
    {
        $return = [];

        foreach ($this->xmlMessage->body->line_items->item as $item){
            $return[] = new Item($item);
        }

        return $return;
    }

    public function getSummary()
    {
        return new Summary($this->xmlMessage->body->summary);
    }
}