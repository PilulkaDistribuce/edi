<?php

namespace Pilulka\Edi\Invoice;

class Header extends \Pilulka\Edi\Message\Header
{

    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        if ((string)$this->getMessageType() != "INVOIC") {
            throw new \InvalidArgumentException("it seems that message type isn't INVOIC");
        }

    }

}
