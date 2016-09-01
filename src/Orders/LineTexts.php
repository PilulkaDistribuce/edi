<?php
namespace Pilulka\Edi\Orders;

class LineTexts
{
    /**
     * @var LineText[]
     */
    private $texts;

    public function addText(LineText $text)
    {
        $this->texts[] = $text;
    }

    public function fillXml(\SimpleXMLElement $collectionElement)
    {
        foreach ($this->texts as $index => $text) {
            $text->fillXml($index + 1, $collectionElement->addChild("text"));
        }
    }
}


