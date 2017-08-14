<?php
namespace Pilulka\Edi\DesAdv;

class Header extends \Pilulka\Edi\Message\Header
{

    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        if ((string)$this->getMessageType() != "DESADV") {
            throw new \InvalidArgumentException("it seems that message type isn't DESADV");
        }

    }

}
