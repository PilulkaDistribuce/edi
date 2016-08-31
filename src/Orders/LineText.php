<?php
namespace Pilulka\Edi\Orders;

class LineText
{
    private $texts = array();

    public function __construct($text1)
    {
        $this->addText($text1);
    }

    private function addText($text)
    {

        $maxLength = 70;
        if (strlen($text) > $maxLength) {
            throw new \InvalidArgumentException("length of text must be <= $maxLength");
        }
        $this->texts[] = $text;
    }

    public function setText2($text)
    {
        $this->addText($text);
    }

    public function setText3($text)
    {
        $this->addText($text);
    }

    public function setText4($text)
    {
        $this->addText($text);
    }

    public function setText5($text)
    {
        $this->addText($text);
    }

    public function getXml($number, \SimpleXMLElement $element)
    {
        $element->addChild("text_number", $number);
        foreach ($this->texts as $index => $text) {
            $element->addChild("text$index", $text);
        }
    }
}

